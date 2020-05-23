import Vue from 'vue'
import Vuex from 'vuex'
import VuexPersistence from 'vuex-persist'

// import module
import alert from './alert'

const vuexPersist = new VuexPersistence({
  key: 'my-app',
  storage: localStorage
})

Vue.use(Vuex)

export default new Vuex.Store({
  plugins: [vuexPersist.plugin],
  modules: {
    alert
  },
  state: {
    token: localStorage.getItem('token') || null,
    errors: null
  },
  getters: {
    // cek state token
    isAuth: state => {
      return state.token !== 'null' && state.token !== null
    }
  },
  mutations: {
    SET_TOKEN (state, payload) {
      localStorage.setItem('token', payload)
      state.token = payload
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
