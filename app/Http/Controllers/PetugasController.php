<?php

namespace App\Http\Controllers;

use App\Models\Petugas;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PetugasController extends Controller
{
    public function index(Request $request)
    {
        $query = Petugas::query();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nama_lengkap', 'like', "%{$search}%")
                  ->orWhere('nip', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('jabatan')) {
            $query->where('jabatan', $request->jabatan);
        }

        $petugas = $query->latest()->paginate(10)->withQueryString();

        return view('petugas.index', compact('petugas'));
    }

    public function create()
    {
        $nip = Petugas::generateNip();
        return view('petugas.create', compact('nip'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_lengkap'  => 'required|string|max:100',
            'jenis_kelamin' => 'required|in:L,P',
            'tanggal_lahir' => 'required|date|before:today',
            'alamat'        => 'required|string',
            'no_telepon'    => 'required|string|max:15',
            'email'         => 'required|email|unique:petugas,email',
            'jabatan'       => 'required|in:kepala_perpustakaan,pustakawan,staf_administrasi,teknisi',
            'status'        => 'required|in:aktif,non-aktif',
            'tanggal_masuk' => 'required|date',
        ], [
            'nama_lengkap.required'  => 'Nama lengkap wajib diisi.',
            'jenis_kelamin.required' => 'Jenis kelamin wajib dipilih.',
            'tanggal_lahir.required' => 'Tanggal lahir wajib diisi.',
            'tanggal_lahir.before'   => 'Tanggal lahir harus sebelum hari ini.',
            'alamat.required'        => 'Alamat wajib diisi.',
            'no_telepon.required'    => 'No. telepon wajib diisi.',
            'email.required'         => 'Email wajib diisi.',
            'email.email'            => 'Format email tidak valid.',
            'email.unique'           => 'Email sudah terdaftar.',
            'jabatan.required'       => 'Jabatan wajib dipilih.',
            'tanggal_masuk.required' => 'Tanggal masuk wajib diisi.',
        ]);

        $validated['nip'] = Petugas::generateNip();

        Petugas::create($validated);

        return redirect()->route('petugas.index')
            ->with('success', 'Data petugas berhasil ditambahkan!');
    }

    public function show(Petugas $petuga)
    {
        return view('petugas.show', ['petugas' => $petuga]);
    }

    public function edit(Petugas $petuga)
    {
        return view('petugas.edit', ['petugas' => $petuga]);
    }

    public function update(Request $request, Petugas $petuga)
    {
        $validated = $request->validate([
            'nama_lengkap'  => 'required|string|max:100',
            'jenis_kelamin' => 'required|in:L,P',
            'tanggal_lahir' => 'required|date|before:today',
            'alamat'        => 'required|string',
            'no_telepon'    => 'required|string|max:15',
            'email'         => ['required', 'email', Rule::unique('petugas', 'email')->ignore($petuga->id)],
            'jabatan'       => 'required|in:kepala_perpustakaan,pustakawan,staf_administrasi,teknisi',
            'status'        => 'required|in:aktif,non-aktif',
            'tanggal_masuk' => 'required|date',
        ], [
            'email.unique'         => 'Email sudah digunakan petugas lain.',
            'tanggal_lahir.before' => 'Tanggal lahir harus sebelum hari ini.',
        ]);

        $petuga->update($validated);

        return redirect()->route('petugas.index')
            ->with('success', 'Data petugas berhasil diperbarui!');
    }

    public function destroy(Petugas $petuga)
    {
        $petuga->delete();

        return redirect()->route('petugas.index')
            ->with('success', 'Data petugas berhasil dihapus!');
    }
}