<template>
  <h1>{{ waktu }}</h1>
</template>

<script>
import store from '../../store'
export default {
  name: "TimerSoal",
  data() {
    return {
      waktu: '00:00:00'
    }
  },
  created() {
    let waktu_selesai = store.state.ujian.waktu_selesai
    waktu_selesai = new Date(waktu_selesai).getTime()

    let x = setInterval(() => {
      // waktu sekarang
      let now = new Date().getTime()

      // selisih waktu
      let distance = waktu_selesai - now

      // perhitungan waktu menit
      let jam = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60))
      let menit = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60))
      let detik = Math.floor((distance % (1000 * 60)) / 1000)

      this.waktu = `${jam < 10 ? '0'+jam : jam}:${menit < 10 ? '0'+menit : menit}:${detik < 10 ? '0'+detik : detik}`

      if (distance < 0) {
        clearInterval(x)
        this.waktu = `Waktu Habis`
        store.dispatch('ujian/setAktif', false)
        console.log('waktu habis')
      }
    }, 1000)
  }
}
</script>
