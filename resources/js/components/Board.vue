<template>
    <div class="board grid gap-4 p-4">
        <Column
            v-for="column in columns"
            :key="column.id"
            :title="column.name"
            :tasks="column.tasks"
            :users="users"
            @add-task="addTask"
            @edit-task="editTask"
            @delete-task="deleteTask"
            @move-task="moveTask"
            @assign-user="assignUser"
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
        users: {
            type: Array,
            required: true,
        },
    },
    components: {
        Column,
    },
    methods: {
        addTask(taskContent, columnId) {
            const column = this.columns.find(col => col.id === columnId);
            if (column) {
                column.tasks.unshift({
                    id: Date.now(),
                    content: taskContent,
                    user: null,
                    history: [`Task created with content: "${taskContent}"`],
                });
            }
        },
        editTask(taskId, newContent) {
            this.columns.forEach(column => {
                const task = column.tasks.find(task => task.id === taskId);
                if (task) {
                    task.content = newContent;
                }
            });
        },
        deleteTask(taskId) {
            this.columns.forEach(column => {
                column.tasks = column.tasks.filter(task => task.id !== taskId);
            });
        },
        moveTask(taskId, targetColumnName) {
            const sourceColumn = this.columns.find(column =>
                column.tasks.some(task => task.id === taskId)
            );
            if (sourceColumn) {
                const taskIndex = sourceColumn.tasks.findIndex(task => task.id === taskId);
                const [task] = sourceColumn.tasks.splice(taskIndex, 1);

                const targetColumn = this.columns.find(column => column.name === targetColumnName);
                if (targetColumn) {
                    task.history.push(`Moved to column: "${targetColumnName}"`);
                    targetColumn.tasks.push(task);
                }
            }
        },
        assignUser(taskId, userId) {
            this.columns.forEach(column => {
                const task = column.tasks.find(task => task.id === taskId);
                if (task) {
                    task.user = this.users.find(user => user.id === userId);
                }
            });
        },
    },
};
</script>