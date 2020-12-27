export default {
  namespaced: true,
  state: {
    nama: '',
    nis: '',
    kelas: '',
    token: localStorage.getItem('token') || null
  },
  getters: {
    isAuth: state => {
      return state.token ?? false
    }
  },
  mutations: {
    set: (state, payload) => {
      localStorage.setItem('token', payload.token)
      state.nama = payload.nama,
      state.nis = payload.nis,
      state.kelas = payload.kelas,
      state.token = payload.token
    },
    setToken: (state, payload) => {
      localStorage.setItem('token', payload)
      state.token = payload
    },
    logout: (state, payload) => {
      localStorage.setItem('token', payload)
      state.nama = payload
      state.nis = payload
      state.kelas = payload
      state.token = payload
    }
  },
  actions: {
    set: ({commit}, payload) => {
      commit('set', payload)
    },
    setToken: ({commit}, payload) => {
      commit('setToken', payload)
    }
  }
}
