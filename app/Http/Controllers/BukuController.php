<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;


class BukuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $buku = Buku::all();
        return view('pages.admin.buku', compact('buku'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kategori = Kategori::all();
        return view('pages.admin.buku.tambah', compact('kategori'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = $request->validate([
            'isbn' => 'required|string',
            'judul' => 'required|string',
            'sinopsis' => 'required|string',
            'penerbit' => 'required|string',
            'cover' => 'required|image|max:10000|mimes:png,jpg',
            'status' => 'required|string',
            'kategori_id' => 'required',
        ]);
        $file = $request->file('cover')->store('buku');
        $validator['cover'] = $file;
        Buku::create($validator);
        return redirect('admin/buku');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Buku  $buku
     * @return \Illuminate\Http\Response
     */
    public function show(Buku $buku)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Buku  $buku
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $buku = Buku::findOrFail($id);
        $kategori = Kategori::all();
        return view('pages.admin.buku.edit', [
            'buku' => $buku,
            'kategori' => $kategori,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Buku  $buku
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $id)
    {
        $buku = Buku::findOrFail($id);
        $validator = $request->validate([
            'isbn' => 'required|string',
            'judul' => 'required|string',
            'sinopsis' => 'required|string',
            'penerbit' => 'required|string',
            'status' => 'required|string',
            'kategori_id' => 'required',
        ]);
        $buku->update($validator);

        $dataLama = Buku::where('id', $id)->first();
        if ($request->file('cover')) {
            $foto1 = public_path('storage/' . $dataLama->cover);
            if (File::exists($foto1)) {
                File::delete($foto1);
            }
            $file = $request->file('cover')->store('buku');
            $buku->update([
                'cover' => $file,
            ]);
            return redirect('admin/buku');
        }
        return redirect('admin/buku');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Buku  $buku
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $dataLama = Buku::where('id', $id)->first();
        $foto1 = public_path('storage/' . $dataLama->cover);
        if (File::exists($foto1)) {
            File::delete($foto1);
        }
        Buku::where('id', $id)->delete();
        return redirect('admin/buku');
    }
}
