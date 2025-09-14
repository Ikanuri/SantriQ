<?php

namespace App\Http\Controllers;

use App\Models\Pelanggaran;
use App\Models\PelanggaranSantri;
use App\Models\Santri;
use Illuminate\Http\Request;

class PelanggaranSantriController extends Controller
{
    protected $model, $santri, $pelanggaran;
    public function __construct(PelanggaranSantri $pelanggaranSantri, Santri $santri, Pelanggaran $pelanggaran)
    {
        $this->model = $pelanggaranSantri;
        $this->santri = $santri;
        $this->pelanggaran = $pelanggaran;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = $this->model->with('santri', 'pelanggaran')->get();
        $santri = $this->santri->all();
        $pelanggaran = $this->pelanggaran->all();
        return view('pages.pelanggaran_santri.index', compact('data', 'santri', 'pelanggaran'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validasi = $request->validate([
            'santri_id' => 'required|exists:santris,id',
            'pelanggaran_id' => 'required|exists:pelanggarans,id',
            'jumlah' => 'required|integer|min:1',
        ], [
            'santri_id.required' => 'Santri tidak boleh kosong',
            'santri_id.exists' => 'Santri tidak valid',
            'pelanggaran_id.required' => 'Pelanggaran tidak boleh kosong',
            'pelanggaran_id.exists' => 'Pelanggaran tidak valid',
            'jumlah.required' => 'Jumlah tidak boleh kosong',
            'jumlah.integer' => 'Jumlah harus berupa angka',
            'jumlah.min' => 'Jumlah harus minimal 1',
        ]);
        try {
            $this->model->create($validasi);
            return redirect()->back()->with('success', 'Data berhasil ditambahkan');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Data gagal ditambahkan');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PelanggaranSantri $pelanggaranSantri)
    {
        $validasi = $request->validate([
            'santri_id' => 'required|exists:santris,id',
            'pelanggaran_id' => 'required|exists:pelanggarans,id',
            'jumlah' => 'required|integer|min:1',
        ], [
            'santri_id.required' => 'Santri tidak boleh kosong',
            'santri_id.exists' => 'Santri tidak valid',
            'pelanggaran_id.required' => 'Pelanggaran tidak boleh kosong',
            'pelanggaran_id.exists' => 'Pelanggaran tidak valid',
            'jumlah.required' => 'Jumlah tidak boleh kosong',
            'jumlah.integer' => 'Jumlah harus berupa angka',
            'jumlah.min' => 'Jumlah harus minimal 1',
        ]);
        try {
            $pelanggaranSantri->update($validasi);
            return redirect()->back()->with('success', 'Data berhasil diubah');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Data gagal diubah');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PelanggaranSantri $pelanggaranSantri)
    {
        try {
            $pelanggaranSantri->delete();
            return redirect()->back()->with('success', 'Data berhasil dihapus');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Data gagal dihapus');
        }
    }

    // Import/Export
    public function export()
    {
        return \Maatwebsite\Excel\Facades\Excel::download(new \App\Exports\PelanggaranSantriExport, 'pelanggaran_santri.xlsx');
    }

    public function import(\Illuminate\Http\Request $request)
    {
        \Maatwebsite\Excel\Facades\Excel::import(new \App\Imports\PelanggaranSantriImport, $request->file('file'));
        return back()->with('success', 'Import berhasil!');
    }
}
