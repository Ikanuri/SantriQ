<?php

namespace App\Http\Controllers;

use App\Models\RayonKamar;
use Illuminate\Http\Request;

class RayonKamarController extends Controller
{
    protected $model;
    public function __construct(RayonKamar $rayonKamar)
    {
        $this->model = $rayonKamar;
    }
    public function index()
    {
        $rayonKamars = RayonKamar::all();
        return view('pages.rayon-kamar.index', compact('rayonKamars'));
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required',
        ]);
        try {
            $this->model->create($validated);
            return redirect()->back()->with('success', 'Data berhasil disimpan');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }
    public function update(Request $request, RayonKamar $rayon)
    {
        $validated = $request->validate([
            'nama' => 'required',
        ]);
        try {
            $rayon->update($validated);
            return redirect()->back()->with('success', 'Data berhasil diupdate');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }
    public function destroy(RayonKamar $rayon)
    {
        try {
            $rayon->delete();
            return redirect()->back()->with('success', 'Data berhasil dihapus');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    // Import/Export
    public function export()
    {
        return \Maatwebsite\Excel\Facades\Excel::download(new \App\Exports\RayonKamarExport, 'rayon_kamar.xlsx');
    }

    public function import(\Illuminate\Http\Request $request)
    {
        \Maatwebsite\Excel\Facades\Excel::import(new \App\Imports\RayonKamarImport, $request->file('file'));
        return back()->with('success', 'Import berhasil!');
    }
}
