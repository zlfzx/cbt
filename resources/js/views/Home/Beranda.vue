<template>
  <v-row>
    <v-col cols="12" sm="10">
      <!-- Alert Ganti Password -->
      <v-alert prominent type="error" v-if="check_password">
        <v-row align="center">
          <v-col class="grow">Sebelum memulai ujian harap mengganti kata sandi terlebih dahulu.</v-col>
          <v-col class="shrink">
            <v-btn to="pengaturan">Ganti Kata Sandi</v-btn>
          </v-col>
        </v-row>
      </v-alert>
      <!-- ./ Alert Ganti Password -->
      <v-card v-else>
        <v-toolbar dense flat color="blue" dark>
          <v-toolbar-title>Daftar Ujian</v-toolbar-title>
        </v-toolbar>
        <v-data-table
          :headers="headers"
          :items="ujian"
          :options.sync="options"
          :server-items-length="totalItems"
          :loading="loading"
          loading-text="Mengambil Data..."
        >
          <template v-slot:item.waktu_ujian="{ item }">
            {{ item.waktu_ujian }} Menit
          </template>
          <template v-slot:item.paket_soal.soal_count="{ item }">
            {{ item.paket_soal.soal_count }} Soal
          </template>
          <template v-slot:item.id="{ item }">
            <v-btn small color="success">Mulai</v-btn>
          </template>
        </v-data-table>
      </v-card>
    </v-col>
  </v-row>
</template>

<script>
import store from './../../store'
import axios from 'axios'
export default {
  name: 'Beranda',
  data () {
    return {
      headers: [
        {text: 'Nama Ujian', value: 'nama', align: 'center'},
        {text: 'Mata Pelajaran', value: 'paket_soal.mapel.nama', align: 'center'},
        {text: 'Waktu', value: 'waktu_ujian', align: 'center'},
        {text: 'Jumlah Soal', value: 'paket_soal.soal_count', align: 'center'},
        {text: 'Status', value: 'id', align: 'center'}
      ],
      loading: false,
    }
  },
  computed: {
    // check password
    token: () => store.state.auth.token,
    check_password: () => store.state.check_password,
    // datatable
    ujian: () => store.getters["ujian/ujian"],
    page: () => store.getters["ujian/page"],
    totalItems: () => store.getters["ujian/totalItems"],
    options: {
      get: () => store.getters["ujian/options"],
      set: (value) => store.dispatch('ujian/getUjian', value)
    }
  },
  mounted() {
    axios.get('/api/password/check', {
      headers: {
        Authorization: "Bearer " + this.token,
        'Content-Type': 'application/json'
      }
    }).then((response) => {
      let res = response.data
      store.commit("SET_CHECK_PASSWORD", res.status)
      // console.log(res)
    })
  },
  watch: {
    options: {
      handler() {
        this.loading = true
        store.dispatch('ujian/getUjian', this.page)
        .then(result => {
          this.loading = false
        })
      },

      update() {
        console.log('update')
        this.loading = true
        store.dispatch('ujian/getUjian', this.page)
        .then(result => {
          this.loading = false
        })
      },

      deep: true
    }
  }
}
</script>
