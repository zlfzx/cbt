@extends('layouts.global')

@section('title', 'Ujian')

@section('style')
<link rel="stylesheet" href="{{ asset('assets/css/tempusdominus-bootstrap-4.css') }}">
@endsection

@section('content')
    <div class="card">
      <div class="card-header">
        <h4 class="card-title">Daftar Ujian</h4>
        <div class="card-tools">
          <button class="btn btn-sm btn-round btn-success" data-toggle="modal" data-target="#modal-tambah"><i class="fas fa-plus"></i> Tambah Ujian</button>
        </div>
      </div>
      <div class="card-body">
        <table class="table table-striped table-hover text-center" id="table-ujian">
          <thead>
            <tr>
              <th>No.</th>
              <th>Nama Ujian</th>
              <th>Kelas</th>
              <th>Mata Pelajaran</th>
              <th>Paket Soal</th>
              <th>Waktu Mulai</th>
              <th>Waktu Ujian</th>
              <th>Token</th>
            </tr>
          </thead>
        </table>
      </div>
    </div>

    <!-- Modal Tambah Ujian -->
    <div class="modal fade" id="modal-tambah">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Tambah Ujian</h4>
            <button class="close" data-toggle="modal" data-dismiss="modal">&times;</button>
          </div>
          <form action="">
            <div class="modal-body">
              <div class="form-group">
                <label for="nama">Nama Ujian</label>
                <input type="text" class="form-control" id="nama" placeholder="Masukkan Nama Ujian">
              </div>
              <div class="form-group">
                <label for="kelas">Kelas</label>
                <select name="kelas" id="kelas" class="form-control"></select>
              </div>
              <div class="form-group">
                <label for="mapel">Mata Pelajaran</label>
                <select name="mapel" id="mapel" class="form-control"></select>
              </div>
              <div class="form-group">
                <label for="paket">Paket Soal</label>
                <select name="paket" id="paket" class="form-control"></select>
              </div>
              <div class="form-group">
                <label for="mulai">Waktu Mulai</label>
                <input type="text" class="form-control datetimepicker-input" id="waktu-mulai" data-toggle="datetimepicker" data-target="#waktu-mulai" placeholder="Masukkan Waktu Mulai Ujian">
              </div>
              <div class="form-group">
                <label for="waktu">Waktu Ujian</label>
                <input type="number" class="form-control" placeholder="Masukkan Waktu Ujian">
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>

    <div class="card">
      <div class="card-header">
        <h4 class="card-title">Ujian Aktif</h4>
      </div>
      <div class="card-body">
        <table class="table table-striped table-hover text-center" id="table-ujian-terlaksana">
          <thead>
            <tr>
              <th>No.</th>
              <th>Nama Ujian</th>
              <th>Kelas</th>
              <th>Mata Pelajaran</th>
              <th>Paket Soal</th>
              <th>Hasil</th>
            </tr>
          </thead>
        </table>
      </div>
    </div>
@endsection

@section('script')
    <script src="{{ asset('assets/js/tempusdominus-bootstrap-4.js') }}"></script>
    <script>
      $('#table-ujian').DataTable()

      $('#table-ujian-terlaksana').DataTable()

      // waktu mulai ujian
      $('#waktu-mulai').datetimepicker()
    </script>
@endsection