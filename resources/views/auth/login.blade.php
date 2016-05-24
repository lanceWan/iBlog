@extends('layouts.login')

@section('content')
@if (isset($errors) && count($errors) > 0 )
<div class="alert alert-danger">
    @foreach($errors->all() as $error)
        <span class="help-block"><strong>{{ $error }}</strong></span>
    @endforeach
</div>
@endif
<form class="login-form" action="{{url('/login')}}" method="post">
    {!! csrf_field() !!}
    <h3 class="form-title">Sign In</h3>
    
    <div class="form-group">
        <label class="control-label visible-ie8 visible-ie9">{{trans('auth.'.env('LOGIN_FIELD', 'email'))}}</label>
        <input class="form-control form-control-solid placeholder-no-fix" type="text" placeholder="{{env('LOGIN_FIELD', 'email')}}" name="{{env('LOGIN_FIELD', 'email')}}" value="{{old(env('LOGIN_FIELD', 'email'))}}" /> </div>
    <div class="form-group">
        <label class="control-label visible-ie8 visible-ie9">{{trans('auth.password')}}</label>
        <input class="form-control form-control-solid placeholder-no-fix" type="password" placeholder="Password" name="password" /> 
    </div>
    <div class="form-group">
        <label class="control-label visible-ie8 visible-ie9">{{trans('auth.captcha')}}</label>
        <div class="input-group">
            <input id="newpassword" class="form-control" type="text" name="captcha" placeholder="captcha">
            <span class="input-group-btn">
                <img style="cursor: pointer;" src="{{captcha_src()}}" onclick="this.src='{{captcha_src()}}' + Math.random()">
            </span>
        </div>
    </div>
    <div class="form-actions">
        <button type="submit" class="btn green uppercase">{{trans('auth.login')}}</button>
        <label class="rememberme check">
            <input type="checkbox" name="remember" value="1" />{{trans('auth.remember')}}</label>
        <a href="javascript:;" id="forget-password" class="forget-password">Forgot Password?</a>
    </div>
    <div class="create-account">
        <p>
            <a href="javascript:;" id="register-btn" class="uppercase">Create an account</a>
        </p>
    </div>
</form>
@endsection
