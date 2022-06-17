@extends('master.dashboard')

@section('main')

<div class="col-12 grid-margin stretch-card">
    <div class="card">
      @if ($message = Session::get('error'))
                        <div class="alert alert-danger" role="alert">
                           {{$message}}
                        </div>
        @endif
      <div class="card-body">
        <h4 class="card-title">Halaman Create</h4>
        <form action="{{ route('kasir.store') }}" method="POST"  class="forms-sample">
          @csrf

          <div class="form-group">
            <label>Nama Pelanggan</label>
            <input type="text" class="form-control" name="nama_pelanggan" autocomplete="off">
          </div>
          <div class="form-group">
            <label>Nama Menu</label>
            <select class="form-select" aria-label="Default select example" name="nama_menu">
            @foreach($menu as $item)
              <option>
                <tr>{{ $item->nama_menu }}</tr>
              </option>
            @endforeach
            </select>
          </div>
          <div class="form-group">
            <label>Jumlah</label>
            <input type="number" class="form-control" name="jumlah" autocomplete="off">
          </div>
          <div class="form-group">
            <label>Nama Pegawai</label>
            <input type="text" class="form-control" name="nama_pegawai" autocomplete="off">
          </div>
          <button type="submit" class="btn btn-primary me-2">Kirim</button>
        </form>
      </div>
    </div>
  </div>
@endsection