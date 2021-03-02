import axios from 'axios'
import store from './index'
export default {
  namespaced: true,
  state: {
    items: [],
    options: {
      page: 1,
      itemsPerPage: 10
    },
    totalItems: 0
  },
  getters: {
    items: state => state.items,
    page: state => state.options,
    totalItems: state => state.totalItems,
    options: state => state.options
  },
  mutations: {
    updateItems (state, payload) {
      state.items = payload.data
      state.options.page = payload.current_page
      state.options.itemsPerPage = parseInt(payload.per_page)
      state.totalItems = payload.total
    }
  },
  actions: {
    getItems: (context, page) => {
      // console.log(page)
      let page_number = page.page || this.state.options.page
      let itemsPerPage = page.itemsPerPage || this.state.options.itemsPerPage
      axios.get('/api/ujian', {
        params: {
          page: page_number,
          per_page: itemsPerPage
        }
      }).then((response) => {
        context.commit('updateItems', response.data.data)
      })
    }
  }
}
