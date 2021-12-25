@extends('layouts.master')
@section('css')

@section('title')
    {{ __('messages.Product images') }}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0"> {{ __('messages.Product images') }}</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="{{ Url('/admin') }}" class="default-color">{{__('messages.Home')}}</a></li>
                <li class="breadcrumb-item active">{{ __('messages.Product images') }}</li>
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
                <form action="{{ Route('imageAdd' , $product->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-lg-6 col-12 form-group">
                            <label for="">{{ __('messages.Add Images') }}</label>
                            <input type="file" name="photos[]" id="" class="form-control" multiple required>
                        </div>
                        <div class="col-lg-6 col-12 form-group pt-4">
                            <input type="submit" class="btn btn-info mt-3" value="{{ __('messages.Save') }}">
                        </div>
                    </div>
                </form>
@include('layouts.session')
                <table class="table table-striped">
                    <thead>
                        <tr>
                        <th scope="col">#</th>
                        <th scope="col" class="text-center">{{__('messages.photo')}}</th>
                        <th scope="col">{{__('messages.opration')}}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $index = 0 ;
                            $collection = collect($product->photos);
                            $count = $collection->count();
                        @endphp
                        @for ($i=0;$i<$count;$i++)
                            <tr>

                                <th scope="row">{{++$index}}</th>
                                <td class="text-center mx-auto"><a href="{{asset('images/Product/'.$product->photos[$i])}}"><img src="{{asset('images/Product/'.$product->photos[$i])}}" class="w-50" alt=""></a></td>
                                <td>
                                    <a href="{{ Route('imageDelete' , ['id' => $product->id , 'image_id' => $i]) }}" class="btn btn-danger">{{__('messages.Delete')}}</a>
                                </td>
                            </tr>
                        @endfor
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- row closed -->
@endsection
@section('js')

@endsection
