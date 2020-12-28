<template>
  <v-row>
    <v-col cols="12" sm="12" md="4">
      <v-card>
        <v-card-title><v-icon>mdi-lock</v-icon> Ganti Kata Sandi</v-card-title>
        <v-divider></v-divider>
        <v-form class="pa-5">
          <v-text-field
            type="password"
            v-model="password_lama"
            label="Password Lama"
            outlined
            dense
          ></v-text-field>
          <v-text-field
            type="password"
            v-model="password_baru"
            label="Password Baru"
            outlined
            dense
          ></v-text-field>
          <v-btn color="success" @click="change_password">
            Simpan
          </v-btn>
        </v-form>
      </v-card>
    </v-col>
  </v-row>
</template>

<script>
import store from './../../store'
import axios from 'axios'
export default {
  name: 'Pengaturan',
  data() {
    return {
      password_lama: '',
      password_baru: ''
    }
  },
  computed: {
    token: () => store.state.auth.token
  },
  methods: {
    change_password() {
      if (this.password_lama !== '' && this.password_baru !== '') {
        axios.post('/api/password/change', {
          'password_lama': this.password_lama,
          'password_baru': this.password_baru
        }, {
          headers: {
            Authorization: 'Bearer ' + this.token,
            'Content-Type': 'application/json'
          }
        })
        .then((response) => {
          let res = response.data
          store.commit("SET_CHECK_PASSWORD", res.check)
          store.dispatch('alert/set', {
            status: true,
            color: 'success',
            text: res.message
          })
          this.password_lama = ''
          this.password_baru = ''
        })
        .catch((err) => {
          let res = err.response.data
          let errors = ''
          res.messages.forEach(function(e) {
            errors += e + "\n"
          })
          store.dispatch('alert/set', {
            status: true,
            color: 'error',
            text: errors
          })
        })
      } else {
        store.dispatch('alert/set', {
          status: true,
          color: 'error',
          text: 'Form harus diisi'
        })
      }
    }
  },
}
</script>
