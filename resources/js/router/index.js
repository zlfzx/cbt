import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)

// import Login from '../views/Login'
// import Home from '../views/Home'

const routes = [
  {
    path: '/login',
    name: 'Login',
    component: () => import(/* webpackChunkName: "about" */ '../views/Login.vue')
  },
  {
    path: '/',
    name: 'Home',
    component: () => import(/* webpackChunkName: "about" */ '../views/Home.vue')
  },
  {
    path: '/ujian',
    name: 'Ujian',
    component: () => import('../views/Ujian.vue')
  }
]

const router = new VueRouter({
  mode: 'history',
  base: process.env.BASE_URL,
  routes
})

export default router