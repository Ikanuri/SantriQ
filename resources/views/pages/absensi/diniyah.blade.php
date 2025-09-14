@extends('layouts.master')
@section('title')
    Data Absensi Diniyah
@endsection
@section('page-title')
    Data Absensi Diniyah
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col">
                            <h4 class="card-title mb-0">Data Absensi Diniyah</h4>
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
                                            <a class="dropdown-item text-white" style="background-color:#145A32;" href="{{ route('absensi.diniyah.export') }}">
                                                Export Excel <i class="bi bi-file-earmark-excel"></i>
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item text-white" style="background-color:#2874A6;" href="#" id="importBtn">
                                                Import Excel <i class="bi bi-upload"></i>
                                            </a>
                                            <form id="importForm" action="{{ route('absensi.diniyah.import') }}" method="POST" enctype="multipart/form-data" style="display:none;">
                                                @csrf
                                                <input type="file" name="file" accept=".xlsx,.csv" required id="importFile" style="display:none;">
                                            </form>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <x-modal id="myModal" title="Tambah Data Absensi Diniyah">
                                <form action="{{ route('absensi.diniyah.store') }}" method="POST">
                                    @csrf
                                    <div class="form-group mt-2">
                                        <label for="santri_id">Nama Santri</label>
                                        <select class="form-control @error('santri_id') is-invalid @enderror"
                                            id="santri_id" name="santri_id"
                                            required>
                                            <option value="" selected disabled>Pilih Santri</option>
                                            @foreach ($santri as $s)
                                                <option value="{{ $s->id }}">{{ $s->nama }}</option>
                                            @endforeach
                                        </select>
                                        @error('santri_id')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group mt-2">
                                        <label for="jml_hadir">Jumlah Hadir</label>
                                        <input type="number" class="form-control @error('jml_hadir') is-invalid @enderror"
                                            id="jml_hadir" name="jml_hadir" min="0" value="{{ old('jml_hadir') }}"
                                            required>
                                        @error('jml_hadir')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group mt-2">
                                        <label for="jml_izin">Jumlah Izin</label>
                                        <input type="number" class="form-control @error('jml_izin') is-invalid @enderror"
                                            id="jml_izin" name="jml_izin" min="0" value="{{ old('jml_izin') }}"
                                            required>
                                        @error('jml_izin')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group mt-2">
                                        <label for="jml_sakit">Jumlah Sakit</label>
                                        <input type="number" class="form-control @error('jml_sakit') is-invalid @enderror"
                                            id="jml_sakit" name="jml_sakit" min="0" value="{{ old('jml_sakit') }}"
                                            required>
                                        @error('jml_sakit')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group mt-2">
                                        <label for="jml_alpha">Jumlah Alpha</label>
                                        <input type="number" class="form-control @error('jml_alpha') is-invalid @enderror"
                                            id="jml_alpha" name="jml_alpha" min="0" value="{{ old('jml_alpha') }}"
                                            required>
                                        @error('jml_alpha')
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
                                    <th class="text-center">Nama Santri</th>
                                    <th class="text-center">Jumlah Hadir</th>
                                    <th class="text-center">Jumlah Izin</th>
                                    <th class="text-center">Jumlah Sakit</th>
                                    <th class="text-center">Jumlah Alpha</th>
                                    <th class="text-center">Tahun Akademik</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $diniyah)
                                    <tr>
                                        <td class="text-center">{{ $loop->iteration }}</td>
                                        <td class="text-center">{{ $diniyah->santri->nama }}</td>
                                        <td class="text-center">{{ $diniyah->jml_hadir }}</td>
                                        <td class="text-center">{{ $diniyah->jml_izin }}</td>
                                        <td class="text-center">{{ $diniyah->jml_sakit }}</td>
                                        <td class="text-center">{{ $diniyah->jml_alpha }}</td>
                                        <td class="text-center">{{ $diniyah->tahunAkademik->tahun }}/{{ $diniyah->tahunAkademik->semester }}</td>
                                        <td class="text-center">
                                            <a href="javascript:;" role="button" class="btn btn-warning"
                                                data-bs-toggle="modal"
                                                data-bs-target="#edit-{{ $loop->iteration }}">Edit</a>
                                            <a href="javascript:;" role="button" class="btn btn-danger"
                                                data-bs-toggle="modal"
                                                data-bs-target="#hapus-{{ $loop->iteration }}">Hapus</a>
                                            <x-modal id="hapus-{{ $loop->iteration }}" title="Hapus Data Absensi Diniyah"
                                                position="modal-dialog-centered">
                                                <form class="text-center"
                                                    action="{{ route('absensi.diniyah.destroy', $diniyah->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <p>
                                                        Apakah anda yakin ingin menghapus data absensi ini?
                                                    </p>
                                                    <div class="form-group mt-3">
                                                        <button type="button" data-bs-dismiss="modal"
                                                            class="btn btn-secondary">Batal</button>
                                                        <button type="submit" class="btn btn-danger">Hapus</button>
                                                    </div>
                                                </form>
                                            </x-modal>
                                        </td>
                                        <x-modal id="edit-{{ $loop->iteration }}" title="Edit Data Absensi Diniyah">
                                            <form action="{{ route('absensi.diniyah.update', $diniyah->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <div class="form-group mt-2">
                                                    <label for="santri_id">Nama Santri</label>
                                                    <select class="form-control @error('santri_id') is-invalid @enderror"
                                                        id="santri_id" name="santri_id"
                                                        required>
                                                        <option value="" selected disabled>Pilih Santri</option>
                                                        @foreach ($santri as $s)
                                                            <option value="{{ $s->id }}" {{ $diniyah->santri_id == $s->id ? 'selected' : '' }}>{{ $s->nama }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('santri_id')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="form-group mt-2">
                                                    <label for="jml_hadir">Jumlah Hadir</label>
                                                    <input type="number" class="form-control @error('jml_hadir') is-invalid @enderror"
                                                        id="jml_hadir" name="jml_hadir" min="0" value="{{ old('jml_hadir') ?? $diniyah->jml_hadir }}"
                                                        required>
                                                    @error('jml_hadir')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="form-group mt-2">
                                                    <label for="jml_izin">Jumlah Izin</label>
                                                    <input type="number" class="form-control @error('jml_izin') is-invalid @enderror"
                                                        id="jml_izin" name="jml_izin" min="0" value="{{ old('jml_izin')?? $diniyah->jml_izin }}"
                                                        required>
                                                    @error('jml_izin')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="form-group mt-2">
                                                    <label for="jml_sakit">Jumlah Sakit</label>
                                                    <input type="number" class="form-control @error('jml_sakit') is-invalid @enderror"
                                                        id="jml_sakit" name="jml_sakit" min="0" value="{{ old('jml_sakit')?? $diniyah->jml_sakit }}"
                                                        required>
                                                    @error('jml_sakit')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="form-group mt-2">
                                                    <label for="jml_alpha">Jumlah Alpha</label>
                                                    <input type="number" class="form-control @error('jml_alpha') is-invalid @enderror"
                                                        id="jml_alpha" name="jml_alpha" min="0" value="{{ old('jml_alpha')?? $diniyah->jml_alpha }}"
                                                        required>
                                                    @error('jml_alpha')
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
