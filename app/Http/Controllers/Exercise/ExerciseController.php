<?php

namespace App\Http\Controllers\Exercise;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category\Category;
use Illuminate\Support\Facades\Auth;
use App\Models\Age\Age;
use App\Models\Exercise\Exercise;
use App\Models\Practitioner\Practitioner;
use App\Models\Color\Color;
use App\Models\Subcategory\Subcategory;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Validator;
use App\Models\Question\Question;
use App\Models\Answer\Answer;
use App\User;
use App\Notifications\newExerciseCreatedForColleagues;
use App\Notifications\ExerciseMadeByUser;


class ExerciseController extends Controller
{
  public function index() {
    $categories = Category::all();
    $practitionerID = Auth::guard('practitioner')->user()->id;
    $practiceID = Auth::guard('practitioner')->user()->practice->id;


    // $users = App\User::with(['posts' => function ($query) { $query->where('title', 'like', '%first%'); }])->get();
    $exercisesByPractitioner = Exercise::where('practitioner_id', $practitionerID)->with('practitioner')->with(['subcategory' => function ($query) { $query->with('category'); }])->with('questions')->with('color')->get();
    $exercisesByColleagues = Exercise::where('practitioner_id', '!=', $practitionerID)->with('practitioner')->with(['practice' => function ($query) use ($practiceID) {$query->where('id', $practiceID); }])->get();


    // return $exercises->get();
    return view('practitioner.exercises.main')->with('categories', $categories)->with('exercisesByPractitioner', $exercisesByPractitioner)->with('exercisesByColleagues', $exercisesByColleagues);

    // $users = App\User::whereHas(
    //     'posts', function ($query) {
    //         $query->where('title', 'like', '%first%');
    //     }
    // )
    // ->with('posts')
    // ->get();

  }

  public function checkExerciseCode(Request $request) {
    $codeArray = $request->all();

    $codeString = '';
    if (count($codeArray) < 4) {

      $returnData = array(
        'status' => 'error',
        'message' => 'Oopsie, je moet een volledige code invullen. Kijk even na als je kan!',
      );
      return response()->json($returnData, 500);

    }
    if (count($codeArray) == 4) {
      foreach ($codeArray as $key => $value) {
        // $codeString = $value->character;
        $newCharacter = $value['character'];
        $codeString = $codeString . $newCharacter;

      }
      $exercise = Exercise::where('code', $codeString)->first();
      if (!$exercise) {
        $returnData = array(
          'status' => 'error',
          'message' => 'Oopsie, niets gevonden. Kijk de code na.',
        );
        return response()->json($returnData, 500);
      }
      else {
        $returnData = array(
          'status' => 'success',
          'message' => 'Oefening gevonden!',
          'code' => $codeString,
        );
        return response()->json($returnData, 200);
      }
    }


  }

  public function showMake($category_id, $slug=null) {
    $agesRanges = Age::all();

    try {
      $category = Category::findorFail($category_id);
    } catch (Exception $e) {
      return redirect('/');
    }

    if ($slug !== str_slug($category->name)) {
      return redirect(action('Exercise\ExerciseController@showMake', ['category_id' => $category->id, 'slug' => str_slug($category->name)]), 301);
    }
    return view('practitioner.exercises.make')->with('category', $category)->with('ageRanges', $agesRanges);
  }

  public function createNew(Request $request) {

    // Get ID from practitioner that wants to make excercise
    $practitionerID = Auth::guard('practitioner')->user()->id;
    $practiceID = Auth::guard('practitioner')->user()->practice->id;

    // Get other practitioners that are linked to the practitioner trying to make an exercise


    // return $practicePractitioners;
    // Find ID for Color code given
    $color = Color::where('code', 'like', '%' . $request->selectedColor . '%')->first();
    $exercise = $request->exercise;
    $questions = $request->questions;

    // return $exercise['name'];
    $selectedColorID = $color->id;
    $selectedAgeRangeID = $request->selectedAgeRange;
    $selectedSubCategoryID = $request->selectedSubCategoryID;

    if ($exercise) {
      $exerciseValidator = Validator::make($exercise, [
        'title' => 'required|min:3',
        'description' => 'required|min:3',
      ]);

      if ($exerciseValidator->fails()) {
        $returnData = array(
          'status' => 'error',
          'message' => 'Kijk je titel en beschrijving van je oefening na!',
          'error' => $exerciseValidator->errors(),
        );
        return response()->json($returnData, 500);
      }



      $newExercise = new Exercise();
      $newExercise->title = $exercise['title'];
      $newExercise->description = $exercise['description'];
      $newExercise->practitioner_id = $practitionerID;
      $newExercise->practice_id = $practiceID;
      $newExercise->age_id = $selectedAgeRangeID;
      $newExercise->color_id = $selectedColorID;
      $newExercise->subcategory_id = $selectedSubCategoryID;

      // Create unique CODE to link with exercises
      $newExercise->code = str_random(4);

      $newExercise->save();


      // Notification
      $otherPracticePractitioners = Practitioner::where('id', '!=', $practitionerID)->with(['practice' => function($query) use($practiceID) { $query->where('id', $practiceID); }])->get();
      $exerciseSaved = Exercise::where('id', $newExercise->id)->with(['subcategory' => function ($query) { $query->with('category'); }])->with('practitioner')->first();


      foreach ($otherPracticePractitioners as $practitioner) {

        $practitioner->notify(new newExerciseCreatedForColleagues($exerciseSaved));
      }
      // Notification


      $valid = false;
      foreach ($questions as $question) {

        $valid = false;
        $newQuestion = new Question();
        $newQuestion->question = $question['question'];
        $newQuestion->exercise_id = $newExercise->id;
        $newQuestion->save();




        foreach ($question['answers'] as $key => $value) {

          $valid = false;

          $answer = new Answer();
          $answer->answer = $value;
          $answer->question_id = $newQuestion->id;

          if ($key == 'correct') {
            $answer->isCorrect = true;
          }
          else if ($key == 'false') {
            $answer->isCorrect = false;
          }

          $answer->save();

          if ($answer) {
            $valid = true;
          }
        }


        if ($answer && $newQuestion) {
          $valid = true;
        }
        }



      // Show if all answers and questions are saved to Database
      if ($valid) {
        $returnData = array(
          'status' => 'success',
          'message' => 'Je oefening is aangemaakt!',
        );
        return response()->json($returnData, 200);
      };


    }

  }

  public function submitExerciseForm(Request $request) {


    $exerciseid = $request->exerciseid;
    $answers = $request->answers;

    $client = Auth::guard('web')->user();
    $practitionerToNotify = Auth::guard('web')->user()->practitioner;





    $exercise = Exercise::where('id', $exerciseid)->with(['subcategory' => function ($query) { $query->with('category'); }])->with(['questions' => function ($query) { $query->with('answers'); }])->first();


    foreach ($exercise->questions as $key => $question) {
      $question->answerGiven = $answers[$key];
    }

    // return $exercise;

    // Check if user already solved the exercise
    $relationshipExists = $exercise->users()->where('user_id', $client->id)->exists();
    if (!$relationshipExists) {
      // Attach to many to many with exercisestable to check how many exercises user has done
      $exercise->users()->attach($client->id);

      // Notify linked practitioner that user made the exercise
      $practitionerToNotify->notify(new ExerciseMadeByUser($exercise, $practitionerToNotify, $client));

      return redirect()->back()->with('successMessage', 'Goed gedaan!');
    }







  }
}
