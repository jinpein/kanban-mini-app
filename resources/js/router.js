import { createRouter, createWebHistory } from 'vue-router';
import Board from './components/Board.vue'; // Assuming you will create this component

const routes = [
    {
        path: '/',
        name: 'Board',
        component: Board // This will be the main component for the Kanban board
    },
    // Additional routes can be added here
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;
