<template>
    <div id="app" class="min-h-screen bg-gray-50">
        <h1 class="text-3xl font-semibold text-center">Kanban Mini App</h1>
        <Board
            :columns="columns"
            @add-task="addTask"
            @edit-task="editTask"
            @delete-task="deleteTask"
        />
    </div>
</template>

<script>
import Board from './Board.vue'; // Ensure this path is correct

export default {
    name: 'App',
    components: {
        Board, // Register the Board component
    },
    data() {
        return {
            columns: [
                { id: 1, name: 'To Do', tasks: [] },
                { id: 2, name: 'In Progress', tasks: [] },
                { id: 3, name: 'Done', tasks: [] },
            ],
        };
    },
    methods: {
        addTask(taskContent, columnId) {
            const newTask = {
                id: Date.now(),
                content: taskContent,
            };
            const column = this.columns.find(col => col.id === columnId);
            if (column) {
                column.tasks.unshift(newTask); // Add the task to the beginning of the array
            }
        },
        editTask(taskId, newContent) {
            for (const column of this.columns) {
                const task = column.tasks.find(task => task.id === taskId);
                if (task) {
                    task.content = newContent;
                    break;
                }
            }
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
    },
};
</script>

<style>
#app {
    font-family: Avenir, Helvetica, Arial, sans-serif;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
    text-align: center;
    color: #2c3e50;
    margin-top: 60px;
}
</style>