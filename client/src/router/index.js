import { createRouter, createWebHistory } from 'vue-router'
import HomeComponent from '/src/components/HomeComponent.vue'
import AdminDashboard from '/src/components/AdminDashboard.vue'
import ClientDashboard from '/src/components/ClientDashboard.vue'

const routes = [
    {
        path: '/',
        name: 'HomeComponent',
        component: HomeComponent,
    },
    {
        path: '/admin',
        name: 'Admin',
        component: AdminDashboard,
    },
    {
        path: '/client',
        name: 'Client',
        component: ClientDashboard,
    },
]
const router = createRouter({
    history: createWebHistory(),
    routes,
})

export default router
