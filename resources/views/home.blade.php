@extends('layouts.app')
@section('title', $title)
@section('css')
    <style>
        hr:not([size]) {
            height: 0.1rem !important
        }
    </style>
@endsection
@section('breadcrumb')
    @include('layouts.component.breadcrumb', ['breadcrumbs' => $breadcrumbs, 'title' => $title])
@endsection
@section('content')
    <div class="row">
        @foreach ($teams as $value)
            <div class="col-md-4 widget-joins widget-arrow mb-3">
                <div class="widget-card bg-white">
                    <div class="media align-self-center">
                        <div class="widget-icon bg-light-success"><i class="icofont icofont-arrow-up font-success"></i></div>
                        <div class="media-body">
                            <h6>{{ $value->name }}</h6>
                            <h5><span class="counter">25698</span><span class="font-success">-36%($2658)</span></h5><span
                                class="font-roboto"> Than last month</span>
                            <hr>
                            <p class="m-0"><small><span class="counter">{{ $value->people }}</span><span class="font-roboto"> People</span></small></p>
                            <p class="m-0"><small><span class="counter">25698</span><span class="font-roboto"> Work</span></small></p>
                            <p class="m-0"><small><span class="counter">25698</span><span class="font-roboto"> Bug</span></small></p>
                        </div>
                        <hr>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
