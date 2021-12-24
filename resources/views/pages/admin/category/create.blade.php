@extends('layouts.app')

@section('title')
    Category
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Tambah Kategori</h6>
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
                    <form method="POST" action="{{ route('admin.categories.store') }}">
                        @csrf
                        <div class="form-group">
                            <label class="form-label">Nama</label>
                            <input type="text" name="name" value="{{ old('name') }}"
                                class="form-control @error('name') is-invalid @enderror" required autofocus
                                placeholder="Masukkan nama">
                        </div>
                        <button type="submit" class="btn btn-primary float-right">Submit</button>
                    </form>
                </div>
            </div>
        </div>

    </div>
@endsection
