@extends('layouts.app')
@section('title', $title)
@section('css')
    <link rel="stylesheet" href="{{ asset('css/vendors/date-picker.css') }}">
@endsection
@section('breadcrumb')
    @include('layouts.component.breadcrumb', ['breadcrumbs' => $breadcrumbs, 'title' => $title])
@endsection
@section('content')
    @if (empty($data))
        {{ Form::open(['novalidate', 'route' => 'holidays.store', 'class' => $errors->any() ? 'was-validated form-horizontal' : 'needs-validation form-horizontal', 'id' => 'account-form', 'method' => 'post', 'files' => true]) }}
    @else
        {{ Form::model($data, ['novalidate', 'route' => ['holidays.update', $data->id], 'class' => $errors->any() ? 'was-validated form-horizontal' : 'needs-validation form-horizontal', 'id' => 'account-form', 'method' => 'put', 'files' => true]) }}
    @endif
    <div class="card">
        <div class="card-body">
            <div class="form-group">
                <div class="row">
                    <div class="col-6">
                        <label class="form-label"><span class="text-danger">*</span> Name</label>
                        {{ Form::text('name', old('name'), ['class' => 'form-control', 'required', 'placeholder' => 'Enter name']) }}
                        @error('name')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-6">
                        <label class="form-label"><span class="text-danger">*</span> Date</label>
                        @if (empty($data))
                        {{ Form::text('date', old('date'), ['class' => 'form-control datePicker', 'required', 'placeholder' => 'Enter date']) }}
                        @else
                        {{ Form::text('date', date('Y-m-d', strtotime($data->date)), ['class' => 'form-control datePicker', 'required', 'placeholder' => 'Enter date']) }}
                        @endif
                        @error('date')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <div class="row">
                <div class="col-6">
                    @include('layouts.component.button.back', [
                        'url' => $breadcrumbs[count($breadcrumbs) - 2]['route'],
                    ])
                    @include('layouts.component.button.reset')
                </div>
                <div class="col-6">
                    @include('layouts.component.button.save', ['value' => 'save'])
                </div>
            </div>
        </div>
    </div>
    {!! Form::close() !!}
@endsection
@section('javascript')
    <script src="{{ asset('js/datepicker/date-picker/datepicker.js') }}"></script>
    <script src="{{ asset('js/datepicker/date-picker/datepicker.en.js') }}"></script>
    <script>
        $('.datePicker').datepicker({
            dateFormat: 'yyyy-mm-dd',
            language: 'en',
            todayBtn: true,
            todayHighlight: true
        });
    </script>
@endsection
