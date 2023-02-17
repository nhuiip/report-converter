@extends('layouts.app')
@section('title', $title)
@section('css')
    <link rel="stylesheet" href="{{ asset('css/vendors/yearpicker.css') }}">
@endsection
@section('breadcrumb')
    @include('layouts.component.breadcrumb', ['breadcrumbs' => $breadcrumbs, 'title' => $title])
@endsection
@section('content')
    <div class="card">
        <div class="card-header pb-0">
            <div class="row">
                <div class="col-7">
                    @include('layouts.component.button.create', ['url' => route('holidays.create')])
                </div>
                <div class="col-2">
                    <input id="year" type="text" class="form-control yearPicker" placeholder="Select Year" onchange="dataTable.ajax.reload()">
                </div>
                <div class="col-3">
                    @include('layouts.component.input-query')
                </div>
            </div>
        </div>
        <div class="card-body">
            <table id="dataTable" data-url="{{ route('holidays.jsontable') }}">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Date</th>
                        <th>Datail</th>
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
    <script src="{{ asset('js/yearpicker.js') }}"></script>
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
                    d.year = $('#year').val();
                },
            },
            columnDefs: [{
                    targets: [0, 1],
                    width: '10%',
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
                    data: 'date'
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

        $(".yearPicker").yearpicker()
    </script>
@endsection
