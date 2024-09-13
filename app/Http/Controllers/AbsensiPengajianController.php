<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\Santri;
use App\Models\TahunAkademik;
use Illuminate\Http\Request;

class AbsensiPengajianController extends Controller
{
    protected $model;
    public function __construct(Absensi $absensi)
    {
        $this->model = $absensi;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = $this->model->with('santri', 'tahunAkademik')->where('departemen', 'Pengajian')->get();
        $santri = Santri::all();
        return view('pages.absensi.pengajian', compact('data', 'santri'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validasi = $request->validate([
            'santri_id' => 'required|exists:santris,id',
            'jml_alpha' => 'required|integer|min:0',
            'jml_sakit' => 'required|integer|min:0',
            'jml_izin' => 'required|integer|min:0',
            'jml_hadir' => 'required|integer|min:0',
        ], [
            'santri_id.required ' => 'Nama Santri tidak boleh kosong',
            'jml_alpha.required' => 'Jumlah Alpha tidak boleh kosong',
            'jml_sakit.required' => 'Jumlah Sakit tidak boleh kosong',
            'jml_izin.required' => 'Jumlah Izin tidak boleh kosong',
            'jml_hadir.required' => 'Jumlah Hadir tidak boleh kosong',
            'jml_hadir.integer' => 'Jumlah Hadir harus berupa angka',
            'jml_alpha.integer' => 'Jumlah Alpha harus berupa angka',
            'jml_sakit.integer' => 'Jumlah Sakit harus berupa angka',
            'jml_izin.integer' => 'Jumlah Izin harus berupa angka',
            'jml_alpha.min' => 'Jumlah Alpha tidak boleh kurang dari 0',
            'jml_sakit.min' => 'Jumlah Sakit tidak boleh kurang dari 0',
            'jml_izin.min' => 'Jumlah Izin tidak boleh kurang dari 0',
            'jml_hadir.min' => 'Jumlah Hadir tidak boleh kurang dari 0',
        ]);
        try {
            $validasi['tahun_akademik_id'] = TahunAkademik::where('status', 'aktif')->first()->id;
            $validasi['departemen'] = 'Pengajian';
            $this->model->create($validasi);
            return redirect()->back()->with('success', 'Data berhasil ditambahkan');
        } catch (\Throwable $th) {
            dd($th->getMessage());
            return redirect()->back()->with('error', 'Data gagal ditambahkan');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Absensi $absensi)
    {
        $validasi = $request->validate([
            'santri_id' => 'required|exists:santris,id',
            'jml_alpha' => 'required|integer|min:0',
            'jml_sakit' => 'required|integer|min:0',
            'jml_izin' => 'required|integer|min:0',
            'jml_hadir' => 'required|integer|min:0',
        ], [
            'santri_id.required ' => 'Nama Santri tidak boleh kosong',
            'jml_alpha.required' => 'Jumlah Alpha tidak boleh kosong',
            'jml_sakit.required' => 'Jumlah Sakit tidak boleh kosong',
            'jml_izin.required' => 'Jumlah Izin tidak boleh kosong',
            'jml_hadir.required' => 'Jumlah Hadir tidak boleh kosong',
            'jml_alpha.min' => 'Jumlah Alpha tidak boleh kurang dari 0',
            'jml_sakit.min' => 'Jumlah Sakit tidak boleh kurang dari 0',
            'jml_izin.min' => 'Jumlah Izin tidak boleh kurang dari 0',
            'jml_hadir.min' => 'Jumlah Hadir tidak boleh kurang dari 0',
            'jml_hadir.integer' => 'Jumlah Hadir harus berupa angka',
            'jml_alpha.integer' => 'Jumlah Alpha harus berupa angka',
            'jml_sakit.integer' => 'Jumlah Sakit harus berupa angka',
            'jml_izin.integer' => 'Jumlah Izin harus berupa angka',
        ]);
        try {
            $absensi->update($validasi);
            return redirect()->back()->with('success', 'Data berhasil diubah');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Data gagal diubah');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Absensi $absensi)
    {
        try {
            $absensi->delete();
            return redirect()->back()->with('success', 'Data berhasil dihapus');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Data gagal dihapus');
        }
    }
}
