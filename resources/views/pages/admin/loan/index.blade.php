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
                <div class="dropdown mb-2">
                    <button class="btn btn-outline-primary dropdown-toggle" type="button" id="dropdownMenuButton"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Filter
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item" href="{{ route('admin.loan.index') }}">Semua</a>
                        <a class="dropdown-item" href="{{ route('admin.loan.index', ['status' => 1]) }}">Menunggu</a>
                        <a class="dropdown-item" href="{{ route('admin.loan.index', ['status' => 2]) }}">Dipinjam</a>
                        <a class="dropdown-item" href="{{ route('admin.loan.index', ['status' => 3]) }}">Selesai</a>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered" id="example1" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th style="width: 10px">No</th>
                                <th>Peminjam</th>
                                <th>Buku</th>
                                <th>Peminjaman</th>
                                <th>Pengembalian</th>
                                <th>Konfirmasi Pengembalian</th>
                                <th>Jumlah</th>
                                <th>Status</th>
                                <th style="width: 120px">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($loans as $loan)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $loan->user->name }}</td>
                                    <td>{{ $loan->book->name }}</td>
                                    <td>{{ $loan->date_of_loan->format('d-m-Y') }}</td>
                                    <td>{{ $loan->date_of_return->format('d-m-Y') }}</td>
                                    <td>{{ $loan->date_of_return_confirmation ? $loan->date_of_return_confirmation->format('d-m-Y') : '-' }}
                                    </td>
                                    <td>{{ $loan->quantity }}</td>
                                    <td><span class="badge @if ($loan->status == 'Menunggu') badge-warning @elseif($loan->status == 'Meminjam') badge-info @else badge-success @endif">{{ $loan->status }}</span>
                                    </td>
                                    <td>
                                        @if ($loan->status == 'Menunggu')
                                            <form class="d-inline" action="{{ route('admin.loan.update', $loan) }}"
                                                method="POST">
                                                @csrf
                                                @method('PUT')
                                                <button type="submit" name="validation" value="2"
                                                    onclick="return confirm('Konfirmasi peminjaman {{ $loan->user->name }}?')"
                                                    class="btn btn-sm btn-outline-info">Pinjam</button>
                                                <button type="submit" name="validation" value="1"
                                                    onclick="return confirm('Hapus peminjaman {{ $loan->user->name }}?')"
                                                    class="btn btn-sm btn-danger d-inline-block">Hapus</button>
                                            </form>
                                        @elseif($loan->status == 'Meminjam')
                                            <form class="d-inline" action="{{ route('admin.loan.update', $loan) }}"
                                                method="POST">
                                                @csrf
                                                @method('PUT')
                                                <button type="submit" name="validation" value="3"
                                                    onclick="return confirm('Konfirmasi selesai peminjaman {{ $loan->user->name }}?')"
                                                    class="btn btn-sm btn-outline-success">Selesai</button>
                                            </form>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8">Tidak ada data buku</td>
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
