<template>
  <div class="mx-6">

    <v-text-field
      label="Masukkan Jawaban"
      hint="Tuliskan jawaban dalam huruf kecil"
      class="mb-5"
      outlined
      v-if="soal.jenis === 'essai'"
    ></v-text-field>

    <v-radio-group v-if="soal.jenis === 'pilihan_ganda'" class="mt-0 pt-0">
      <v-radio v-for="(j, index) in soal.jawaban" :key="j.id" class="my-3">
        <template v-slot:label>
          <div class="jawaban" v-html="j.jawaban"></div>
        </template>
      </v-radio>

<!--      <v-radio class="my-3">-->
<!--        <template v-slot:label>-->
<!--          <v-img src="https://picsum.photos/seed/picsum/300/200" width="100"></v-img>-->
<!--        </template>-->
<!--      </v-radio>-->

<!--      <v-radio label="Jawaban A" class="my-3"></v-radio>-->

<!--      <v-radio label="Jawaban A" class="my-3"></v-radio>-->

    </v-radio-group>
  </div>
</template>

<script>
import axios from 'axios'
import store from '../../store'
export default {
  name: "JawabanSoal",
  computed: {
    soal: () => store.getters['ujian/soalAktif']
  },
  methods: {
    ambilJawaban() {
      // if (this.soal.jenis === 'pilihan_ganda') {
      //   if (!this.soal.jawaban) {
      //     console.log('ambil jawaban')
      //     axios.post('/api/ujian/jawaban', {
      //       'id': this.soal.id
      //     }).then(response => {
      //       store.dispatch('ujian/setSoalJawaban', {
      //         id: this.soal.id,
      //         jawaban: response.data.data
      //       })
      //     })
      //   } else {
      //     console.log('tampil jawaban')
      //   }
      // }
      store.dispatch('ujian/setSoalJawaban', this.soal.id)
    }
  }
}
</script>

<style scoped>
  >>> .jawaban > p {
    margin-bottom: 0 !important;
  }
</style>
