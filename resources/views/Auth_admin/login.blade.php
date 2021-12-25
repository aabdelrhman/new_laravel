<!DOCTYPE html>
<html lang="{{LaravelLocalization::getCurrentLocale()}}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('assets/css/plugins/bootstrap.min.css') }}">
    <title>{{__('messages.Log in')}}</title>
</head>
<body style="direction: {{LaravelLocalization::getCurrentLocaleDirection()}}">
    <section class="vh-100" style="background-color: #508bfc;">
        <div class="container py-5 h-100">
          <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-12 col-md-8 col-lg-6 col-xl-5">
              <div class="card shadow-2-strong" style="border-radius: 1rem;">
                <div class="card-body p-5 text-center">

                  <h3 class="mb-5">{{__('messages.Login gaurd admin')}}</h3>
                  @if (Session::has('message'))
                      <div class="alert alert-danger">{{ Session::get('message') }}</div>
                  @endif

                  {{-- Email --}}
                <form action="{{ Route('adminLogin') }}" method="post">
                    @csrf
                    <div class="form-outline mb-4">
                        <label class="form-label" for="typeEmailX-2">{{__('messages.Email')}}</label>
                        <input type="email" id="typeEmailX-2" name="email"
                        class="form-control form-control-lg
                        @error('email')
                            is-invalid
                        @enderror
                        " placeholder="{{__('messages.Enter your email')}}" value="{{ old('email') }}"/>
                        @error('email')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>

                    {{-- password --}}
                    <div class="form-outline mb-4">
                        <label class="form-label" for="typePasswordX-2">{{__('messages.Password')}}</label>
                        <input type="password" id="typePasswordX-2" name="password"
                        class="form-control form-control-lg
                        @error('password')
                            is-invalid
                        @enderror
                        " placeholder="{{__('messages.Enter Password')}}" />
                        @error('password')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>

                    <!-- Checkbox -->
                    <div class="form-check d-flex justify-content-start mb-4">
                        <input
                        class="form-check-input"
                        type="checkbox"
                        name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}
                        />
                        <label class="
                        @if (LaravelLocalization::getCurrentLocale() == 'ar')
                            mr-4
                        @endif
                        " for="form1Example3"> {{ __('messages.Remember Me') }} </label>
                    </div>

                    <button class="btn btn-primary btn-lg btn-block" type="submit">{{__('messages.Log in')}}</button>
                </form>
                  <hr class="my-2">

                  <a class="btn btn-lg btn-block btn-primary" style="background-color: #dd4b39;" href="{{ Route('login.google' , 'google') }}"><i class="fab fa-google me-2"></i> {{__('messages.Sign in with google')}}</a>
                  {{-- <button class="btn btn-lg btn-block btn-primary mb-2" style="background-color: #3b5998;" type="submit"><i class="fab fa-facebook-f me-2"></i>Sign in with facebook</button> --}}

                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
</body>
</html>
