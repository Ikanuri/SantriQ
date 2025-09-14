<?php

namespace App\Http\Controllers;

use App\Models\IzinSantri;
use App\Models\Santri;
use App\Models\SuratIzin;
use Illuminate\Http\Request;

class IzinSantriController extends Controller
{
    protected $model, $santri, $surat;
    public function __construct(IzinSantri $model, Santri $santri, SuratIzin $surat)
    {
        $this->model = $model;
        $this->santri = $santri;
        $this->surat = $surat;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = $this->model->orderBy('id', 'desc')->get();
        $santri = $this->santri->orderBy('id', 'desc')->get();
        $surat = $this->surat->orderBy('id', 'desc')->get();
        return view('pages.izin_santri.index', compact('data', 'santri', 'surat'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validasi = $request->validate([
            'santri_id' => 'required|exists:santris,id',
            'surat_izin_id' => 'required|exists:surat_izins,id',
            'alasan' => 'required|string|max:255',
            'tanggal_keluar' => 'required|date',
            'tanggal_kembali' => 'required|date',
        ], [
            'santri_id.required' => 'Santri tidak boleh kosong',
            'santri_id.exists' => 'Santri tidak valid',
            'surat_izin_id.required' => 'Surat tidak boleh kosong',
            'surat_izin_id.exists' => 'Surat tidak valid',
            'alasan.required' => 'Alasan tidak boleh kosong',
            'alasan.string' => 'Alasan harus berupa string',
            'alasan.max' => 'Alasan maksimal 255 karakter',
            'tanggal_keluar.required' => 'Tanggal keluar tidak boleh kosong',
            'tanggal_keluar.date' => 'Tanggal keluar harus berupa tanggal',
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
    public function update(Request $request, IzinSantri $izinSantri)
    {
        $validasi = $request->validate([
            'santri_id' => 'required|exists:santris,id',
            'surat_izin_id' => 'required|exists:surat_izins,id',
            'alasan' => 'required|string|max:255',
            'tanggal_keluar' => 'required|date',
            'tanggal_kembali' => 'required|date',
        ], [
            'santri_id.required' => 'Santri tidak boleh kosong',
            'santri_id.exists' => 'Santri tidak valid',
            'surat_izin_id.required' => 'Surat tidak boleh kosong',
            'surat_izin_id.exists' => 'Surat tidak valid',
            'alasan.required' => 'Alasan tidak boleh kosong',
            'alasan.string' => 'Alasan harus berupa string',
            'alasan.max' => 'Alasan maksimal 255 karakter',
            'tanggal_keluar.required' => 'Tanggal keluar tidak boleh kosong',
            'tanggal_keluar.date' => 'Tanggal keluar harus berupa tanggal',
        ]);
        try {
            $izinSantri->update($validasi);
            return redirect()->back()->with('success', 'Data berhasil diubah');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Data gagal diubah');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(IzinSantri $izinSantri)
    {
        try {
            $izinSantri->delete();
            return redirect()->back()->with('success', 'Data berhasil dihapus');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Data gagal dihapus');
        }
    }

    // Import/Export
    public function export()
    {
        return \Maatwebsite\Excel\Facades\Excel::download(new \App\Exports\IzinSantriExport, 'izin_santri.xlsx');
    }

    public function import(\Illuminate\Http\Request $request)
    {
        \Maatwebsite\Excel\Facades\Excel::import(new \App\Imports\IzinSantriImport, $request->file('file'));
        return back()->with('success', 'Import berhasil!');
    }
}
