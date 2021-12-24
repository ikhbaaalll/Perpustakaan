@extends('layouts.app')

@section('title')
    Peminjaman
@endsection

@section('content')
    <div class="row">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Daftar Peminjaman</h6>
            </div>
            <div class="card-body">
                @if (session('status'))
                    <div class="alert alert-success mt-3">
                        {{ session('status') }}
                    </div>
                @endif
                <div class="table-responsive">
                    <table class="table table-bordered" id="example1" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th style="width: 10px">No</th>
                                <th>Buku</th>
                                <th>Pengarang</th>
                                <th>Penerbit</th>
                                <th>Peminjaman</th>
                                <th>Pengembalian</th>
                                <th>Konfirmasi Pengembalian</th>
                                <th>Jumlah</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($loans as $loan)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $loan->book->name }}</td>
                                    <td>{{ $loan->book->author }}</td>
                                    <td>{{ $loan->book->publisher }}</td>
                                    <td>{{ $loan->date_of_loan->format('d-m-Y') }}</td>
                                    <td>{{ $loan->date_of_return->format('d-m-Y') }}</td>
                                    <td>{{ $loan->date_of_return_confirmation->format('d-m-Y') }}</td>
                                    <td>{{ $loan->quantity }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8">Tidak ada data peminjaman</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $(function() {
            $("#example1").DataTable({
                "order": [],
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": ['copyHtml5',
                    'excelHtml5',
                    'csvHtml5',
                    'pdfHtml5', "colvis"
                ]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        });
    </script>
@endsection
