@extends('layouts.global')

@section('title', 'Paket Soal')

@section('content')
    <div class="card">
      <div class="card-header">
        <h4 class="card-title">Daftar Paket Soal</h4>
      </div>
      <div class="card-body">
        <table class="table table-striped table-hover" id="table-paket">
          <thead>
            <tr>
              <th>No.</th>
              <th>kelas</th>
              <th>Mata Pelajaran</th>
              <th>Nama Paket Soal</th>
            </tr>
          </thead>
        </table>
      </div>
    </div>
@endsection

@section('script')
    <script>
      $('#table-paket').DataTable()
    </script>
@endsection