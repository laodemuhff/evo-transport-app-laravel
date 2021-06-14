@extends('layouts.app')

@section('title', 'Setting App Wordings')

@section('breadcrumb')
    <h3 class="kt-subheader__title">
        Setting
    </h3>
    <span class="kt-subheader__separator kt-hidden"></span>
    <div class="kt-subheader__breadcrumbs">
        <a href="#" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
        <a href="{{route('setting.wordings')}}" class="kt-subheader__breadcrumbs-link">
            Update App Wordings
        </a>
    </div>
@endsection

@section('styles')
    
@endsection

@section('content')
    <div class="row">
        <div class="col">
            <div class="alert alert-light alert-elevate fade show" role="alert">
                <div class="alert-icon"><i class="flaticon-information kt-font-info"></i></div>
                <div class="alert-text">
                    Pada page ini anda dapat mengedit settingan wordings website Evo Transport
                </div>
            </div>
        </div>
    </div>
    @include('layouts.notification')

    <form action="{{route('setting.wordings.update')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="kt-portlet">
            <div class="kt-portlet__head">
                <div class="m-portlet__head-caption" style="padding-top:15px">
                    <div class="m-portlet__head-title">
                        <h4 class="m-portlet__head-text">
                        Setting App Wordings
                        </h4>
                    </div>
                </div>
            </div>
            <div class="kt-portlet__body">
                <div class="row">
                    {{-- Input field --}}
                   
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="pull-right">
                    <button class="btn btn-primary btn-sm">
                        <i class="flaticon2-send-1"></i> Update
                    </button>
                </div>
            </div>
        </div>
    </form>
@endsection

@section('scripts')
    
@endsection