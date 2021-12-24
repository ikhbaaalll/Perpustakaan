@extends('layouts.app')

@section('title-page', 'Dashboard Perpustakaan')

@section('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endsection

@section('content')
    <div class="row mt-3">
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Menunggu</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $count['waiting'] }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-toolbox fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Sedang Dipinjam</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $count['onloan'] }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fab fa-wpforms fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Selesai</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $count['done'] }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-exclamation fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Pinjam Buku</h6>
            </div>
            <div class="card-body">
                <div class="row">
                    @if (session('status'))
                        <div class="alert alert-success mt-3">
                            {{ session('status') }}
                        </div>
                    @endif
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form action="{{ route('user.book.rent') }}" class="col-4 mx-auto" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="book_id">Buku</label>
                            <select name="book_id" id="book_id"
                                class="form-control select2 @error('book_id') is-invalid @enderror" required>
                                <option value="" selected disabled>Pilih Buku</option>
                                @foreach ($books as $book)
                                    <option value="{{ $book->id }}"
                                        {{ old('book_id') == $book->id ? 'selected' : '' }}>
                                        {{ $book->name }}, <small>Kategori: {{ $book->category->name }}</small></option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="quantity">Jumlah</label>
                            <input type="number" value="{{ old('quantity') }}" name="quantity" id="quantity"
                                class="form-control @error('quantity') is-invalid @enderror" placeholder="Jumlah Buku"
                                required>
                        </div>
                        <div class="form-group">
                            <label for="date_of_loan">Tanggal Peminjaman</label>
                            <input type="date" value="{{ old('date_of_loan') }}" name="date_of_loan" id="date_of_loan"
                                class="form-control @error('date_of_loan') is-invalid @enderror"
                                placeholder="Tanggal Pinjam" required>
                        </div>
                        <div class="form-group">
                            <label for="date_of_return">Tanggal Pengembalian</label>
                            <input type="date" value="{{ old('date_of_return') }}" name="date_of_return"
                                id="date_of_return" class="form-control @error('date_of_return') is-invalid @enderror"
                                placeholder="Tanggal Pinjam" required>
                        </div>
                        <button type="submit" class="btn btn-primary float-right">Pinjam</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Daftar Peminjaman Buku</h6>
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
                                <th>Kategori</th>
                                <th>Pengarang</th>
                                <th>Penerbit</th>
                                <th>Jumlah</th>
                                <th>Peminjaman</th>
                                <th>Pengembalian</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($loans as $loan)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $loan->book->name }}</td>
                                    <td>{{ $loan->book->category->name }}</td>
                                    <td>{{ $loan->book->author }}</td>
                                    <td>{{ $loan->book->publisher }}</td>
                                    <td>{{ $loan->quantity }}</td>
                                    <td>{{ $loan->date_of_loan->format('d-m-Y') }}</td>
                                    <td>{{ $loan->date_of_return->format('d-m-Y') }}</td>
                                    <td><span class="badge @if ($loan->status == 'Menunggu') badge-warning @elseif($loan->status == 'Meminjam') badge-info @else badge-success @endif">{{ $loan->status }}</span></td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6">Tidak ada data peminjaman</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- The core Firebase JS SDK is always required and must be listed first -->
@endsection

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.select2').select2()
        });
    </script>
    <script>
        $(function() {
            $("#example1").DataTable({
                "order": [],
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                // "buttons": ['copyHtml5',
                //     'excelHtml5',
                //     'csvHtml5',
                //     'pdfHtml5', "colvis"
                // ]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        });
    </script>
@endsection
