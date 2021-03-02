<template>
  <v-card>
    <v-card-text>Daftar Soal</v-card-text>
    <v-divider></v-divider>
    <v-row class="mx-1">
      <v-flex v-for="(item, index) in soal" :key="index" class="w-20 text-center pt-4">
        <v-btn
          color="success"
          :outlined="item.aktif"
          :disabled="item.aktif"
          v-on:click="pilihSoal(item.id)"
        >{{ index + 1 }}
        <v-icon
          dark
          small
          v-if="item.ragu"
        >
          mdi-alert-circle
        </v-icon>
        </v-btn>
      </v-flex>
    </v-row>
    <v-card-actions class="mt-4">
      <v-btn block color="red" dark>SELESAI</v-btn>
    </v-card-actions>
  </v-card>
</template>

<script>
import store from '../../store'
export default {
  name: "DaftarSoal",
  computed: {
    soal: () => store.getters['ujian/soal']
  },
  methods: {
    pilihSoal(id) {
      store.dispatch('ujian/setSoalAktif', id)
      this.$parent.$parent.$parent.$refs.jawabanSoal.ambilJawaban()
    }
  }
}
</script>
