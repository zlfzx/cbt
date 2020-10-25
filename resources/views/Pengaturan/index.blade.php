@extends('layouts.global')

@section('title')
    Pengaturan
@endsection

@section('content')
    <div class="row">
      <div class="col-md-4">
        <div class="card">
          <div class="card-header">
            <h4 class="card-title">Informasi Aplikasi</h4>
          </div>
          <form action="">
            <div class="card-body">
              <div class="form-group">
                <label for="form-judul">Title <small>(Judul Aplikasi)</small></label>
                <input type="text" class="form-control" placeholder="Masukkan Title Aplikasi">
              </div>
              <div class="form-group">
                <label for="form-deskripsi">Deskripsi</label>
                <input type="text" class="form-control" placeholder="Masukkan Deskripsi Aplikasi">
              </div>
              <div class="form-group">
                <label for="form-logo">Logo Aplikasi</label>
                <div class="current-logo mb-3">
                  <!-- <h1><i class="
                    fas fa-cloud-upload-alt"></i></h1> -->
                  <img src="https://i.pinimg.com/originals/a3/1b/1d/a31b1d35380af24948f54b42346225f6.png" width="150px" alt="">
                </div>
                <input type="file" name="" id="" class="form-control">
              </div>
            </div>
            <div class="card-footer">
              <button class="btn btn-sm btn-success">Simpan</button>
            </div>
          </form>
        </div>
      </div>
      <div class="col-md-8">
        <div class="card">
          <div class="card-header">
            <h4 class="card-title">Informasi Ujian</h4>
          </div>
          <div class="card-body">
            <textarea name="informasi_ujian" id="info-ujian" cols="30" rows="10"></textarea>
          </div>
          <div class="card-footer">
            <button class="btn btn-sm btn-success">Simpan</button>
          </div>
        </div>
      </div>
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <h4 class="card-title">Daftar Admin</h4>
            <div class="card-tools">
              <button data-toggle="modal" data-target="#modal-tambah-admin" class="btn btn-sm btn-success btn-round"><i class="fas fa-plus"></i> Tambah Admin</button>
            </div>
          </div>
          <div class="card-body">
            <table class="table table-striped table-hover text-center display nowrap w-100" id="table-admin">
              <thead>
                <tr>
                  <th>No.</th>
                  <th>Nama</th>
                  <th>Email</th>
                  <th>Roles</th>
                  <th>#</th>
                </tr>
              </thead>
            </table>
          </div>
        </div>
      </div>
    </div>
    <!-- Modal Tambah Admin -->
    <div class="modal fade" id="modal-tambah-admin">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Tambah Admin</h4>
            <button class="close" data-toggle="modal" data-dismiss="modal">&times;</button>
          </div>
          <form id="form-tambah-admin">
            <div class="modal-body">
              <div class="form-group">
                <label for="form-nama">Nama</label>
                <input type="text" name="name" id="tambah_nama" class="form-control" placeholder="Masukkan Nama Admin">
              </div>
              <div class="form-group">
                <label for="form-email">Email</label>
                <input type="email" name="email" id="tambah_email" class="form-control" placeholder="Masukkan Email Admin">
              </div>
              <div class="form-group">
                <label for="form-password">Password</label>
                <input type="password" name="password" id="tambah_password" class="form-control" placeholder="Masukkan Password Admin">
              </div>
              <div class="form-group">
                <label for="roles">Roles</label><br>
                <div class="custom-control custom-checkbox mr-3">
                  <input type="checkbox" name="roles[]" value="admin" id="role-admin" class="custom-control-input">
                  <label for="role-admin" class="custom-control-label">Admin</label>
                </div>
                <div class="custom-control custom-checkbox mr-3">
                  <input type="checkbox" name="roles[]" value="petugas_soal" id="role-petugas-soal" class="custom-control-input">
                  <label for="role-petugas-soal" class="custom-control-label">Petugas Soal</label>
                </div>
                <div class="custom-control custom-checkbox mr-3">
                  <input type="checkbox" name="roles[]" value="petugas_ujian" id="role-petugas-ujian" class="custom-control-input">
                  <label for="role-petugas-ujian" class="custom-control-label">Petugas Ujian</label>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-sm btn-success">Simpan</button>
            </div>
          </form>
        </div>
      </div>
    </div>
@endsection

@section('script')
    <script src="{{ asset('dist/plugins/ckeditor/ckeditor.js') }}"></script>
    <script>
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      })

      var table_admin = $('#table-admin').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
          type: 'POST',
          url: "{{ route('pengaturan.data-admin') }}"
        },
        columns: [
          {data: 'DT_RowIndex'},
          {data: 'name'},
          {data: 'email'},
          {data: 'roles', render: function(data) {
            var html = ''
            data.forEach(function(d) {
              if (d == 'admin') {
                html += `<span class="badge badge-danger">Admin</span> `
              } else if (d == 'petugas_soal') {
                html += `<span class="badge badge-warning">Petugas Soal</span> `
              } else if (d == 'petugas_ujian') {
                html += `<span class="badge badge-info">Petugas Ujian</span>`
              }
            })
            return html
          }, searchable: false, orderable: false},
          {data: 'id', render: function(data) {
            var html = `<button class="btn btn-xs btn-danger"><i class="fas fa-trash"></i></button>`

            return html
          }}
        ]
      })

      $('#form-tambah-admin').on('submit', function(e) {
        e.preventDefault()
        var data = new FormData(this)
        $.ajax({
          processData: false,
          contentType: false,
          type: 'POST',
          data: data,
          url: "{{ route('pengaturan.tambah-admin') }}",
          success: function(res) {
            swal.fire('Berhasil', res.message, 'success')
            table_admin.draw()
            $('#form-tambah-admin').trigger('reset')
            $('#modal-tambah-admin').modal('hide')
          },
          error: function(err) {
            let error = err.responseJSON
            var  errors = ''
            error.messages.forEach(function(e) {
              errors += e + '<br />'
            })
            swal.fire('Gagal', errors, 'error')
          }
        })
      })

      CKEDITOR.replace('info-ujian', {
        height: '283',
        filebrowserImageBrowseUrl: '{{ url("/filemanager?type=Images") }}',
        filebrowserImageUploadUrl: '{{ url("/filemanager/upload?type=Images&_token=") }}',
        filebrowserBrowseUrl: '{{ url("/filemanager?type=Files") }}',
        filebrowserUploadUrl: '{{ url("/filemanager/upload?type=Files&_token") }}='
      })
    </script>
@endsection
