<?php

namespace App\Http\Controllers;

use App\Models\Pengguna;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function index()
    {
        $admins = Pengguna::admins()->orderBy('nama_lengkap')->get();
        return view('admin.index', compact('admins'));
    }

    public function create()
    {
        return view('admin.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_lengkap' => ['required','string','max:100'],
            'email' => ['required','email','max:100','unique:pengguna,email'],
            'password' => ['required','string','min:8','confirmed'],
        ]);

        Pengguna::create([
            'nama_lengkap' => $validated['nama_lengkap'],
            'email' => $validated['email'],
            'kata_sandi' => Hash::make($validated['password']),
            'is_admin' => true,
        ]);

        return redirect()->route('admins.index')->with('success','Admin berhasil dibuat');
    }

    public function edit(Pengguna $admin)
    {
        return view('admin.edit', compact('admin'));
    }

    public function update(Request $request, Pengguna $admin)
    {
        $validated = $request->validate([
            'nama_lengkap' => ['required','string','max:100'],
            'email' => ['required','email','max:100','unique:pengguna,email,'.$admin->id_pengguna.',id_pengguna'],
            'password' => ['nullable','string','min:8','confirmed'],
        ]);

        $admin->nama_lengkap = $validated['nama_lengkap'];
        $admin->email = $validated['email'];
        if (!empty($validated['password'])) {
            $admin->kata_sandi = Hash::make($validated['password']);
        }
        $admin->save();

        return redirect()->route('admins.index')->with('success','Admin diperbarui');
    }

    public function destroy(Pengguna $admin)
    {
        if ($admin->isSuperAdmin()) {
            return back()->with('error','Super admin tidak dapat dihapus');
        }

        $admin->delete();
        return redirect()->route('admins.index')->with('success','Admin dihapus');
    }
}


