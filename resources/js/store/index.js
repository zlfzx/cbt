import Vue from 'vue'
import Vuex from 'vuex'
import VuexPersistence from 'vuex-persist'

// import module
import auth from './auth'
import alert from './alert'
import daftarUjian from './daftarUjian'
import ujian from "./ujian";

const vuexPersist = new VuexPersistence({
  key: 'my-app',
  storage: localStorage
})

Vue.use(Vuex)

export default new Vuex.Store({
  plugins: [vuexPersist.plugin],
  modules: {
    auth,
    alert,
    daftarUjian,
    ujian
  },
  state: {
    check_password: true,
    errors: null
  },
  mutations: {
    SET_CHECK_PASSWORD (state, payload) {
      state.check_password = payload
    },
    SET_ERRORS(state, payload) {
      state.errors = payload
    },
    CLEAR_ERRORS(state, payload) {
      state.errors = null
    }
  },
  actions: {
    coba: ({commit}, payload) => {
      commit('SET_ERRORS', payload)
    }
  }
})
