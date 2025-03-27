<template>
    <div id="app" class="min-h-screen bg-gray-50">
        <div class="flex justify-between items-center p-4">
            <h1 class="text-3xl font-semibold">Kanban Mini App</h1>
            <button
                class="bg-blue-500 text-white px-4 py-2 rounded"
                @click="addUser"
            >
                Add User
            </button>
        </div>
        <Board
            :columns="columns"
            :users="users"
            @add-task="addTask"
            @edit-task="editTask"
            @delete-task="deleteTask"
            @assign-user="assignUser"
        />
    </div>
</template>

<script>
import Board from './Board.vue';

export default {
    name: 'App',
    components: {
        Board,
    },
    data() {
        return {
            columns: [
                { id: 1, name: 'To Do', tasks: [] },
                { id: 2, name: 'In Progress', tasks: [] },
                { id: 3, name: 'Done', tasks: [] },
            ],
            users: [], // List of users
        };
    },
    methods: {
        addUser() {
            const userName = prompt('Enter the name of the new user:');
            if (userName) {
                this.users.push({ id: Date.now(), name: userName });
            }
        },
        addTask(taskContent, columnId) {
            const newTask = {
                id: Date.now(),
                content: taskContent,
                user: null, // No user assigned initially
            };
            const column = this.columns.find(col => col.id === columnId);
            if (column) {
                column.tasks.unshift(newTask);
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
        assignUser(taskId, userId) {
            for (const column of this.columns) {
                const task = column.tasks.find(task => task.id === taskId);
                if (task) {
                    task.user = this.users.find(user => user.id === userId);
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