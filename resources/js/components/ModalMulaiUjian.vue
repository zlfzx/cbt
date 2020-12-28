<template>
  <v-row justify="space-around">
    <v-col cols="auto">
      <v-dialog
        transition="dialog-bottom-transition"
        max-width="600"
      >
        <template v-slot:activator="{ on, attrs }">
          <v-btn
            small
            color="success"
            v-bind="attrs"
            v-on="on"
          >Mulai</v-btn>
        </template>
        <template v-slot:default="dialog">
          <v-card>
            <v-toolbar
              color="primary"
              dark
            >{{ ujian.nama }}</v-toolbar>
            <v-card-text class="pb-0">
              <v-container class="pb-0">
                <v-row>
                  <v-col cols="12">
                    <v-simple-table>
                      <template v-slot:default>
                        <tbody>
                          <tr>
                            <th>Kode Paket</th>
                            <td>{{ ujian.paket_soal.kode_paket }}</td>
                          </tr>
                          <tr>
                            <th>Nama Paket</th>
                            <td>{{ ujian.paket_soal.nama }}</td>
                          </tr>
                          <tr>
                            <th>Ketarangan Paket</th>
                            <td>{{ ujian.paket_soal.keterangan }}</td>
                          </tr>
                        <tr>
                          <th>Mata Pelajaran</th>
                          <td>{{ ujian.paket_soal.mapel.nama }}</td>
                        </tr>
                        <tr>
                          <th>Kelas</th>
                          <td>{{ ujian.paket_soal.kelas.nama }}</td>
                        </tr>
                        <tr>
                          <th>Jumlah Soal</th>
                          <td>{{ ujian.paket_soal.soal_count }} Soal</td>
                        </tr>
                        <tr>
                          <th>Waktu Ujian</th>
                          <td>{{ ujian.waktu_mulai }}</td>
                        </tr>
                        <tr>
                          <th>Durasi Ujian</th>
                          <td>{{ ujian.waktu_ujian }} Menit</td>
                        </tr>
                        <tr>
                          <th>Keterangan Ujian</th>
                          <td>{{ ujian.keterangan }}</td>
                        </tr>
                        </tbody>
                      </template>
                    </v-simple-table>
                  </v-col>

                  <v-col cols="6" offset="6">
                    <v-form
                      ref="formToken"
                      v-model="validToken"
                      lazy-validation
                    >
                      <v-text-field
                        label="Token"
                        hint="Masukkan Token Ujian"
                        type="password"
                        v-model="token"
                        :rules="[tokenRules.required]"
                        required
                      ></v-text-field>
                    </v-form>
                  </v-col>
                </v-row>
              </v-container>
            </v-card-text>
            <v-card-actions class="justify-end">
              <v-btn
                text
                @click="mulai"
              >Mulai</v-btn>
              <v-btn
                text
                color="red"
                @click="dialog.value = false"
              >Batal</v-btn>
            </v-card-actions>
          </v-card>
        </template>
      </v-dialog>
    </v-col>
  </v-row>
</template>

<script>
import axios from 'axios'
import store from '../store'
export default {
  name: "ModalMulaiUjian",
  props: [
    'ujian'
  ],
  data() {
    return {
      validToken: true,
      token: '',
      tokenRules: {
        required: v => !!v || 'Token harus diisi!'
      }
    }
  },
  methods: {
    mulai() {
      if (this.$refs.formToken.validate()) {
        axios.post('/api/ujian/cek-token', {
          id: this.ujian.id,
          token: this.token
        }).then(response => {
          if (response.data.status) {
            // lanjut ke ujian
          } else {
            store.dispatch('alert/set', {
              status: true,
              color: 'error',
              text: 'Token salah!'
            })
          }
        })
      }
    }
  }
}
</script>

<style scoped>

</style>
