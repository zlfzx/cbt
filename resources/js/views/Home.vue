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
            <img src="http://cbt.local/assets/img/profile.jpg">
          </v-list-item-avatar>

          <v-list-item-content>
            <v-list-item-title>Muhammad Zulfi Izzulhaq</v-list-item-title>
            <v-list-item-subtitle>Web Developer</v-list-item-subtitle>
          </v-list-item-content>
        </v-list-item>
        <v-list-item>
          <v-btn to="/login" small color="red" block rounded>LOGOUT</v-btn>
        </v-list-item>

        <v-divider></v-divider>
        
        <v-list-item link>
          <v-list-item-action>
            <v-icon>mdi-home</v-icon>
          </v-list-item-action>
          <v-list-item-content>
            <v-list-item-title>Home</v-list-item-title>
          </v-list-item-content>
        </v-list-item>
        
        <v-list-item link>
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
        <v-row>
          <v-col cols="12" sm="12" md="8">
            <v-card>
              <v-toolbar dense flat color="blue" dark>
                <v-toolbar-title>Daftar Ujian</v-toolbar-title>
              </v-toolbar>
              <v-data-table
                :headers="headers"
              ></v-data-table>
            </v-card>
          </v-col>
        </v-row>
      </v-container>
    </v-content>
  </v-app>
</template>

<script>
  export default {
    props: {
      source: String,
    },
    data: () => ({
      drawer: null,
      headers: [
        {text: 'Nama Ujian', align: 'center'},
        {text: 'Mata Pelajaran', align: 'center'},
        {text: 'Waktu', align: 'center'},
        {text: 'Jumlah Soal', align: 'center'},
        {text: 'Status', align: 'center'}
      ]
    }),
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
      }
    }
  }
</script>
