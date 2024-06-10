@extends('layouts.adm-main')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Detail Barang Keluar</div>

                    <div class="card-body">
                        <p><strong>Nama Barang:</strong> {{ $barangKeluar->barang->merk }}</p>
                        <p><strong>Tanggal Keluar:</strong> {{ $barangKeluar->tgl_keluar }}</p>
                        <p><strong>Jumlah Keluar:</strong> {{ $barangKeluar->qty_keluar }}</p>
                        

                        <!-- You can display other details here -->

                        <div class="text-center">
                            <a href="{{ route('barangkeluar.index') }}" class="btn btn-primary">Kembali</a>
                        </div> 
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection