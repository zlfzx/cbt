<template>
  <v-row>
    <v-col cols="12" sm="12" md="8">
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
        ></v-data-table>
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
        {text: 'Nama Ujian', align: 'center'},
        {text: 'Mata Pelajaran', align: 'center'},
        {text: 'Waktu', align: 'center'},
        {text: 'Jumlah Soal', align: 'center'},
        {text: 'Status', align: 'center'}
      ]
    }
  },
  computed: {
    token: () => store.state.auth.token,
    check_password: () => store.state.check_password
  },
  mounted() {
    console.log('beranda')
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
}
</script>