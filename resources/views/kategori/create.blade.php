@extends('layouts.adm-main')

@section('content')  
    
<div class="row m-4">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Tambahkan Kategori</h2>
        </div>
        <div class="pull-right ">
            <a class="btn btn-primary" href="{{ route('kategori.index') }}"> Back</a>
        </div>
    </div>
   
    @if ($errors->any())
    <div class="row m-4">
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    </div>
    @endif

    <hr/>

    <!-- <form action="{{ route('barang.store') }}" method="POST">
    <form method="POST" action="/barang" enctype="multipart/form-data"> -->
    <form action="{{ route('kategori.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
  
        <div class="row">

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Deskripsi</strong>
                    <input type="text" name="deskripsi" class="form-control" placeholder="deskripsi">
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>jenis</strong>
                    <input type="text" name="kategori" class="form-control" placeholder="kategori">
                </div>
            </div>

            <!-- <div class="col-xs-12 col-sm-12 col-md-12">
    <div class="form-group">
        <strong>Jenis</strong>
        <select name="jenis" class="form-control">
            <option value="A">A</option>
            <option value="M">M</option>
            <option value="BHP">BHP</option>
            <option value="BTHP">BTHP</option>
        </select>
    </div>
</div> -->

            <!-- <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>jenis</strong>
                    <select class="form-control" name="jenis" aria-label="Default select example" >
                        <option selected>jenis</option>
                        <option value="M">M</option>
                        <option value="A">A</option>
			<option value="BHP">BHP</option>
			<option value="BTHP">BTHP</option>
                    </select>
                </div>
            </div> -->

            


            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                    <button type="submit" class="btn btn-primary">Submit</button>
            </div>

        </div>

    </form>
</div>
   
@endsection