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
        moveTask(taskId, targetColumnName) {
            const sourceColumn = this.columns.find(column =>
                column.tasks.some(task => task.id === taskId)
            );
            if (sourceColumn) {
                const taskIndex = sourceColumn.tasks.findIndex(task => task.id === taskId);
                const [task] = sourceColumn.tasks.splice(taskIndex, 1);

                const targetColumn = this.columns.find(column => column.name === targetColumnName);
                if (targetColumn) {
                    this.deleteTask(taskId); // Explicitly delete the task from the source column
                    targetColumn.tasks.push(task); // Add the task to the target column
                }
            }
        },
    },
};
</script>