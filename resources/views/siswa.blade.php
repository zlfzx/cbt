@extends('layouts.global')

@section('title', 'Siswa')

@section('content')
    <div class="card">
      <div class="card-header">
        <h4 class="card-title">Daftar Siswa</h4>
        <div class="card-tools">
          <button data-toggle="modal" data-target="#modal-tambah" class="btn btn-sm btn-round btn-success"><i class="fas fa-plus"></i> Tambah Siswa</button>
          <button class="btn btn-sm btn-round btn-info"><i class="fas fa-cloud-upload-alt"></i> Import Siswa</button>
        </div>
      </div>
      <div class="card-body">
        <table class="table table-hover table-striped text-center display nowrap w-100" id="table-siswa">
          <thead>
            <tr>
              <th>No.</th>
              <th>NIS</th>
              <th>Nama</th>
              <th>Password</th>
              <th>Kelas</th>
              <th>#</th>
            </tr>
          </thead>
        </table>
      </div>
    </div>
    <!-- Modal Tambah Siswa -->
    <div class="modal fade" id="modal-tambah">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Tambah Siswa</h4>
            <button data-toggle="modal" data-dismiss="modal" class="close">&times;</button>
          </div>
          <form id="form-tambah">
            <div class="modal-body">
              <div class="form-group">
                <label for="form-nama">Nama</label>
                <input type="text" name="nama" class="form-control" placeholder="Masukkan Nama Siswa">
              </div>
              <div class="form-group">
                <label for="form-nis">NIS</label>
                <input type="text" name="nis" class="form-control" placeholder="Masukkan NIS Siswa">
              </div>
              <div class="form-group">
                <label for="form-kelas">Kelas</label>
                <select name="kelas" class="select-kelas form-control"></select>
              </div>
              <div class="form-group">
                <label for="form-password">Password</label>
                <input type="password" name="password" class="form-control" placeholder="Kosongkan untuk menggenerate password default">
              </div>
            </div>
            <div class="modal-footer">
              <button class="btn btn-sm btn-danger" data-toggle="modal" data-dismiss="modal">Batal</button>
              <button type="submit" class="btn btn-sm btn-success">Simpan</button>
            </div>
          </form>
        </div>
      </div>
    </div>
    <!-- Modal Edit Siswa -->
    <div class="modal fade" id="modal-edit">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Tambah Siswa</h4>
            <button data-toggle="modal" data-dismiss="modal" class="close">&times;</button>
          </div>
          <form id="form-edit">
            @method('PUT')
            <input type="hidden" name="id" id="edit-id">
            <div class="modal-body">
              <div class="form-group">
                <label for="edit-nama">Nama</label>
                <input type="text" id="edit-nama" name="nama" class="form-control" placeholder="Masukkan Nama Siswa">
              </div>
              <div class="form-group">
                <label for="edit-nis">NIS</label>
                <input type="text" id="edit-nis" name="nis" class="form-control" placeholder="Masukkan NIS Siswa">
              </div>
              <div class="form-group">
                <label for="form-kelas">Kelas</label>
                <select name="kelas" id="edit-kelas" class="select-kelas form-control"></select>
              </div>
              <div class="form-group">
                <label for="form-password">Password</label>
                <input type="password" id="edit-password" name="password" class="form-control" placeholder="Kosongkan untuk menggenerate password default">
              </div>
            </div>
            <div class="modal-footer">
              <button class="btn btn-sm btn-danger" data-toggle="modal" data-dismiss="modal">Batal</button>
              <button type="submit" class="btn btn-sm btn-success">Simpan</button>
            </div>
          </form>
        </div>
      </div>
    </div>
    <!-- modal lihat password -->
    <div class="modal fade" id="modal-password">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Password <span id="password-user"></span></h4>
            <button class="close" data-toggle="modal" data-dismiss="modal">&times;</button>
          </div>
          <div class="modal-body">
            <div id="passwd" class="d-flex align-items-center justify-content-center"></div>
            <h4 id="passwd-nama" class="text-center"></h4>
          </div>
          <div class="modal-footer">
            <button class="btn btn-sm btn-danger" data-toggle="modal" data-dismiss="modal">Tutup</button>
          </div>
        </div>
      </div>
    </div>
@endsection

