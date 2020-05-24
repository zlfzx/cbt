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
            <img src="http://cbt.local/dist/img/avatar04.png">
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
            <v-list-item-title>Home</v-list-item-title>
          </v-list-item-content>
        </v-list-item>
        
        <v-list-item link to="pengaturan">
          <v-list-item-action>
            <v-icon>mdi-settings</v-icon>
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

      <!-- <v-menu
        left
        bottom
      >
        <template v-slot:activator="{ on }">
          <v-btn icon v-on="on">
            <v-icon>mdi-dots-vertical</v-icon>
          </v-btn>
        </template>

        <v-list>
          <v-list-item
            v-for="n in 5"
            :key="n"
            @click="() => {}"
          >
            <v-list-item-title>Option {{ n }}</v-list-item-title>
          </v-list-item>
        </v-list>
      </v-menu> -->
    </v-app-bar>

    <v-content class="grey lighten-4">
      <v-container fluid>
        <router-view></router-view>
        <!-- <v-row>
          <v-col cols="12" sm="12" md="8"> -->
            <!-- Alert Ganti Password -->
            <!-- <v-alert prominent type="error">
              <v-row align="center">
                <v-col class="grow">Sebelum memulai ujian harap mengganti kata sandi terlebih dahulu.</v-col>
                <v-col class="shrink">
                  <v-btn>Ganti Kata Sandi</v-btn>
                </v-col>
              </v-row>
            </v-alert> -->
            <!-- ./ Alert Ganti Password -->
            <!-- <v-card>
              <v-toolbar dense flat color="blue" dark>
                <v-toolbar-title>Daftar Ujian</v-toolbar-title>
              </v-toolbar>
              <v-data-table
                :headers="headers"
              ></v-data-table>
            </v-card>
          </v-col>
        </v-row> -->
      </v-container>
    </v-content>
  </v-app>
</template>

<script>
  import store from '../store'
  import axios from 'axios'
  // import { mapState } from 'vuex'
  export default {
    data: () => ({
      drawer: null
    }),
    computed: {
      nama: () => store.state.auth.nama,
      nis: () => store.state.auth.nis,
      kelas: () => store.state.auth.kelas
    },
    // computed: mapState({
    //   nama: state => state.auth.nama,
    //   nis: state => state.auth.nis,
    //   kelas: state => state.auth.kelas
    // }),
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
        let token = store.state.auth.token
        axios.post('/api/logout', {}, {
          headers: {
            Authorization: 'Bearer ' + token,
            'Content-Type': 'application/json'
          }
        }).then((response) => {
          let res = response.data
          console.log(res)
          if (res.status === 'success') {
            // store.commit('SET_TOKEN', null)

            // console.log('logout')
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
