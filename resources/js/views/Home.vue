<template>
  <v-app id="inspire">
    <v-navigation-drawer
      v-model="drawer"
      app
      dark
    >
      <v-toolbar color="blue" dark>
        <v-toolbar-title class="ml-0 pl-3">
          <span>Computer Based Test</span>
        </v-toolbar-title>
      </v-toolbar>

      <v-list dense nav>
        <v-list-item two-line :class="'px-0'">
          <v-list-item-avatar>
            <img src="http://cbt.local/dist/img/avatar04.png" alt="">
          </v-list-item-avatar>

          <v-list-item-content>
            <v-list-item-title>{{ nama }}</v-list-item-title>
            <v-list-item-subtitle>{{ nis }} | {{ kelas }}</v-list-item-subtitle>
          </v-list-item-content>
        </v-list-item>
        <v-list-item>
          <v-btn @click="logout" small color="red" block rounded>KELUAR <v-icon small>mdi-logout</v-icon></v-btn>
        </v-list-item>

        <v-divider></v-divider>

        <v-list-item link to="/">
          <v-list-item-action>
            <v-icon>mdi-home</v-icon>
          </v-list-item-action>
          <v-list-item-content>
            <v-list-item-title>Beranda</v-list-item-title>
          </v-list-item-content>
        </v-list-item>

        <v-list-item link to="pengaturan">
          <v-list-item-action>
            <v-icon>mdi-account-settings</v-icon>
          </v-list-item-action>
          <v-list-item-content>
            <v-list-item-title>Pengaturan</v-list-item-title>
          </v-list-item-content>
        </v-list-item>
      </v-list>
    </v-navigation-drawer>

    <v-app-bar
      app
      color="blue"
      dark
    >
      <v-app-bar-nav-icon @click.stop="drawer = !drawer" />

      <v-spacer></v-spacer>

      <v-btn icon @click="toggleFullScreen()">
        <v-icon>mdi-fullscreen</v-icon>
      </v-btn>
    </v-app-bar>

    <v-content class="grey lighten-4">
      <v-container fluid>
        <router-view></router-view>
      </v-container fluid>
    </v-content>
    <Alert></Alert>
  </v-app>
</template>

<script>
  import store from '../store'
  import axios from 'axios'
  import Alert from '../components/Alert'
  export default {
    components: {
      Alert
    },
    data: () => ({
      drawer: null,
      checkPassword: true
    }),
    computed: {
      nama: () => store.state.auth.nama,
      nis: () => store.state.auth.nis,
      kelas: () => store.state.auth.kelas,
      token: () => store.state.auth.token
    },
    // computed: mapState({
    //   nama: state => state.auth.nama,
    //   nis: state => state.auth.nis,
    //   kelas: state => state.auth.kelas
    // }),
    mounted() {
      console.log('home')
    },
    methods: {
      toggleFullScreen () {
        let doc = window.document
        let docEl = doc.documentElement

        let requestFullScreen =
          docEl.requestFullscreen || docEl.mozRequestFullScreen || docEl.webkitRequestFullScreen || docEl.msRequestFullscreen
        let cancelFullScreen =
          doc.exitFullscreen || doc.mozCancelFullScreen || doc.webkitExitFullscreen || doc.msExitFullscreen

        if (!doc.fullscreenElement && !doc.mozFullScreenElement && !doc.webkitFullscreenElement && !doc.msFullscreenElement) {
          requestFullScreen.call(docEl)
        } else {
          cancelFullScreen.call(doc)
        }
      },
      logout() {
        // let token = store.state.auth.token
        axios.post('/api/logout', {}, {
          headers: {
            Authorization: 'Bearer ' + this.token,
            'Content-Type': 'application/json'
          }
        }).then((response) => {
          let res = response.data
          console.log(res)
          if (res.status === 'success') {
            store.commit('auth/logout', null)
            if(!store.getters['auth/isAuth']) {
              store.dispatch('alert/set', {
                status: true,
                color: 'success',
                text: res.message
              })
              this.$router.push('/login')
            }
          }
        }).catch((error) => {
          console.log(error.response)
        })
      }
    }
  }
</script>
