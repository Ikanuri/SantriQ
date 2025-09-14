@extends('layouts.master')
@section('title')
    Data Pelanggaran Santri
@endsection
@section('page-title')
    Data Pelanggaran Santri
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col">
                            <h4 class="card-title mb-0">Data Pelanggaran Santri</h4>
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
                                            <a class="dropdown-item text-white" style="background-color:#145A32;" href="{{ route('pelanggaran.santri.export') }}">
                                                Export Excel <i class="bi bi-file-earmark-excel"></i>
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item text-white" style="background-color:#2874A6;" href="#" id="importBtn">
                                                Import Excel <i class="bi bi-upload"></i>
                                            </a>
                                            <form id="importForm" action="{{ route('pelanggaran.santri.import') }}" method="POST" enctype="multipart/form-data" style="display:none;">
                                                @csrf
                                                <input type="file" name="file" accept=".xlsx,.csv" required id="importFile" style="display:none;">
                                            </form>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <x-modal id="myModal" title="Tambah Data Pelanggaran Santri">
                                <form action="{{ route('pelanggaran.santri.store') }}" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-6">
                                                <label for="santri_id">Nama Santri</label>
                                                <select name="santri_id" id="santri_id"
                                                    class="form-control @error('santri_id') is-invalid @enderror">
                                                    <option value="" selected disabled>Pilih Santri</option>
                                                    @foreach ($santri as $sn)
                                                        <option value="{{ $sn->id }}">
                                                            {{ $sn->nama }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('santri_id')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col">
                                                <label for="pelanggaran_id">Pelanggaran</label>
                                                <select name="pelanggaran_id" id="pelanggaran_id"
                                                    class="form-control @error('pelanggaran_id') is-invalid @enderror">
                                                    <option value="" selected disabled>Pilih Pelanggaran</option>
                                                    @foreach ($pelanggaran as $plg)
                                                        <option value="{{ $plg->id }}">
                                                            {{ $plg->nama }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('pelanggaran_id')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group mt-2">
                                        <label for="jumlah">Jumlah</label>
                                        <input type="number" class="form-control @error('jumlah') is-invalid @enderror"
                                            id="jumlah" name="jumlah" min="1" value="{{ old('jumlah') }}"
                                            required>
                                        @error('jumlah')
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
                                    <th class="text-center">Pelanggaran</th>
                                    <th class="text-center">Jumlah</th>
                                    <th class="text-center">Kamar</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $plgSantri)
                                    <tr>
                                        <td class="text-center">{{ $loop->iteration }}</td>
                                        <td class="text-center">{{ $plgSantri->santri->nama }}</td>
                                        <td class="text-center">{{ $plgSantri->pelanggaran->nama }}</td>
                                        <td class="text-center">{{ $plgSantri->jumlah }}</td>
                                        <td class="text-center">
                                            {{ $plgSantri->santri->kamar->rayon->nama . '-' . $plgSantri->santri->nomor_kamar }}
                                        </td>
                                        <td class="text-center">
                                            <a href="javascript:;" role="button" class="btn btn-warning"
                                                data-bs-toggle="modal"
                                                data-bs-target="#edit-{{ $loop->iteration }}">Edit</a>
                                            <a href="javascript:;" role="button" class="btn btn-danger"
                                                data-bs-toggle="modal"
                                                data-bs-target="#hapus-{{ $loop->iteration }}">Hapus</a>
                                            <x-modal id="hapus-{{ $loop->iteration }}" title="Hapus Data santri"
                                                position="modal-dialog-centered">
                                                <form class="text-center"
                                                    action="{{ route('pelanggaran.santri.destroy', $plgSantri->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <p>
                                                        Apakah anda yakin ingin menghapus data santri ini?
                                                    </p>
                                                    <div class="form-group mt-3">
                                                        <button type="button" data-bs-dismiss="modal"
                                                            class="btn btn-secondary">Batal</button>
                                                        <button type="submit" class="btn btn-danger">Hapus</button>
                                                    </div>
                                                </form>
                                            </x-modal>
                                        </td>
                                        <x-modal id="edit-{{ $loop->iteration }}" title="Edit Data Santri">
                                            <form action="{{ route('pelanggaran.santri.update', $plgSantri->id) }}"
                                                method="POST">
                                                @csrf
                                                @method('PUT')
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-6">
                                                            <label for="santri_id">Nama Santri</label>
                                                            <select name="santri_id" id="santri_id"
                                                                class="form-control @error('santri_id') is-invalid @enderror">
                                                                <option value="" selected disabled>Pilih Santri
                                                                </option>
                                                                @foreach ($santri as $sn)
                                                                    <option value="{{ $sn->id }}"
                                                                        {{ $plgSantri->santri_id == $sn->id ? 'selected' : '' }}>
                                                                        {{ $sn->nama }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                            @error('santri_id')
                                                                <div class="invalid-feedback">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                        <div class="col">
                                                            <label for="pelanggaran_id">Pelanggaran</label>
                                                            <select name="pelanggaran_id" id="pelanggaran_id"
                                                                class="form-control @error('pelanggaran_id') is-invalid @enderror">
                                                                <option value="" selected disabled>Pilih Pelanggaran
                                                                </option>
                                                                @foreach ($pelanggaran as $plg)
                                                                    <option value="{{ $plg->id }}"
                                                                        {{ $plgSantri->pelanggaran_id == $plg->id ? 'selected' : '' }}>
                                                                        {{ $plg->nama }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                            @error('pelanggaran_id')
                                                                <div class="invalid-feedback">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group mt-2">
                                                    <label for="jumlah">Jumlah</label>
                                                    <input type="number"
                                                        class="form-control @error('jumlah') is-invalid @enderror"
                                                        id="jumlah" name="jumlah" min="1"
                                                        value="{{ old('jumlah') ?? $plgSantri->jumlah }}" required>
                                                    @error('jumlah')
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
