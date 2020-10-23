@extends('layouts.global')

@section('title', 'Ujian')

@section('content')
    <div class="card">
      <div class="card-header">
        <h4 class="card-title">Daftar Ujian</h4>
        <div class="card-tools">
          <button class="btn btn-sm btn-round btn-success" data-toggle="modal" data-target="#modal-tambah"><i class="fas fa-plus"></i> Tambah Ujian</button>
        </div>
      </div>
      <div class="card-body">
        <table class="table table-striped table-hover text-center display nowrap w-100" id="table-ujian">
          <thead>
            <tr>
              <th>No.</th>
              <th>Nama Ujian</th>
              <th>Kelas</th>
              <th>Paket Soal</th>
              <th>Waktu Mulai</th>
              <th>Waktu Ujian</th>
              <th>Token</th>
              <th>#</th>
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
          <form id="tambah-ujian">
            <div class="modal-body">
              <div class="form-group">
                <label for="nama">Nama Ujian</label>
                <input type="text" name="nama" class="form-control" id="nama" placeholder="Masukkan Nama Ujian">
              </div>
              <div class="form-group">
                <label for="kelas">Kelas</label>
                <select name="kelas" id="kelas" class="form-control select-kelas" style="width: 100%;"></select>
              </div>
              <div class="form-group">
                <label for="mapel">Mata Pelajaran</label>
                <select name="mapel" id="mapel" class="form-control select-mapel"></select>
              </div>
              <div class="form-group">
                <label for="paket">Paket Soal</label>
                <select name="paket" id="paket" class="form-control select-paket"></select>
              </div>
              <div class="form-group">
                <label for="mulai">Waktu Mulai</label>
                <input type="text" name="mulai" class="form-control" id="waktu-mulai" placeholder="Masukkan Waktu Mulai Ujian">
              </div>
              <div class="form-group">
                <label for="waktu">Waktu Ujian</label>
                <input type="number" name="waktu" min="0" class="form-control" placeholder="Masukkan Waktu Ujian">
              </div>
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-sm btn-success">Simpan</button>
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
    <script>
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      })

      var table = $('#table-ujian').DataTable({
        responsive: true,
        scrollX: true,
        processing: true,
        serverSide: true,
        ajax: {
          type: 'POST',
          url: "{{ route('ujian.data') }}"
        },
        columns: [
          {data: 'DT_RowIndex', searchable: false},
          {data: 'nama'},
          {data: 'kelas.nama'},
          {data: 'paket_soal.nama'},
          {data: 'waktu_mulai'},
          {data: 'waktu_ujian', render: function(data) {
            return data + ' Menit'
          }},
          {data: 'token'},
          {
            data: 'id', searchable: false,
            render: function(data) {
              var html = `<button class="btn btn-xs btn-danger"><i class="fas fa-trash"></i></button>`
              return html
            }
          }
        ]
      })

      $('#table-ujian-terlaksana').DataTable()

      // cari kelas (select2)
      $('.select-kelas').select2({
        theme: 'bootstrap4',
        placeholder: 'Cari kelas...',
        ajax: {
          delay: 250,
          url: "{{ route('kelas.select') }}",
          processResults: function(data, params) {
            params.page = params.page || 1
            // console.log(data)
            return {
              results: $.map(data, function(item) {
                return {
                  id: item.id,
                  text: item.nama
                }
              }),
              pagination: {
                more: (params.page * 10) < data.length
              }
            }
          }
        }
      })

      // cari mapel (select2)
      $('.select-mapel').select2({
        theme: 'bootstrap4',
        placeholder: 'Cari Mata Pelajaran...',
        ajax: {
          delay: 250,
          url: "{{ route('mapel.select') }}",
          processResults: function(data, params) {
            params.page = params.page || 1
            // console.log(data)
            return {
              results: $.map(data, function(item) {
                return {
                  id: item.id,
                  text: item.nama
                }
              }),
              pagination: {
                more: (params.page * 10) < data.length
              }
            }
          }
        }
      })

      // cari paket soal (select2)
      $('.select-paket').select2({
        theme: 'bootstrap4',
        placeholder: 'Cari Paket Soal...',
        ajax: {
          delay: 250,
          url: "{{ route('paket-soal.select') }}",
          data: function(params) {
            return {
              kelas: $('.select-kelas').val(),
              mapel: $('.select-mapel').val()
            }
          },
          processResults: function(data, params) {
            params.page = params.page || 1
            // console.log(data)
            return {
              results: $.map(data, function(item) {
                return {
                  id: item.id,
                  text: item.nama
                }
              }),
              pagination: {
                more: (params.page * 10) < data.length
              }
            }
          }
        }
      })

      // waktu mulai ujian
      $('#waktu-mulai').daterangepicker({
        timePicker: true,
        singleDatePicker: true,
        locale: {
          format: 'YYYY-MM-DD hh:mm:ss'
        }
      })

      $('#tambah-ujian').on('submit', function(e) {
        e.preventDefault();
        var data = new FormData(this)
        $.ajax({
          processData: false,
          contentType: false,
          type: 'POST',
          data: data,
          url: "{{ route('ujian.store') }}",
          success: function(res) {
            swal.fire('Berhasil', res.message, 'success')
            $('.select-mapel').select2('val', '')
            $('.select-kelas').select2('val', '')
            $('.select-paket').select2('val', '')
            $('#tambah-ujian').trigger('reset')
            table.draw();
            $('#modal-tambah').modal('hide')
          },
          error: function(err) {
            let error = err.responseJSON
            let errors = ''
            error.messages.forEach(function(d) {
              errors += d + '<br />'
            })
            swal.fire('Gagal', errors, 'error')
          }
        })
      })
    </script>
@endsection
