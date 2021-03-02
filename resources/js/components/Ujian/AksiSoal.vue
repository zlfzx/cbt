<template>
  <v-card-actions class="d-flex justify-space-between flex-wrap">
    <v-btn color="warning" class="pr-4 ml-3" rounded @click="prev"><v-icon dark small left>mdi-arrow-left</v-icon>Kembali</v-btn>
    <v-checkbox label="Ragu-ragu" v-model="isRagu"></v-checkbox>
    <v-btn color="warning" class="pl-4 mr-3" rounded @click="next">Lanjut<v-icon dark small right>mdi-arrow-right</v-icon></v-btn>
  </v-card-actions>
</template>

<script>
import store from '../../store'
export default {
  name: "AksiSoal",
  computed: {
    soal: () => store.getters['ujian/soalAktif'],
    isRagu: {
      get() {
        let ragu = this.soal.ragu
        console.log('ragu-ragu', ragu)
        return ragu
      },
      set(value) {
        this.ragu(value)
      }
    }
  },
  methods: {
    prev() {
      console.log('prev')
    },
    next() {
      console.log('next')
    },
    ragu(value) {
      console.log(value)
      store.commit('ujian/setSoalragu', {
        id: this.soal.id,
        status: value
      })
    }
  }
}
</script>
