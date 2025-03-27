<template>
    <div class="board grid gap-4 p-4">
        <Column
            v-for="column in columns"
            :key="column.id"
            :title="column.name"
            :tasks="column.tasks"
            @add-task="addTask"
            @edit-task="editTask"
            @delete-task="deleteTask"
        />
    </div>
</template>

<script>
import Column from './Column.vue';

export default {
    name: 'Board',
    props: {
        columns: {
            type: Array,
            required: true,
        },
    },
    components: {
        Column,
    },
    methods: {
        addTask(taskContent, columnId) {
            this.$emit('add-task', taskContent, columnId);
        },
        editTask(taskId, newContent) {
            this.$emit('edit-task', taskId, newContent);
        },
        deleteTask(taskId) {
            this.$emit('delete-task', taskId);
        },
    },
};
</script>

<style>
.board {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 1rem;
}
</style>