<template>
  <div class="mx-3">
    <v-card-text>
      <!-- <v-img src="https://picsum.photos/seed/picsum/300/200" width="500"></v-img>-->
      <!-- <audio src="/dummy/audio.mp3" controls></audio>-->
      <!-- <video src="/dummy/video.mp4" class="w-100" controls></video>-->
      <!-- Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptas, officiis repellendus dolor natus quibusdam est voluptatum tempore quidem labore quaerat veniam alias reprehenderit a in sapiente ad magni quam numquam dolorum tempora fugit officia nam quod! Perferendis eaque similique, provident fuga dolor distinctio, modi mollitia tenetur voluptatem, aliquam ratione minima.-->
      <div v-html="itemSoal.soal"></div>
    </v-card-text>
  </div>
</template>

<script>
import store from '../../store'
export default {
  name: "TampilSoal",
  computed: {
    itemSoal: () => store.getters['ujian/soalAktif']
  }
}
</script>
