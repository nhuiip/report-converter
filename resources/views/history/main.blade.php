@extends('layouts.app')
@section('title', $title)
@section('css')
    <link rel="stylesheet" href="{{ asset('css/vendors/select2.css') }}">
    <style>
        .select2-container--default .select2-selection--multiple .select2-selection__rendered {
            padding: 5px 5px 0;
        }
    </style>
@endsection
@section('breadcrumb')
    @include('layouts.component.breadcrumb', ['breadcrumbs' => $breadcrumbs, 'title' => $title])
@endsection
@section('content')
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-3">
                    <select class="select2" multiple="multiple">
                        @foreach ($type as $item)
                            <option value="{{ $item['value'] }}">{{ $item['desc'] }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-2">

                </div>
            </div>
        </div>
        <div class="card-body">
            <table id="dataTable" data-url="{{ route('histories.jsontable') }}">
                <thead>
                    <tr>
                        <th>Issue-Key</th>
                        <th>Assignee</th>
                        <th>Type</th>
                        <th>Lavel</th>
                        <th>Manday</th>
                        <th>Start</th>
                        <th>Delivery</th>
                        <th>Workday</th>
                        <th>Tracking</th>
                        <th>Created</th>
                    </tr>
                </thead>
                <tbody>
                    <tr></tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection
@section('javascript')
    <script src="{{ asset('js/select2/select2.full.min.js') }}"></script>
    <script>
        $('.select2').select2();
    </script>
@endsection
