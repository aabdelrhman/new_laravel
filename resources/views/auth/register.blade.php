@extends('frontLayouts.master')
@section('title')
    {{ __('messages.Admins title') }}
@endsection
@section('main')

			<div class="wrap-breadcrumb">
				<ul>
					<li class="item-link"><a href="#" class="link">home</a></li>
					<li class="item-link"><span>Register</span></li>
				</ul>
			</div>
			<div class="row">
				<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12 col-md-offset-3">
					<div class=" main-content-area">
						<div class="wrap-login-item ">
							<div class="register-form form-item ">
								<form class="form-stl" action="{{ route('register') }}" name="frm-login" method="POST" >
                                    @csrf
									<fieldset class="wrap-title">
										<h3 class="form-title">Create an account</h3>
										<h4 class="form-subtitle">Personal infomation</h4>
									</fieldset>
									<fieldset class="wrap-input">
										<label for="frm-reg-lname">{{ __('Name') }}</label>
										<input type="text" id="frm-reg-lname" name="name" placeholder="Last name*">
										@error('name')
											<span class="invalid-feedback" role="alert">
												<strong class="text-danger">{{ $message }}</strong>
											</span>
										@enderror
									</fieldset>
									<fieldset class="wrap-input">
										<label for="frm-reg-email">{{ __('E-Mail Address') }}</label>
										<input type="email" id="frm-reg-email" name="email" placeholder="Email address">
										@error('email')
											<span class="invalid-feedback" role="alert">
												<strong class="text-danger">{{ $message }}</strong>
											</span>
										@enderror
									</fieldset>
									<fieldset class="wrap-input item-width-in-half left-item ">
										<label for="frm-reg-pass">{{ __('Password') }}</label>
										<input type="password" id="frm-reg-pass" name="password" placeholder="Password">
										@error('password')
											<span class="invalid-feedback" role="alert">
												<strong class="text-danger">{{ $message }}</strong>
											</span>
										@enderror
									</fieldset>
									<fieldset class="wrap-input item-width-in-half ">
										<label for="frm-reg-cfpass">{{ __('Confirm Password') }}</label>
										<input type="password" id="frm-reg-cfpass" name="password_confirmation" placeholder="Confirm Password">
									</fieldset>
									<input type="submit" class="btn btn-sign" value="{{ __('Register') }}" name="register">
								</form>
							</div>
						</div>
					</div><!--end main products area-->
				</div>
			</div>

@endsection
