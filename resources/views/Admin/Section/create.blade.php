@extends('layouts.master')
@section('css')

@section('title')
    {{ __('messages.section_title') }}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0"> {{ __('messages.sectionAdd') }}</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="{{ Route('Dashboard') }}" class="default-color">{{__('messages.Home')}}</a></li>
                <li class="breadcrumb-item active">{{ __('messages.sectionAdd') }}</li>
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
                <form action="{{ Route('section.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-12 form-group">
                            <label for="nameEN">{{__('messages.Name English')}}</label>
                            <input type="text" name="name_en" id=""
                             placeholder="{{__('messages.Enter Name English')}}" class="form-control
                            @error('name_en')
                                is-invalid
                            @enderror
                            ">
                            @error('name_en')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        {{-- ------------------------------------------------------------------------- --}}
                        <div class="col-lg-6 col-md-6 col-12 form-group">
                            <label for="nameAR">{{__('messages.Name Arabic')}}</label>
                            <input type="text" name="name_ar" id=""
                             placeholder="{{__('messages.Enter Name Arabic')}}" class="form-control
                            @error('name_ar')
                                is-invalid
                            @enderror
                            ">
                            @error('name_ar')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    {{-- --------------------------------------------------------------------------------- --}}
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-12 form-group">
                            <label for="">{{ __('messages.Description English') }}</label>
                            <textarea name="desc_en" id="" class="form-control
                                @error('desc_en')
                                    is-invalid
                                @enderror
                            "></textarea>
                            @error('desc_en')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        {{-- -------------------------------------------------------- --}}
                        <div class="col-lg-6 col-md-6 col-12 form-group">
                            <label for="">{{ __('messages.Description Arabic') }}</label>
                            <textarea name="desc_ar" id="" class="form-control
                                @error('desc_ar')
                                    is-invalid
                                @enderror
                            "></textarea>
                            @error('desc_ar')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    {{-- ---------------------------------------------------------------- --}}
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-12 form-group">
                            <label for="">{{ __('messages.photo') }}</label>
                            <input type="file" name="photo" id="" class="form-control
                                @error('photo')
                                    is-invalid
                                @enderror
                            ">
                            @error('photo')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
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
