<template>
    <div class="column bg-white shadow-md rounded p-4">
        <h2 class="text-xl font-bold mb-4">{{ title }}</h2>
        <ul>
            <Task
                v-for="task in localTasks"
                :key="task.id"
                :task="task"
                @edit-task="editTask"
                @delete-task="deleteTask"
            />
        </ul>
        <button
            class="mt-4 bg-blue-500 text-white px-4 py-2 rounded"
            @click="promptAddTask"
        >
            Add Task
        </button>
    </div>
</template>

<script>
import Task from './Task.vue';

export default {
    name: 'Column',
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
    components: {
        Task,
    },
    data() {
        return {
            localTasks: [...this.tasks],
        };
    },
    watch: {
        tasks: {
            immediate: true,
            handler(newTasks) {
                this.localTasks = [...newTasks];
            },
        },
    },
    methods: {
        promptAddTask() {
            const taskContent = prompt('Enter task content:');
            if (taskContent) {
                const newTask = { id: Date.now(), content: taskContent };
                this.localTasks.push(newTask);
                this.$emit('add-task', taskContent, this.$props.title);
            }
        },
        editTask(taskId, newContent) {
            this.$emit('edit-task', taskId, newContent);
        },
        deleteTask(taskId) {
            this.localTasks = this.localTasks.filter(task => task.id !== taskId);
            this.$emit('delete-task', taskId);
        },
    },
};
</script>

<style>
.column {
    min-height: 300px;
}
</style>