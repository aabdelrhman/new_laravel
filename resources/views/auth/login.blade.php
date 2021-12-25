@extends('frontLayouts.master')
@section('title')
    {{ __('messages.Admins title') }}
@endsection
@section('main')

<div class="wrap-breadcrumb">
    <ul>
        <li class="item-link"><a href="{{ Route('Front.index') }}" class="link">home</a></li>
        <li class="item-link"><span>{{ __('Login') }}</span></li>
    </ul>
</div>
<div class="row">
    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12 col-md-offset-3">
        <div class=" main-content-area">
            <div class="wrap-login-item ">
                <div class="login-form form-item form-stl">
                    <form name="frm-login" method="POST" action="{{ route('login') }}">
                        @csrf
                        <fieldset class="wrap-title">
                            <h3 class="form-title">Log in to your account</h3>
                        </fieldset>
                        <fieldset class="wrap-input">
                            <label for="frm-login-uname">{{ __('E-Mail Address') }}</label>
                            <input type="text" id="frm-login-uname" name="email" placeholder="Type your email address">
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong class="text-danger">{{ $message }}</strong>
                                </span>
                            @enderror
                        </fieldset>
                        <fieldset class="wrap-input">
                            <label for="frm-login-pass">{{ __('Password') }}</label>
                            <input type="password" id="frm-login-pass" name="password" placeholder="************">
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong class="text-danger">{{ $message }}</strong>
                                </span>
                            @enderror
                        </fieldset>

                        <fieldset class="wrap-input">
                            <label class="remember-field">
                                <input class="frm-input " name="remember" id="rememberme" value="forever" type="checkbox"><span>{{ __('Remember Me') }}</span>
                            </label>
                            {{-- <a class="link-function left-position" href="{{ route('password.request') }}" title="Forgotten password?">{{ __('Forgot Your Password?') }}</a> --}}
                        </fieldset>
                        <input type="submit" class="btn btn-submit" value="{{ __('Login') }}" name="submit">
                    </form>
                </div>
            </div>
        </div><!--end main products area-->
    </div>
</div><!--end row-->

@endsection
