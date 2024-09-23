@extends('layouts.master')
@section('title')
    Dashboard
@endsection
@section('page-title')
    Dashboard
@endsection
@section('content')
    <div class="row">
        <div class="col-xl-12">
            <div class="row">
                <div class="col-xl-6">
                    <div class="card">
                        <div class="card-body">
                            <div>
                                <div class="d-flex align-items-center">
                                    <div class="avatar">
                                        <div class="avatar-title rounded bg-primary-subtle">
                                            <i class="bx bx-check-shield font-size-24 mb-0 text-primary"></i>
                                        </div>
                                    </div>

                                    <div class="flex-grow-1 ms-3">
                                        <h6 class="mb-0 font-size-15">Total Santri</h6>
                                    </div>
                                </div>

                                <div>
                                    <h4 class="mt-4 pt-1 mb-0 font-size-22">{{ $santri }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6">
                    <div class="card">
                        <div class="card-body">
                            <div>
                                <div class="d-flex align-items-center">
                                    <div class="avatar">
                                        <div class="avatar-title rounded bg-primary-subtle">
                                            <i class="bx bx-cart-alt font-size-24 mb-0 text-primary"></i>
                                        </div>
                                    </div>

                                    <div class="flex-grow-1 ms-3">
                                        <h6 class="mb-0 font-size-15">Total Rayon Kamar</h6>
                                    </div>
                                </div>

                                <div>
                                    <h4 class="mt-4 pt-1 mb-0 font-size-22">{{ $rayonKamar }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-6">
                    <div class="card">
                        <div class="card-body">
                            <div>
                                <div class="d-flex align-items-center">
                                    <div class="avatar">
                                        <div class="avatar-title rounded bg-primary-subtle">
                                            <i class="bx bx-package font-size-24 mb-0 text-primary"></i>
                                        </div>
                                    </div>

                                    <div class="flex-grow-1 ms-3">
                                        <h6 class="mb-0 font-size-15">Total Pengguna</h6>
                                    </div>
                                </div>

                                <div>
                                    <h4 class="mt-4 pt-1 mb-0 font-size-22">{{ $pengguna }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6">
                    <div class="card">
                        <div class="card-body">
                            <div>
                                <div class="d-flex align-items-center">
                                    <div class="avatar">
                                        <div class="avatar-title rounded bg-primary-subtle">
                                            <i class="bx bx-rocket font-size-24 mb-0 text-primary"></i>
                                        </div>
                                    </div>

                                    <div class="flex-grow-1 ms-3">
                                        <h6 class="mb-0 font-size-15">Total Kamar</h6>
                                    </div>
                                </div>

                                <div>
                                    <h4 class="mt-4 pt-1 mb-0 font-size-22">{{ $kamar }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-6">
            <div class="card">
                <div class="card-body pb-0">
                    <div class="d-flex align-items-start">
                        <div class="flex-grow-1">
                            <h5 class="card-title mb-4">Pelanggar Bulanan</h5>
                        </div>
                    </div>

                    <div>
                        <div id="overview" data-colors='["#1F59C6"]' class="apex-chart"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-6">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-start">
                        <div class="flex-grow-1 overflow-hidden">
                            <h5 class="card-title mb-4 text-truncate">Persentase Pelanggaran</h5>
                        </div>
                    </div>
                    <div id="saleing-categories" data-colors='["#EC5455", "#1f58c7"]' class="apex-charts" dir="ltr">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end row -->

    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-start mb-2">
                        <div class="flex-grow-1">
                            <h5 class="card-title">Santri Sering Melanggar</h5>
                        </div>
                    </div>

                    <div class="mx-n4" data-simplebar style="max-height: 216px;">
                        @foreach ($topSantriPelanggar as $item)
                            <div class="border-bottom loyal-customers-box pt-2">
                                <div class="d-flex align-items-center">
                                    <img src="{{ URL::asset('build/images/users/avatar-3.jpg') }}"
                                        class="rounded-circle avatar img-thumbnail" alt="">
                                    <div class="flex-grow-1 ms-3 overflow-hidden">
                                        <h5 class="font-size-15 mb-1 text-truncate">{{ $item->santri->nama }}</h5>
                                        <p class="text-muted text-truncate mb-0">
                                            {{ $item->santri->alamat }}
                                            (Kamar
                                            {{ $item->santri->kamar->rayon->nama . ' - ' . $item->santri->nomor_kamar }})
                                        </p>
                                    </div>
                                    <div class="flex-shrink-0">
                                        <h5 class="font-size-14 mb-0 text-truncate w-xs bg-light p-2 rounded text-center">
                                            {{ $item->jumlah }}
                                        </h5>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- end row -->
@endsection
