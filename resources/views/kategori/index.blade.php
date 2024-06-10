@extends('layouts.adm-main')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <a href="{{ route('kategori.create') }}" class="btn btn-md btn-success mb-3">TAMBAH KATEGORI</a>
                    </div>
                </div>

                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <!-- <th>Id</th> -->
                            <th>Deskripsi </th>
                            <th>Jenis</th>
                            <th style="width: 15%">Aksi</th>

                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($rsetKategori as $rowbarang)
                            <tr>
                                <!-- <td>{{ $rowbarang->id  }}</td> -->
                                <td>{{ $rowbarang->deskripsi  }}</td>
                                <td>{{ $rowbarang->kategori }}</td>
                                <td class="text-center"> 
                                    <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{ route('kategori.destroy', $rowbarang->id) }}" method="POST">
                                        <a href="{{ route('kategori.show', $rowbarang->id) }}" class="btn btn-sm btn-dark"><i class="fa fa-eye"></i></a>
                                        <a href="{{ route('kategori.edit', $rowbarang->id) }}" class="btn btn-sm btn-primary"><i class="fa fa-pencil-alt"></i></a>
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>
                                    </form>
                                </td>
                                
                            </tr>
                        @empty
                            <div class="alert">
                                Data Kategori belum tersedia
                            </div>
                        @endforelse
                    </tbody>
                    
                </table>
                

            </div>
        </div>
    </div>
@endsection