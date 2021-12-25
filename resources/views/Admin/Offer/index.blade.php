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
            <h4 class="mb-0"> {{ __('messages.offers') }}</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="{{ Url('/admin') }}" class="default-color">{{__('messages.Home')}}</a></li>
                <li class="breadcrumb-item active">{{ __('messages.offers') }}</li>
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
            <a href="{{ Route('offers.create') }}" class="btn btn-info" >{{ __('messages.offers add') }}</a>
            <div class="card-body">
@include('layouts.session')
                <table class="table table-striped">
                    <thead>
                        <tr>
                        <th scope="col">#</th>
                        <th scope="col">{{__('messages.Name')}}</th>
                        <th scope="col">{{__('messages.offer_ratio')}}</th>
                        <th scope="col">{{__('messages.from')}}</th>
                        <th scope="col">{{__('messages.to')}}</th>
                        <th scope="col">{{__('messages.opration')}}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($offers as $index=>$offer)
                            <tr>

                                <th scope="row">{{++$index}}</th>
                                <td>{{$offer->product->name}}</td>
                                <td>{{$offer->offer_ratio}}</td>
                                <td>{{$offer->offer_begin}}</td>
                                <td>{{$offer->offer_end}}</td>
                                <td>
                                    @permission('edit-brand')
                                    <a href="{{ Route('offers.edit' , $offer->id) }}" class="btn btn-info">{{__('messages.Edit')}}</a>
                                    @endpermission
                                    @permission('delete-brand')
                                    <a href="{{ Route('offers.destroy' , $offer->id) }}"
                                        onclick="event.preventDefault();
                                     document.getElementById('Delete-form{{$offer->id}}').submit();"
                                      class="btn btn-danger" >{{__('messages.Delete')}}</a>
                                {{-- Form delete --}}
                                    <form id="Delete-form{{$offer->id}}" action="{{ route('offers.destroy' , $offer->id) }}" method="POST" class="d-none">
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
                    {!! $offers->links() !!}
                </div>
            </div>
        </div>
    </div>
</div>
<!-- row closed -->
@endsection
@section('js')

@endsection
