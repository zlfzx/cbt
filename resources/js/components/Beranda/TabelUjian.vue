<template>
  <v-card>
    <v-toolbar dense flat color="blue" dark>
      <v-toolbar-title>Daftar Ujian</v-toolbar-title>
    </v-toolbar>
    <v-data-table
      :headers="headers"
      :items="items"
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
        <ModalMulaiUjian :ujian="item"/>
      </template>
    </v-data-table>
  </v-card>
</template>

<script>
import store from '../../store'
import ModalMulaiUjian from "../ModalMulaiUjian";
export default {
  name: "TabelUjian",
  components: {
    ModalMulaiUjian
  },
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
    // datatable
    items: () => store.getters["daftarUjian/items"],
    page: () => store.getters["daftarUjian/page"],
    totalItems: () => store.getters["daftarUjian/totalItems"],
    options: {
      get: () => store.getters["daftarUjian/options"],
      set: (value) => store.dispatch('daftarUjian/getItems', value)
    }
  },
  watch: {
    options: {
      handler() {
        this.loading = true
        store.dispatch('daftarUjian/getItems', this.page)
        .then(() => {
          this.loading = false
        })
      },

      // update() {
      //   console.log('update')
      //   this.loading = true
      //   store.dispatch('daftarUjian/getItems', this.page)
      //   .then(() => {
      //     console.log('update')
      //     this.loading = false
      //   })
      // },

      deep: true
    }
  }
}
</script>
