<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AnggotaController extends Controller
{
    public function index(Request $request)
    {
        $query = Anggota::query();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nama_lengkap', 'like', "%{$search}%")
                  ->orWhere('no_anggota', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $anggota = $query->latest()->paginate(10)->withQueryString();

        return view('anggota.index', compact('anggota'));
    }

    public function create()
    {
        $noAnggota = Anggota::generateNoAnggota();
        return view('anggota.create', compact('noAnggota'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_lengkap'    => 'required|string|max:100',
            'jenis_kelamin'   => 'required|in:L,P',
            'tanggal_lahir'   => 'required|date|before:today',
            'alamat'          => 'required|string',
            'no_telepon'      => 'required|string|max:15',
            'email'           => 'required|email|unique:anggota,email',
            'status'          => 'required|in:aktif,non-aktif',
            'tanggal_daftar'  => 'required|date',
            'tanggal_expire'  => 'required|date|after:tanggal_daftar',
        ], [
            'nama_lengkap.required'   => 'Nama lengkap wajib diisi.',
            'jenis_kelamin.required'  => 'Jenis kelamin wajib dipilih.',
            'tanggal_lahir.required'  => 'Tanggal lahir wajib diisi.',
            'tanggal_lahir.before'    => 'Tanggal lahir harus sebelum hari ini.',
            'alamat.required'         => 'Alamat wajib diisi.',
            'no_telepon.required'     => 'No. telepon wajib diisi.',
            'email.required'          => 'Email wajib diisi.',
            'email.email'             => 'Format email tidak valid.',
            'email.unique'            => 'Email sudah terdaftar.',
            'tanggal_daftar.required' => 'Tanggal daftar wajib diisi.',
            'tanggal_expire.required' => 'Tanggal expire wajib diisi.',
            'tanggal_expire.after'    => 'Tanggal expire harus setelah tanggal daftar.',
        ]);

        $validated['no_anggota'] = Anggota::generateNoAnggota();

        Anggota::create($validated);

        return redirect()->route('anggota.index')
            ->with('success', 'Data anggota berhasil ditambahkan!');
    }

    public function show(Anggota $anggotum)
    {
        return view('anggota.show', ['anggota' => $anggotum]);
    }

    public function edit(Anggota $anggotum)
    {
        return view('anggota.edit', ['anggota' => $anggotum]);
    }

    public function update(Request $request, Anggota $anggotum)
    {
        $validated = $request->validate([
            'nama_lengkap'    => 'required|string|max:100',
            'jenis_kelamin'   => 'required|in:L,P',
            'tanggal_lahir'   => 'required|date|before:today',
            'alamat'          => 'required|string',
            'no_telepon'      => 'required|string|max:15',
            'email'           => ['required', 'email', Rule::unique('anggota', 'email')->ignore($anggotum->id)],
            'status'          => 'required|in:aktif,non-aktif',
            'tanggal_daftar'  => 'required|date',
            'tanggal_expire'  => 'required|date|after:tanggal_daftar',
        ], [
            'email.unique'         => 'Email sudah digunakan anggota lain.',
            'tanggal_lahir.before' => 'Tanggal lahir harus sebelum hari ini.',
            'tanggal_expire.after' => 'Tanggal expire harus setelah tanggal daftar.',
        ]);

        $anggotum->update($validated);

        return redirect()->route('anggota.index')
            ->with('success', 'Data anggota berhasil diperbarui!');
    }

    public function destroy(Anggota $anggotum)
    {
        $anggotum->delete();

        return redirect()->route('anggota.index')
            ->with('success', 'Data anggota berhasil dihapus!');
    }
}