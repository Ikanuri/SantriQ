<?php

namespace App\Http\Controllers;

use App\Models\Pelanggaran;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PelanggaranController extends Controller
{
    protected $model;
    public function __construct(Pelanggaran $pelanggaran)
    {
        $this->model = $pelanggaran;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pelanggaran = $this->model->all();
        return view('pages.pelanggaran.index', compact('pelanggaran'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|min:5',
        ], [
            'nama.required' => 'Nama harus diisi',
            'nama.string' => 'Nama harus berupa huruf',
            'nama.min' => 'Nama minimal 5 karakter',
        ]);
        try {
            $this->model->create($validated);
            return redirect()->back()->with('success', 'Pelanggaran berhasil ditambahkan');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Pelanggaran gagal ditambahkan');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pelanggaran $pelanggaran)
    {
        $validated = $request->validate([
            'nama' => [
                'required',
                'string',
                'min:5',
                Rule::unique('pelanggarans', 'nama')->ignoreModel(Pelanggaran::findOrFail($pelanggaran->id)),
            ],
        ], [
            'nama.required' => 'Nama harus diisi',
            'nama.string' => 'Nama harus berupa huruf',
            'nama.min' => 'Nama minimal 5 karakter',
            'nama.unique' => 'Nama sudah digunakan',
        ]);
        try {
            $pelanggaran->update($validated);
            return redirect()->back()->with('success', 'Pelanggaran berhasil diubah');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Pelanggaran gagal diubah');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pelanggaran $pelanggaran)
    {
        try {
            $pelanggaran->delete();
            return redirect()->back()->with('success', 'Pelanggaran berhasil dihapus');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Pelanggaran gagal dihapus');
        }
    }

    // Import/Export
    public function export()
    {
        return \Maatwebsite\Excel\Facades\Excel::download(new \App\Exports\PelanggaranExport, 'pelanggaran.xlsx');
    }

    public function import(\Illuminate\Http\Request $request)
    {
        \Maatwebsite\Excel\Facades\Excel::import(new \App\Imports\PelanggaranImport, $request->file('file'));
        return back()->with('success', 'Import berhasil!');
    }
}
