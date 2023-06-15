@extends('layouts.admin.master')

@section('title', 'Dashboard')

@push('add-style')
    <style>
        .bg_card {
            background-color: #1c2b23;
        }
    </style>
@endpush

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page_title_box d-flex align-items-center justify-content-between">
                <div class="page_title_left">
                    <h3 class="f_s_30 f_w_700 text_white">Dashboard</h3>
                    <ol class="breadcrumb page_bradcam mb-0">
                        <li class="breadcrumb-item"><a href="javascript:void(0);">Dashboard</a></li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 card_height_100">
            <div class="white_card mb_20">
                <div class="white_card_body pb-0">
                    <div class="row mt-4 text-center">
                        <div class="col-md-6">
                            <div class="card_box position-relative  mb_30  bg_card">
                                <div class="box_body px-2 py-4">
                                    <h4 class="text-white">TOTAL SALES</h4>
                                    <h2 class="text-white">3456</h2>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card_box position-relative  mb_30  bg_card">
                                <div class="box_body px-2 py-4">
                                    <h4 class="text-white">TOTAL CONTACT</h4>
                                    <h2 class="text-white">8567</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
