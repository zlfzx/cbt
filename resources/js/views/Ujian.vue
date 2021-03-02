<template>
  <v-app id="inspire">
    <v-app-bar app dark color="blue">
      <v-toolbar-title>Computer Based Test</v-toolbar-title>
      <v-spacer></v-spacer>
      <TimerSoal></TimerSoal>
    </v-app-bar>
    <v-content class="grey lighten-4">
      <v-container class="pb-0">
        <v-row align="center" justify="center">
          <v-col cols="12">
            <v-card>
              <v-card-title>{{ mapel }}</v-card-title>
              <v-card-subtitle>Kelas {{ kelas }}</v-card-subtitle>
              <v-spacer></v-spacer>
            </v-card>
          </v-col>
        </v-row>
      </v-container>
      <v-container class="pt-0 mb-5">
        <v-row>
          <v-col md="8" cols="12">
            <v-card>
              <v-card-text>Soal {{ no_soal }}</v-card-text>
              <v-divider></v-divider>
              <TampilSoal ref="tampilSoal"></TampilSoal>
              <JawabanSoal ref="jawabanSoal"></JawabanSoal>
              <v-divider></v-divider>
              <AksiSoal></AksiSoal>
            </v-card>
          </v-col>
          <v-col md="4" cols="12">
            <DaftarSoal/>
            <v-card class="mt-4">
              <v-alert text prominent type="error" dense>
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Illum illo porro animi exercitationem iste rerum odit magni aliquid numquam hic.
              </v-alert>
            </v-card>
          </v-col>
        </v-row>
      </v-container>
    </v-content>
    <Alert></Alert>
  </v-app>
</template>

<script>
import store from '../store'
import Alert from '../components/Alert'
import DaftarSoal from "../components/Ujian/DaftarSoal";
import TimerSoal from "../components/Ujian/TimerSoal";
import TampilSoal from "../components/Ujian/TampilSoal";
import JawabanSoal from "../components/Ujian/JawabanSoal";
import AksiSoal from "../components/Ujian/AksiSoal";
export default {
  name: 'Ujian',
  components: {
    AksiSoal,
    JawabanSoal,
    TampilSoal,
    TimerSoal,
    DaftarSoal,
    Alert
  },
  created() {
    console.log('created')
    const aktif = store.getters['ujian/aktif']
    if (aktif) {
      console.log('mulai ujian')

      // set title
      const ujian = store.state.ujian.nama
      const mapel = store.state.ujian.paket_soal.mapel.nama
      document.title = `${ujian} | ${mapel}`

    } else {
      store.dispatch('alert/set', {
        status: true,
        color: 'error',
        text: 'Tidak ada ujian yang aktif!'
      })
      this.$router.push('/')
    }
  },
  computed: {
    mapel: () => store.state.ujian.paket_soal.mapel.nama,
    kelas: () => store.state.ujian.kelas.nama,
    no_soal: () => store.getters['ujian/soalAktif'].no
  }
}
</script>
