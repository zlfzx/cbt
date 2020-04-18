@extends('layouts.global')

@section('title')
    Pengaturan
@endsection

@section('content')
    <div class="row">
      <div class="col-4">
        <div class="card">
          <div class="card-header">
            <h4 class="card-title">Informasi Aplikasi</h4>
          </div>
          <div class="card-body">
            <form action="">
              <div class="form-group">
                <label for="form-judul">Title</label>
                <input type="text" class="form-control">
              </div>
              <div class="form-group">
                <label for="form-deskripsi">Deskripsi</label>
                <input type="text" class="form-control">
              </div>
              <div class="form-group">
                <label for="form-logo">Logo</label>
                <div class="current-logo">
                  <h1><i class="
                    fas fa-cloud-upload-alt"></i></h1>
                  <img src="" alt="">
                </div>
                <input type="file" name="" id="" class="form-control">
              </div>
              <div class="form-group">
                <button class="btn btn-sm btn-success">Simpan</button>
              </div>
            </form>
          </div>
        </div>
      </div>
      <div class="col-8">
        <div class="card">
          <div class="card-header">
            <div class="card-head-row">
              <h4 class="card-title">Daftar Admin</h4>
              <div class="card-tools">
                <button data-toggle="modal" data-target="#modal-tambah-admin" class="btn btn-sm btn-success btn-round"><i class="fas fa-plus"></i> Tambah Admin</button>
              </div>
            </div>
          </div>
          <div class="card-body">
            <table class="table table-striped table-hover text-center" id="table-admin">
              <thead>
                <tr>
                  <th>No.</th>
                  <th>Nama</th>
                  <th>Email</th>
                  <th>Roles</th>
                  <th>#</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>1.</td>
                  <td>Muhammad Zulfi Izzulhaq</td>
                  <th>zulfi.izzulhaq@gmail.com</th>
                  <th>
                    <span class="badge badge-danger">Admin</span>
                    <span class="badge badge-warning">Petugas Soal</span>
                    <span class="badge badge-info">Petugas Ujian</span>
                  </th>
                  <th>
                    <button class="btn btn-sm btn-danger">Hapus</button>
                  </th>
                </tr>
              </tbody>
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
          <form action="">
            <div class="modal-body">
              <div class="form-group">
                <label for="form-nama">Nama</label>
                <input type="text" class="form-control">
              </div>
              <div class="form-group">
                <label for="form-email">Email</label>
                <input type="email" name="" id="" class="form-control">
              </div>
              <div class="form-group">
                <label for="form-password">Password</label>
                <input type="password" name="" id="" class="form-control">
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
              <button class="btn btn-sm btn-success">Simpan</button>
            </div>
          </form>
        </div>
      </div>
    </div>
@endsection

@section('script')
    
@endsection