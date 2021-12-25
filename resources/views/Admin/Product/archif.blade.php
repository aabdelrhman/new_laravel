@extends('layouts.master')
@section('css')

@section('title')
    {{ __('messages.Product Archif') }}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0"> {{ __('messages.Product Archif') }}</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="{{ Url('/admin') }}" class="default-color">{{__('messages.Home')}}</a></li>
                <li class="breadcrumb-item active">{{ __('messages.Product Archif') }}</li>
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
@include('layouts.session')
                <table class="table table-striped">
                    <thead>
                        <tr>
                        <th scope="col">#</th>
                        <th scope="col">{{__('messages.Name')}}</th>
                        <th scope="col">{{__('messages.Description')}}</th>
                        <th scope="col">{{__('messages.price')}}</th>
                        <th scope="col">{{__('messages.active')}}</th>
                        <th scope="col">{{__('messages.opration')}}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($products as $index=>$product)
                            <tr>

                                <th scope="row">{{++$index}}</th>
                                <td>{{$product->name}}</td>
                                <td>{{$product->desc}}</td>
                                <td>{{$product->price}}</td>
                                <td>{{$product->getStatus()}}</td>
                                <td>
                                    <a href="{{ Route('deleteArchif' , $product->id) }}" class="btn btn-danger">{{__('messages.Delete')}}</a>
                                    <a href="{{ Route('restoreArchif' , $product->id) }}" class="btn btn-success">{{__('messages.restore')}}</a>
                                </td>
                                {{-- Form delete --}}
                                <form id="Delete-form{{$product->id}}" action="{{ Route('product.destroy' , $product->id) }}" method="POST" class="d-none">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </tr>
                        @empty
                            <tr class="text-center">{{ __('messages.no items') }}</tr>
                        @endforelse
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
