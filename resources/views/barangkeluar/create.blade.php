@extends('layouts.adm-main')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        Tambah Barang Keluar
                    </div>
                    <div class="card-body">
                        <form id="createForm" action="{{ route('barangkeluar.store') }}" method="POST" enctype="multipart/form-data">                    
                            @csrf

                            <div class="form-group">
                                <label class="font-weight-bold">Tanggal Keluar</label>
                                <input type="date" class="form-control @error('tgl_keluar') is-invalid @enderror" name="tgl_keluar" value="{{ old('tgl_keluar') }}" placeholder="Masukkan Tanggal Keluar Barang">
                                @error('tgl_keluar')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="font-weight-bold">Jumlah Keluar</label>
                                <input type="number" min="1" class="form-control @error('qty_keluar') is-invalid @enderror" name="qty_keluar" value="{{ old('qty_keluar') }}" placeholder="Masukkan Jumlah Keluar Barang">
                                @error('qty_keluar')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="font-weight-bold">Pilih Barang</label>
                                <select class="form-control @error('barang_id') is-invalid @enderror" name="barang_id" required>
                                    <option value="" disabled>Pilih Barang</option>
                                    @foreach ($abarangkeluar as $barang)
                                        <option value="{{ $barang->id }}">{{ $barang->merk }} - {{ $barang->seri }}</option>
                                    @endforeach
                                </select>
                                @error('barang_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-md btn-primary">Simpan</button>
                            <a href="{{ route('barangkeluar.index') }}" class="btn btn-md btn-secondary">Batal</a>
                        </form>
                        <div id="successMessage" class="mt-3" style="display: none;">
                            <div class="alert alert-success">
                                Data berhasil disimpan!
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        // Validasi di bagian frontend
        $(document).ready(function () {
            $('#createForm').submit(function (event) {
                event.preventDefault();
                var tgl_keluar = $('#tgl_keluar').val();
                var qty_keluar = $('#qty_keluar').val();
                var barang_id = $('#barang_id').val();

                // Validasi tanggal
                if (!tgl_keluar) {
                    alert('Tanggal keluar harus diisi!');
                    return;
                }

                // Validasi jumlah
                if (!qty_keluar || qty_keluar <= 0) {
                    alert('Jumlah keluar harus diisi dan lebih dari 0!');
                    return;
                }

                // Validasi barang dipilih
                if (!barang_id) {
                    alert('Barang harus dipilih!');
                    return;
                }

                // Jika lolos validasi, submit form
                this.submit();
            });
        });
    </script>
@endsection
