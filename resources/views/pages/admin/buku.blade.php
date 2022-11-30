@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="card">
            <h5 class="card-header">Table Buku</h5>
            <div class="table-responsive text-nowrap">
                <a href="{{ route('buku.create') }}" class="mt-4 ms-4 mb-4 btn btn-sm  btn-outline-primary">Tambah Buku</a>
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>ISBN</th>
                            <th>Judul</th>
                            <th>Sinopsis</th>
                            <th>Penerbit</th>
                            <th>Cover</th>
                            <th>Kategori</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @foreach ($buku as $item)
                            <tr>
                                <td><i class="fab fa-angular fa-lg text-danger me-3"></i>
                                    <strong>{{ $item['isbn'] }}</strong>
                                </td>
                                <td>{{ $item['judul'] }}</td>
                                <td>{{ $item['sinopsis'] }}
                                </td>
                                <td>{{ $item['penerbit'] }}</td>
                                <td><img src="{{ asset('storage/' . $item->cover) }}" alt="" width="100px"
                                        height="100px">
                                </td>
                                <td>{{ $item->kategori->namaKategori }}</td>
                                <td>{{ $item['status'] }}</td>

                                {{-- <td>{{ $item->client }}</td> --}}
                                <td>
                                    <div class="dropdown">
                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                            data-bs-toggle="dropdown">
                                            <i class="bx bx-dots-vertical-rounded"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="{{ route('buku.edit', $item->id) }}"><i
                                                    class="bx bx-edit-alt me-1"></i> Edit</a>
                                            {{-- <a class="dropdown-item" href="{{ url('deleteproduk/' . $item->id) }}"><i
                                                        class="bx bx-trash me-1"></i> Delete</a> --}}
                                            <a class="dropdown-item" href="{{ route('deletebuku', $item->id) }}"><i
                                                    class="bx bx-trash me-1"></i>
                                                Delete</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
