@extends('layouts.master')
@section('title')
    Data Santri
@endsection
@section('page-title')
    Data Santri
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col">
                            <h4 class="card-title mb-0">Data Santri</h4>
                        </div>
                        <div class="col">
                            <a href="javascript:;" role="button" class="btn btn-primary float-end" data-bs-toggle="modal"
                                data-bs-target="#myModal">Tambah Data</a>
                            <x-modal id="myModal" title="Tambah Data Santri">
                                <form action="{{ route('santri.store') }}" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-6">
                                                <label for="kamar_id">Nama Kamar</label>
                                                <select name="kamar_id" id="kamar_id"
                                                    class="form-control @error('kamar_id') is-invalid @enderror">
                                                    <option value="" selected disabled>Pilih Kamar</option>
                                                    @foreach ($kamar as $kmr)
                                                        <option value="{{ $kmr->id }}"
                                                            data-kamar="{{ $kmr->jumlah_kamar }}">
                                                            {{ $kmr->rayon->nama }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('kamar_id')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col">
                                                <label for="nomor_kamar">Nomor Kamar</label>
                                                <input type="number" name="nomor_kamar" id="nomor_kamar"
                                                    class="form-control @error('nomor_kamar') is-invalid @enderror" required
                                                    min="1">
                                                @error('nomor_kamar')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group mt-2">
                                        <label for="nama">Nama Lengkap</label>
                                        <input type="text" class="form-control @error('nama') is-invalid @enderror"
                                            id="nama" name="nama" value="{{ old('nama') }}" required>
                                        @error('nama')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group mt-2">
                                        <label for="alamat">Alamat Lengkap</label>
                                        <textarea class="form-control @error('alamat') is-invalid @enderror" id="alamat" name="alamat" min="1"
                                            required>{{ old('alamat') }}</textarea>
                                        @error('alamat')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group mt-2">
                                        <label for="tempat_lahir">Tempat Lahir</label>
                                        <input type="text"
                                            class="form-control @error('tempat_lahir') is-invalid @enderror"
                                            id="tempat_lahir" name="tempat_lahir" min="1"
                                            value="{{ old('tempat_lahir') }}" required>
                                        @error('tempat_lahir')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group mt-2">
                                        <label for="tanggal_lahir">Tanggal Lahir</label>
                                        <input type="date"
                                            class="form-control @error('tanggal_lahir') is-invalid @enderror"
                                            id="tanggal_lahir" name="tanggal_lahir" min="1"
                                            value="{{ old('tanggal_lahir') }}" required>
                                        @error('tanggal_lahir')
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
                                    <th class="text-center">Alamat</th>
                                    <th class="text-center">Tempat/Tanggal Lahir</th>
                                    <th class="text-center">Kamar</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($santri as $sn)
                                    <tr>
                                        <td class="text-center">{{ $loop->iteration }}</td>
                                        <td class="text-center">{{ $sn->nama }}</td>
                                        <td class="text-center">{{ $sn->alamat }}</td>
                                        <td class="text-center">{{ $sn->tempat_lahir . '/' . $sn->tanggal_lahir }}</td>
                                        <td class="text-center">{{ $sn->kamar->rayon->nama . '-' . $sn->nomor_kamar }}</td>
                                        <td class="text-center">
                                            <a href="javascript:;" role="button" class="btn btn-warning"
                                                data-bs-toggle="modal"
                                                data-bs-target="#edit-{{ $loop->iteration }}">Edit</a>
                                            <a href="javascript:;" role="button" class="btn btn-danger"
                                                data-bs-toggle="modal"
                                                data-bs-target="#hapus-{{ $loop->iteration }}">Hapus</a>
                                            <x-modal id="hapus-{{ $loop->iteration }}" title="Hapus Data santri"
                                                position="modal-dialog-centered">
                                                <form class="text-center" action="{{ route('santri.destroy', $sn->id) }}"
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
                                            <form action="{{ route('santri.update', $sn->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-6">
                                                            <label for="kamar_id-{{ $loop->iteration }}">Nama
                                                                Kamar</label>
                                                            <select name="kamar_id" id="kamar_id-{{ $loop->iteration }}"
                                                                class="form-control @error('kamar_id') is-invalid @enderror">
                                                                <option value="" selected disabled>Pilih Kamar
                                                                </option>
                                                                @foreach ($kamar as $kmr)
                                                                    <option value="{{ $kmr->id }}"
                                                                        data-kamar="{{ $kmr->jumlah_kamar }}"
                                                                        {{ $sn->kamar_id == $kmr->id ? 'selected' : '' }}>
                                                                        {{ $kmr->rayon->nama }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                            @error('kamar_id')
                                                                <div class="invalid-feedback">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                        <div class="col">
                                                            <label for="nomor_kamar-{{ $loop->iteration }}">Nomor
                                                                Kamar</label>
                                                            <input type="number" name="nomor_kamar"
                                                                id="nomor_kamar-{{ $loop->iteration }}"
                                                                class="form-control @error('nomor_kamar') is-invalid @enderror"
                                                                min="1"
                                                                value="{{ old('nomor_kamar') ?? $sn->nomor_kamar }}"
                                                                required>
                                                            @error('nomor_kamar')
                                                                <div class="invalid-feedback">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group mt-2">
                                                    <label for="nama">Nama Lengkap</label>
                                                    <input type="text"
                                                        class="form-control @error('nama') is-invalid @enderror"
                                                        id="nama" name="nama"
                                                        value="{{ old('nama') ?? $sn->nama }}" required>
                                                    @error('nama')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="form-group mt-2">
                                                    <label for="alamat">Alamat Lengkap</label>
                                                    <textarea class="form-control @error('alamat') is-invalid @enderror" id="alamat" name="alamat" min="1"
                                                        required>{{ old('alamat') ?? $sn->alamat }}</textarea>
                                                    @error('alamat')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="form-group mt-2">
                                                    <label for="tempat_lahir">Tempat Lahir</label>
                                                    <input type="text"
                                                        class="form-control @error('tempat_lahir') is-invalid @enderror"
                                                        id="tempat_lahir" name="tempat_lahir" min="1"
                                                        value="{{ old('tempat_lahir') ?? $sn->tempat_lahir }}" required>
                                                    @error('tempat_lahir')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="form-group mt-2">
                                                    <label for="tanggal_lahir">Tanggal Lahir</label>
                                                    <input type="date"
                                                        class="form-control @error('tanggal_lahir') is-invalid @enderror"
                                                        id="tanggal_lahir" name="tanggal_lahir" min="1"
                                                        value="{{ old('tanggal_lahir') ?? $sn->tanggal_lahir }}" required>
                                                    @error('tanggal_lahir')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="form-group mt-2">
                                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                                </div>
                                            </form>
                                        </x-modal>
                                        @push('scripts')
                                            <script>
                                                $(document).ready(function() {
                                                    $('#edit-{{ $loop->iteration }}').on('shown.bs.modal', function() {
                                                        let jumlah_kamar = $('#kamar_id-{{ $loop->iteration }} option:selected').data(
                                                            'kamar');
                                                        $('#nomor_kamar-{{ $loop->iteration }}').attr('max', jumlah_kamar);
                                                        if ($('#nomor_kamar-{{ $loop->iteration }}').next('small').length) {
                                                            $('#nomor_kamar-{{ $loop->iteration }}').next('small').remove();
                                                        }
                                                        $('#nomor_kamar-{{ $loop->iteration }}').after(
                                                            `<small class="text-muted">Max: ${jumlah_kamar}</small>`);

                                                        $('#kamar_id-{{ $loop->iteration }}').change(function() {
                                                            let jumlah_kamar = $('#kamar_id-{{ $loop->iteration }} option:selected').data(
                                                                'kamar');
                                                            $('#nomor_kamar-{{ $loop->iteration }}').attr('max', jumlah_kamar);
                                                            if ($('#nomor_kamar-{{ $loop->iteration }}').next('small').length) {
                                                                $('#nomor_kamar-{{ $loop->iteration }}').next('small').remove();
                                                            }
                                                            $('#nomor_kamar-{{ $loop->iteration }}').after(
                                                                `<small class="text-muted">Max: ${jumlah_kamar}</small>`);
                                                        });
                                                    })
                                                });
                                            </script>
                                        @endpush
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
            $('#kamar_id').change(function() {
                let jumlah_kamar = $('#kamar_id option:selected').data('kamar');
                $('#nomor_kamar').attr('max', jumlah_kamar);
                if ($('#nomor_kamar').next('small').length) {
                    $('#nomor_kamar').next('small').remove();
                }
                $('#nomor_kamar').after(`<small class="text-muted">Max: ${jumlah_kamar}</small>`);
            });
        });
    </script>
@endpush
