@extends('layouts.app')

@section('title', 'driver Management')
@section('driver', 'kt-menu__item--open')

@section('breadcrumb')
    <h3 class="kt-subheader__title">
        Driver Management
    </h3>
    <span class="kt-subheader__separator kt-hidden"></span>
    <div class="kt-subheader__breadcrumbs">
        <a href="#" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
        <a href="{{route('driver.assigned')}}" class="kt-subheader__breadcrumbs-link">
            Assigned Driver
        </a>
    </div>
@endsection

@section('styles')
    <link href="{{ asset('assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
    <div class="kt-portlet kt-portlet--height-fluid">
        <div class="kt-portlet__head">
            <div class="kt-portlet__head-label">
                <h3 class="kt-portlet__head-title">
                    Timeline v3
                </h3>
            </div>
            <div class="kt-portlet__head-toolbar">
                <div class="dropdown dropdown-inline">
                    <button type="button" class="btn btn-clean btn-sm btn-icon btn-icon-md" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="flaticon-more-1"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-right" x-placement="bottom-end" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(32px, 33px, 0px);">
                        <ul class="kt-nav">
                            <li class="kt-nav__item">
                                <a href="#" class="kt-nav__link">
                                    <i class="kt-nav__link-icon flaticon2-line-chart"></i>
                                    <span class="kt-nav__link-text">Reports</span>
                                </a>
                            </li>
                            <li class="kt-nav__item">
                                <a href="#" class="kt-nav__link">
                                    <i class="kt-nav__link-icon flaticon2-send"></i>
                                    <span class="kt-nav__link-text">Messages</span>
                                </a>
                            </li>
                            <li class="kt-nav__item">
                                <a href="#" class="kt-nav__link">
                                    <i class="kt-nav__link-icon flaticon2-pie-chart-1"></i>
                                    <span class="kt-nav__link-text">Charts</span>
                                </a>
                            </li>
                            <li class="kt-nav__item">
                                <a href="#" class="kt-nav__link">
                                    <i class="kt-nav__link-icon flaticon2-avatar"></i>
                                    <span class="kt-nav__link-text">Members</span>
                                </a>
                            </li>
                            <li class="kt-nav__item">
                                <a href="#" class="kt-nav__link">
                                    <i class="kt-nav__link-icon flaticon2-settings"></i>
                                    <span class="kt-nav__link-text">Settings</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="kt-portlet__body">
            <div class="kt-scroll ps ps--active-y" data-scroll="true" data-height="380" data-mobile-height="300" style="height: 380px; overflow: hidden;">

                <!--Begin::Timeline 3 -->
                <div class="kt-timeline-v2">
                    <div class="kt-timeline-v2__items  kt-padding-top-25 kt-padding-bottom-30">
                        <div class="kt-timeline-v2__item">
                            <span class="kt-timeline-v2__item-time">10:00</span>
                            <div class="kt-timeline-v2__item-cricle">
                                <i class="fa fa-genderless kt-font-danger"></i>
                            </div>
                            <div class="kt-timeline-v2__item-text  kt-padding-top-5">
                                Lorem ipsum dolor sit amit,consectetur eiusmdd tempor<br>
                                incididunt ut labore et dolore magna
                            </div>
                        </div>
                        <div class="kt-timeline-v2__item">
                            <span class="kt-timeline-v2__item-time">12:45</span>
                            <div class="kt-timeline-v2__item-cricle">
                                <i class="fa fa-genderless kt-font-success"></i>
                            </div>
                            <div class="kt-timeline-v2__item-text kt-timeline-v2__item-text--bold">
                                AEOL Meeting With
                            </div>
                            <div class="kt-list-pics kt-list-pics--sm kt-padding-l-20">
                                <a href="#"><img src="assets/media/users/100_4.jpg" title=""></a>
                                <a href="#"><img src="assets/media/users/100_13.jpg" title=""></a>
                                <a href="#"><img src="assets/media/users/100_11.jpg" title=""></a>
                                <a href="#"><img src="assets/media/users/100_14.jpg" title=""></a>
                            </div>
                        </div>
                        <div class="kt-timeline-v2__item">
                            <span class="kt-timeline-v2__item-time">14:00</span>
                            <div class="kt-timeline-v2__item-cricle">
                                <i class="fa fa-genderless kt-font-brand"></i>
                            </div>
                            <div class="kt-timeline-v2__item-text kt-padding-top-5">
                                Make Deposit <a href="#" class="kt-link kt-link--brand kt-font-bolder">USD 700</a> To ESL.
                            </div>
                        </div>
                        <div class="kt-timeline-v2__item">
                            <span class="kt-timeline-v2__item-time">16:00</span>
                            <div class="kt-timeline-v2__item-cricle">
                                <i class="fa fa-genderless kt-font-warning"></i>
                            </div>
                            <div class="kt-timeline-v2__item-text kt-padding-top-5">
                                Lorem ipsum dolor sit amit,consectetur eiusmdd tempor<br>
                                incididunt ut labore et dolore magna elit enim at minim<br>
                                veniam quis nostrud
                            </div>
                        </div>
                        <div class="kt-timeline-v2__item">
                            <span class="kt-timeline-v2__item-time">17:00</span>
                            <div class="kt-timeline-v2__item-cricle">
                                <i class="fa fa-genderless kt-font-info"></i>
                            </div>
                            <div class="kt-timeline-v2__item-text kt-padding-top-5">
                                Placed a new order in <a href="#" class="kt-link kt-link--brand kt-font-bolder">SIGNATURE MOBILE</a> marketplace.
                            </div>
                        </div>
                        <div class="kt-timeline-v2__item">
                            <span class="kt-timeline-v2__item-time">16:00</span>
                            <div class="kt-timeline-v2__item-cricle">
                                <i class="fa fa-genderless kt-font-brand"></i>
                            </div>
                            <div class="kt-timeline-v2__item-text kt-padding-top-5">
                                Lorem ipsum dolor sit amit,consectetur eiusmdd tempor<br>
                                incididunt ut labore et dolore magna elit enim at minim<br>
                                veniam quis nostrud
                            </div>
                        </div>
                        <div class="kt-timeline-v2__item">
                            <span class="kt-timeline-v2__item-time">17:00</span>
                            <div class="kt-timeline-v2__item-cricle">
                                <i class="fa fa-genderless kt-font-danger"></i>
                            </div>
                            <div class="kt-timeline-v2__item-text kt-padding-top-5">
                                Received a new feedback on <a href="#" class="kt-link kt-link--brand kt-font-bolder">FinancePro App</a> product.
                            </div>
                        </div>
                    </div>
                </div>

                <!--End::Timeline 3 -->
            <div class="ps__rail-x" style="left: 0px; bottom: 0px;"><div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div></div><div class="ps__rail-y" style="top: 0px; height: 380px; right: 0px;"><div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 300px;"></div></div></div>
        </div>
    </div>
@endsection
