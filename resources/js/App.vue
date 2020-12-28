<template>
  <div>
    <router-view></router-view>
  </div>
</template>

<script>
import axios from 'axios'
import store from './store'
export default {
  name: 'App',
  watch: {
    '$route' (to) {
      document.title = to.meta.title || 'Computer Based Test'
    }
  },
  computed: {
    token: () => store.state.auth.token
  },
  created: function () {
    axios.interceptors.request.use( (config) => {
      // auth token
      const token = this.token
      if (token) {
        config.headers['Authorization'] = `Bearer ${token}`
      }

      return config
    })
    axios.interceptors.response.use( (response) => {
      // return response berhasil
      return response
    }, (error) => {
      // return error selain error auth
      if (error.response.status !== 401) {
        return new Promise( (resolve, reject) => {
          reject(error)
        } )
      }

      // logout user jika refresh token tidak berhasil
      if (error.config.url === '/api/user/refresh') {
        // TODO: hapus token di localStorage
        store.commit('auth/logout', null)
        // TODO: push ke halaman login
        this.$router.push('/login')

        return new Promise( (resolve, reject) => {
          reject(error)
        } )
      }

      // coba ulangi request dengan token baru
      return new Promise((resolve, reject) => {
        return axios.post('/api/user/refresh', {}, {
          headers: {
            Authorization: "Bearer " + this.token,
            'Content-Type': 'application/json'
          }
        }).then((response) => {
          let res = response.data
          store.dispatch('auth/setToken', res.access_token)

          // ulangi request
          const config = error.config
          config.headers['Authorization'] = `Bearer ${res.access_token}`

          return new Promise((resolve, reject) => {
            axios.request(config).then(response => {
              console.log('berhasil request kembali')
              resolve(response)
            }).catch((error) => {
              reject(error)
            })
          })
        }).catch((error) => {
          reject(error)
        })
      })

    } )
  }
}
</script>

<style>
  html {
    overflow-y: auto;
  }
  .w-100 {
    width: 100%;
  }
</style>
