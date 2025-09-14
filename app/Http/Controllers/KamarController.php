<?php

namespace App\Http\Controllers;

use App\Models\Kamar;
use App\Models\RayonKamar;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class KamarController extends Controller
{
    protected $model;
    public function __construct(Kamar $kamar)
    {
        $this->model = $kamar;
    }
    public function index()
    {
        $kamar = Kamar::with('rayon')->get();
        $rayon = RayonKamar::all();
        return view('pages.kamar.index', compact('kamar', 'rayon'));
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'jumlah_kamar' => 'required|numeric',
            'rayon_kamar_id' => [
                'required',
                'exists:App\Models\RayonKamar,id',
                Rule::unique('kamars', 'rayon_kamar_id'),
            ],
        ], [
            'rayon_kamar_id.exists' => 'Rayon tidak ditemukan',
            'rayon_kamar_id.required' => 'Rayon harus diisi',
            'rayon_kamar_id.unique' => 'Rayon sudah ada',
            'jumlah_kamar.required' => 'Jumlah kamar harus diisi',
            'jumlah_kamar.numeric' => 'Jumlah kamar harus berupa angka',
        ]);
        try {
            $this->model->create($validated);
            return redirect()->back()->with('success', 'Data berhasil disimpan');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }
    public function update(Request $request, Kamar $kamar)
    {
        $validated = $request->validate([
            'jumlah_kamar' => 'required|numeric',
            'rayon_kamar_id' => [
                'required',
                'exists:App\Models\RayonKamar,id',
                Rule::unique('rayon_kamars', 'id')->ignoreModel(RayonKamar::find($request->rayon_kamar_id)),
            ],
        ], [
            'rayon_kamar_id.exists' => 'Rayon tidak ditemukan',
            'rayon_kamar_id.required' => 'Rayon harus diisi',
            'rayon_kamar_id.unique' => 'Rayon sudah ada',
            'jumlah_kamar.required' => 'Jumlah kamar harus diisi',
            'jumlah_kamar.numeric' => 'Jumlah kamar harus berupa angka',
        ]);
        try {
            $kamar->update($validated);
            return redirect()->back()->with('success', 'Data berhasil diupdate');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }
    public function destroy(Kamar $kamar)
    {
        try {
            $kamar->delete();
            return redirect()->back()->with('success', 'Data berhasil dihapus');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    // Import/Export
    public function export()
    {
        return \Maatwebsite\Excel\Facades\Excel::download(new \App\Exports\KamarExport, 'kamar.xlsx');
    }

    public function import(\Illuminate\Http\Request $request)
    {
        \Maatwebsite\Excel\Facades\Excel::import(new \App\Imports\KamarImport, $request->file('file'));
        return back()->with('success', 'Import berhasil!');
    }
}
