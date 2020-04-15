@extends('layouts.global')

@section('title', 'Mata Pelajaran')

@section('content')
    <div class="row">
      <div class="col-8">
        <div class="card">
          <div class="card-header">
            <h4 class="card-title">Daftar Mata Pelajaran</h4>
          </div>
          <div class="card-body">
            <table class="table table-hover table-striped" id="table-mapel">
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
      <div class="col-4">
        <div class="card">
          <div class="card-header">
            <h4 class="card-title">Tambah Mata Pelajaran</h4>
          </div>
          <div class="card-body">
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