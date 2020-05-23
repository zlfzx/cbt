<template>
  <v-app id="inspire">
    <v-content>
      <v-container
        class="fill-height blue"
        dark
        fluid
      >
        <v-row
          align="center"
          justify="center"
        >
          <v-col
            cols="12"
            sm="8"
            md="4"
            lg="3"
          >
            <v-card class="elevation-12 pa-5">
              <div align="center" justify="center">
                <v-img src="/dist/img/caps-lock.svg" width="100px" contain></v-img>
              </div>
              <!-- <h1 class="display-1 text-center grey--text">LOGIN CBT</h1> -->
              <v-card-text>
                <v-form ref="form" v-model="valid" lazy-validation>
                  <v-text-field
                    label="NIS"
                    v-model="nis"
                    prepend-icon="mdi-account"
                    type="text"
                    required
                    :rules="nisRules"
                  />

                  <v-text-field
                    id="password"
                    label="Password"
                    v-model="password"
                    prepend-icon="mdi-lock"
                    type="password"
                    required
                    :rules="passwordRules"
                  />
                </v-form>
              </v-card-text>
              <v-card-actions>
                <v-btn :disabled="!valid" @click="submit" color="yellow" block rounded>Login</v-btn>
              </v-card-actions>
            </v-card>
          </v-col>
        </v-row>
      </v-container>
    </v-content>
  </v-app>
</template>

<script>
import store from '../store'
import axios from 'axios'
export default {
  name: 'Login',
  data() {
    return {
      valid: true,
      nis: '',
      nisRules: [
        v => !!v || 'Masukkan Nis'
      ],
      password: '',
      passwordRules: [
        v => !!v || 'Masukkan Password'
      ]
    }
  },
  methods: {
    submit() {
      // console.log('login')
      if (this.$refs.form.validate()) {
        let formData = {
          'nis': this.nis,
          'password': this.password
        }
        axios.post('/api/login', formData)
        .then((response) => {
          console.log(response)
          let res = response.data
          if (res.status === 'success') {
            store.commit('SET_TOKEN', res.data.api_token)
            if(store.getters.isAuth) {
              this.$router.push('/')
            }
          }
        })
        .catch((error) => {
          let res = error.response.data
          store.commit('SET_ERRORS', res.message)
          console.log(store.state.errors)
        })
      }
    }
  }
}
</script>