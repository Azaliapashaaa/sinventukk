@extends('layouts.adm-main')

@section('content')
    <div class="container">
        <div class="pull-left">
            <h2>KATEGORI</h2>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <form action="{{ route('kategori.index') }}" method="GET" class="form-inline">
                                    <div class="input-group">
                                        <input type="text" name="query" class="form-control" placeholder="Cari kategori..." value="{{ request('query') }}">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="submit">
                                                <i class="fa fa-search"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="col-md-6 text-right">
                                <a href="{{ route('kategori.create') }}" class="btn btn-success">TAMBAH KATEGORI</a>
                            </div>
                        </div>
                        <!-- Tabel Kategori -->
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Deskripsi</th>
                                    <th>Jenis</th>
                                    <th>Keterangan</th>
                                    <th style="width: 15%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($kategoriAll as $row)
                                    <tr>
                                        <td>{{ $row->deskripsi }}</td>
                                        <td>{{ $row->kategori }}</td>
                                        <td>{{ $row->ketkategori }}</td> <!-- Menambahkan kolom KETERANGAN -->
                                        <td class="text-center">
                                            <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{ route('kategori.destroy', $row->id) }}" method="POST">
                                                <a href="{{ route('kategori.show', $row->id) }}" class="btn btn-sm btn-dark"><i class="fa fa-eye"></i></a>
                                                <a href="{{ route('kategori.edit', $row->id) }}" class="btn btn-sm btn-primary"><i class="fa fa-pencil-alt"></i></a>
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center">Data Kategori belum tersedia</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
