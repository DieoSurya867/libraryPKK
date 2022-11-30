@extends('layouts.admin')

@section('content')
    <div class="container">
        <form action="{{ url('admin/buku') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="container-xxl flex-grow-1 container-p-y">
                <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Admin / Buku /</span> Tambah Buku</h4>
                <!-- Form controls -->
                <div class="col-md-6">
                    <div class="card mb-4">

                        <h5 class="card-header">Form Controls</h5>
                        <div class="card-body">

                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">International Standard Book Number
                                    (ISBN)</label>
                                <input type="text"
                                    class="form-control @error('isbn') is-invalid
                          @enderror"
                                    id="exampleFormControlInput1" name="isbn" value="{{ old('isbn') }}" />
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlReadOnlyInput1" class="form-label">Judul Buku</label>
                                <input class="form-control @error('judul') is-invalid
                          @enderror"
                                    type="text" id="exampleFormControlReadOnlyInput1" name="judul"
                                    value="{{ old('judul') }}" />
                            </div>
                            <div class="input-group">
                                <span class="input-group-text">Sinopsis</span>
                                <textarea class="form-control @error('sinopsis') is-invalid @enderror" aria-label="With textarea" name="sinopsis"
                                    value="{{ old('sinopsis') }}">
                            </textarea>
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlReadOnlyInput1" class="form-label">Penerbit</label>
                                <input
                                    class="form-control @error('penerbit') is-invalid
                          @enderror"
                                    type="text" id="exampleFormControlReadOnlyInput1" name="penerbit"
                                    value="{{ old('penerbit') }}" />
                            </div>
                            <div class="mb-3">
                                <label for="formFile" class="form-label">File Foto Buku</label>
                                <input class="form-control" type="file" id="formFile" name="cover" />
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlSelect1" class="form-label">Pilih Kategori Buku</label>
                                <select
                                    class="form-select @error('kategori_id') is-invalid
                          @enderror"
                                    id="exampleFormControlSelect1" aria-label="Default select example" name="kategori_id">
                                    <option selected>Pilih Nama Kategori</option>
                                    @foreach ($kategori as $item)
                                        <option value="{{ $item->id }}" @selected(old('kategori_id') == $item->id)>
                                            {{ $item->namaKategori }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md">
                                <small class="text-light fw-semibold">Status Buku</small>
                                <div class="form-check mt-1">
                                    <input name="status" class="form-check-input" type="radio" value="tampil"
                                        id="defaultRadio1" />
                                    <label class="form-check-label" for="defaultRadio1"> Ditampilkan </label>
                                </div>
                                <div class="form-check">
                                    <input name="status" class="form-check-input" type="radio" value="tidak"
                                        id="defaultRadio2" checked />
                                    <label class="form-check-label" for="defaultRadio2"> Tidak Ditampilkan </label>
                                </div>
                            </div>

                            <div>
                                <button type="submit" class="mt-3 ms-1 btn btn-sm  btn-outline-primary">Tambah
                                    Data</button>

                            </div>
                        </div>
                    </div>
        </form>
    </div>
@endsection
