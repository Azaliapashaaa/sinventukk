@extends('layouts.adm-main')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        Edit Barang Keluar
                    </div>
                    <div class="card-body">
                        <form action="{{ route('barangkeluar.update', $barangKeluar->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="form-group">
                                <label for="tgl_keluar" class="font-weight-bold">Tanggal Keluar</label>
                                <input type="date" class="form-control @error('tgl_keluar') is-invalid @enderror" name="tgl_keluar" value="{{ old('tgl_keluar', $barangKeluar->tgl_keluar) }}" required>
                                @error('tgl_keluar')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="qty_keluar" class="font-weight-bold">Quantity Keluar</label>
                                <input type="number" class="form-control @error('qty_keluar') is-invalid @enderror" name="qty_keluar" value="{{ old('qty_keluar', $barangKeluar->qty_keluar) }}" required>
                                @error('qty_keluar')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="barang_id" class="font-weight-bold">Barang</label>
                                <select class="form-control @error('barang_id') is-invalid @enderror" name="barang_id" required>
                                    <option value="" disabled>Select Barang</option>
                                    @foreach($abarangkeluar as $barang)
                                        <option value="{{ $barang->id }}" {{ $barang->id == $barangKeluar->barang_id ? 'selected' : '' }}>
                                            {{ $barang->merk }} - {{ $barang->seri }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('barang_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Submit</button>
                                <a href="{{ route('barangkeluar.index') }}" class="btn btn-secondary">Cancel</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection