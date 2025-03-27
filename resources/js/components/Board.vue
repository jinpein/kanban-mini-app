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
            @move-task="moveTask"
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
            for (const column of this.columns) {
                const taskIndex = column.tasks.findIndex(task => task.id === taskId);
                if (taskIndex !== -1) {
                    column.tasks.splice(taskIndex, 1);
                    break;
                }
            }
        },
        moveTask(taskId, targetColumnName) {
            const sourceColumn = this.columns.find(column =>
                column.tasks.some(task => task.id === taskId)
            );
            const taskIndex = sourceColumn.tasks.findIndex(task => task.id === taskId);
            const [task] = sourceColumn.tasks.splice(taskIndex, 1);

            const targetColumn = this.columns.find(column => column.name === targetColumnName);
            if (targetColumn) {
                targetColumn.tasks.push(task);
            }
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