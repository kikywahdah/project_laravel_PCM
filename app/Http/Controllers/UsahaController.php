<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usaha;

class UsahaController extends Controller
{
    public function index()
    {
        $usahas = Usaha::all();
        return view('usaha.index', compact('usahas'));
    }

    public function create()
    {
        return view('usaha.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_usaha' => 'required',
            'jenis_usaha' => 'required',
            'keterangan' => 'nullable',
        ]);

        Usaha::create([
            'id_pengguna' => auth()->id(), // Menggunakan id_pengguna dari user yang login
            'nama_usaha' => $request->nama_usaha,
            'jenis_usaha' => $request->jenis_usaha,
            'keterangan' => $request->keterangan,
        ]);
        return redirect()->route('usaha.index')->with('success', 'Usaha berhasil ditambahkan');
    }

    public function edit($id)
    {
        $usaha = Usaha::findOrFail($id);
        return view('usaha.edit', compact('usaha'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_usaha' => 'required',
            'jenis_usaha' => 'required',
            'keterangan' => 'nullable',
        ]);

        $usaha = Usaha::findOrFail($id);
        $usaha->update([
            'nama_usaha' => $request->nama_usaha,
            'jenis_usaha' => $request->jenis_usaha,
            'keterangan' => $request->keterangan,
        ]);
        return redirect()->route('usaha.index')->with('success', 'Usaha berhasil diupdate');
    }

    public function destroy($id)
    {
        $usaha = Usaha::findOrFail($id);
        $usaha->delete();
        return redirect()->route('usaha.index')->with('success', 'Usaha berhasil dihapus');
    }
} 