@extends('layouts.global')

@section('title', 'Tambah Soal')

@section('content')
  <form id="form-tambah" enctype="multipart/form-data">
    <div class="card">
      <div class="card-header">
        <h4 class="card-title">Detail Soal</h4>
      </div>
      <div class="card-body">
        <div class="row">
          <div class="col-lg-3 col-md-6 col-sm-12">
            <div class="form-group">
              <label for="form-kelas">Kelas</label>
              <select name="soal[kelas]" id="form-kelas" class="form-control select-kelas"></select>
            </div>
          </div>
          <div class="col-lg-3 col-md-6 col-sm-12">
            <div class="form-group">
              <label for="form-mapel">Mata Pelajaran</label>
              <select name="soal[mapel]" id="form-mapel" class="form-control select-mapel"></select>
            </div>
          </div>
          <div class="col-lg-3 col-md-6 col-sm-12">
            <div class="form-group">
              <label for="form-paket">Paket Soal</label>
              <select name="soal[paket]" id="form-paket" class="form-control select-paket"></select>
            </div>
          </div>
          <div class="col-lg-3 col-md-6 col-sm-12">
            <div class="form-group">
              <label for="form-jenis">Jenis Soal</label>
              <select name="soal[jenis]" id="form-jenis" class="form-control">
                <option value=""></option>
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
          <input type="text" name="soal[nama]" class="form-control" id="form-nama" placeholder="Masukkan Nama Soal">
        </div>
        <div class="form-group">
          <label for="form-soal">Soal</label>
          <textarea name="soal[soal]" class="form-control" id="form-soal" cols="30" rows="10"></textarea>
        </div>
        <div class="form-group">
          <label for="media-soal">Media Soal (opsional)</label>
          <input type="file" name="soal[soal_media]" id="" class="form-control">
          <small id="mediaHelp" class="form-text text-muted">File : MP3/MP4/3GP/AVI</small>
        </div>
        <div class="form-group" id="form-essai">
          <label for="form-jawaban">Jawaban Essai</label>
          <input type="text" name="jawaban[essai]" class="form-control" id="form-jawaban" placeholder="Masukkan jawaban essai (huruf kecil)">
        </div>
        <div id="form-pilgan">
          <div class="form-group">
            <label for="">Jawaban Pilihan Ganda</label>
            <div class="row mt-1">
              <div class="col-lg-9 order-lg-1 order-sm-2" id="list-pg">
                <h1 class="text-muted text-center"><span class="badge badge-danger">Pilih Jumlah Jawaban</span></h1>
                <h2 class="text-center"><i class="fas fa-arrow-down"></i></h2>
                <h1 class="text-muted text-center"><span class="badge badge-success">Pilih Jawaban Benar</span></h1>
              </div>
              <div class="col-lg-3 order-lg-2 ordder-sm-1">
                <div class="form-group">
                  <label for="jumlah-pilihan">Jumlah Pilihan</label>
                  <select name="soal[jumlah_pilihan]" id="jumlah-pilihan" class="form-control">
                    <option value="">Pilihan</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                  </select>
                </div>
                <div class="form-group">
                  <label for="jawaban-benar">Jawaban Benar</label>
                  <select name="jawaban[benar]" id="jawaban-benar" class="form-control">
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
  <script src="{{ asset('dist/plugins/ckeditor/ckeditor.js') }}"></script>
  <script>
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
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

    // cari mapel (select2)
    $('.select-mapel').select2({
      theme: 'bootstrap4',
      placeholder: 'Cari Mata Pelajaran...',
      ajax: {
        delay: 250,
        url: "{{ route('mapel.select') }}",
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

    // cari paket soal (select2)
    $('.select-paket').select2({
      theme: 'bootstrap4',
      placeholder: 'Cari Paket Soal...',
      ajax: {
        delay: 250,
        url: "{{ route('paket-soal.select') }}",
        data: function(params) {
          return {
            kelas: $('.select-kelas').val(),
            mapel: $('.select-mapel').val()
          }
        },
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

    $('#form-jenis').select2({
      theme: 'bootstrap4',
      placeholder: 'Pilih Jenis Soal',
      data: [
        {
          id: 'pilihan_ganda',
          text: 'Pilihan Ganda'
        },
        {
          id: 'essai',
          text: 'Essai'
        }
      ]
    })

    $('#form-pilgan').hide()
    $('#form-essai').hide()
    $('#form-jenis').on('change', function() {
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
      let option = '<option value>-- Jawaban --</option>';
      let jumlah = $(this).val()
      for (let id = 1; id <= jumlah; id++) {
        // console.log(id)
        let pilihan = String.fromCharCode(64 + id)
        list += `
        <div class="mb-4" id="jawaban-${id}">
          <h4><b>Pilihan ${pilihan}</b></h4>
          <textarea name="jawaban[pilgan][${id}][jawaban]" id="jawaban-pilgan-${id}" cols="30" rows="10" class="form-control jawaban-pilgan"></textarea>
          <h5 class="mt-2">Media Jawaban (opsional)</h5>
          <input type="file" name="jawaban[pilgan][${id}][media]" id="media-jawaban-${id}" class="form-control">
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

    // simpan
    $('#form-tambah').on('submit', function(e) {
      e.preventDefault();
      var data = new FormData(this)
      // isi soal
      data.append('soal[soal]', CKEDITOR.instances['form-soal'].getData())
      var jumlah_pilihan = $('#jumlah-pilihan').val()
      // console.log(jumlah_pilihan)
      for (let i = 1; i <= jumlah_pilihan; i++) {
        // console.log('jawaban ' + i)
        data.append('jawaban[pilgan]['+i+'][jawaban]', CKEDITOR.instances['jawaban-pilgan-'+i].getData())
      }
      $.ajax({
        processData: false,
        contentType: false,
        type: 'POST',
        data: data,
        url: "{{ route('soal.store') }}",
        success: function(data) {
          if (data.status) {
            swal.fire({
              title: 'Berhasil',
              text: data.message,
              icon: 'success'
            })
            // $('.select-kelas').val('').trigger('change')
            // $('.select-mapel').val('').trigger('change')
            // $('.select-paket').val('').trigger('change')
            // $('#form-jenis').val('').trigger('change')
            $('#form-tambah').trigger('reset')
            CKEDITOR.instances['form-soal'].setData('')
          }
          else {
            var errors = ''
            data.message.forEach(function(e) {
              errors += e + "\n"
            })
            swal.fire('Gagal', errors, 'error')
          }
        }
      })
    })

  </script>
@endsection
