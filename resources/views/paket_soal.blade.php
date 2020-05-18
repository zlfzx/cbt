@extends('layouts.global')

@section('title', 'Paket Soal')

@section('content')
    <div class="card">
      <div class="card-header">
        <h4 class="card-title">Daftar Paket Soal</h4>
        <div class="card-tools">
          <button class="btn btn-round btn-sm btn-success" data-toggle="modal" data-target="#modal-tambah"><i class="fas fa-plus"></i> Tambah Paket Soal</button>
        </div>
      </div>
      <div class="card-body">
        <table class="table table-striped table-hover display nowrap w-100 text-center" id="table-paket">
          <thead>
            <tr>
              <th>No.</th>
              <th>kelas</th>
              <th>Mata Pelajaran</th>
              <th>Nama Paket Soal</th>
              <th>Kode Paket</th>
              <th>#</th>
            </tr>
          </thead>
        </table>
      </div>
    </div>
    <!-- Modal tambah paket -->
    <div class="modal fade" id="modal-tambah">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Tambah Paket Soal</h4>
            <button class="close" data-toggle="modal" data-dismiss="modal">&times;</button>
          </div>
          <form id="form-tambah">
            <div class="modal-body">
              <div class="form-group">
                <label for="form-kelas">Kelas</label>
                <select name="kelas" id="form-kelas" class="form-control select-kelas"></select>
              </div>
              <div class="form-group">
                <label for="form-mapel">Mata Pelajaran</label>
                <select name="mapel" id="form-mapel" class="form-control select-mapel"></select>
              </div>
              <div class="form-group">
                <label for="form-nama">Nama Paket</label>
                <input type="text" name="nama" class="form-control" id="form-nama" placeholder="Masukkan Nama Paket Soal">
              </div>
              <div class="form-group">
                <label for="form-keterangan">Keterangan</label>
                <input type="text" name="keterangan" class="form-control" id="form-keterangan" placeholder="Keterangan Paket Soal (opsional)">
              </div>
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-sm btn-success">Simpan</button>
            </div>
          </form>
        </div>
      </div>
    </div>

    <!-- Modal edit paket -->
    <div class="modal fade" id="modal-edit">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Tambah Paket Soal</h4>
            <button class="close" data-toggle="modal" data-dismiss="modal">&times;</button>
          </div>
          <form id="form-edit">
            @method('PUT')
            <input type="hidden" name="id" id="edit-id">
            <div class="modal-body">
              <div class="form-group">
                <label for="edit-kelas">Kelas</label>
                <select name="kelas" id="edit-kelas" class="form-control select-kelas"></select>
              </div>
              <div class="form-group">
                <label for="edit-mapel">Mata Pelajaran</label>
                <select name="mapel" id="edit-mapel" class="form-control select-mapel"></select>
              </div>
              <div class="form-group">
                <label for="edit-nama">Nama Paket</label>
                <input type="text" name="nama" class="form-control" id="edit-nama" placeholder="Masukkan Nama Paket Soal">
              </div>
              <div class="form-group">
                <label for="edit-keterangan">Keterangan</label>
                <input type="text" name="keterangan" class="form-control" id="edit-keterangan" placeholder="Keterangan Paket Soal (opsional)">
              </div>
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-sm btn-success">Simpan</button>
            </div>
          </form>
        </div>
      </div>
    </div>

    <!-- modal detail paket -->
    <div class="modal fade" id="modal-detail">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Detail Paket Soal</h4>
            <button class="close" data-toggle="modal" data-dismiss="modal">&times;</button>
          </div>
          <div class="modal-body">
            <table class="table">
              <tr>
                <th>Nama Paket Soal</th>
                <td id="detail-nama"></td>
              </tr>
              <tr>
                <th>Kode Paket Soal</th>
                <td id="detail-kode"></td>
              </tr>
              <tr>
                <th>Mata Pelajaran</th>
                <td id="detail-mapel"></td>
              </tr>
              <tr>
                <th>Kelas</th>
                <td id="detail-kelas"></td>
              </tr>
            </table>
            <ol id="detail-soal"></ol>
          </div>
          <div class="modal-footer">
            <button class="btn btn-danger" data-toggle="modal" data-dismiss="modal">Tutup</button>
          </div>
        </div>
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

      var table = $('#table-paket').DataTable({
        processing: true,
        serverSide: true,
        scrollX: true,
        ajax: {
          type: 'POST',
          url: "{{ route('paket-soal.data') }}"
        },
        columns: [
          {
            data: 'DT_RowIndex'
          }, 
          {
            data: 'kelas.nama'
          },
          {
            data: 'mapel.nama'
          },
          {
            data: 'nama'
          },
          {
            data: 'kode_paket'
          },
          {
            data: 'id', render: function(data) {
              var btn = `<button class="btn btn-xs btn-info btn-detail" data-id="${data}"><i class="fas fa-eye"></i></button> `
              btn += `<button class="btn btn-xs btn-warning btn-edit" data-id="${data}"><i class="fas fa-edit"></i></button> `
              btn += `<button class="btn btn-xs btn-danger btn-hapus" data-id="${data}"><i class="fas fa-trash"></i></button>`
              return btn
            }
          }
        ]
      })

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

      // simpan paket soal
      $('#form-tambah').on('submit', function(e) {
        e.preventDefault();
        var data = new FormData(this)
        $.ajax({
          processData: false,
          contentType: false,
          type: 'POST',
          data: data,
          url: "{{ route('paket-soal.store') }}",
          success: function(data) {
            if (data.status) {
              $(this).trigger('reset')
              table.draw()
              swal.fire('Berhasil', data.message, 'success')
              $('#modal-tambah').modal('hide')
            } else {
              var errors = ''
              data.message.forEach(function(e) {
                errors += e + "\n"
              })
              swal.fire('Gagal', errors, 'error')
            }
          }
        })
      })

      // edit paket soal
      table.on('click', '.btn-edit', function() {
        var id = $(this).attr('data-id')
        $.ajax({
          type: 'GET',
          url: "{{ route('paket-soal.index') }}/"+id+"/edit",
          success: function(data) {
            if (data.status) {
              $('#edit-id').val(data.message.id)
              $('#edit-kelas').empty().append('<option value="'+data.message.kelas.id+'">'+data.message.kelas.nama+'</option>')
              $('#edit-mapel').empty().append('<option value="'+data.message.mapel.id+'">'+data.message.mapel.nama+'</option>')
              $('#edit-nama').val(data.message.nama)
              $('#edit-keterangan').val(data.message.keterangan)

              $('#modal-edit').modal()
            }
          }
        })
      })

      // update paket soal
      $('#form-edit').on('submit', function(e) {
        e.preventDefault()
        var id = $('#edit-id').val()
        var data = new FormData(this)
        $.ajax({
          processData: false, 
          contentType: false,
          type: 'POST',
          data: data,
          url: "{{ route('paket-soal.index') }}/"+id,
          success: function(data) {
            if (data.status) {
              table.draw()
              swal.fire('Berhasil', data.message, 'success')
              $('#modal-edit').modal('hide')
            } else {
              var errors = ''
              data.message.forEach(function(e) {
                errors += e + "\n"
              })
              swal.fire('Gagal', errors, 'error')
            }
          }
        })
      })

      // hapus paket soal
      table.on('click', '.btn-hapus', function() {
        var id = $(this).attr('data-id')
        swal.fire({
          title: 'Hapus Paket Soal?',
          text: 'Semua data yang terkait akan ikut terhapus!',
          icon: 'warning',
          buttons: {
            confirm: {
              text: 'Ya',
              className: 'btn border'
            },
            cancel: {
              visible: true,
              text: 'Batal',
              className: 'btn btn-danger'
            }
          }
        }).then((hapus) => {
          if (hapus.value) {
            console.log('hapus')
            $.ajax({
              type: 'DELETE',
              url: "{{ route('paket-soal.index') }}/"+id,
              success: function(data) {
                if (data.status) {
                  swal.fire('Berhasil', data.message, 'success')
                  table.draw()
                }
              }
            })
          } else {
            swal.fire.close()
          }
        })
      })

      // detail paket soal
      table.on('click', '.btn-detail', function() {
        var id = $(this).attr('data-id')
        $.ajax({
          type: 'GET',
          url: "{{ route('paket-soal.index') }}/"+id,
          success: function(data) {
            if (data.status) {
              var d = data.message
              $('#detail-nama').html(d.nama)
              $('#detail-kode').html(d.kode_paket)
              $('#detail-mapel').html(d.mapel.nama)
              $('#detail-kelas').html(d.kelas.nama)
              var s = ''
              d.soal.forEach(function(soal) {
                console.log(soal)
                s += `<li class="list-soal">${soal.soal}
                  <ul>`
                soal.soal_jawaban.forEach(function(j) {
                  // console.log(j)
                  var benar = ''
                  if (j.status == 1) benar = " text-danger"
                  s += `<li class="list-jawaban ${benar}">${j.jawaban}</li>`
                })
                s += '</ul></li>'
              })
              $('#detail-soal').html(s)

              $('#modal-detail').modal()
            }
          }
        })
      })

    </script>
@endsection