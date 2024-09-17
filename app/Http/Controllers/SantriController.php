<?php

namespace App\Http\Controllers;

use App\Models\Kamar;
use App\Models\Santri;
use Illuminate\Http\Request;

class SantriController extends Controller
{
    protected $model;
    public function __construct(Santri $santri)
    {
        $this->model = $santri;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $santri = Santri::with('kamar')->get();
        $kamar = Kamar::with('rayon')->get();
        return view('pages.santri.index', compact('santri', 'kamar'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'kamar_id' => 'required|exists:App\Models\Kamar,id',
            'nomor_kamar' => 'required|numeric',
            'nama' => 'required|string|min:5',
            'alamat' => 'required|string',
            'tempat_lahir' => 'required|string',
            'tanggal_lahir' => 'required|date',
        ], [
            'kamar_id.required' => 'Kamar harus diisi',
            'kamar_id.exists' => 'Kamar tidak ditemukan',
            'nomor_kamar.required' => 'Nomor kamar harus diisi',
            'nomor_kamar.numeric' => 'Nomor kamar harus berupa angka',
            'nama.required' => 'Nama harus diisi',
            'nama.string' => 'Nama harus berupa huruf',
            'nama.min' => 'Nama minimal 5 karakter',
            'alamat.required' => 'Alamat harus diisi',
            'alamat.string' => 'Alamat harus berupa huruf',
            'tempat_lahir.required' => 'Tempat lahir harus diisi',
            'tempat_lahir.string' => 'Tempat lahir harus berupa huruf',
            'tanggal_lahir.required' => 'Tanggal lahir harus diisi',
            'tanggal_lahir.date' => 'Tanggal lahir harus berupa tanggal',
        ]);
        try {
            $this->model->create($validated);
            return redirect()->back()->with('success', 'Santri berhasil ditambahkan');
        } catch (\Throwable $th) {
            dd($th->getMessage());
            return redirect()->back()->with('error', 'Santri gagal ditambahkan');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Santri $santri)
    {
        $validated = $request->validate([
            'kamar_id' => 'required|exists:App\Models\Kamar,id',
            'nomor_kamar' => 'required|numeric',
            'nama' => 'required|string|min:5',
            'alamat' => 'required|string',
            'tempat_lahir' => 'required|string',
            'tanggal_lahir' => 'required|date',
        ], [
            'kamar_id.required' => 'Kamar harus diisi',
            'kamar_id.exists' => 'Kamar tidak ditemukan',
            'nomor_kamar.required' => 'Nomor kamar harus diisi',
            'nomor_kamar.numeric' => 'Nomor kamar harus berupa angka',
            'nama.required' => 'Nama harus diisi',
            'nama.string' => 'Nama harus berupa huruf',
            'nama.min' => 'Nama minimal 5 karakter',
            'alamat.required' => 'Alamat harus diisi',
            'alamat.string' => 'Alamat harus berupa huruf',
            'tempat_lahir.required' => 'Tempat lahir harus diisi',
            'tempat_lahir.string' => 'Tempat lahir harus berupa huruf',
            'tanggal_lahir.required' => 'Tanggal lahir harus diisi',
            'tanggal_lahir.date' => 'Tanggal lahir harus berupa tanggal',
        ]);
        try {
            $santri->update($validated);
            return redirect()->back()->with('success', 'Santri berhasil diubah');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Santri gagal diubah');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Santri $santri)
    {
        try {
            $santri->delete();
            return redirect()->back()->with('success', 'Santri berhasil dihapus');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Santri gagal dihapus');
        }
    }
}
