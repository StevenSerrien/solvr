@extends('layouts.app')

@section('content')
<div class="container container--signup-clients" ng-controller='UserAuthCtrl as auth'>
  <div class="row">
  <div class="form-block form-block--contact-signup small-centered large-8 columns">
    <div class="row">
      <div class="large-12 columns" >

        <form name='userLoginForm' method='POST' action="{{ url('/login') }}" class='form-block__inner' >
          {{ csrf_field() }}
          <div class="row">
            <div class="large-12 columns">

              <h2 class='t--semi-bold text-center'>Cool! Welkom <span class='highlight highlight--color-1'>terug</span> </h2>
              <h3 class='t--regular t--lightest m-b-60 text-center'>Log hier in </h3>
            </div>
          </div>

          <div class="row">
            <div class="large-8 small-centered columns">
              <div class="row">
                <div class="medium-12 columns">
                    <input class='input--stnrd {{ $errors->has('email') ? ' error' : '' }}' type="email"  name='email' ng-init="auth.userLogin.email='{{ old('email') }}'" ng-model='auth.userLogin.email' placeholder="Je e-mailadres" autocomplete="off" required>
                </div>
              </div>
              <div class="row m-t-20">
                <div class="medium-12 columns">
                    <input class='input--stnrd {{ $errors->has('password') ? ' error' : '' }}' name='password'  ng-model='auth.userRegister.password' type="password" placeholder="Je wachtwoord" autocomplete="off" required >
                </div>
              </div>
              <div class="row">
                <div class="medium-12 columns">
                  <div class="response-container">
                    <div class="error-block callout {{ $errors ? 'error-block--slide-in' : '' }}" ng-class="{'error-block--slide-in': contact.state.response.status == 'error'}">
                      <span class="error-block__message">{{ $errors->first() }}</span>
                    </div>
                  </div>
                </div>
              </div>

              <div class="row m-t-20">
                <div class="medium-12 columns">
                <button class='btn btn--frm btn--block' ng-disabled='userLoginForm.$invalid' type="submit" >inloggen</button>
              </div>
              </div>
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
 <a class='btn-help' href="{{route('user.register.show')}}" target="_self">Nog geen account?</a>
</div>
<div class="bottom-left-button">

</div>

@endsection
