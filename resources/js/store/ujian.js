import axios from 'axios'
import store from './index'
export default {
  namespaced: true,
  state: {
    ujian: [],
    options: {
      page: 1,
      itemsPerPage: 10
    },
    totalItems: 0
  },
  getters: {
    ujian: state => state.ujian,
    page: state => state.options,
    totalItems: state => state.totalItems,
    options: state => state.options
  },
  mutations: {
    updateUjian (state, payload) {
      state.ujian = payload.data
      state.options.page = payload.current_page
      state.options.itemsPerPage = parseInt(payload.per_page)
      state.totalItems = payload.total
    }
  },
  actions: {
    getUjian: (context, page) => {
      // console.log(page)
      let page_number = page.page || this.state.options.page
      let itemsPerPage = page.itemsPerPage || this.state.options.itemsPerPage
      axios.get('/api/ujian', {
        params: {
          page: page_number,
          per_page: itemsPerPage
        },
        headers: {
          Authorization: 'Bearer ' + store.state.auth.token,
          'Content-Type': 'application/json'
        }
      })
        .then((response) => {
          context.commit('updateUjian', response.data.data)
        })
    }
  }
}
