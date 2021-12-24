@extends('layouts.app')

@section('title')
    Book {{ $category->name }}
@endsection

@section('content')
    <div class="row">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Daftar Buku {{ $category->name }}</h6>
            </div>
            <div class="card-body">
                @if (session('status'))
                    <div class="alert alert-success mt-3">
                        {{ session('status') }}
                    </div>
                @endif
                <a href="{{ route('admin.categories.books.create', $category) }}" class="btn btn-primary mb-2">Tambah
                    Buku</a>
                <div class="table-responsive">
                    <table class="table table-bordered" id="example1" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th style="width: 10px">No</th>
                                <th>Nama</th>
                                {{-- <th>Jumlah Buku</th> --}}
                                <th style="width: 150px">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($books as $book)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $book->name }}</td>
                                    {{-- <td>{{ $category->books_count }}</td> --}}
                                    <td>
                                        {{-- <a href="{{ route('admin.categories.books.index', $category) }}"
                                            class="btn btn-sm btn-info">Buku</a> --}}
                                        <a href="{{ route('admin.categories.books.edit', [$category, $book]) }}"
                                            class="btn btn-sm btn-warning">Edit</a>
                                        <form class="d-inline"
                                            action="{{ route('admin.categories.books.destroy', [$category, $book]) }}"
                                            method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                onclick="return confirm('Hapus buku {{ $book->name }}?')"
                                                class="btn btn-sm btn-danger d-inline-block">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3">Tidak ada data buku</td>
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
