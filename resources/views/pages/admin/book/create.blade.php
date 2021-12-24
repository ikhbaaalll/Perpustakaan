@extends('layouts.app')

@section('title')
    Book {{ $category->name }}
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Tambah Buku {{ $category->name }}</h6>
            </div>
            <div class="card-body">
                <div class="col-6 mx-auto">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form method="POST" action="{{ route('admin.categories.books.store', $category) }}">
                        @csrf
                        <div class="form-group">
                            <label class="form-label">Nama</label>
                            <input type="text" name="name" value="{{ old('name') }}"
                                class="form-control @error('name') is-invalid @enderror" required autofocus
                                placeholder="Masukkan nama">
                        </div>
                        <div class="form-group">
                            <label class="form-label">ISBN</label>
                            <input type="text" name="isbn" value="{{ old('isbn') }}"
                                class="form-control @error('isbn') is-invalid @enderror" required autofocus
                                placeholder="Masukkan ISBN">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Penerbit</label>
                            <input type="text" name="publisher" value="{{ old('publisher') }}"
                                class="form-control @error('publisher') is-invalid @enderror" required autofocus
                                placeholder="Masukkan penerbit">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Pengaran</label>
                            <input type="text" name="author" value="{{ old('author') }}"
                                class="form-control @error('author') is-invalid @enderror" required autofocus
                                placeholder="Masukkan pengarang">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Tanggal Masuk</label>
                            <input type="date" name="date_of_entry" value="{{ old('date_of_entry') }}"
                                class="form-control @error('date_of_entry') is-invalid @enderror" required autofocus
                                placeholder="Masukkan tanggal masuk">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Jumlah</label>
                            <input type="text" name="quantity" value="{{ old('quantity') }}"
                                class="form-control @error('quantity') is-invalid @enderror" required autofocus
                                placeholder="Masukkan jumlah">
                        </div>
                        <button type="submit" class="btn btn-primary float-right">Submit</button>
                    </form>
                </div>
            </div>
        </div>

    </div>
@endsection
