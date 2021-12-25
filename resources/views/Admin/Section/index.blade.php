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
            <h3 class="mb-0"> {{ __('messages.section_title') }}</h3>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="{{ Url('/admin') }}" class="default-color">{{__('messages.Home')}}</a></li>
                <li class="breadcrumb-item active">{{ __('messages.section_title') }}</li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6 col-md-6 col-12 from-group">
            <form action="{{ Route('importSectionExcel') }}" method="post" enctype="multipart/form-data">
                @csrf
                <h6>Upload Excel File Sections </h6>
                <input type="file" name="excel" id="" class="form-control">
                @error('excel')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
                <input type="submit" value="{{ __('messages.Save') }}" class="btn btn-info">
            </form>
        </div>
        <div class="col-lg-6 col-md-6 col-12 from-group ">
            <h6>Export Excel Sections File </h6>
            <a href="{{ Route('export.sections', ['slug' => 'xlsx']) }}" class="btn btn-info"> Download Excel Sections File </a>
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
                <table class="table">
                    <thead>
                        <tr>
                        <th scope="col"  class="text-center">#</th>
                        <th scope="col"  class="text-center">{{__('messages.Name')}}</th>
                        <th scope="col" class="text-center">{{__('messages.Description')}}</th>
                        <th scope="col" class="text-center">{{__('messages.photo')}}</th>
                        <th scope="col" class="text-center">{{__('messages.active')}}</th>
                        <th scope="col" class="text-center">{{__('messages.opration')}}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($sections as $index=>$section)
                            <tr>

                                <th scope="row">{{++$index}}</th>
                                <td>{{$section->name}}</td>
                                <td>{{$section->desc}}</td>
                                <td class="text-center w-50">
                                    <a href="{{$section->photo}}">
                                        <img src="{{$section->getPhoto()}}" alt="avatar" class="w-50 rounded-circle">
                                    </a>
                                </td>
                                <td>{{ $section->getStatus() }}</td>
                                <td>
                                    {{-- Route Edit --}}
                                    @permission('edit-section')
                                    <a href="{{ Route('section.edit' , $section->id) }}" class="btn btn-info">{{__('messages.Edit')}}</a>
                                    @endpermission
                                    {{-- Route Delete --}}
                                    @permission('delete-section')
                                    <a href="{{ Route('section.destroy' , $section->id) }}"
                                        onclick="event.preventDefault();
                                     document.getElementById('Delete-form{{ $section->id }}').submit();"
                                      class="btn btn-danger" >{{__('messages.Delete')}}</a>
                                {{-- Form delete --}}
                                <form id="Delete-form{{ $section->id }}" action="{{ route('section.destroy' , $section->id) }}" method="POST" class="d-none">
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
                    {!! $sections->links() !!}
                </div>
            </div>
        </div>
    </div>
</div>
<!-- row closed -->
@endsection
@section('js')

@endsection
