@extends('layouts.master')
@section('css')

@section('title')
    {{ __('messages.Brands Title') }}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0"> {{ __('messages.Brands Title') }}</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="{{ Url('/admin') }}" class="default-color">{{__('messages.Home')}}</a></li>
                <li class="breadcrumb-item active">{{ __('messages.Brands Title') }}</li>
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
                        <th scope="col">{{__('messages.active')}}</th>
                        <th scope="col">{{__('messages.opration')}}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($brands as $index=>$brand)
                            <tr>

                                <th scope="row">{{++$index}}</th>
                                <td>{{$brand->name}}</td>
                                <td>{{__('messages.'.$brand->getStatus())}}</td>
                                <td>
                                    @permission('edit-brand')
                                    <a href="{{ Route('brand.edit' , $brand->id) }}" class="btn btn-info">{{__('messages.Edit')}}</a>
                                    @endpermission
                                    @permission('delete-brand')
                                    <a href="{{ Route('brand.destroy' , $brand->id) }}"
                                        onclick="event.preventDefault();
                                     document.getElementById('Delete-form{{$brand->id}}').submit();"
                                      class="btn btn-danger" >{{__('messages.Delete')}}</a>
                                {{-- Form delete --}}
                                    <form id="Delete-form{{$brand->id}}" action="{{ route('brand.destroy' , $brand->id) }}" method="POST" class="d-none">
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
            </div>
        </div>
    </div>
</div>
<!-- row closed -->
@endsection
@section('js')

@endsection
