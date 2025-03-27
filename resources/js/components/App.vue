<template>
    <div id="app" class="min-h-screen bg-gray-50">
        <h1 class="text-3xl font-semibold text-center">Kanban Mini App</h1>

        <router-view></router-view>
    </div>
</template>

<script>
import { createRouter, createWebHistory } from 'vue-router';
import Board from './Board.vue'; // Assuming you will create this component

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

export default {
    name: 'App',
    router // Add the router to the component
}
</script>
