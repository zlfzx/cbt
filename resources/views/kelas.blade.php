@extends('layouts.global')

@section('title', 'Kelas')

@section('content')
    <div class="row">
      <div class="col-8">
        <div class="card">
          <div class="card-header">
            <h4 class="card-title">Daftar Kelas</h4>
          </div>
          <div class="card-body">
            <table class="table table-hover table-striped" id="table-kelas">
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
      <div class="col-4">
        <div class="card">
          <div class="card-header">
            <h4 class="card-title">Tambah Kelas</h4>
          </div>
          <div class="card-body">
            <form>
              <div class="form-group">
                <label for="form-kelas">Nama Kelas</label>
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
      $('#table-kelas').DataTable()
    </script>
@endsection