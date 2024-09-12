<?php

namespace App\Http\Controllers;

use App\Models\TahunAkademik;
use Illuminate\Http\Request;

class TahunAkademikController extends Controller
{
    protected $model;
    public function __construct(TahunAkademik $tahun)
    {
        $this->model = $tahun;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tahun = $this->model->all();
        return view('pages.tahunAkademik.index', compact('tahun'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'tahun' => 'required|numeric',
        ], [
            'tahun.required' => 'Tahun harus diisi',
            'tahun.numeric' => 'Tahun harus berupa angka',
        ]);
        try {
            $semester = ['Ganjil', 'Genap'];
            foreach ($semester as $key => $value) {
                $this->model->create([
                    'tahun' => $validated['tahun'],
                    'semester' => $value,
                ]);
            }
            return redirect()->back()->with('success', 'Tahun Akademik berhasil ditambahkan');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Tahun Akademik gagal ditambahkan');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TahunAkademik $tahun)
    {
        $validated = $request->validate([
            'tahun' => 'required|numeric',
            'semester' => 'required|numeric|in:1,2',
        ], [
            'tahun.required' => 'Tahun harus diisi',
            'tahun.numeric' => 'Tahun harus berupa angka',
            'semester.required' => 'Semester harus diisi',
            'semester.numeric' => 'Semester harus berupa angka',
            'semester.in' => 'Semester antara 1 atau 2',
        ]);
        try {
            $tahun->update($validated);
            return redirect()->back()->with('success', 'Tahun Akademik berhasil diubah');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Tahun Akademik gagal diubah');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TahunAkademik $tahun)
    {
        try {
            $this->model->where('tahun', $tahun->tahun)->delete();
            return redirect()->back()->with('success', 'Tahun Akademik berhasil dihapus');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Tahun Akademik gagal dihapus');
        }
    }

    /**
     * Aktifkan tahun akademik
     */
    public function aktif(TahunAkademik $tahun)
    {
        try {
            $status = 0;
            $cekTahun = $this->model->where('status', true)->where('tahun', $tahun->tahun)->first();
            if ($cekTahun) {
                $status = 1;
                $cekTahun->update([
                    'status' => false,
                ]);
            } else {
                $cek = $this->model->where('status', true)->first();
                if ($cek) {
                    return redirect()->back()->with('error', 'Tahun Akademik gagal diaktifkan, tahun akademik lain sudah aktif');
                }
                $status = 1;
            }
            $tahun->update([
                'status' => $status,
            ]);
            return redirect()->back()->with('success', 'Tahun Akademik berhasil diaktifkan');
        } catch (\Throwable $th) {
            dd($th->getMessage());
            return redirect()->back()->with('error', 'Tahun Akademik gagal diaktifkan');
        }
    }
}