@section('script')
    <script src="{{ asset('assets/js/qrcode.min.js') }}"></script>
    <script>
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      })

      var table = $('#table-siswa').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
          type: 'POST',
          url: "{{ route('siswa.data') }}"
        },
        columns:[
          {
            data: 'DT_RowIndex'
          },{
            data: 'nama'
          },
          {
            data: 'nis'
          },
          {
            data: 'id', render: function(data) {
              var btn = `
                <button type="button" class="btn btn-info btn-xs lihat-password" data-id="${data}"><i class="fas fa-eye"></i> Lihat Password</button> `
              btn += `
                <button type="button" class="btn btn-xs btn-warning reset-password" data-id="${data}"><i class="fas fa-undo"></i> Reset Password</button>`
              return btn
            }, orderable: false, searchable: false
          },
          {
            data: 'kelas.nama'
          },
          {
            data: 'id', render: function(data) {
              var btn = `<button type="button" class="btn btn-xs btn-warning btn-edit" data-id="${data}"><i class="fas fa-edit"></i></button> `
              btn += `<button type="button" class="btn btn-xs btn-danger btn-hapus" data-id="${data}"><i class="fas fa-trash"></i></button>`
              return btn
            }, orderable: false, searchable: false
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
      
      // tambah siswa
      $('#form-tambah').on('submit', function(e) {
        e.preventDefault()
        var data = new FormData($('#form-tambah')[0])
        $.ajax({
          processData: false, 
          contentType: false,
          type: 'POST',
          data: data,
          url: "{{ route('siswa.store') }}",
          success: function(data) {
            if (data.status) {
              swal.fire('Berhasil', data.message, 'success')
              table.draw()
              $('#form-tambah').trigger('reset')
              $('#modal-tambah').modal('hide')
            } else {
              var errors = ''
              data.message.forEach(function(d) {
                errors += d + '\n'
              })
              swal.fire('Gagal', errors, 'error')
            }
          }
        })
      })

      // edit siswa
      table.on('click', '.btn-edit', function() {
        var id = $(this).attr('data-id')
        $.ajax({
          type: 'GET',
          url: "{{ route('siswa.index') }}/"+id+"/edit",
          success: function(data) {
            $('#edit-id').val(data.id)
            $('#edit-nama').val(data.nama)
            $('#edit-nis').val(data.nis)
            $('#edit-password').val(data.password)
            $('#edit-kelas').empty().append('<option value="'+data.kelas_id+'">'+data.kelas.nama+'</option>').trigger('change')
            $('#modal-edit').modal('show')
          }
        })
      })

      // update siswa
      $('#form-edit').on('submit', function(e) {
        e.preventDefault()
        var id = $('#edit-id').val()
        var data = new FormData(this)
        $.ajax({
          processData: false,
          contentType: false,
          method: 'POST',
          data: data,
          url: "{{ route('siswa.index') }}/"+id,
          success: function(data) {
            if (data.status) {
              swal.fire('Berhasil', data.message, 'success')
              table.draw()
              $('#modal-edit').modal('hide')
            } else {
              var errors = ''
              data.message.forEach(function(d) {
                errors += d + '\n'
              })
              swal.fire('Gagal', errors, 'error')
            }
          }
        })
      })

      // hapus siswa
      table.on('click', '.btn-hapus', function() {
        var id = $(this).attr('data-id')
        swal.fire({
          title: 'Hapus Siswa?',
          text: 'Semua data yang terkait akan ikut terhapus!',
          icon: 'warning',
          buttons: {
            confirm: {
              text: 'Ya',
              className: 'btn border'
            },
            cancel: {
              visible: 'true',
              text: 'Batal',
              className: 'btn btn-danger'
            }
          }
        }).then((hapus) => {
          if (hapus.value) {
            console.log('hapus')
            $.ajax({
              type: 'DELETE',
              url: "{{ route('siswa.index') }}/"+id,
              success: function(data) {
                if (data.status) {
                  swal.fire({
                    title: 'Berhasil',
                    text: data.message,
                    icon: 'success'
                  })
                  table.draw()
                }
              }
            })
          } else {
            swal.fire.close()
          }
        })
      })

      // lihat password
      table.on('click', '.lihat-password', function() {
        var id = $(this).attr('data-id')
        $.ajax({
          type: 'POST',
          data: {id: id},
          url: "{{ route('siswa.lihat_password') }}",
          success: function(data) {
            $('#password-user').html(data.nama)
            $('#passwd').empty()
            var qrcode = new QRCode('passwd')
            // qrcode.clear()
            qrcode.makeCode(data.password)
          }
        })

        $('#modal-password').modal('show')
      })

      // reset password
      table.on('click', '.reset-password', function() {
        var id = $(this).attr('data-id')
        swal.fire({
          title: 'Reset Password?',
          icon: 'warning',
          buttons: {
            confirm: {
              text: 'Ya'
            },
            cancel: {
              visible: true,
              text: 'Batal'
            }
          }
        }).then((reset) => {
          if (reset.value) {
            $.ajax({
              type: 'POST',
              data: {id: id},
              url: "{{ route('siswa.reset_password') }}",
              success: function(data) {
                if (data.status) {
                  swal.fire('Berhasil', data.message, 'success')
                } else {
                  swal.fire('Gagal', data.message, 'error')
                }
              }
            })
          } else {
            swal.fire.close()
          }
        })
      })

    </script>
@endsection