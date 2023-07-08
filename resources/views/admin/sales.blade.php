@extends('layouts.admin.master')

@section('title', 'Sales')

@push('add-style')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.13.1/datatables.min.css" />
    <style>
        table.dataTable thead th {
            color: white;
            font-weight: 600;
        }

        table.dataTable tbody td {
            font-size: 14px;
            color: black;
        }

        div.dataTables_wrapper div.dataTables_filter label {
            font-weight: normal;
            white-space: nowrap;
            text-align: left;
            margin-bottom: 10px;
        }
    </style>
@endpush

@php
    use App\Models\Subscriber;
@endphp

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page_title_box d-flex align-items-center justify-content-between">
                <div class="page_title_left">
                    <h3 class="f_s_30 f_w_700 text_white">Sales</h3>
                    <ol class="breadcrumb page_bradcam mb-0">
                        <li class="breadcrumb-item"><a href="javascript:void(0);">sales</a></li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 card_height_100">
            <div class="white_card mb_20">
                <div class="white_card_body">
                    <div class="QA_table mb_30 mt-2">
                        <div class="table-responsive">
                            <table class="table lms_table_active" id="myTable">
                                <thead style="background-color: #1c2b23;">
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Email</th>
                                        <th>Nomor HP</th>
                                        <th>Status Langganan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($sales as $key => $value)
                                        @php
                                            $subscribe = Subscriber::where('user_id', $value->id)->first();
                                            $data = !empty($subscribe) && $subscribe->status == 'subscriber' ? '<span class="bg-success rounded-1 p-2">Berlangganan</span>' : '-';
                                        @endphp
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $value->name }}</td>
                                            <td>{{ $value->email }}</td>
                                            <td>{{ $value->phone }}</td>
                                            <td>
                                                {!! $data !!}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('add-script')
    <script>
        $(document).ready(function() {
            $('#myTable').DataTable();
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <script>
        $('.delete-data').click(function() {
            var id = $(this).data('id');
            $('#id').val(id);
        });
    </script>
@endpush
