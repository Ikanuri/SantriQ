@extends('layouts.master')
@section('title')
    Data Pengguna
@endsection
@section('page-title')
    Data Pengguna
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col">
                            <h4 class="card-title mb-0">Data Pengguna</h4>
                        </div>
                        <div class="col">
                            <a href="javascript:;" role="button" class="btn btn-primary float-end" data-bs-toggle="modal"
                                data-bs-target="#myModal">Tambah Data</a>
                            <x-modal id="myModal" title="Tambah Data Pengguna">
                                <form action="{{ route('user.store') }}" method="POST">
                                    @csrf
                                    <div class="form-group mt-2">
                                        <label for="name">Nama</label>
                                        <input type="text" name="name" id="name"
                                            class="form-control @error('name') is-invalid @enderror">
                                        @error('name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group mt-2">
                                        <label for="email">Email</label>
                                        <input type="email" name="email" id="email"
                                            class="form-control @error('email') is-invalid @enderror">
                                        @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group mt-2">
                                        <label for="password">Password</label>
                                        <input type="password" name="password" id="password"
                                            class="form-control @error('password') is-invalid @enderror">
                                        @error('password')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group mt-2">
                                        <label for="role">Role</label>
                                        <select name="role" id="role"
                                            class="form-control @error('role') is-invalid @enderror">
                                            <option value="" selected disabled>Pilih Role</option>
                                            <option value="pusat">Pusat</option>
                                            <option value="kantib">Kantib</option>
                                            <option value="diniyah">Diniyah</option>
                                            <option value="pengajian">Pengajian</option>
                                        </select>
                                        @error('role')
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
                    <div class="table-responsive">
                        <table class="table table-striped" id="table">
                            <thead>
                                <tr>
                                    <th class="text-center">#</th>
                                    <th class="text-center">Nama</th>
                                    <th class="text-center">Email</th>
                                    <th class="text-center">Role</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <td class="text-center">{{ $loop->iteration }}</td>
                                        <td class="text-center">{{ $user->name }}</td>
                                        <td class="text-center">{{ $user->email }}</td>
                                        <td class="text-center text-capitalize">{{ $user->role }}</td>
                                        <td class="text-center">
                                            <a href="javascript:;" role="button" class="btn btn-warning"
                                                data-bs-toggle="modal"
                                                data-bs-target="#edit-{{ $loop->iteration }}">Edit</a>
                                            <a href="javascript:;" role="button" class="btn btn-danger"
                                                data-bs-toggle="modal"
                                                data-bs-target="#hapus-{{ $loop->iteration }}">Hapus</a>
                                            <x-modal id="hapus-{{ $loop->iteration }}" title="Hapus Data Pengguna"
                                                position="modal-dialog-centered">
                                                <form class="text-center" action="{{ route('user.destroy', $user->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <p>
                                                        Apakah anda yakin ingin menghapus data pengguna ini?
                                                    </p>
                                                    <div class="form-group mt-3">
                                                        <button type="button" data-bs-dismiss="modal"
                                                            class="btn btn-secondary">Batal</button>
                                                        <button type="submit" class="btn btn-danger">Hapus</button>
                                                    </div>
                                                </form>
                                            </x-modal>
                                        </td>
                                        <x-modal id="edit-{{ $loop->iteration }}" title="Edit Data Pengguna">
                                            <form action="{{ route('user.update', $user->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <div class="form-group mt-2">
                                                    <label for="name">Nama</label>
                                                    <input type="text" name="name" id="name"
                                                        class="form-control @error('name') is-invalid @enderror"
                                                        value="{{ $user->name }}" required>
                                                    @error('name')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="form-group mt-2">
                                                    <label for="email">Email</label>
                                                    <input type="email" name="email" id="email"
                                                        class="form-control @error('email') is-invalid @enderror"
                                                        value="{{ $user->email }}" required>
                                                    @error('email')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="form-group mt-2">
                                                    <label for="password">Password</label>
                                                    <input type="password" name="password" id="password"
                                                        class="form-control @error('password') is-invalid @enderror"
                                                        required>
                                                    @error('password')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="form-group mt-2">
                                                    <label for="role">Role</label>
                                                    <select name="role" id="role"
                                                        class="form-control @error('role') is-invalid @enderror">
                                                        <option value="" selected disabled>Pilih Role</option>
                                                        <option value="pusat"
                                                            {{ $user->role == 'pusat' ? 'selected' : '' }}>Pusat</option>
                                                        <option value="kantib"
                                                            {{ $user->role == 'kantib' ? 'selected' : '' }}>Kantib</option>
                                                        <option value="diniyah"
                                                            {{ $user->role == 'diniyah' ? 'selected' : '' }}>Diniyah
                                                        </option>
                                                        <option value="pengajian"
                                                            {{ $user->role == 'pengajian' ? 'selected' : '' }}>Pengajian
                                                        </option>
                                                    </select>
                                                    @error('role')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="form-group mt-2">
                                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                                </div>
                                            </form>
                                        </x-modal>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
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
