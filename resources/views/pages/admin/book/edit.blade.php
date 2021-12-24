@extends('layouts.app')

@section('title')
    Book {{ $category->name }}
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Edit Buku {{ $book->name }}</h6>
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
                    <form method="POST" action="{{ route('admin.categories.books.update', [$category, $book]) }}">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label class="form-label">Nama</label>
                            <input type="text" name="name" value="{{ $book->name }}"
                                class="form-control @error('name') is-invalid @enderror" required autofocus
                                placeholder="Masukkan nama">
                        </div>
                        <div class="form-group">
                            <label class="form-label">ISBN</label>
                            <input type="text" name="isbn" value="{{ $book->isbn }}"
                                class="form-control @error('isbn') is-invalid @enderror" required
                                placeholder="Masukkan ISBN">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Penerbit</label>
                            <input type="text" name="publisher" value="{{ $book->publisher }}"
                                class="form-control @error('publisher') is-invalid @enderror" required
                                placeholder="Masukkan penerbit">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Pengarang</label>
                            <input type="text" name="author" value="{{ $book->author }}"
                                class="form-control @error('author') is-invalid @enderror" required
                                placeholder="Masukkan pengarang">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Tanggal Masuk</label>
                            <input type="date" name="date_of_entry" value="{{ $book->date_of_entry }}"
                                class="form-control @error('date_of_entry') is-invalid @enderror" required
                                placeholder="Masukkan tanggal masuk">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Jumlah</label>
                            <input type="text" name="quantity" value="{{ $book->quantity }}"
                                class="form-control @error('quantity') is-invalid @enderror" required
                                placeholder="Masukkan jumlah">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Deskripsi</label>
                            <textarea type="text" name="description"
                                class="form-control @error('description') is-invalid @enderror" required
                                placeholder="Masukkan deskripsi" rows="5" cols="5">{{ $book->description }}</textarea>
                        </div>
                        <button type="submit" class="btn btn-primary float-right">Submit</button>
                    </form>
                </div>
            </div>
        </div>

    </div>
@endsection
