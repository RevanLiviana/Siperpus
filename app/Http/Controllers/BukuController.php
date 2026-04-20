<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class BukuController extends Controller
{
    public function index(Request $request)
    {
        $query = Buku::query();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('judul', 'like', "%{$search}%")
                  ->orWhere('kode_buku', 'like', "%{$search}%")
                  ->orWhere('pengarang', 'like', "%{$search}%")
                  ->orWhere('isbn', 'like', "%{$search}%");
            });
        }

        if ($request->filled('kategori')) {
            $query->where('kategori', $request->kategori);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $buku = $query->latest()->paginate(10)->withQueryString();
        $kategoriList = Buku::kategoriList();

        return view('buku.index', compact('buku', 'kategoriList'));
    }

    public function create()
    {
        $kodeBuku = Buku::generateKodeBuku();
        $kategoriList = Buku::kategoriList();
        return view('buku.create', compact('kodeBuku', 'kategoriList'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul'         => 'required|string|min:5|max:100',
            'pengarang'     => 'required|string|min:3|max:30',
            'penerbit'      => 'required|string|min:3|max:30',
            'tahun_terbit'  => 'required|integer|min:2020|max:' . date('Y'),
            'isbn'          => 'nullable|string|max:20|unique:buku,isbn',
            'kategori'      => 'required|string|max:50',
            'stok'          => 'required|integer|min:1',
            'deskripsi'     => 'nullable|string',
            'lokasi_rak'    => 'nullable|string|max:50',
            'status'        => 'required|in:tersedia,tidak_tersedia',
            'cover'         => 'required|image|mimes:jpeg,jpg|min:50|max:200',
        ], [
            // Judul
            'judul.required'        => 'Judul buku wajib diisi.',
            'judul.min'             => 'Judul buku minimal 5 karakter.',
            'judul.max'             => 'Judul buku maksimal 100 karakter.',

            // Pengarang
            'pengarang.required'    => 'Pengarang wajib diisi.',
            'pengarang.min'         => 'Nama pengarang minimal 3 karakter.',
            'pengarang.max'         => 'Nama pengarang maksimal 30 karakter.',

            // Penerbit
            'penerbit.required'     => 'Penerbit wajib diisi.',
            'penerbit.min'          => 'Nama penerbit minimal 3 karakter.',
            'penerbit.max'          => 'Nama penerbit maksimal 30 karakter.',

            // Tahun Terbit
            'tahun_terbit.required' => 'Tahun terbit wajib diisi.',
            'tahun_terbit.integer'  => 'Tahun terbit harus berupa angka.',
            'tahun_terbit.min'      => 'Tahun terbit minimal 2020.',
            'tahun_terbit.max'      => 'Tahun terbit maksimal ' . date('Y') . '.',

            // ISBN
            'isbn.unique'           => 'ISBN sudah terdaftar.',

            // Lainnya
            'kategori.required'     => 'Kategori wajib dipilih.',
            'stok.required'         => 'Stok wajib diisi.',
            'stok.min'              => 'Stok minimal 1.',
            'status.required'       => 'Status wajib dipilih.',

            // Cover
            'cover.required'        => 'Cover buku wajib diupload.',
            'cover.image'           => 'Cover harus berupa file gambar.',
            'cover.mimes'           => 'Cover harus berformat JPG/JPEG saja.',
            'cover.min'             => 'Ukuran cover minimal 50 KB.',
            'cover.max'             => 'Ukuran cover maksimal 200 KB.',
        ]);

        $validated['kode_buku'] = Buku::generateKodeBuku();
        $validated['stok_tersedia'] = $validated['stok'];

        // Simpan file cover ke storage/app/public/covers
        if ($request->hasFile('cover')) {
            $validated['cover'] = $request->file('cover')->store('covers', 'public');
        }

        Buku::create($validated);

        return redirect()->route('buku.index')
            ->with('success', 'Data buku berhasil ditambahkan!');
    }

    public function show(Buku $buku)
    {
        return view('buku.show', compact('buku'));
    }

    public function edit(Buku $buku)
    {
        $kategoriList = Buku::kategoriList();
        return view('buku.edit', compact('buku', 'kategoriList'));
    }

    public function update(Request $request, Buku $buku)
    {
        $validated = $request->validate([
            'judul'         => 'required|string|max:200',
            'pengarang'     => 'required|string|max:100',
            'penerbit'      => 'required|string|max:100',
            'tahun_terbit'  => 'required|digits:4|integer|min:1900|max:' . date('Y'),
            'isbn'          => ['nullable', 'string', 'max:20', Rule::unique('buku', 'isbn')->ignore($buku->id)],
            'kategori'      => 'required|string|max:50',
            'stok'          => 'required|integer|min:1',
            'deskripsi'     => 'nullable|string',
            'lokasi_rak'    => 'nullable|string|max:50',
            'status'        => 'required|in:tersedia,tidak_tersedia',
        ], [
            'judul.required'        => 'Judul buku wajib diisi.',
            'pengarang.required'    => 'Pengarang wajib diisi.',
            'penerbit.required'     => 'Penerbit wajib diisi.',
            'tahun_terbit.required' => 'Tahun terbit wajib diisi.',
            'tahun_terbit.digits'   => 'Tahun terbit harus 4 digit.',
            'isbn.unique'           => 'ISBN sudah digunakan buku lain.',
            'kategori.required'     => 'Kategori wajib dipilih.',
            'stok.required'         => 'Stok wajib diisi.',
            'stok.min'              => 'Stok minimal 1.',
            'status.required'       => 'Status wajib dipilih.',
        ]);

        // Update stok_tersedia secara proporsional
        $selisih = $validated['stok'] - $buku->stok;
        $validated['stok_tersedia'] = max(0, $buku->stok_tersedia + $selisih);

        $buku->update($validated);

        return redirect()->route('buku.index')
            ->with('success', 'Data buku berhasil diperbarui!');
    }

    public function destroy(Buku $buku)
    {
        $buku->delete();

        return redirect()->route('buku.index')
            ->with('success', 'Data buku berhasil dihapus!');
    }
}