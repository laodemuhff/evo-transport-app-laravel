@extends('layouts.app')

@section('title', 'Update Profile')

@section('breadcrumb')
    <h3 class="kt-subheader__title">
        User Profile Management
    </h3>
    <span class="kt-subheader__separator kt-hidden"></span>
    <div class="kt-subheader__breadcrumbs">
        <a href="#" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
        <a href="{{route('admin.profile')}}" class="kt-subheader__breadcrumbs-link">
            Update User Profile
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
                    Pada page ini anda dapat mengedit profile user
                </div>
            </div>
        </div>
    </div>
    @include('layouts.notification')

    <form action="{{route('admin.profile.update')}}" method="POST">
        @csrf
        <div class="kt-portlet">
            <div class="kt-portlet__head">
                <div class="m-portlet__head-caption" style="padding-top:15px">
                    <div class="m-portlet__head-title">
                        <h4 class="m-portlet__head-text">
                        Edit Profile
                        </h4>
                    </div>
                </div>
            </div>
            <div class="kt-portlet__body">
                <div class="row">
                    {{-- Input field --}}
                    <div class="col-md-8">
                        <div class="form-group row">
                            <label class="col-4 col-form-label">
                                <div class="pull-right">
                                    Nama User <span style="color:red;">*</span> <i class="flaticon-info" data-toggle="kt-tooltip" data-placement="top" data-original-title="Nama User"></i>
                                </div>
                            </label>
                            <div class="col-8">
                                <input type="text" name="name" id="name" class="form-control" value="{{ old('name') ?? $name }}" required>
                            </div>
                            @error('name')
                                <div class="my-alert alert-danger">! {{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group row">
                            <label class="col-4 col-form-label">
                                <div class="pull-right">
                                    No. Telepon User <span style="color:red;">*</span> <i class="flaticon-info" data-toggle="kt-tooltip" data-placement="top" data-original-title="No. Telp."></i>
                                </div>
                            </label>
                            <div class="col-8">
                                <div class="input-group">
                                    <input class="form-control" type="text" name="mobile_number" id="mobile_number" autocomplete="off" value="{{ old('mobile_number') ?? $mobile_number }}" required>
                                </div>
                                @error('mobile_number')
                                    <div class="my-alert alert-danger">! {{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-4 col-form-label">
                                <div class="pull-right">
                                    Email User <span style="color:red;">*</span> <i class="flaticon-info" data-toggle="kt-tooltip" data-placement="top" data-original-title="Email User"></i>
                                </div>
                            </label>
                            <div class="col-8">
                                <div class="input-group">
                                    <input class="form-control" type="email" name="email" id="email" autocomplete="off" value="{{ old('email') ?? $email }}" required>
                                </div>
                                @error('email')
                                    <div class="my-alert alert-danger">! {{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-4 col-form-label">
                                <div class="pull-right">
                                    Password <span style="color:red;">*</span> <i class="flaticon-info" data-toggle="kt-tooltip" data-placement="top" data-original-title="Password User"></i>
                                </div>
                            </label>
                            <div class="col-8">
                                <div class="input-group">
                                    <input class="form-control" type="password" name="password" id="password" autocomplete="off" value="" required>
                                </div>
                                @error('password')
                                    <div class="my-alert alert-danger">! {{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-4 col-form-label">
                                <div class="pull-right">
                                    Confirm Password <span style="color:red;">*</span> <i class="flaticon-info" data-toggle="kt-tooltip" data-placement="top" data-original-title="Confirm Password User"></i>
                                </div>
                            </label>
                            <div class="col-8">
                                <div class="input-group">
                                    <input class="form-control" type="password" name="confirmation_password" id="confirmation_password" autocomplete="off" required>
                                </div>
                                @error('confirmation_password')
                                    <div class="my-alert alert-danger">! {{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
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