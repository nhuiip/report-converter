@extends('layouts.app')
@section('title', $title)
@section('breadcrumb')
    @include('layouts.component.breadcrumb', ['breadcrumbs' => $breadcrumbs, 'title' => $title])
@endsection
@section('content')
    <div class="card">
        <div class="card-header pb-0">
            <div class="row">
                <div class="col-9">
                    @include('layouts.component.button.create', ['url' => route('teams.create')])
                </div>
                <div class="col-3">
                    @include('layouts.component.input-query')
                </div>
            </div>
        </div>
        <div class="card-body">
            <table id="dataTable" data-url="{{ route('teams.jsontable') }}">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
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
                    d.displayType = 'mainPage'
                },
            },
            columnDefs: [{
                    targets: [0],
                    width: '10%',
                },
                {
                    targets: [2, 3],
                    width: '15%',
                },
                {
                    targets: [4],
                    width: '5%',
                    className: 'text-center',
                    orderable: false
                }
            ],
            columns: [{
                    data: 'id'
                },
                {
                    data: 'name'
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
