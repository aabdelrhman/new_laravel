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
            <h4 class="mb-0"> {{ __('messages.Product title') }}</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="{{ Url('/admin') }}" class="default-color">{{__('messages.Home')}}</a></li>
                <li class="breadcrumb-item active">{{ __('messages.Product title') }}</li>
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
                        <th scope="col">{{__('messages.section')}}</th>
                        <th scope="col">{{__('messages.brand')}}</th>
                        <th scope="col">{{__('messages.active')}}</th>
                        <th scope="col">{{__('messages.opration')}}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($products as $index=>$product)
                            <tr>

                                <th scope="row">
                                    {{++$index}}
                                    @if (isset($product->offer))
                                        <span class="badge badge-pill badge-danger">OFFER</span>
                                    @endif
                                </th>
                                <td>{{$product->name}}</td>
                                <td>{{$product->desc}}</td>
                                {{-- Check product has offer or not --}}
                                @if (isset($product->offer))
                                    @php
                                        $price       = (int)$product->price;  //Price befor offer
                                        $offer_ratio = (int)$product->offer->offer_ratio;  //offer ratio
                                        $discount    = round($price/$offer_ratio , 2) ;  //Discount offer
                                        $new_price   = $price - $discount ;  //new price after discount
                                    @endphp
                                    <td><h6 style="text-decoration-line: line-through;">{{$product->price}}</h6><h5>{{ $new_price }}</h5></td>
                                @else
                                    <td><h5>{{$product->price}}</h5></td>
                                @endif
                                {{--  End Check product has offer or not --}}
                                <td>{{$product->section->name}}</td>
                                <td>{{$product->brand->name}}</td>
                                <td>{{$product->getStatus()}}</td>
                                <td>
                                    @permission('edit-product')
                                    <a href="{{ Route('product.edit' , $product->id) }}" class="btn btn-info">{{__('messages.Edit')}}</a>
                                    @endpermission
                                    <a href="{{ Route('showImages' , $product->id) }}" class="btn btn-success">{{__('messages.Show images')}}</a>
                                    @permission('archif-product')
                                    <a href="{{ Route('product.destroy' , $product->id) }}"
                                        onclick="event.preventDefault();
                                     document.getElementById('Delete-form{{$product->id}}').submit();"
                                      class="btn btn-danger" >{{__('messages.Archief')}}</a>
                                {{-- Form delete --}}
                                    <form id="Delete-form{{$product->id}}" action="{{ Route('product.destroy' , $product->id) }}" method="POST" class="d-none">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                    @endpermission
                                </td>
                            </tr>
                        @empty
                            <tr class="text-center">{{ __('messages.no items') }}</tr>
                        @endforelse
                    </tbody>
                </table>
                <div class="d-flex justify-content-center">
                    {!! $products->links() !!}
                </div>
            </div>
        </div>
    </div>
</div>
<!-- row closed -->
@endsection
@section('js')

@endsection
