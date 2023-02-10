@extends('layouts.app')
@section('title', $title)
@section('breadcrumb')
    @include('layouts.component.breadcrumb', ['breadcrumbs' => $breadcrumbs, 'title' => $title])
@endsection
@section('content')
    <div class="card">
        <div class="card-header pb-0">
            <div class="row">
                <div class="col-7">
                    @include('layouts.component.button.create', ['url' => route('accounts.create')])
                </div>
                <div class="col-2">
                    <select id="role" class="form-select" onchange="dataTable.ajax.reload()">
                        <option value="">Select Role</option>
                        @foreach ($role as $value)
                            <option value="{{ $value->name }}">{{ $value->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-3">
                    @include('layouts.component.input-query')
                </div>
            </div>
        </div>
        <div class="card-body">
            <table id="dataTable" data-url="{{ route('accounts.jsontable') }}">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Info</th>
                        <th>Role</th>
                        <th>Created</th>
                        <th>Updated</th>
                        <th></th>
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
    <script src="{{ asset('js/datatable/datatables/jquery.dataTables.min.js') }}"></script>
    <script>
        let dataTable = $('#dataTable').DataTable({
            responsive: true,
            processing: true,
            serverSide: true,
            pageLength: 8,
            dom: 'rtip',
            ajax: {
                url: $('#dataTable').attr('data-url'),
                type: "GET",
                data: function(d) {
                    d.role = $('#role').val();
                },
            },
            columnDefs: [{
                    targets: [0],
                    width: '10%',
                },
                {
                    targets: [1],
                    orderable: false
                },
                {
                    targets: [2],
                    width: '15%',
                    orderable: false
                },
                {
                    targets: [3, 4],
                    width: '15%',
                },
                {
                    targets: [5],
                    width: '5%',
                    className: 'text-center',
                    orderable: false
                }
            ],
            columns: [{
                    data: 'id'
                },
                {
                    data: 'info'
                },
                {
                    data: 'role'
                },
                {
                    data: 'created_at'
                },
                {
                    data: 'updated_at'
                },
                {
                    data: 'action'
                }
            ]
        });
    </script>
@endsection
