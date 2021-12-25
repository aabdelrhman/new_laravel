@extends('layouts.master')
@section('css')

@section('title')
    {{ __('messages.Roles') }}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0"> {{__('messages.Edit Roles')}}</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="{{ Url('/admin') }}" class="default-color">{{__('messages.Home')}}</a></li>
                <li class="breadcrumb-item active">{{__('messages.Edit Roles')}}</li>
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
                <form action="{{ Route('roles.update' , $role->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-12 form-group">
                            <label for="nameEN">{{__('messages.Name Role')}}</label>
                            <input type="text" name="name" id=""
                             placeholder="{{__('messages.Enter Name Role')}}" class="form-control
                            @error('name')
                                is-invalid
                            @enderror
                            " value="{{ $role->name }}">
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-lg-6 col-md-6 col-12 form-group">
                            <div class="form-check form-switch">
                                @foreach ($permissions as $permission)
                                    <input class="form-check-input" name="permission[]" type="checkbox"
                                    value="{{ $permission->id }}" role="switch" id="flexSwitchCheckChecked"
                                    @foreach ($Role_permissions as $Role_permission)
                                        @if ($Role_permission->id == $permission->id)
                                            checked
                                        @endif
                                    @endforeach
                                    >
                                    <label class="form-check-label" for="flexSwitchCheckChecked">{{ $permission->name }}</label><br>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    {{-- ----------------------=====================--------------------- --}}
                    <div class="row">
                        <div class="mx-auto">
                            <input type="submit" value="{{ __('messages.Edit') }}" class="btn btn-info">
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
