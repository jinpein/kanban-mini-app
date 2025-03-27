<template>
    <div id="app" class="min-h-screen bg-gray-50">
        <h1 class="text-3xl font-semibold text-center">Kanban Mini App</h1>
        <router-view :columns="columns" :tasks="tasks"></router-view>
    </div>
</template>

<script>
import { createRouter, createWebHistory } from 'vue-router';
import Board from './Board.vue'; // Ensure this file exists and is correctly implemented

const routes = [
    {
        path: '/',
        name: 'Board',
        component: Board
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default {
    name: 'App',
    setup() {
        const columns = [
            { id: 1, name: 'To Do' },
            { id: 2, name: 'In Progress' },
            { id: 3, name: 'Done' }
        ];

        const tasks = [
            { id: 1, name: 'Task 1', columnId: 1 },
            { id: 2, name: 'Task 2', columnId: 1 },
            { id: 3, name: 'Task 3', columnId: 2 }
        ];

        return { columns, tasks };
    },
    created() {
        this.$router = router; // Ensure the router is properly attached to the Vue instance
    }
};
</script>
