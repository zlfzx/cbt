@extends('layouts.global')

@section('title', 'Soal')

@section('content')
  <div class="card">
    <div class="card-header">
      <div class="card-head-row">
        <h4 class="card-title">Daftar Soal</h4>
        <div class="card-tools">
          <a href="{{ route('soal.create') }}" class="btn btn-sm btn-round btn-success"><i class="fas fa-plus"></i> Tambah Soal</a>
          <button class="btn btn-sm btn-round btn-info"><i class="fas fa-cloud-upload-alt"></i> Import Soal</button>
        </div>
      </div>
    </div>
    <div class="card-body">
      <table class="table table-hover table-striped text-center" id="table-soal">
        <thead>
          <tr>
            <th>No.</th>
            <th>Kelas</th>
            <th>Mata Pelajaran</th>
            <th>Paket Soal</th>
            <th>#</th>
          </tr>
        </thead>
      </table>
    </div>
  </div>
@endsection

@section('script')
  <script>
    $('#table-soal').DataTable()
  </script>
@endsection