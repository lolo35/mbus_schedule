import { createRouter, createWebHashHistory } from 'vue-router'
import Home from '../views/Home.vue'

const routes = [
  {
    path: '/',
    name: 'Home',
    component: Home
  },
  {
    path: '/login',
    name: 'login',
    component: () => import('../views/Login.vue'),
  },
  {
    path: '/createuser',
    name: 'createuser',
    component: () => import('../views/CreateUser.vue'),
  },
  {
    path: '/feedback',
    name: "Feedback",
    component: () => import('../views/Feedback.vue'),
  },
  {
    path: "/favorites",
    name: "Favorites",
    component: () => import('../views/Favorites.vue'),
  },
  {
    path: "/transportPlan",
    name: "TransportPlan",
    component: () => import('../views/TransportPlan.vue'),
  },
  {
    path: "/transportRules",
    name: "TransportRules",
    component: () => import('../views/TransportRules.vue'),
  },
  {
    path: "/contact",
    name: "Contact",
    component: () => import('../views/Contact.vue')
  },
  {
    path: "/station",
    name: "Station",
    props: route => ({query: route.query.route_id, route_name: route.query.name, route_path: route.query.route}),
    component: () => import('../views/Station.vue'),
  }
]

const router = createRouter({
  history: createWebHashHistory(),
  routes
})

export default router
