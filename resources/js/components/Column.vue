<template>
    <div class="column bg-white shadow-md rounded p-4">
        <h3 class="text-lg font-semibold mb-2">{{ title }}</h3>
        <div class="tasks space-y-2">
            <Task v-for="(task, index) in tasks" :key="index" :content="task" />
        </div>
    </div>
</template>

<script>
import Task from './Task.vue';

export default {
    name: 'Column',
    components: { Task },
    props: {
        title: {
            type: String,
            required: true,
        },
        tasks: {
            type: Array,
            required: true,
        },
    },
};
</script>

<style scoped>
.column {
    width: 300px;
    min-height: 400px;
}
</style>
