@extends('layouts.global')

@section('title', 'Kelas')

@section('content')
    <div class="row">
      <div class="col-lg-8 col-sm-12">
        <div class="card">
          <div class="card-header">
            <h4 class="card-title">Daftar Kelas</h4>
            <div class="card-tools">
              <button:button class="btn btn-sm btn-round btn-success" data-toggle="modal" data-target="#modal-tambah"><i class="fas fa-plus"></i> Tambah Kelas</button:button>
            </div>
          </div>
          <div class="card-body">
            <table class="table table-hover table-striped text-center display nowrap w-100" id="table-kelas">
              <thead>
                <tr>
                  <th>No.</th>
                  <th>Nama Kelas</th>
                  <th>#</th>
                </tr>
              </thead>
            </table>
          </div>
        </div>
      </div>
    </div>
    <!-- modal tambah kelas -->
    <div class="modal fade" id="modal-tambah">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Tambah Kelas</h4>
            <button class="close" data-toggle="modal" data-dismiss="modal">&times;</button>
          </div>
          <div class="modal-body">
            <form id="form-tambah">
              <div class="form-group">
                <label for="form-kelas">Nama Kelas</label>
                <input type="text" name="kelas" class="form-control" placeholder="Masukkan Nama Kelas" required>
              </div>
              <div class="form-group">
                <button type="submit" class="btn btn-success float-right">Tambah</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    <!-- modal edit kelas -->
    <div class="modal fade" id="modal-edit">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Edit Kelas</h4>
            <button class="close" data-toggle="modal" data-dismiss="modal">&times;</button>
          </div>
          <div class="modal-body">
            <form id="form-edit">
              <input type="hidden" id="edit-id" name="id">
              <div class="form-group">
                <label for="form-kelas">Nama Kelas</label>
                <input type="text" id="edit-kelas" name="kelas" class="form-control" placeholder="Masukkan Nama Kelas" required>
              </div>
              <div class="form-group">
                <button type="submit" class="btn btn-success float-right">Simpan</button>
              </div>
            </form>
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

      var table = $('#table-kelas').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
          type: 'POST',
          url: "{{ route('kelas.data') }}"
        },
        columns: [
          {
            data: 'DT_RowIndex',
            searchable: false
          },
          {
            data: 'nama'
          },
          {
            data: 'id',
            render: function(data) {
              var btn = `<button type="button" class="btn btn-xs btn-warning btn-edit" data-id="${data}"><i class="fas fa-edit"></i></button> `
              btn += `<button type="button" class="btn btn-xs btn-danger btn-hapus" data-id="${data}"><i class="fas fa-trash"></i></button>`
              return btn
            }, 
            orderable: false,
            searchable: false
          }
        ]
      })

      // tambah kelas
      $('#form-tambah').on('submit', function(e) {
        e.preventDefault()
        var data = new FormData($('#form-tambah')[0])
        // console.log(data.get('kelas'))
        $.ajax({
          processData: false,
          contentType: false,
          type: 'POST',
          data: data,
          url: "{{ route('kelas.store') }}",
          success: function(data) {
            // var d = JSON.parse(res)
            if (data.status) {
              swal.fire({
                title: 'Berhasil',
                text: data.message,
                icon: 'success'
              })
              $('#form-tambah').trigger('reset')
              table.draw()
              $('#modal-tambah').modal('hide')
            }
          }
        })
      })
      
      // hapus kelas
      table.on('click', '.btn-hapus', function() {
        var id = $(this).attr('data-id')
        swal.fire({
          title: 'Hapus Kelas?',
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
              url: "{{ route('kelas.index') }}/"+id,
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

      // modal edit kelas
      table.on('click', '.btn-edit', function() {
        var id = $(this).attr('data-id')
        $.ajax({
          type: 'GET',
          url: "{{ route('kelas.index') }}/" + id + "/edit",
          success: function(data) {
            $('#edit-id').val(data.id)
            $('#edit-kelas').val(data.nama)
            $('#modal-edit').modal('show')
          }
        })
      })

      // simpan edit kelas
      $('#form-edit').on('submit', function(e) {
        e.preventDefault()
        var id = $('#edit-id').val(),
            kelas = $('#edit-kelas').val()
        $.ajax({
          type: 'PUT',
          data: {kelas: kelas},
          url: "{{ route('kelas.index') }}/"+id,
          success: function(data) {
            if (data.status) {
              swal.fire('Berhasil', data.message, 'success')
              $('#modal-edit').modal('hide')
              table.draw()
            }
          }
        })
      }) 

    </script>
@endsection