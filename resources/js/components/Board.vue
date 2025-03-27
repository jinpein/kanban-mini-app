<template>
    <div class="board p-4">
        <h2 class="text-2xl font-bold mb-4">Kanban Board</h2>
        <div class="columns flex space-x-4">
            <Column
                v-for="(column, index) in columns"
                :key="index"
                :title="column.title"
                :tasks="column.tasks"
            />
        </div>
    </div>
</template>

<script>
import Column from './Column.vue';

export default {
    name: 'Board',
    components: { Column },
    data() {
        return {
            columns: [
                { title: 'To Do', tasks: ['Task 1', 'Task 2'] },
                { title: 'In Progress', tasks: ['Task 3'] },
                { title: 'Done', tasks: ['Task 4', 'Task 5'] },
            ],
        };
    },
};
</script>

<style scoped>
.board {
    background-color: #f9fafb;
    border-radius: 8px;
    padding: 16px;
}
</style>
