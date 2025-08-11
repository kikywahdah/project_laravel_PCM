<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Aset;
use App\Models\Usaha;
use App\Models\Modal;

class AsetController extends Controller
{
    public function index()
    {
        $asets = Aset::all();
        $totalAset = $asets->count();
        $totalUsaha = Usaha::count();
        $totalModal = Modal::sum('jumlah');

        return view('data_aset.index', compact('asets', 'totalAset', 'totalUsaha', 'totalModal'));
    }

    public function create()
    {
        return view('data_aset.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_aset' => 'required',
            'jenis_aset' => 'required',
            'lokasi' => 'required',
            'luas' => 'nullable',
            'status_kepemilikan' => 'required',
            'tahun_perolehan' => 'required|integer',
            'nilai_aset' => 'nullable|numeric',
            'keterangan' => 'nullable',
        ]);

        Aset::create([
            'id_pengguna' => auth()->id(), // Menggunakan id_pengguna dari user yang login
            'nama_aset' => $request->nama_aset,
            'jenis_aset' => $request->jenis_aset,
            'lokasi' => $request->lokasi,
            'luas' => $request->luas,
            'status_kepemilikan' => $request->status_kepemilikan,
            'tahun_perolehan' => $request->tahun_perolehan,
            'nilai_aset' => $request->nilai_aset,
            'keterangan' => $request->keterangan,
        ]);

        return redirect()->route('data_aset.index')->with('success', 'Aset berhasil ditambahkan');
    }

    public function edit($id)
    {
        $aset = Aset::findOrFail($id);
        return view('data_aset.edit', compact('aset'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_aset' => 'required',
            'jenis_aset' => 'required',
            'lokasi' => 'required',
            'luas' => 'nullable',
            'status_kepemilikan' => 'required',
            'tahun_perolehan' => 'required|integer',
            'nilai_aset' => 'nullable|numeric',
            'keterangan' => 'nullable',
        ]);

        $aset = Aset::findOrFail($id);
        $aset->update([
            'nama_aset' => $request->nama_aset,
            'jenis_aset' => $request->jenis_aset,
            'lokasi' => $request->lokasi,
            'luas' => $request->luas,
            'status_kepemilikan' => $request->status_kepemilikan,
            'tahun_perolehan' => $request->tahun_perolehan,
            'nilai_aset' => $request->nilai_aset,
            'keterangan' => $request->keterangan,
        ]);

        return redirect()->route('data_aset.index')->with('success', 'Aset berhasil diupdate');
    }

    public function destroy($id)
    {
        $aset = Aset::findOrFail($id);
        $aset->delete();
        return redirect()->route('data_aset.index')->with('success', 'Aset berhasil dihapus');
    }
} 