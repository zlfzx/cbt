<template>
  <v-app id="inspire">
    <v-navigation-drawer
      v-model="drawer"
      app
      dark
    >
      <v-toolbar color="blue" dark>
        <v-toolbar-title class="ml-0 pl-3">
          <span>Laravel Vue</span>
        </v-toolbar-title>
      </v-toolbar>

      <v-list dense nav>
        <v-list-item two-line :class="miniVariant && 'px-0'">
          <v-list-item-avatar>
            <img src="https://randomuser.me/api/portraits/men/81.jpg">
          </v-list-item-avatar>

          <v-list-item-content>
            <v-list-item-title>Application</v-list-item-title>
            <v-list-item-subtitle>Subtext</v-list-item-subtitle>
          </v-list-item-content>
        </v-list-item>
        <v-list-item>
          <v-btn small color="red" block rounded>LOGOUT</v-btn>
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
            <v-icon>mdi-contact-mail</v-icon>
          </v-list-item-action>
          <v-list-item-content>
            <v-list-item-title>Contact</v-list-item-title>
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

      <v-menu
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
      </v-menu>
    </v-app-bar>

    <v-content class="grey lighten-4">
      <v-container>
        <v-row
          align="center"
          justify="center"
        >
          <v-col>
            <v-card>
              <v-card-title>Selamat Datang</v-card-title>
              <v-card-text>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Fugiat veniam ducimus reiciendis alias nisi unde saepe officiis est nihil animi ipsam, ipsa dolore esse ipsum a tempora? Tempora, consequatur voluptatum?</v-card-text>
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
