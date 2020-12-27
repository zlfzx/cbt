@extends('layouts.global')

@section('title', 'Edit Soal '.$soal['nama'])

@section('content')
  <form id="form-edit" enctype="multipart/form-data">
    @method('PUT')
    <div class="card">
      <div class="card-header">
        <h4 class="card-title">Detail Soal</h4>
      </div>
      <div class="card-body">
        <div class="row">
          <div class="col-lg-3 col-md-6 col-sm-12">
            <div class="form-group">
              <label for="form-kelas">Kelas</label>
              <select name="soal[kelas_id]" id="form-kelas" class="form-control select-kelas">
                <option value="{{ $soal['kelas']['id'] }}">{{ $soal['kelas']['nama'] }}</option>
              </select>
            </div>
          </div>
          <div class="col-lg-3 col-md-6 col-sm-12">
            <div class="form-group">
              <label for="form-mapel">Mata Pelajaran</label>
              <select name="soal[mapel_id]" id="form-mapel" class="form-control select-mapel">
                <option value="{{ $soal['mapel']['id'] }}">{{ $soal['mapel']['nama'] }}</option>
              </select>
            </div>
          </div>
          <div class="col-lg-3 col-md-6 col-sm-12">
            <div class="form-group">
              <label for="form-paket">Paket Soal</label>
              <select name="soal[paket_soal_id]" id="form-paket" class="form-control select-paket">
                <option value="{{ $soal['paket_soal']['id'] }}">{{ $soal['paket_soal']['nama'] }}</option>
              </select>
            </div>
          </div>
          <div class="col-lg-3 col-md-6 col-sm-12">
            <div class="form-group">
              <label for="form-jenis">Jenis Soal</label>
              <select name="soal[jenis]" id="form-jenis" class="form-control" disabled>
                <option value="{{ $soal['jenis'] }}">{{ $soal['jenis'] == 'essai' ? 'Essai' : 'Pilihan Ganda' }}</option>
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
          <input type="text" name="soal[nama]" value="{{ $soal['nama'] }}" class="form-control" id="form-nama" placeholder="Masukkan Nama Soal">
        </div>
        <div class="form-group">
          <label for="form-soal">Soal</label>
          <textarea name="soal[soal]" class="form-control" id="form-soal" cols="30" rows="10">
            {{ $soal['soal'] }}
          </textarea>
        </div>
        <div class="form-group">
          <label for="media-soal">Media Soal (opsional)</label>
          <input type="file" name="soal[soal_media]" id="" class="form-control">
          <small id="mediaHelp" class="form-text text-muted">File : MP3/MP4/3GP/AVI</small>
        </div>

        {{-- Jawaban Essai --}}
        @if($soal['jenis'] == 'essai')
        <div class="form-group" id="form-essai">
          <label for="form-jawaban">Jawaban Essai</label>
          <input type="text" name="jawaban[essai]" value="{{ $soal['soal_jawaban'][0]['jawaban'] }}" class="form-control" id="form-jawaban" placeholder="Masukkan jawaban essai (huruf kecil)">
        </div>
        @elseif($soal['jenis'] == 'pilihan_ganda')
        {{-- Jawaban Pilihan Ganda --}}
        <div id="form-pilgan">
          <div class="form-group">
            <label for="">Jawaban Pilihan Ganda</label>
            <div class="row mt-1">
              <div class="col-lg-9 order-lg-1 order-sm-2" id="list-pg">
                {{-- List Jawaban --}}
                @foreach($soal['soal_jawaban'] as $key => $value)
                <div class="mb-4" id="jawaban-{{ $key + 1 }}">
                  <h4><b>Pilihan {{ $key + 1 }}</b></h4>
                  <textarea name="jawaban[pilgan][{{ $value['id'] }}][jawaban]" id="jawaban-pilgan-{{ $key + 1 }}" cols="30" rows="10" class="form-control jawaban-pilgan">
                    {{ $value['jawaban'] }}
                  </textarea>
                  <h5 class="mt-2">Media Jawaban (opsional)</h5>
                  <input type="file" name="jawaban[pilgan][{{ $value['id'] }}][media]" id="media-jawaban-{{ $key + 1 }}" class="form-control">
                  <small class="form-text text-muted">File : MP3/MP4/3GP/AVI</small>
                </div>
                @endforeach
              </div>
              <div class="col-lg-3 order-lg-2 ordder-sm-1">
                <div class="form-group">
                  <label for="jawaban-benar">Jawaban Benar</label>
                  <select name="jawaban[benar]" id="jawaban-benar" class="form-control">
                    @foreach($soal['soal_jawaban'] as $key => $value)
                    <option value="{{ $value['id'] }}" {{ $value['status'] == 1 ? 'selected' : '' }}>Pilihan {{ $key + 1 }}</option>
                    @endforeach
                  </select>
                </div>
              </div>
            </div>
          </div>
        </div>
        @endif

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

    // soal
    CKEDITOR.replace('form-soal', {
      filebrowserImageBrowseUrl: '{{ url("/filemanager?type=Images") }}',
      filebrowserImageUploadUrl: '{{ url("/filemanager/upload?type=Images&_token=") }}',
      filebrowserBrowseUrl: '{{ url("/filemanager?type=Files") }}',
      filebrowserUploadUrl: '{{ url("/filemanager/upload?type=Files&_token") }}='
    })

    // Jawaban
    @foreach($soal['soal_jawaban'] as $key => $value)
    CKEDITOR.replace('jawaban-pilgan-{{ $key + 1 }}', {
      filebrowserImageBrowseUrl: '{{ url("/filemanager?type=Images") }}',
      filebrowserImageUploadUrl: '{{ url("/filemanager/upload?type=Images&_token=") }}',
      filebrowserBrowseUrl: '{{ url("/filemanager?type=Files") }}',
      filebrowserUploadUrl: '{{ url("/filemanager/upload?type=Files&_token") }}='
    })
    @endforeach

    // simpan
    $('#form-edit').on('submit', function(e) {
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
        url: "{{ route('soal.update', ['soal' => $soal['id']]) }}",
        success: function(data) {
          swal.fire({
            title: 'Berhasil',
            text: data.message,
            icon: 'success'
          })
        },
        error: function(err) {
          let error = err.responseJSON
          let errors = ''
          error.messages.forEach(function(e) {
            errors += e + "<br />"
          })
          swal.fire('Gagal', errors, 'error')
        }
      })
    })

  </script>
@endsection
