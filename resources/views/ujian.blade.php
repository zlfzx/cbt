@extends('layouts.global')

@section('title', 'Ujian')

@section('content')
    <div class="card">
      <div class="card-header">
        <div class="card-head-row">
          <h4 class="card-title">Daftar Ujian</h4>
          <div class="card-tools">
            <button class="btn btn-sm btn-round btn-success"><i class="fas fa-plus"></i> Tambah Ujian</button>
          </div>
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
    <script>
      $('#table-ujian').DataTable()

      $('#table-ujian-terlaksana').DataTable()
    </script>
@endsection