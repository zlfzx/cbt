@extends('layouts.global')

@section('title', 'Mata Pelajaran')

@section('content')
    <div class="row">
      <div class="col-8">
        <div class="card">
          <div class="card-header">
            <div class="card-head-row">
              <h4 class="card-title">Daftar Mata Pelajaran</h4>
              <div class="card-tools">
                <button type="button" data-toggle="modal" data-target="#modal-tambah" class="btn btn-sm btn-round btn-success"><i class="fas fa-plus"></i> Tambah Mapel</button>
              </div>
            </div>
          </div>
          <div class="card-body">
            <table class="table table-hover table-striped text-center" id="table-mapel">
              <thead>
                <tr>
                  <th>No.</th>
                  <th>Mata Pelajaran</th>
                  <th>#</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>1.</td>
                  <td>Bahasa Indonesia</td>
                  <td>
                    <button class="btn btn-xs btn-danger">Hapus</button>
                  </td>
                </tr>
                <tr>
                  <td>2.</td>
                  <td>Bahasa Indonesia</td>
                  <td>
                    <button class="btn btn-xs btn-danger">Hapus</button>
                  </td>
                </tr>
                <tr>
                  <td>3.</td>
                  <td>Bahasa Indonesia</td>
                  <td>
                    <button class="btn btn-xs btn-danger">Hapus</button>
                  </td>
                </tr>
                <tr>
                  <td>4.</td>
                  <td>Bahasa Indonesia</td>
                  <td>
                    <button class="btn btn-xs btn-danger">Hapus</button>
                  </td>
                </tr>
              </tbody>
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
            <form>
              <div class="form-group">
                <label for="form-mapel">Nama Mapel</label>
                <input type="text" class="form-control">
              </div>
              <div class="form-group">
                <button class="btn btn-success float-right">Tambah</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
@endsection

@section('script')
    <script>
      $('#table-mapel').DataTable()
    </script>
@endsection