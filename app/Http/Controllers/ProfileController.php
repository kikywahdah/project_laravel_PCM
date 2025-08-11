<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function show()
    {
        $user = Auth::user();
        return view('profile.show', compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'nama_lengkap' => ['required','string','max:100'],
            'email' => ['required','email','max:100','unique:pengguna,email,'.$user->id_pengguna.',id_pengguna'],
            'password' => ['nullable','string','min:8','confirmed'],
        ]);

        $user->nama_lengkap = $validated['nama_lengkap'];
        $user->email = $validated['email'];
        if (!empty($validated['password'])) {
            $user->kata_sandi = Hash::make($validated['password']);
        }
        $user->save();

        return redirect()->route('profile.show')->with('success', 'Profil berhasil diperbarui');
    }
}


