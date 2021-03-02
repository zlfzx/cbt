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
      <div v-else>
        <CekUjian></CekUjian>
        <TabelUjian></TabelUjian>
      </div>
    </v-col>
  </v-row>
</template>

<script>
import store from './../../store'
import axios from 'axios'
import CekUjian from "../../components/Beranda/CekUjian";
import TabelUjian from "../../components/Beranda/TabelUjian";
export default {
  name: 'Beranda',
  components: {
    CekUjian,
    TabelUjian
  },
  computed: {
    // check password
    check_password: () => store.getters['checkPassword'],
  },
  mounted() {
    axios.get('/api/password/check').then((response) => {
      let res = response.data
      store.commit("SET_CHECK_PASSWORD", res.status)
      // console.log(res)
    })
  }
}
</script>
