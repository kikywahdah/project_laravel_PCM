<?php

namespace App\Http\Controllers;

use App\Models\Pengguna;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class AdminController extends Controller
{
    public function index()
    {
        $admins = Pengguna::admins()->orderBy('nama_lengkap')->get();
        $pendingUsers = Pengguna::pendingApproval()->orderBy('tanggal_dibuat')->get();
        
        return view('admin.index', compact('admins', 'pendingUsers'));
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
            'is_approved' => true,
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

    public function approveUser($id)
    {
        $pengguna = Pengguna::findOrFail($id);
        
        if ($pengguna->is_approved) {
            return back()->with('error', 'Akun ini sudah disetujui sebelumnya.');
        }

        $pengguna->update(['is_approved' => true]);

        // Send approval notification email
        $this->sendApprovalNotification($pengguna, true);

        Log::info('User approved by admin', [
            'user_id' => $pengguna->id_pengguna,
            'email' => $pengguna->email,
            'approved_by' => auth()->user()->email
        ]);

        return back()->with('success', 'Akun berhasil disetujui. Email notifikasi telah dikirim.');
    }

    public function rejectUser($id)
    {
        $pengguna = Pengguna::findOrFail($id);
        
        if ($pengguna->is_approved) {
            return back()->with('error', 'Akun ini sudah disetujui sebelumnya.');
        }

        // Send rejection notification email
        $this->sendApprovalNotification($pengguna, false);

        // Delete rejected user
        $pengguna->delete();

        Log::info('User rejected by admin', [
            'user_id' => $pengguna->id_pengguna,
            'email' => $pengguna->email,
            'rejected_by' => auth()->user()->email
        ]);

        return back()->with('success', 'Akun berhasil ditolak dan dihapus. Email notifikasi telah dikirim.');
    }

    public function pendingUsers()
    {
        $pendingUsers = Pengguna::pendingApproval()->orderBy('tanggal_dibuat')->get();
        return view('admin.pending-users', compact('pendingUsers'));
    }

    private function sendApprovalNotification(Pengguna $pengguna, bool $approved)
    {
        try {
            $subject = $approved ? 'Akun Anda Telah Disetujui - PCM Benowo' : 'Akun Anda Ditolak - PCM Benowo';
            $message = $approved ? 
                "Selamat! Akun Anda telah disetujui oleh admin. Anda sekarang dapat login ke sistem PCM Benowo." :
                "Maaf, akun Anda tidak disetujui oleh admin. Silakan hubungi admin untuk informasi lebih lanjut.";

            Mail::send('emails.approval_notification', [
                'pengguna' => $pengguna,
                'approved' => $approved,
                'message' => $message
            ], function ($mail) use ($pengguna, $subject) {
                $mail->to($pengguna->email)
                     ->subject($subject);
            });

            Log::info('Approval notification sent', [
                'user_id' => $pengguna->id_pengguna,
                'email' => $pengguna->email,
                'approved' => $approved
            ]);
        } catch (\Exception $e) {
            Log::error('Failed to send approval notification', [
                'error' => $e->getMessage(),
                'user_id' => $pengguna->id_pengguna
            ]);
        }
    }
}


