<template>
  <v-alert prominent type="warning" v-if="checkUjian">
    <v-row align="center">
      <v-col class="grow">Anda sedang mengerjakan <b>{{ ujian.nama }}</b> sampai pukul <b>{{ ujian.waktu_selesai }}</b>.</v-col>
      <v-col class="shrink">
        <v-btn to="ujian">Lanjutkan</v-btn>
      </v-col>
    </v-row>
  </v-alert>
</template>

<script>
import axios from 'axios'
import store from '../../store'
export default {
  name: "CekUjian",
  computed: {
    // check ujian
    checkUjian: () => store.getters['ujian/aktif'],
    ujian: () => {
      return {
        nama: store.state.ujian.nama,
        waktu_selesai: store.state.ujian.waktu_selesai
      }
    }
  },
  created() {
    console.log('created')
    console.log(this.checkUjian)
    axios.get('/api/ujian/cek-ujian')
    .then(response => {
      const data = response.data.data
      if (data) {
        console.log('ada ujian aktif')
        console.log(data)

        store.dispatch('ujian/setAktif', true)
        store.dispatch('ujian/setDetail', {
          'id': data.ujian.id,
          'nama': data.ujian.nama,
          'keterangan': data.ujian.keterangan,
          'kode_paket': data.ujian.paket_soal.kode_paket,
          'kelas': {
            id: data.ujian.paket_soal.kelas.id,
            nama: data.ujian.paket_soal.kelas.nama
          },
          'paket_soal': {
            id: data.ujian.paket_soal.id,
            nama: data.ujian.paket_soal.nama,
            keterangan: data.ujian.paket_soal.keterangan,
            mapel: {
              id: data.ujian.paket_soal.mapel.id,
              nama: data.ujian.paket_soal.mapel.nama
            }
          },
          'waktu_mulai': data.waktu_mulai,
          'waktu_selesai': data.waktu_selesai
        })
        store.dispatch('ujian/ambilSoal', data.soal)
      } else {
        console.log('tidak ada ujian aktif')
      }
    })
  },
  mounted() {
    console.log('mounted')
    console.log(this.checkUjian)
  }
}
</script>
