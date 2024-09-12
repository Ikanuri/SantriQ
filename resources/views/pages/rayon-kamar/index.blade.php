@extends('layouts.master')
@section('title')
    Rayon Kamar
@endsection
@section('page-title')
    Rayon Kamar
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col">
                            <h4 class="card-title mb-0">Data Rayon Kamar</h4>
                        </div>
                        <div class="col">
                            <a href="javascript:;" role="button" class="btn btn-primary float-end" data-bs-toggle="modal"
                                data-bs-target="#myModal">Tambah Data</a>
                            <x-modal id="myModal" title="Tambah Data Rayon">
                                <form action="{{ route('rayon-kamar.store') }}" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <label for="nama">Nama Rayon</label>
                                        <input type="text" class="form-control @error('nama') is-invalid @enderror"
                                            id="nama" name="nama" value="{{ old('nama') }}" required>
                                        @error('nama')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group mt-2">
                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                    </div>
                                </form>
                            </x-modal>
                        </div>
                    </div>
                </div><!-- end card header -->
                <div class="card-body">
                    <table class="table table-striped" id="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama Rayon</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($rayonKamars as $rayonKamar)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $rayonKamar->nama }}</td>
                                    <td>
                                        <a href="javascript:;" role="button" class="btn btn-warning" data-bs-toggle="modal"
                                            data-bs-target="#edit-{{ $loop->iteration }}">Edit</a>
                                        <x-modal id="edit-{{ $loop->iteration }}" title="Edit Data Rayon">
                                            <form action="{{ route('rayon-kamar.update', $rayonKamar->id) }}"
                                                method="POST">
                                                @csrf
                                                @method('PUT')
                                                <div class="form-group">
                                                    <label for="nama">Nama Rayon</label>
                                                    <input type="text"
                                                        class="form-control @error('nama') is-invalid @enderror"
                                                        id="nama" name="nama"
                                                        value="{{ old('nama') ?? $rayonKamar->nama }}" required>
                                                    @error('nama')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="form-group mt-2">
                                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                                </div>
                                            </form>
                                        </x-modal>
                                        <a href="javascript:;" role="button" class="btn btn-danger" data-bs-toggle="modal"
                                            data-bs-target="#hapus-{{ $loop->iteration }}">Hapus</a>
                                        <x-modal id="hapus-{{ $loop->iteration }}" title="Hapus Data Rayon"
                                            position="modal-dialog-centered">
                                            <form class="text-center"
                                                action="{{ route('rayon-kamar.destroy', $rayonKamar->id) }}"
                                                method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <p>
                                                    Apakah anda yakin ingin menghapus data rayon ini?
                                                </p>
                                                <div class="form-group mt-3">
                                                    <button type="button" data-bs-dismiss="modal"
                                                        class="btn btn-secondary">Batal</button>
                                                    <button type="submit" class="btn btn-danger">Hapus</button>
                                                </div>
                                            </form>
                                        </x-modal>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- end card body -->
            </div>
            <!-- end card -->
        </div>
        <!-- end col -->
    </div>
@endsection
@push('scripts')
    <script>
        $(document).ready(function() {
            $('#table').DataTable();
        });
    </script>
@endpush
