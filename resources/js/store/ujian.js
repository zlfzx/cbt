import axios from 'axios'
export default {
  namespaced: true,
  state: {
    aktif: false,
    id: 0,
    nama: '',
    keterangan: '',
    kode_paket: '',
    kelas: {
      id: 0,
      nama: ''
    },
    paket_soal: {
      id: 0,
      nama: '',
      mapel: {
        id: 0,
        nama: ''
      }
    },
    waktu_mulai: null,
    waktu_selesai: null,
    soal: []
  },
  getters: {
    aktif: state => state.aktif,
    id: state => state.id,
    soal: state => state.soal,
    soalAktif: state => state.soal.filter(soal => soal.aktif)[0]
  },
  mutations: {
    // set status ujian
    setUjianAktif(state, payload) {
      state.aktif = payload
    },
    // set detail ujian aktif
    setDetailUjian(state, payload) {
      state.id = payload.id
      state.nama = payload.nama
      state.keterangan = payload.keterangan
      state.kode_paket = payload.kode_paket
      state.kelas = payload.kelas
      state.paket_soal = payload.paket_soal
      state.waktu_mulai = payload.waktu_mulai
      state.waktu_selesai = payload.waktu_selesai
    },
    // set daftar soal untuk ujian
    setSoal(state, payload) {
      state.soal = payload
    },
    setSoalAktif(state, payload) {
      let currentSoal = state.soal.find(soal => soal.aktif)
      currentSoal.aktif = false

      // aktifkan soal terbaru
      let tampilSoal = state.soal.find(soal => soal.id === payload)
      tampilSoal.aktif = true
    },
    // set daftar jawaban dari soal
    setSoalJawaban(state, payload) {
      let soal = state.soal.find(soal => soal.id === payload.id)
      soal.jawaban = payload.jawaban
    },
    // set status ragu ragu soal
    setSoalragu(state, payload) {
      let soal = state.soal.find(soal => soal.id === payload.id)
      soal.ragu = payload.status
    }
  },
  actions: {
    // set ujian aktif
    setAktif: ({commit}, payload) => {
      commit('setUjianAktif', payload)
    },
    // detial ujian
    setDetail: ({commit}, payload) => {
      commit('setDetailUjian', payload)
    },
    // ambil soal ujian
    ambilSoal: ({commit}, payload) => {
      let soal = []
      let no = 1
      payload.forEach(function (item, index) {
        item.no = no++
        item.status = false
        item.ragu = false
        item.jawaban = null
        item.aktif = index === 0;
        soal.push(item)
      })
      commit('setSoal', soal)
    },
    // soal aktif / tampil soal
    setSoalAktif: ({commit}, payload) => {
      commit('setSoalAktif', payload)
    },
    // set detail jawaban dari soal
    setSoalJawaban: ({commit}, payload) => {
      console.log('jwb')
      axios.post('/api/ujian/jawaban', {
        id: payload
      }).then(response => {
        commit('setSoalJawaban', {
          id: payload,
          jawaban: response.data.data
        })
      })
    }
  }
}
