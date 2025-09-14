@extends('layouts.master')
@section('title')
    Data Izin Santri
@endsection
@section('page-title')
    Data Izin Santri
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col">
                            <h4 class="card-title mb-0">Data Izin Santri</h4>
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
                                            <a class="dropdown-item text-white" style="background-color:#145A32;" href="{{ route('izin.santri.export') }}">
                                                Export Excel <i class="bi bi-file-earmark-excel"></i>
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item text-white" style="background-color:#2874A6;" href="#" id="importBtn">
                                                Import Excel <i class="bi bi-upload"></i>
                                            </a>
                                            <form id="importForm" action="{{ route('izin.santri.import') }}" method="POST" enctype="multipart/form-data" style="display:none;">
                                                @csrf
                                                <input type="file" name="file" accept=".xlsx,.csv" required id="importFile" style="display:none;">
                                            </form>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <x-modal id="myModal" title="Tambah Data Izin Santri">
                                <form action="{{ route('izin.santri.store') }}" method="POST">
                                    @csrf
                                    <div class="form-group mt-2">
                                        <label for="santri_id">Nama Santri</label>
                                        <select name="santri_id" id="santri_id"
                                            class="form-control @error('santri_id') is-invalid @enderror">
                                            <option value="">Pilih Santri</option>
                                            @foreach ($santri as $snt)
                                                <option value="{{ $snt->id }}">{{ $snt->nama }}</option>
                                            @endforeach
                                        </select>
                                        @error('santri_id')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group mt-2">
                                        <label for="surat_izin_id">Surat Izin</label>
                                        <select name="surat_izin_id" id="surat_izin_id"
                                            class="form-control @error('surat_izin_id') is-invalid @enderror">
                                            <option value="">Pilih Surat Izin</option>
                                            @foreach ($surat as $sr)
                                                <option value="{{ $sr->id }}">{{ $sr->nama }}</option>
                                            @endforeach
                                        </select>
                                        @error('surat_izin_id')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group mt-2">
                                        <label for="alasan">Alasan</label>
                                        <textarea name="alasan" id="alasan" cols="30" rows="3"
                                            class="form-control @error('alasan') is-invalid @enderror"></textarea>
                                        @error('alasan')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group mt-2">
                                        <label for="tanggal_keluar">Tanggal Keluar</label>
                                        <input type="date" name="tanggal_keluar" id="tanggal_keluar"
                                            class="form-control @error('tanggal_keluar') is-invalid @enderror">
                                        @error('tanggal_keluar')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group mt-2">
                                        <label for="tanggal_kembali">Tanggal Kembali</label>
                                        <input type="date" name="tanggal_kembali" id="tanggal_kembali"
                                            class="form-control @error('tanggal_kembali') is-invalid @enderror">
                                        @error('tanggal_kembali')
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
                                    <th class="text-center">Surat Izin</th>
                                    <th class="text-center">Alasan</th>
                                    <th class="text-center">Keluar</th>
                                    <th class="text-center">Kembali</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $izin)
                                    <tr>
                                        <td class="text-center">{{ $loop->iteration }}</td>
                                        <td class="text-center">{{ $izin->santri->nama }}</td>
                                        <td class="text-center">{{ $izin->surat->nama }}</td>
                                        <td class="text-center">{{ $izin->alasan }}</td>
                                        <td class="text-center">{{ date('d F Y', strtotime($izin->tanggal_keluar)) }}</td>
                                        <td class="text-center">{{ date('d F Y', strtotime($izin->tanggal_kembali)) }}</td>
                                        <td class="text-center">
                                            <a href="javascript:;" role="button" class="btn btn-warning"
                                                data-bs-toggle="modal"
                                                data-bs-target="#edit-{{ $loop->iteration }}">Edit</a>
                                            <a href="javascript:;" role="button" class="btn btn-danger"
                                                data-bs-toggle="modal"
                                                data-bs-target="#hapus-{{ $loop->iteration }}">Hapus</a>
                                            <x-modal id="hapus-{{ $loop->iteration }}" title="Hapus Data Izin Santri"
                                                position="modal-dialog-centered">
                                                <form class="text-center"
                                                    action="{{ route('izin.santri.destroy', $izin->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <p>
                                                        Apakah anda yakin ingin menghapus data izin santri ini?
                                                    </p>
                                                    <div class="form-group mt-3">
                                                        <button type="button" data-bs-dismiss="modal"
                                                            class="btn btn-secondary">Batal</button>
                                                        <button type="submit" class="btn btn-danger">Hapus</button>
                                                    </div>
                                                </form>
                                            </x-modal>
                                        </td>
                                        <x-modal id="edit-{{ $loop->iteration }}" title="Edit Data Izin Santri">
                                            <form action="{{ route('izin.santri.update', $izin->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <div class="form-group mt-2">
                                                    <label for="santri_id">Nama Santri</label>
                                                    <select name="santri_id" id="santri_id"
                                                        class="form-control @error('santri_id') is-invalid @enderror">
                                                        <option value="">Pilih Santri</option>
                                                        @foreach ($santri as $snt)
                                                            <option value="{{ $snt->id }}"
                                                                {{ $izin->santri_id == $snt->id ? 'selected' : '' }}>
                                                                {{ $snt->nama }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    @error('santri_id')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="form-group mt-2">
                                                    <label for="surat_izin_id">Surat Izin</label>
                                                    <select name="surat_izin_id" id="surat_izin_id"
                                                        class="form-control @error('surat_izin_id') is-invalid @enderror">
                                                        <option value="">Pilih Surat Izin</option>
                                                        @foreach ($surat as $sr)
                                                            <option value="{{ $sr->id }}"
                                                                {{ $izin->surat_izin_id == $sr->id ? 'selected' : '' }}>
                                                                {{ $sr->nama }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    @error('surat_izin_id')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="form-group mt-2">
                                                    <label for="alasan">Alasan</label>
                                                    <textarea name="alasan" id="alasan" cols="30" rows="3"
                                                        class="form-control @error('alasan') is-invalid @enderror">{{ $izin->alasan }}</textarea>
                                                    @error('alasan')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="form-group mt-2">
                                                    <label for="tanggal_keluar">Tanggal Keluar</label>
                                                    <input type="date" name="tanggal_keluar" id="tanggal_keluar"
                                                        class="form-control @error('tanggal_keluar') is-invalid @enderror"
                                                        value="{{ $izin->tanggal_keluar }}">
                                                    @error('tanggal_keluar')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="form-group mt-2">
                                                    <label for="tanggal_kembali">Tanggal Kembali</label>
                                                    <input type="date" name="tanggal_kembali" id="tanggal_kembali"
                                                        class="form-control @error('tanggal_kembali') is-invalid @enderror"
                                                        value="{{ $izin->tanggal_kembali }}">
                                                    @error('tanggal_kembali')
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
