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

@section('content')
    @include('sweetalert::alert')
    <div class="row">
        <div class="col-12">
            <div class="page_title_box d-flex align-items-center justify-content-between">
                <div class="page_title_left">
                    <h3 class="f_s_30 f_w_700 text_white">Transaksi</h3>
                    <ol class="breadcrumb page_bradcam mb-0">
                        <li class="breadcrumb-item"><a href="javascript:void(0);">Transaksi</a></li>
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
                                        <th>Nama Sales</th>
                                        <th>Email</th>
                                        <th>Nomor HP</th>
                                        <th>Status</th>
                                        <th>Bukti Pembayaran</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($order as $key => $value)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $value->User->name }}</td>
                                            <td>{{ $value->User->email }}</td>
                                            <td>{{ $value->User->phone }}</td>
                                            <td>
                                                @if ($value->status == 'pending')
                                                    <span class="p-2 bg-primary rounded-1">Pending</span>
                                                @elseif($value->status == 'success')
                                                    <span class="p-2 bg-success rounded-1">Success</span>
                                                @else
                                                    <span class="p-2 bg-danger rounded-1">Rejected</span>
                                                @endif
                                            </td>
                                            <td>
                                                <a class="konfirmasi" href='javascript:void(0)'
                                                    data-id="{{ $value->id }}">
                                                    <span class="p-2 bg-info rounded-1">Konfirmasi</span>
                                                </a>
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

@push('modal')
    <div class="modal fade" id="modalTambah" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Konfirmasi Pembayaran</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('dashboard.confirm') }}" method="post">
                        @csrf
                        <div>
                            <input type=hidden id="id" name="id">
                            <input type=hidden id="package_id" name="package_id">
                            <p class="text-center" id="image-pembayaran"></p>
                            <div class="form-group">
                                <label for="">Nama : <span id="nama"></span></label>
                            </div>
                            <div class="form-group">
                                <label for="">Nama Bank : <span id="bank_name"></span></label>
                            </div>
                            <div class="form-group">
                                <label for="">Total Bayar : <span id="total_bayar"></span></label>
                            </div>
                            <div class="form-group">
                                <select name="status" id="status" class="form-control " autocomplete="off">
                                    <option value="pending">Pending</option>
                                    <option value="success">Success</option>
                                    <option value="rejected">Rejected</option>
                                </select>
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Keluar</button>
                    <button type="submit" class="btn btn-success">Konfirmasi</button>
                </div>
                </form>
            </div>
        </div>
    </div>
@endpush

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
        $('body').on('click', '.konfirmasi', function() {
            let data_id = $(this).data('id');
            $.get('show-confirmation/' + data_id, function(data) {
                console.log(data)
                $('#modalTambah').modal('show');
                $('#image-pembayaran').html('')
                $('#nama').text(data.name)
                $('#bank_name').text(data.bank_name);
                $('#total_bayar').text(data.total_price);
                $('#status').val(data.status);
                $('#id').val(data.id);
                $('#package_id').val(data.subscription_package_id)
                if (data.evidence_of_transfer) {
                    $('#image-pembayaran').append(
                        `  <img src="{{ asset('storage/transfer/${data.evidence_of_transfer}') }}"  width="70%" height="auto"></img>`
                    );
                }
            })
        });
    </script>
@endpush
