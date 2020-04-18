@extends('layouts.global')

@section('title', 'Siswa')

@section('content')
    <div class="card">
      <div class="card-header">
        <div class="card-head-row">
          <h4 class="card-title">Daftar Siswa</h4>
          <div class="card-tools">
            <button data-toggle="modal" data-target="#modal-tambah" class="btn btn-sm btn-round btn-success"><i class="fas fa-plus"></i> Tambah Siswa</button>
            <button class="btn btn-sm btn-round btn-info"><i class="fas fa-cloud-upload-alt"></i> Import Siswa</button>
          </div>
        </div>
      </div>
      <div class="card-body">
        <table class="table table-hover table-striped text-center" id="table-siswa">
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
          <tbody>
            <tr>
              <td>1.</td>
              <td>1610853</td>
              <td>Muhammad Zulfi Izzulhaq</td>
              <td>
                <button class="btn btn-info btn-xs"><i class="fas fa-eye"></i> Lihat Password</button>
                <button class="btn btn-xs btn-warning"><i class="fas fa-undo"></i> Reset Password</button>
              </td>
              <td>12 TKJ 2</td>
              <td>
                <button class="btn btn-xs btn-danger">Hapus</button>
              </td>
            </tr>
          </tbody>
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
                <input type="text" class="form-control">
              </div>
              <div class="form-group">
                <label for="form-nis">NIS</label>
                <input type="text" class="form-control">
              </div>
              <div class="form-group">
                <label for="form-kelas">Kelas</label>
                <select name="" id="" class="form-control"></select>
              </div>
              <div class="form-group">
                <label for="form-password">Password</label>
                <input type="text" class="form-control" placeholder="Kosongkan untuk menggenerate password default">
              </div>
            </div>
            <div class="modal-footer">
              <button class="btn btn-sm btn-danger" data-toggle="modal" data-dismiss="modal">Batal</button>
              <button class="btn btn-sm btn-success">Simpan</button>
            </div>
          </form>
        </div>
      </div>
    </div>
@endsection

@section('script')
    <script>
      $('#table-siswa').DataTable()
    </script>
@endsection