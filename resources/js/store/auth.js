import $axios from '../plugins/api'

const actions = {
  submit({ commit }, payload) {
    // reset localstorage ke null
    localStorage.setItem('token', null)
    // reset state token ke null
    commit('SET_TOKEN', null, { root: true })

    return new Promise((resolve, reject) => {
      // request ke server, payload dari login
      $axios.post('/login', payload)
      .then((response) => {
        let { data } = response.data
        if (data.status === 'success') {
          // set token
          localStorage.setItem('token', data.api_token)
          commit('SET_TOKEN', data.api_token, {root: true})
        } else {
          commit('SET_ERRORS', {invalid: 'Email/Password Salah'}, {root: true})
        }
        resolve(data)
      })
      .catch((error) => {
        if (error.response.status) {
          
        }
      })
    })
  }
}

export default {
  namespaced: true,
  actions
}