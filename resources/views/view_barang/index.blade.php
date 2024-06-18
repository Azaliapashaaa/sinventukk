@extends('layouts.adm-main')

@section('content')
    <div class="container">
    <div class="pull-left">
		    <h2>BARANG</h2>
		</div>
        

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                    <div class="row mb-3">
            <div class="col-md-6">
                <form action="{{ route('barang.index') }}" method="GET" class="form-inline">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control" placeholder="Cari barang..." value="{{ request('search') }}">
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="submit">
                                <i class="fa fa-search"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-md-6 text-right">
                <a href="{{ route('barang.create') }}" class="btn btn-success">TAMBAH BARANG</a>
            </div>
        </div>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Merk</th>
                                    <th>Seri</th>
                                    <th>Spesifikasi</th>
                                    <th>Stok</th>
                                    <th>Kategori</th>
                                    <th style="width: 15%">Aksi</th> 
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($rsetBarang as $rowbarang)
                                    <tr>
                                        <td>{{ ++$i }}</td>
                                        <td>{{ $rowbarang->merk }}</td>
                                        <td>{{ $rowbarang->seri }}</td>
                                        <td>{{ $rowbarang->spesifikasi }}</td>
                                        <td>{{ $rowbarang->stok }}</td>
                                        <td>{{ $rowbarang->kategori->deskripsi ?? 'No Category' }}</td>
                                        <td class="text-center"> 
                                            <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{ route('barang.destroy', $rowbarang->id) }}" method="POST">
                                                <a href="{{ route('barang.show', $rowbarang->id) }}" class="btn btn-sm btn-dark"><i class="fa fa-eye"></i></a>
                                                <a href="{{ route('barang.edit', $rowbarang->id) }}" class="btn btn-sm btn-primary"><i class="fa fa-pencil-alt"></i></a>
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center">Data Barang belum tersedia</td>
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
