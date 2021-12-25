@extends('layouts.master')
@section('css')

@section('title')
    {{ __('messages.offers') }}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0"> {{ __('messages.offers add') }}</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="{{ Route('Dashboard') }}" class="default-color">{{__('messages.Home')}}</a></li>
                <li class="breadcrumb-item active">{{ __('messages.offers add') }}</li>
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
                <form action="{{ Route('offers.store') }}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-12 form-group">
                            <label for="nameEN">{{__('messages.Name English offer')}}</label>
                            <input type="text" name="name_en" id=""
                             placeholder="{{__('messages.Enter Name English offer')}}" class="form-control
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
                            <label for="nameAR">{{__('messages.Name Arabic offer')}}</label>
                            <input type="text" name="name_ar" id=""
                             placeholder="{{__('messages.Enter Name Arabic offer')}}" class="form-control
                            @error('name_ar')
                                is-invalid
                            @enderror
                            ">
                            @error('name_ar')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    {{-- ----------------------=====================--------------------- --}}
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-12 form-group">
                            <label for="">{{ __('messages.section') }}</label>
                            <select name="section_id" id="section_id" class="form-control">
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
                            <select name="brand_id" id="brand_id" class="form-control">
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
                        <div class="col-lg-6 col-md-6 col-12 form-group">
                            <label for="">{{ __('messages.product') }}</label>
                            <div id="product" class="row">

                            </div>
                            @error('product_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-lg-6 col-md-6 col-12 form-group">
                            <label for="">{{ __('messages.offer_ratio') }}</label>
                            <input type="number" name="offer_ratio" id="" class="form-control">
                            @error('offer_ratio')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    {{-- ----------------------------------====================================== --}}
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-12 form-group">
                            <label for="">{{ __('messages.from') }}</label>
                            <input type="date" name="offer_begin" id="" class="form-control">
                            @error('offer_begin')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-lg-6 col-md-6 col-12 form-group">
                            <label for="">{{ __('messages.to') }}</label>
                            <input type="date" name="offer_end" id="" class="form-control">
                            @error('offer_end')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    {{-- --------------=======================------------------===================== --}}
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
<script>
$(document).ready(function () {
    $("#section_id").change(function(){
        var section_id = $(this).val();
        var brand_id = $('#brand_id').val();
        if(brand_id == ''){
            brand_id = '0';
        }
        if(section_id == ''){
            section_id = '0';
        }
        $.ajax({
            type:"GET",
            url:"/admin/ajaxGetProduct/"+section_id+"/"+brand_id,
            dataType: "json",
            success:function(response) {
                $('#product').empty();
                $.each(response.products , function(key , product){
                    $('#product').append(
                        "<div class='col-6'><input type='checkbox' name='product_id[]' value='"+product.id+"' class=''><label>"+product.name+"</label>&nbsp;</div>"
                    )
                });
            }
        });
    });
    $("#brand_id").change(function(){
        var brand_id = $(this).val();
        var section_id = $('#section_id').val();
        if(section_id == ''){
            section_id = '0';
        }
        if(brand_id == ''){
            brand_id = '0';
        }
            $.ajax({
                type:"GET",
                url:"/admin/ajaxGetProduct/"+section_id+"/"+brand_id,
                dataType: "json",
                success:function(response) {
                $('#product').empty();
                $.each(response.products , function(key , product){
                    $('#product').append(
                        "<div class='col-6'><input type='checkbox' name='product_id[]' value='"+product.id+"'><label>"+product.name+"</label>&nbsp;</div>"
                    )
                });
            }
        });
    });

});
</script>
@endsection
