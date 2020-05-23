import Vue from 'vue'
import Vuex from 'vuex'

// import module auth
// import auth from './auth'

Vue.use(Vuex)

export default new Vuex.Store({
  // modules: {
  //   auth
  // },
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
  }
})
