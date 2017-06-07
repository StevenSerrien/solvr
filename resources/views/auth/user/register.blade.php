@extends('layouts.app')

@section('content')
<div class="container container--signup-clients" ng-controller='UserAuthCtrl as auth'>
  <div class="row">
  <div class="form-block form-block--contact-signup small-centered large-8 columns">
    <div class="row">
      <div class="large-12 columns" >

        <form name='userSignupForm' method='POST' action="{{ url('/register') }}" class='form-block__inner' >
          {{ csrf_field() }}
          <div class="row">
            <div class="large-12 columns">

              <h2 class='t--semi-bold text-center'>Registratie voor <span class='highlight highlight--color-1'>clientjes</span> </h2>
              <h3 class='t--regular t--lightest m-b-60 text-center'>Vul jouw gegevens in </h3>
            </div>
          </div>


          <div class="row">
            <div class="medium-6 columns">
                <input class='input--stnrd {{ $errors->has('firstname') ? ' error' : '' }}'  type="text" name='firstname' ng-init="auth.userRegister.firstname='{{ old('firstname') }}'" ng-model='auth.userRegister.firstname' placeholder="Voornaam" autocomplete="off" required >
            </div>
            <div class="medium-6 columns">
                <input class='input--stnrd {{ $errors->has('lastname') ? ' error' : '' }}' type="text"  name='lastname' ng-init="auth.userRegister.lastname='{{ old('lastname') }}'" ng-model='auth.userRegister.lastname' placeholder="Achternaam" autocomplete="off" required>
            </div>
            <div class="medium-12 columns">
                <input class='input--stnrd {{ $errors->has('email') ? ' error' : '' }}' type="email"  name='email' ng-init="auth.userRegister.email='{{ old('email') }}'" ng-model='auth.userRegister.email' placeholder="E-mail" autocomplete="off" required>
            </div>
          </div>
          <div class="row m-t-20">
            <div class="medium-6 columns">
                <input class='input--stnrd {{ $errors->has('password') ? ' error' : '' }}' name='password'  ng-model='auth.userRegister.password' type="password" placeholder="Wachtwoord" autocomplete="off" required >
            </div>
            <div class="medium-6 columns">
                <input class='input--stnrd {{ $errors->has('password') ? ' error' : '' }}'  data-match='auth.userRegister.password' ng-model='auth.userRegister.confirmPassword' type="password"  placeholder="Bevestig wachtwoord" autocomplete="off" required >
            </div>
          </div>
          <div class="row">
            <div class="large-12 columns">
              <div class="response-container">
                <div class="error-block callout {{ $errors ? 'error-block--slide-in' : '' }}" ng-class="{'error-block--slide-in': contact.state.response.status == 'error'}">
                  <span class="error-block__message">{{ $errors->first() }}</span>
                </div>
              </div>
            </div>
          </div>

          <div class="row m-t-20">
            <div class="medium-12 columns">
            <button class='btn btn--frm btn--block' ng-disabled='userSignupForm.$invalid' type="submit" >registreer mij</button>
          </div>
          </div>

        </form>
      </div>
    </div>

    </div>
</div>


</div>
<div class="bg bg--signup-clients ">
</div>
<div class="bottom-right-button">
 <a class='btn-help' href="{{route('user.login.show')}}" target="_self">Heb je al een account?</a>
</div>
<div class="bottom-left-button">

</div>
{{-- <div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Register</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/register') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Name</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Register
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> --}}
@endsection
