@extends('layouts.adm-main')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        Edit Barang Masuk
                    </div>
                    <div class="card-body">
                        <form action="{{ route('barangmasuk.update', $barangMasuk->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="form-group">
                                <label for="tgl_masuk" class="font-weight-bold">Tanggal masuk</label>
                                <input type="date" class="form-control @error('tgl_masuk') is-invalid @enderror" name="tgl_masuk" value="{{ old('tgl_masuk', $barangMasuk->tgl_masuk) }}" required>
                                @error('tgl_masuk')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="qty_masuk" class="font-weight-bold">Quantity masuk</label>
                                <input type="number" class="form-control @error('qty_masuk') is-invalid @enderror" name="qty_masuk" value="{{ old('qty_masuk', $barangMasuk->qty_masuk) }}" required>
                                @error('qty_masuk')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="barang_id" class="font-weight-bold">Barang</label>
                                <select class="form-control @error('barang_id') is-invalid @enderror" name="barang_id" required>
                                    <option value="" disabled>Select Barang</option>
                                    @foreach($abarangmasuk as $barang)
                                        <option value="{{ $barang->id }}" {{ $barang->id == $barangMasuk->barang_id ? 'selected' : '' }}>
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
                                <a href="{{ route('barangmasuk.index') }}" class="btn btn-secondary">Cancel</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection