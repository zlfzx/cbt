@extends('layouts.global')

@section('title', 'Mata Pelajaran')

@section('content')
    <div class="row">
      <div class="col-lg-8 col-sm-12">
        <div class="card">
          <div class="card-header">
            <h4 class="card-title">Daftar Mata Pelajaran</h4>
            <div class="card-tools">
              <button type="button" data-toggle="modal" data-target="#modal-tambah" class="btn btn-sm btn-round btn-success"><i class="fas fa-plus"></i> Tambah Mapel</button>
            </div>
          </div>
          <div class="card-body">
            <table class="table table-hover table-striped text-center display nowrap w-100" id="table-mapel">
              <thead>
                <tr>
                  <th>No.</th>
                  <th>Mata Pelajaran</th>
                  <th>#</th>
                </tr>
              </thead>
            </table>
          </div>
        </div>
      </div>
    </div>
    <!-- Modal tambah mapel -->
    <div class="modal fade" id="modal-tambah">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Tambah Mata Pelajaran</h4>
            <button class="close" data-toggle="modal" data-dismiss="modal">&times;</button>
          </div>
          <div class="modal-body">
            <form id="form-tambah">
              <div class="form-group">
                <label for="form-mapel">Nama Mapel</label>
                <input type="text" id="form-mapel" name="nama" class="form-control" placeholder="Masukkan Mata Pelajaran" required>
              </div>
              <div class="form-group">
                <button type="submit" class="btn btn-success float-right">Tambah</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    <!-- Modal edit mapel -->
    <div class="modal fade" id="modal-edit">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Edit Mata Pelajaran</h4>
            <button class="close" data-toggle="modal" data-dismiss="modal">&times;</button>
          </div>
          <div class="modal-body">
            <form id="form-edit">
              <input type="hidden" name="id" id="edit-id">
              <div class="form-group">
                <label for="edit-mapel">Nama Mapel</label>
                <input type="text" name="nama" id="edit-mapel" class="form-control" placeholder="Masukkan Mata Pelajaran" required>
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
      const table = $('#table-mapel').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
          type: 'POST',
          url: "{{ route('mapel.data') }}"
        },
        columns: [
          {
            data: 'DT_RowIndex'
          },
          {
            data: 'nama'
          },
          {
            data: 'id',
            render: function (data) {
              let btn = `<button type="button" class="btn btn-xs btn-warning btn-edit" data-id="${data}"><i class="fas fa-edit"></i></button> `;
              btn += `<button type="button" class="btn btn-xs btn-danger btn-hapus" data-id="${data}"><i class="fas fa-trash"></i></button>`
              return btn
            }
          }
        ]
      });

      // tambah kelas
      $('#form-tambah').on('submit', function(e) {
        e.preventDefault();
        const data = new FormData($('#form-tambah')[0]);
        $.ajax({
          processData: false,
          contentType: false,
          type: 'POST',
          data: data,
          url: "{{ route('mapel.store') }}",
          success: function(data) {
            if (data.status) {
              swal.fire('Berhasil', data.message, 'success')
              table.draw()
              $('#form-tambah').trigger('reset')
              $('#modal-tambah').modal('hide')
            }
          }
        })
      })

      // hapus mapel
      table.on('click', '.btn-hapus', function() {
        const id = $(this).attr('data-id');
        swal.fire({
          title: 'Hapus Mata Pelajaran?',
          text: 'Semua data terkait akan ikut terhapus!',
          icon: 'warning',
          showCancelButton: true,
          confirmButtonText: 'Ya',
          confirmButtonColor: '#d33',
          cancelButtonText: 'Tidak'
        }).then((hapus) => {
          if (hapus.value) {
            // hapus
            $.ajax({
              type: 'DELETE',
              url: "{{ route('mapel.index') }}/"+id,
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

      // edit mapel
      table.on('click', '.btn-edit', function() {
        const id = $(this).attr('data-id');
        $.ajax({
          type: 'GET',
          url: "{{ route('mapel.index') }}/"+id+"/edit",
          success: function(data) {
            $('#edit-id').val(data.id)
            $('#edit-mapel').val(data.nama)
            $('#modal-edit').modal('show')
          }
        })
      })

      // update mapel
      $('#form-edit').on('submit', function(e) {
        e.preventDefault()
        const id = $('#edit-id').val();
        const mapel = $('#edit-mapel').val();
        $.ajax({
          type: 'PUT',
          data: {nama: mapel},
          url: "{{ route('mapel.index') }}/"+id,
          success: function(data) {
            if (data.status) {
              swal.fire('Berhasil', data.message, 'success')
              table.draw()
              $('#modal-edit').modal('hide')
            }
          }
        })
      })
    </script>
@endsection
