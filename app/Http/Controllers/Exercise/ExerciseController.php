<?php

namespace App\Http\Controllers\Exercise;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category\Category;
use Illuminate\Support\Facades\Auth;
use App\Models\Age\Age;
use App\Models\Exercise\Exercise;
use App\Models\Color\Color;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Validator;
use App\Models\Question\Question;
use App\Models\Answer\Answer;

class ExerciseController extends Controller
{
  public function index() {
    $categories = Category::all();
    return view('practitioner.exercises.main')->with('categories', $categories);;
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
      $newExercise->age_id = $selectedAgeRangeID;
      $newExercise->subcategory_id = $selectedSubCategoryID;

      $newExercise->save();
      // return $newExercise->id;

      $valid = false;
      foreach ($questions as $question) {

        $valid = false;
        $newQuestion = new Question();
        $newQuestion->question = $question['question'];
        $newQuestion->exercise_id = $newExercise->id;
        $newQuestion->save();

        $answer = new Answer();
        $answer->answer = $question['answer'];
        $answer->isCorrect = true;
        $answer->question_id = $newQuestion->id;
        $answer->save();

        if ($answer && $question) {
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
}
