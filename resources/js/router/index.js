import Vue from 'vue'
import VueRouter from 'vue-router'
import store from '../store'

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
    component: () => import(/* webpackChunkName: "about" */ '../views/Home.vue'),
    meta: {
      requiresAuth: true
    },
    children: [
      {
        path: '',
        component: () => import('../views/Home/Beranda.vue')
      },
      {
        path: 'pengaturan',
        name: 'pengaturan',
        component: () => import(/* webpackChunkName: "about" */ '../views/Home/Pengaturan.vue'),
      }
    ]
  },
  {
    path: '/ujian',
    name: 'Ujian',
    component: () => import('../views/Ujian.vue'),
    meta: {
      requiresAuth: true
    }
  }
]

const router = new VueRouter({
  mode: 'history',
  base: process.env.BASE_URL,
  routes
})

router.beforeEach((to, from, next) => {
  // let auth = store.getters.isAuth
  let auth = store.getters['auth/isAuth']
  let requiresAuth = to.matched.some(record => record.meta.requiresAuth)

  if (!auth && requiresAuth) {
    next('/login')
  }
  else if (auth && !requiresAuth) {
    next('/')
  }
  else if (auth && requiresAuth) {
    next()
  }
  else {
    next()
  }
})

export default router