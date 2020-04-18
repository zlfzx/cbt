@extends('layouts.global')

@section('title', 'Tambah Soal')

@section('content')
  <form id="form-tambah-soal">
    <div class="card">
      <div class="card-header">
        <h4 class="card-title">Detail Soal</h4>
      </div>
      <div class="card-body">
        <div class="row">
          <div class="col-lg-3 col-md-6 col-sm-12">
            <div class="form-group">
              <label for="form-kelas">Kelas</label>
              <select name="" id="form-kelas" class="form-control"></select>
            </div>
          </div>
          <div class="col-lg-3 col-md-6 col-sm-12">
            <div class="form-group">
              <label for="form-mapel">Mata Pelajaran</label>
              <select name="" id="form-mapel" class="form-control"></select>
            </div>
          </div>
          <div class="col-lg-3 col-md-6 col-sm-12">
            <div class="form-group">
              <label for="form-paket">Paket Soal</label>
              <select name="" id="form-paket" class="form-control"></select>
            </div>
          </div>
          <div class="col-lg-3 col-md-6 col-sm-12">
            <div class="form-group">
              <label for="form-jenis">Jenis Soal</label>
              <select name="" id="form-jenis" class="form-control">
                <option value="">-- Pilih Jenis Soal --</option>
                <option value="pilihan_ganda">Pilihan Ganda</option>
                <option value="essai">Essai</option>
              </select>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="card">
      <div class="card-header">
        <h4 class="card-title">Isi Soal</h4>
      </div>
      <div class="card-body">
        <div class="form-group">
          <label for="form-nama">Nama <span class="text-muted">(informasi materi soal)</span></label>
          <input type="text" class="form-control" id="form-nama">
        </div>
        <div class="form-group">
          <label for="form-soal">Soal</label>
          <textarea name="" class="form-control" id="form-soal" cols="30" rows="10"></textarea>
        </div>
        <div class="form-group">
          <label for="media-soal">Media Soal (opsional)</label>
          <input type="file" name="" id="" class="form-control">
          <small id="mediaHelp" class="form-text text-muted">File : MP3/MP4/3GP/AVI</small>
        </div>
        <div class="form-group" id="form-essai">
          <label for="form-jawaban">Jawaban Essai</label>
          <input type="text" class="form-control" id="form-jawaban" placeholder="Masukkan jawaban essai (huruf kecil)">
        </div>
        <div id="form-pilgan">
          <div class="form-group">
            <label for="">Jawaban Pilihan Ganda</label>
            <div class="row mt-1">
              <div class="col-9" id="list-pg">
                <h1 class="text-muted text-center"><span class="badge badge-danger">Pilih Jumlah Jawaban</span></h1>
                <h2 class="text-center"><i class="fas fa-arrow-down"></i></h2>
                <h1 class="text-muted text-center"><span class="badge badge-success">Pilih Jawaban Benar</span></h1>
              </div>
              <div class="col-3">
                <div class="form-group">
                  <label for="jumlah-pilihan">Jumlah Pilihan</label>
                  <select name="" id="jumlah-pilihan" class="form-control">
                    <option value="">Pilihan</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                  </select>
                </div>
                <div class="form-group">
                  <label for="jawaban-benar">Jawaban Benar</label>
                  <select name="" id="jawaban-benar" class="form-control">
                    <option value="">-- Kosong --</option>
                  </select>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="form-group">
          <button class="btn btn-success">Simpan</button>
        </div>
      </div>
    </div>
  </form>
@endsection

@section('script')
  <script src="{{ asset('assets/ckeditor/ckeditor.js') }}"></script>
  <script>
    $('#form-kelas').select2({
      placeholder: 'Pilih Kelas...'
    })

    $('#form-mapel').select2({
      placeholder: 'Pilih Mata Pelajaran...'
    })
    $('#form-paket').select2({
      placeholder: 'Pilih Paket Soal...'
    })
    $('#form-jenis').select2()

    $('#form-pilgan').hide()
    $('#form-essai').hide()
    $('#form-jenis').off('change').on('change', function() {
      let jenis = $('#form-jenis').val()
      if (jenis == 'pilihan_ganda') {
        console.log(jenis)
        $('#form-essai').hide()
        $('#form-pilgan').show()
      }
      else if (jenis == 'essai') {
        console.log(jenis)
        $('#form-pilgan').hide()
        $('#form-essai').show()
      }
      else {
        $('#form-essai').hide()
        $('#form-pilgan').hide()
      }
    })

    // soal
    CKEDITOR.replace('form-soal', {
      filebrowserImageBrowseUrl: '{{ url("/filemanager?type=Images") }}',
      filebrowserImageUploadUrl: '{{ url("/filemanager/upload?type=Images&_token=") }}',
      filebrowserBrowseUrl: '{{ url("/filemanager?type=Files") }}',
      filebrowserUploadUrl: '{{ url("/filemanager/upload?type=Files&_token") }}='
    })

    // jumlah jawaban
    $('#jumlah-pilihan').on('change', function(){
      // console.log($(this).val())
      let list = '';
      let option = '<option>-- Jawaban --</option>';
      let jumlah = $(this).val()
      for (let id = 1; id <= jumlah; id++) {
        console.log(id)
        let pilihan = String.fromCharCode(64 + id)
        list += `
        <div class="mb-4" id="jawaban-${id}">
          <h4><b>Pilihan ${pilihan}</b></h4>
          <textarea name="" id="jawaban-pilgan-${id}" cols="30" rows="10" class="form-control jawaban-pilgan"></textarea>
          <h5 class="mt-2">Media Jawaban (opsional)</h5>
          <input type="file" name="" id="media-jawaban-${id}" class="form-control">
          <small class="form-text text-muted">File : MP3/MP4/3GP/AVI</small>
        </div>`;

        // option jawaban
        option += `<option value="${id}">${pilihan}</option>`
      }
      $('#list-pg').html(list)
      
      // CKEditor form jawaban
      $('.jawaban-pilgan').each(function() {
        CKEDITOR.replace($(this).attr('id'), {
          height: '100px',
          filebrowserImageBrowseUrl: '{{ url("/filemanager?type=Images") }}',
          filebrowserImageUploadUrl: '{{ url("/filemanager/upload?type=Images&_token=") }}',
          filebrowserBrowseUrl: '{{ url("/filemanager?type=Files") }}',
          filebrowserUploadUrl: '{{ url("/filemanager/upload?type=Files&_token") }}='
        })
      })

      // select jawaban benar
      $('#jawaban-benar').html(option)
    })

  </script>
@endsection