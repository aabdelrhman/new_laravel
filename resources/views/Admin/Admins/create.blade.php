@extends('layouts.master')
@section('css')

@section('title')
    {{ __('messages.Admins title') }}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0"> {{ __('messages.Admins add') }}</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="{{ Route('Dashboard') }}" class="default-color">{{__('messages.Home')}}</a></li>
                <li class="breadcrumb-item active">{{ __('messages.Admins add') }}</li>
            </ol>
        </div>
    </div>
</div>
<!-- breadcrumb -->
@endsection
@section('content')
<!-- row -->
<div class="row">
    <div class="col-md-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">
                <form action="{{ Route('admins.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-12 form-group">
                            <label for="nameEN">{{__('messages.Name')}}</label>
                            <input type="text" name="name" id=""
                             placeholder="{{__('messages.Enter your Name')}}" class="form-control
                            @error('name')
                                is-invalid
                            @enderror
                            " value="{{ old('name') }}">
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        {{-- ------------------------------------------------------------------------- --}}
                        <div class="col-lg-6 col-md-6 col-12 form-group">
                            <label for="nameAR">{{__('messages.Email')}}</label>
                            <input type="email" name="email" id=""
                            placeholder="{{__('messages.Enter email')}}" class="form-control
                            @error('email')
                                is-invalid
                            @enderror
                            " value="{{ old('email') }}">
                            @error('email')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    {{-- --------------------------------------------------------------------------------- --}}
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-12 form-group">
                            <label for="">{{ __('messages.Password') }}</label>
                            <input type="password" placeholder="{{ __('messages.Enter Password') }}" name="password" id="" class="form-control
                                @error('password')
                                    is-invalid
                                @enderror
                            ">
                            @error('password')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        {{-- ---------------===============================----------------------------- --}}
                        <div class="col-lg-6 col-md-6 col-12 form-group">
                            <label for="">{{ __('messages.confirm password') }}</label>
                            <input type="password" placeholder="{{ __('messages.Enter Password') }}" name="password_confirmation" id="" class="form-control
                                @error('password')
                                    is-invalid
                                @enderror
                            ">
                            @error('password')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    {{-- ----------------------=====================--------------------- --}}
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-12 form-group">
                            <label for="">{{ __('messages.photo') }}</label>
                            <input type="file" name="photo" id="" class="form-control
                                @error('photo')
                                    is-invalid
                                @enderror
                            " >
                            @error('photo')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-lg-6 col-md-6 col-12 form-group">
                            <div class="form-check form-switch">
                                @foreach ($roles as $role)
                                    <input class="form-check-input" name="role[]" type="checkbox"
                                    value="{{ $role->id }}" role="switch" id="flexSwitchCheckChecked"
                                    >
                                    <label class="form-check-label" for="flexSwitchCheckChecked">{{ $role->name }}</label><br>
                                @endforeach
                                @error('role')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                            </div>
                        </div>
                    </div>
                    {{-- ----------------------=====================--------------------- --}}
                    <div class="row">
                        <div class="mx-auto">
                            <input type="submit" value="{{ __('messages.Save') }}" class="btn btn-info">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- row closed -->
@endsection
@section('js')

@endsection
