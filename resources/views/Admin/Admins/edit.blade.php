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
            <h4 class="mb-0"> {{__('messages.Admin edit')}}</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="{{ Url('/admin') }}" class="default-color">{{__('messages.Home')}}</a></li>
                <li class="breadcrumb-item active">{{__('messages.Admin edit')}}</li>
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
                <form action="{{ Route('admins.update' , $admin->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-12 form-group">
                            <label for="Roles">{{__('messages.Roles')}}</label>
                            <div class="form-check form-switch">
                                @foreach ($roles as $role)
                                    <input class="form-check-input" name="Roles[]" type="checkbox"
                                    value="{{ $role->id }}" role="switch" id="flexSwitchCheckChecked"
                                    @foreach ($admin->roles as $Role_admin)
                                        @if ($Role_admin->id == $role->id)
                                            checked
                                        @endif
                                    @endforeach
                                    >
                                    <label class="form-check-label" for="flexSwitchCheckChecked">{{ $role->name }}</label><br>
                                @endforeach
                            </div>
                            @error('Roles')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    {{-- ==----=======--------==========--------==========---================== --}}
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
