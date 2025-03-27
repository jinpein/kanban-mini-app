import { createRouter, createWebHistory } from 'vue-router';
import Board from '../components/Board.vue'; // Ensure this file exists and is correctly implemented

const routes = [
    {
        path: '/',
        name: 'Board',
        component: Board
    },
    // Add more routes here as needed
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;
