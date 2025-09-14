@extends('layouts.master')
@section('title')
    Data Kamar
@endsection
@section('page-title')
    Data Kamar
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col">
                            <h4 class="card-title mb-0">Data Kamar</h4>
                        </div>
                        <div class="col">
                            <div class="btn-group float-end" role="group">
                                <a href="javascript:;" role="button" class="btn btn-primary me-2" data-bs-toggle="modal" data-bs-target="#myModal">Tambah Data</a>
                                <div class="btn-group" role="group">
                                    <button type="button" class="btn btn-success dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                        Export/Import <i class="bi bi-file-earmark-excel" style="margin-left:5px;"></i>
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <a class="dropdown-item text-white" style="background-color:#145A32;" href="{{ route('kamar.export') }}">
                                                Export Excel <i class="bi bi-file-earmark-excel"></i>
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item text-white" style="background-color:#2874A6;" href="#" id="importBtn">
                                                Import Excel <i class="bi bi-upload"></i>
                                            </a>
                                            <form id="importForm" action="{{ route('kamar.import') }}" method="POST" enctype="multipart/form-data" style="display:none;">
                                                @csrf
                                                <input type="file" name="file" accept=".xlsx,.csv" required id="importFile" style="display:none;">
                                            </form>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <x-modal id="myModal" title="Tambah Data Kamar">
                                <form action="{{ route('kamar.store') }}" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <label for="rayon_kamar_id">Nama Rayon</label>
                                        <select name="rayon_kamar_id" id="rayon_kamar_id"
                                            class="form-control @error('rayon_kamar_id') is-invalid @enderror">
                                            <option value="" selected disabled>Pilih Rayon</option>
                                            @foreach ($rayon as $r)
                                                <option value="{{ $r->id }}">{{ $r->nama }}</option>
                                            @endforeach
                                        </select>
                                        @error('rayon_kamar_id')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="jumlah_kamar">Jumlah Kamar</label>
                                        <input type="number"
                                            class="form-control @error('jumlah_kamar') is-invalid @enderror"
                                            id="jumlah_kamar" name="jumlah_kamar" min="1"
                                            value="{{ old('jumlah_kamar') }}" required>
                                        @error('jumlah_kamar')
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
                                    <th class="text-center">Nama Rayon</th>
                                    <th class="text-center">Jumlah Kamar</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($kamar as $kmr)
                                    <tr>
                                        <td class="text-center">{{ $loop->iteration }}</td>
                                        <td class="text-center">{{ $kmr->rayon->nama }}</td>
                                        <td class="text-center">{{ $kmr->jumlah_kamar }}</td>
                                        <td class="text-center">
                                            <a href="javascript:;" role="button" class="btn btn-warning"
                                                data-bs-toggle="modal"
                                                data-bs-target="#edit-{{ $loop->iteration }}">Edit</a>
                                            <a href="javascript:;" role="button" class="btn btn-danger"
                                                data-bs-toggle="modal"
                                                data-bs-target="#hapus-{{ $loop->iteration }}">Hapus</a>
                                            <x-modal id="hapus-{{ $loop->iteration }}" title="Hapus Data kamar"
                                                position="modal-dialog-centered">
                                                <form class="text-center" action="{{ route('kamar.destroy', $kmr->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <p>
                                                        Apakah anda yakin ingin menghapus data kamar ini?
                                                    </p>
                                                    <div class="form-group mt-3">
                                                        <button type="button" data-bs-dismiss="modal"
                                                            class="btn btn-secondary">Batal</button>
                                                        <button type="submit" class="btn btn-danger">Hapus</button>
                                                    </div>
                                                </form>
                                            </x-modal>
                                        </td>
                                        <x-modal id="edit-{{ $loop->iteration }}" title="Edit Data Kamar">
                                            <form action="{{ route('kamar.update', $kmr->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <div class="form-group">
                                                    <label for="rayon_kamar_id">Nama Rayon</label>
                                                    <select name="rayon_kamar_id" id="rayon_kamar_id"
                                                        class="form-control @error('rayon_kamar_id') is-invalid @enderror">
                                                        <option value="" selected disabled>Pilih Rayon</option>
                                                        @foreach ($rayon as $r)
                                                            <option value="{{ $r->id }}"
                                                                {{ $kmr->rayon_kamar_id == $r->id ? 'selected' : '' }}>
                                                                {{ $r->nama }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    @error('rayon_kamar_id')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="jumlah_kamar">Jumlah Kamar</label>
                                                    <input type="text"
                                                        class="form-control @error('jumlah_kamar') is-invalid @enderror"
                                                        id="jumlah_kamar" name="jumlah_kamar"
                                                        value="{{ old('jumlah_kamar') ?? $kmr->jumlah_kamar }}" required>
                                                    @error('jumlah_kamar')
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

            // Import Excel logic
            $('#importBtn').on('click', function(e) {
                e.preventDefault();
                $('#importFile').click();
            });
            $('#importFile').on('change', function() {
                $('#importForm').submit();
            });
        });
    </script>
@endpush
