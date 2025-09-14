<?php

namespace App\Http\Controllers;

use App\Models\SuratIzin;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class SuratIzinController extends Controller
{
    protected $model;
    public function __construct(SuratIzin $surat)
    {
        $this->model = $surat;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $surat = $this->model->all();
        return view('pages.surat.index', compact('surat'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|min:5|unique:surat_izins,nama',
        ], [
            'nama.required' => 'Nama harus diisi',
            'nama.string' => 'Nama harus berupa huruf',
            'nama.min' => 'Nama minimal 5 karakter',
            'nama.unique' => 'Nama sudah digunakan',
        ]);
        try {
            $this->model->create($validated);
            return redirect()->back()->with('success', 'Surat Izin berhasil ditambahkan');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Surat Izin gagal ditambahkan');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SuratIzin $surat)
    {
        $validated = $request->validate([
            'nama' => [
                'required',
                'string',
                'min:5',
                Rule::unique('surat_izins', 'nama')->ignoreModel(SuratIzin::findOrFail($surat->id)),
            ],
        ], [
            'nama.required' => 'Nama harus diisi',
            'nama.string' => 'Nama harus berupa huruf',
            'nama.min' => 'Nama minimal 5 karakter',
            'nama.unique' => 'Nama sudah digunakan',
        ]);
        try {
            $surat->update($validated);
            return redirect()->back()->with('success', 'Surat Izin berhasil diubah');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Surat Izin gagal diubah');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SuratIzin $surat)
    {
        try {
            $surat->delete();
            return redirect()->back()->with('success', 'Surat Izin berhasil dihapus');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Surat Izin gagal dihapus');
        }
    }

    // Import/Export
    public function export()
    {
        return \Maatwebsite\Excel\Facades\Excel::download(new \App\Exports\SuratIzinExport, 'surat_izin.xlsx');
    }

    public function import(\Illuminate\Http\Request $request)
    {
        \Maatwebsite\Excel\Facades\Excel::import(new \App\Imports\SuratIzinImport, $request->file('file'));
        return back()->with('success', 'Import berhasil!');
    }
}
