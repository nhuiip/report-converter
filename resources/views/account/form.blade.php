@extends('layouts.app')
@section('title', $title)
@section('breadcrumb')
    @include('layouts.component.breadcrumb', ['breadcrumbs' => $breadcrumbs, 'title' => $title])
@endsection
@section('content')
    @if (empty($data))
        {{ Form::open(['novalidate', 'route' => 'accounts.store', 'class' => $errors->any() ? 'was-validated form-horizontal' : 'needs-validation form-horizontal', 'id' => 'account-form', 'method' => 'post', 'files' => true]) }}
    @else
        {{ Form::model($data, ['novalidate', 'route' => ['accounts.update', $data->id], 'class' => $errors->any() ? 'was-validated form-horizontal' : 'needs-validation form-horizontal', 'id' => 'account-form', 'method' => 'put', 'files' => true]) }}
    @endif
    <div class="card">
        <div class="card-body">
            <div class="form-group">
                @if (Route::Is('accounts.create') || Route::Is('accounts.edit'))
                    <div class="row mb-3">
                        <div class="col-6">
                            <label class="form-label"><span class="text-danger">*</span> Role</label>
                            @if (empty($data))
                                {{ Form::select('role', $role, old('role'), ['class' => 'form-select', 'required']) }}
                            @else
                                {{ Form::select('role', $role, $data->roles->first()->name, ['class' => 'form-select', 'required']) }}
                            @endif
                            @error('role')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-6">
                            <label class="form-label"><span class="text-danger">*</span> Name</label>
                            {{ Form::text('name', old('name'), ['class' => 'form-control', 'required', 'placeholder' => 'Enter name']) }}
                            @error('name')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col-6">
                            <label class="form-label"><span class="text-danger">*</span> Email</label>
                            {{ Form::text('email', old('email'), ['class' => 'form-control', 'required', 'placeholder' => 'Enter email']) }}
                            @error('email')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                @endif
                @if (Route::Is('accounts.create') || Route::Is('accounts.resetpassword'))
                    <div class="row">
                        <div class="col-3">
                            <label class="form-label"><span class="text-danger">*</span> Password</label>
                            {{ Form::password('password', ['class' => 'form-control password', 'required', 'placeholder' => 'Enter password']) }}
                            @error('password')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col-3">
                            <label class="form-label"><span class="text-danger">*</span> Confirm Password</label>
                            {{ Form::password('password_confirmation', ['class' => 'form-control password', 'required', 'placeholder' => 'Enter confirm password']) }}
                            @error('password_confirmation')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col-6">
                            <label class="form-label">.</label>
                            <div class="input-group">
                                <input class="form-control password" type="text" placeholder="Random password">
                                <button type="button" class="btn btn-light" onclick="rondomPassword(8)">Random</button>
                            </div>
                        </div>
                    </div>
                @endif
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
                    @if (Route::Is('accounts.resetpassword'))
                        @include('layouts.component.button.save', ['value' => 'resetpassword'])
                    @else
                        @include('layouts.component.button.save', ['value' => 'save'])
                    @endif
                </div>
            </div>
        </div>
    </div>
    {!! Form::close() !!}
@endsection
@section('javascript')
    <script>
        function rondomPassword(e) {
            let password = Math.random().toString(36).slice(-e);
            $('.password').val(password)
        }
    </script>
@endsection
