@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h5 class="mb-0">Daftar Admin</h5>
        <a class="btn btn-primary" href="{{ route('admins.create') }}">Tambah Admin</a>
    </div>

    <div class="card shadow-sm">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Super</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($admins as $admin)
                    <tr>
                        <td>{{ $admin->nama_lengkap }}</td>
                        <td>{{ $admin->email }}</td>
                        <td>
                            @if($admin->is_super_admin)
                                <span class="badge bg-success">Ya</span>
                            @else
                                <span class="badge bg-secondary">Tidak</span>
                            @endif
                        </td>
                        <td class="d-flex gap-2">
                            <a class="btn btn-sm btn-warning" href="{{ route('admins.edit', $admin->id_pengguna) }}">Edit</a>
                            @if(!$admin->is_super_admin)
                            <form method="POST" action="{{ route('admins.destroy', $admin->id_pengguna) }}" onsubmit="return confirm('Hapus admin ini?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger" type="submit">Hapus</button>
                            </form>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="text-center text-muted">Belum ada admin</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection


