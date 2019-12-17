@extends('layouts.backend');
@section('content')
    <div class="content">
    <!-- Dynamic Table Full -->
    <div class="block">
        <div class="block-header block-header-default">
            <h3 class="block-title">Fatura <small>LİSTESİ</small></h3>
        </div>
        <div class="block-content block-content-full">
            <!-- DataTables functionality is initialized with .js-dataTable-full class in js/pages/be_tables_datatables.min.js which was auto compiled from _es6/pages/be_tables_datatables.js -->
            <table class="table table-bordered table-striped table-vcenter js-dataTable">
                <thead>
                <tr>

                    <th>No</th>
                    <th class="d-none d-sm-table-cell">Tarih</th>
                    <th class="d-none d-sm-table-cell">Firma Adı</th>
                    <th class="d-none d-sm-table-cell text-right">Tutar</th>

                </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>
    </div>
    <!-- END Dynamic Table Full -->
    </div>
@stop
@section('js_after')
    <script src="{{ asset('js/plugins/datatables/datatables.min.js') }}"></script>
    <script>
        $('.js-dataTable').dataTable({
            processing: true,
            serverSide: true,
            language:{
              url: "{{ asset('js/plugins/datatables/Turkish.json') }}"
            },
            ajax: "{{ route('dataTableServerSide') }}",

            dom: 'lBfrtip<"actions">',
            buttons: [
                {
                    extend: 'copy',
                    text: window.copyButtonTrans,
                    exportOptions: {
                        columns: ':visible'
                    }
                },{
                    extend: 'csv',
                    text: window.csvButtonTrans,
                    exportOptions: {
                        columns: ':visible'
                    }
                },
                {
                    extend: 'excel',
                    text: window.excelButtonTrans,
                    exportOptions: {
                        columns: ':visible'
                    }
                },
                {
                    extend: 'pdf',
                    text: window.pdfButtonTrans,
                    exportOptions: {
                        columns: ':visible'
                    }
                },
                {
                    extend: 'print',
                    text: window.printButtonTrans,
                    exportOptions: {
                        columns: ':visible'
                    }
                },
                {
                    extend: 'colvis',
                    text: window.colvisButtonTrans,
                    exportOptions: {
                        columns: ':visible'
                    }
                },
                'excel', 'pdf', 'print'
            ],
            columns: [
                {data: 'date',name:'date'},
                {data: 'number',name:'number'},
                {data: 'company',name:'company'},
                {data: 'total',name:'tutar',className: 'text-right'},

            ]

        });
    </script>


@stop
@section('css_before')
    <link rel="stylesheet" href="{{ asset('js/plugins/datatables/DataTables-1.10.20/css/dataTables.bootstrap4.min.css') }}">
    @endsection
