@extends('layouts.global')

@section('title', 'Ujian Aktif')

@section('content')
    <div class="card">
      <div class="card-header">
        <h4 class="card-title">Daftar Ujian Aktif</h4>
        <div class="card-tools">
          <button class="btn btn-sm btn-primary"><i class="fas fa-sync-alt"></i> Refresh</button>
        </div>
      </div>
      <div class="card-body">
        <table class="table table-striped table-hover text-center display nowrap w-100" id="table-ujian">
          <thead>
            <tr>
              <th>No.</th>
              <th>Nama</th>
              <th>Nama Ujian</th>
              <th>Waktu Mulai</th>
              <th>Waktu Selesai</th>
            </tr>
          </thead>
        </table>
      </div>
    </div>

    <div class="card">
      <div class="card-header">
        <h4 class="card-title">Hasil Ujian</h4>
        <div class="card-tools">
          <button class="btn btn-sm btn-primary"><i class="fas fa-sync-alt"></i> Refresh</button>
        </div>
      </div>
      <div class="card-body">
        <table class="table table-striped table-hover display nowrap w-100" id="table-hasil">
          <thead>
            <tr>
              <th>No.</th>
              <th>Nama</th>
              <th>Nama Ujian</th>
              <th>Mulai</th>
              <th>Selesai</th>
              <th>Hasil</th>
              <th>Nilai</th>
            </tr>
          </thead>
        </table>
      </div>
    </div>
@endsection

@section('script')
    <script>
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      })

      var table_ujian = $('#table-ujian').DataTable({
        responsive: true,
        scrollX: true,
        processing: true,
        serverSide: true,
        ajax: {
          type: 'POST',
          url: "{{ route('ujian.data-aktif') }}"
        },
        columns: [
          {data: 'DT_RowIndex', searchable: false},
          {data: 'siswa.nama'},
          {data: 'ujian.nama'},
          {data: 'waktu_mulai'},
          {data: 'waktu_selesai'}
        ]
      })
    </script>
@endsection