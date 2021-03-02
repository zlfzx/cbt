<template>
  <v-snackbar v-model="alert" :color="color" multi-line top>
    {{ text }}
    <v-btn dark text @click="close">
      <v-icon>mdi-close-circle</v-icon>
    </v-btn>
  </v-snackbar>
</template>

<script>
import { mapGetters, mapState, mapActions } from 'vuex'
import store from '../store'
export default {
  name: 'Alert',
  computed: {
    status: () => store.getters['alert/status'],
    color: () => store.getters['alert/color'],
    text: () => store.getters['alert/text'],
    alert: {
      get () {
        return this.status
      },
      set (value) {
        store.dispatch('alert/set', {
          status: value,
          color: 'error',
          text: 'Ok!'
        })
      }
    }
  },
  methods: {
    ...mapActions({
      setAlert: 'alert/set'
    }),
    close() {
      store.dispatch('alert/set', {
        status: false
      })
    }
  },
}
</script>
