<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Modal;

class ModalController extends Controller
{
    public function index()
    {
        $modals = Modal::all();
        return view('modal.index', compact('modals'));
    }

    public function create()
    {
        return view('modal.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'sumber_modal' => 'required',
            'jumlah' => 'required|numeric',
            'tanggal_terima' => 'required|date',
            'keterangan' => 'nullable',
        ]);

        Modal::create([
            'id_pengguna' => auth()->id(), // Menggunakan id_pengguna dari user yang login
            'sumber_modal' => $request->sumber_modal,
            'jumlah' => $request->jumlah,
            'tanggal_terima' => $request->tanggal_terima,
            'keterangan' => $request->keterangan,
        ]);
        return redirect()->route('modal.index')->with('success', 'Modal berhasil ditambahkan');
    }

    public function edit($id)
    {
        $modal = Modal::findOrFail($id);
        return view('modal.edit', compact('modal'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'sumber_modal' => 'required',
            'jumlah' => 'required|numeric',
            'tanggal_terima' => 'required|date',
            'keterangan' => 'nullable',
        ]);

        $modal = Modal::findOrFail($id);
        $modal->update([
            'sumber_modal' => $request->sumber_modal,
            'jumlah' => $request->jumlah,
            'tanggal_terima' => $request->tanggal_terima,
            'keterangan' => $request->keterangan,
        ]);
        return redirect()->route('modal.index')->with('success', 'Modal berhasil diupdate');
    }

    public function destroy($id)
    {
        $modal = Modal::findOrFail($id);
        $modal->delete();
        return redirect()->route('modal.index')->with('success', 'Modal berhasil dihapus');
    }
} 