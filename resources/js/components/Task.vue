<template>
    <li class="task bg-gray-100 p-2 rounded mb-2">
        <p>{{ task.content }}</p>
        <div class="flex justify-end gap-2 mt-2">
            <button
                class="bg-yellow-500 text-white px-2 py-1 rounded"
                @click="promptEditTask"
            >
                Edit
            </button>
            <button
                class="bg-red-500 text-white px-2 py-1 rounded"
                @click="deleteTask"
            >
                Delete
            </button>
        </div>
    </li>
</template>

<script>
export default {
    name: 'Task',
    props: {
        task: {
            type: Object,
            required: true,
        },
    },
    methods: {
        promptEditTask() {
            const newContent = prompt('Edit task content:', this.task.content);
            if (newContent) {
                this.$emit('edit-task', this.task.id, newContent);
            }
        },
        deleteTask() {
            this.$emit('delete-task', this.task.id);
        },
    },
};
</script>

<style>
.task {
    list-style: none;
}
</style>