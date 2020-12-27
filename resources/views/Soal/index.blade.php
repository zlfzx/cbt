@extends('layouts.global')

@section('title', 'Soal')

@section('content')
  <div class="card">
    <div class="card-header">
      <h4 class="card-title">Daftar Soal</h4>
      <div class="card-tools">
        <a href="{{ route('soal.create') }}" class="btn btn-sm btn-round btn-success"><i class="fas fa-plus"></i> Tambah Soal</a>
        <button class="btn btn-sm btn-round btn-info"><i class="fas fa-cloud-upload-alt"></i> Import Soal</button>
      </div>
    </div>
    <div class="card-body">
      <table class="table table-hover table-striped text-center display nowrap w-100" id="table-soal">
        <thead>
          <tr>
            <th>No.</th>
            <th>Kelas</th>
            <th>Mata Pelajaran</th>
            <th>Paket Soal</th>
            <th>Nama Soal</th>
            <th>Jenis</th>
            <th>#</th>
          </tr>
        </thead>
      </table>
    </div>
  </div>

  <!-- modal detail -->
  <div class="modal fade" id="modal-detail">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Detail Soal</h4>
          <button class="close" data-toggle="modal" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
          <table class="table">
            <tr>
              <th>Nama Soal</th>
              <td id="detail-nama"></td>
            </tr>
            <tr>
              <th>Jenis Soal</th>
              <td id="detail-jenis"></td>
            </tr>
            <tr>
              <th>Kelas</th>
              <td id="detail-kelas"></td>
            </tr>
            <tr>
              <th>Mata Pelajaran</th>
              <td id="detail-mapel"></td>
            </tr>
            <tr>
              <th>Paket Soal</th>
              <td id="detail-paket">Belum Ada Paket Soal</td>
            </tr>
          </table>
          <div class="col-sm-12">
            <h4><b>Isi Soal :</b></h4>
            <div id="detail-soal"></div>

            <h4><b>Media Soal :</b></h4>
            <div id="detail-media">
              <i class="text-muted">Tidak Ada Media</i>
              <br>
              <audio src="#" controls></audio>
              <video src="#" controls></video>
            </div>
          </div>
          <hr>
          <div class="col-sm-12">
            <h4><b>Jawaban :</b></h4>
            <div id="detail-jawaban"></div>
          </div>
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
    const table = $('#table-soal').DataTable({
      responsive: true,
      scrollX: true,
      processing: true,
      serverSide: true,
      ajax: {
        type: 'POST',
        url: "{{ route('soal.data') }}"
      },
      columns: [
        {
          data: 'DT_RowIndex', searchable: false
        },
        {
          data: 'kelas.nama'
        },
        {
          data: 'mapel.nama'
        },
        {
          data: 'paket_soal.nama', render: function (data) {
            if (data) {
              return data
            }
            return '<i class="text-muted">Belum ada Paket Soal</i>'
          }
        },
        {
          data: 'nama'
        },
        {
          data: 'jenis'
        },
        {
          data: 'id', orderable: false, searchable: false,
          render: function (data) {
            let btn = `<button class="btn btn-xs btn-info btn-detail" data-id="${data}"><i class="fas fa-eye"></i></button> `;
            btn += `<a href="{{ route('soal.index') }}/${data}/edit" class="btn btn-xs btn-warning btn-edit" data-id="${data}"><i class="fas fa-edit"></i></a> `
            btn += `<button class="btn btn-xs btn-danger btn-hapus" data-id="${data}"><i class="fas fa-trash"></i></button>`
            return btn
          }
        }
      ]
    });

    table.on('click', '.btn-detail', function() {
      const id = $(this).attr('data-id');
      $.ajax({
        type: 'GET',
        url: "{{ route('soal.index') }}/"+id,
        success: function(data) {
          if (data.status) {
            var d = data.message
            $('#detail-nama').html(d.nama)
            $('#detail-jenis').html(d.jenis)
            $('#detail-kelas').html(d.kelas.nama)
            $('#detail-mapel').html(d.mapel.nama)
            $('#detail-paket').html(d.paket_soal != null ? d.paket_soal.nama : '<i>Belum ada Paket Soal</i>')
            $('#detail-soal').html(d.soal)
            // jawaban
            var jawaban = ''
            d.soal_jawaban.forEach(function(j) {
              console.log(j)
              jawaban += `<div class="card">
              <div class="card-body list-jawaban">
              ${j.jawaban}
              <br>
              <audio src="#" controls></audio>
              <video src="#" controls></video>
              </div>
              </div>`
            })
            $('#detail-jawaban').html(jawaban)

            $('#modal-detail').modal()
          }
        }
      })
    })

    // hapus soal
    table.on('click', '.btn-hapus', function(e) {
      e.preventDefault()
      Swal.fire({
        title: 'Hapus Soal',
        text: "Anda yakin ingin menghapus soal tersebut?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya',
        cancelButtonText: 'Batal'
      }).then((result) => {
        let id = $(this).data('id')
        if (result.value) {
          $.ajax({
            type: 'DELETE',
            url: "{{ route('soal.index') }}/" + id,
            success: function(res) {
              Swal.fire(
                'Berhasil',
                res.message,
                'success'
              )
              table.draw()
            }
          })
        }
      })
    })
  </script>
@endsection
