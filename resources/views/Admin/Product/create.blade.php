@extends('layouts.master')
@section('css')

@section('title')
    {{ __('messages.Product title') }}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0"> {{ __('messages.Product add') }}</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="{{ Route('Dashboard') }}" class="default-color">{{__('messages.Home')}}</a></li>
                <li class="breadcrumb-item active">{{ __('messages.Product add') }}</li>
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
                <form action="{{ Route('product.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-12 form-group">
                            <label for="nameEN">{{__('messages.Name English product')}}</label>
                            <input type="text" name="name_en" id=""
                             placeholder="{{__('messages.Enter Name English product')}}" class="form-control
                            @error('name_en')
                                is-invalid
                            @enderror
                            " value="{{ old('name_en') }}">
                            @error('name_en')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        {{-- ------------------------------------------------------------------------- --}}
                        <div class="col-lg-6 col-md-6 col-12 form-group">
                            <label for="nameAR">{{__('messages.Name Arabic product')}}</label>
                            <input type="text" name="name_ar" id=""
                            placeholder="{{__('messages.Enter Name Arabic product')}}" class="form-control
                            @error('name_ar')
                                is-invalid
                            @enderror
                            " value="{{ old('name_ar') }}">
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
                            "> {{ old('desc_en') }}</textarea>
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
                            "> {{ old('desc_ar') }}</textarea>
                            @error('desc_ar')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    {{-- ---------------------------------------------------------------- --}}
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-12 form-group">
                            <label for="">{{ __('messages.price') }}</label>
                            <input type="number" placeholder="{{ __('messages.Enter price') }}" name="price" id="" class="form-control
                                @error('price')
                                    is-invalid
                                @enderror
                            " value="{{ old('price') }}">
                            @error('price')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-lg-6 col-md-6 col-12 form-group">
                            <label for="">{{ __('messages.photo') }}</label>
                            <input type="file" name="photos[]" id="" class="form-control
                                @error('photo')
                                    is-invalid
                                @enderror
                            " multiple>
                            @error('photo')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    {{-- ----------------------=====================--------------------- --}}
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-12 form-group">
                            <label for="">{{ __('messages.section') }}</label>
                            <select name="section_id" id="" class="form-control">
                                <option value="" aria-readonly=""> -- {{__('messages.Select Section')}} --</option>
                                @foreach ($sections as $section)
                                    <option value="{{ $section->id }}">{{ $section->name }}</option>
                                @endforeach
                            </select>
                            @error('section_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-lg-6 col-md-6 col-12 form-group">
                            <label for="">{{ __('messages.brand') }}</label>
                            <select name="brand_id" id="" class="form-control">
                                <option value="" aria-readonly=""> -- {{__('messages.Select Brand')}} --</option>
                                @foreach ($brands as $brand)
                                    <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                                @endforeach
                            </select>
                            @error('brand_id')
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
