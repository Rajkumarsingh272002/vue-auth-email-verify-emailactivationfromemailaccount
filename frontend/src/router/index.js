import { createRouter, createWebHistory } from 'vue-router'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/login',
      name: 'login',
      component: () => import('@/views/login.vue'),
    },
    {
      path: '/',
      redirect: '/login',
    },
    {
      path: '/signup',
      name: 'signup',
      component: () => import('@/views/signup.vue'),
    },

    {
      path: '/simple',
      name: 'simple',
      component: () => import('@/views/simple.vue'),
    },
  ],
})

export default router
