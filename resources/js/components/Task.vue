<template>
    <li
        class="task bg-gray-100 p-2 rounded-full mb-2 shadow cursor-move"
        draggable="true"
        @dragstart="handleDragStart"
    >
        <div class="task-content" v-html="formattedContent"></div>
        <div class="flex justify-end gap-2 mt-2">
            <button
                class="bg-yellow-500 text-white px-2 py-1 rounded"
                @click="openModal"
            >
                Edit
            </button>
            <button
                class="bg-red-500 text-white px-2 py-1 rounded"
                @click="confirmDeleteTask"
            >
                Delete
            </button>
        </div>
        <div class="absolute bottom-0 left-0 text-xs text-gray-500">
            <p>{{ task.status }}: {{ task.timestamp }}</p>
        </div>

        <!-- Modal for editing task content -->
        <div v-if="isModalOpen" class="modal-overlay">
            <div class="modal-content">
                <textarea
                    v-model="modalContent"
                    class="w-full h-40 p-2 border rounded"
                ></textarea>
                <div class="flex justify-end gap-2 mt-4">
                    <button
                        class="bg-blue-500 text-white px-4 py-2 rounded"
                        @click="saveModalContent"
                    >
                        Save
                    </button>
                    <button
                        class="bg-gray-500 text-white px-4 py-2 rounded"
                        @click="closeModal"
                    >
                        Cancel
                    </button>
                </div>
            </div>
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
    data() {
        return {
            isModalOpen: false,
            modalContent: '',
        };
    },
    computed: {
        formattedContent() {
            // Ensure links are clickable and open in a new tab
            return this.task.content.replace(
                /<a\s+(?!.*target="_blank")/g,
                '<a target="_blank" rel="noopener noreferrer" '
            );
        },
    },
    methods: {
        handleDragStart(event) {
            event.dataTransfer.setData('task', JSON.stringify(this.task));
        },
        openModal() {
            this.modalContent = this.task.content;
            this.isModalOpen = true;
        },
        closeModal() {
            this.isModalOpen = false;
        },
        saveModalContent() {
            this.$emit('edit-task', this.task.id, this.modalContent);
            this.closeModal();
        },
        confirmDeleteTask() {
            const confirmDelete = confirm('Are you sure you want to delete this task?');
            if (confirmDelete) {
                this.deleteTask();
            }
        },
        deleteTask() {
            this.$emit('delete-task', this.task.id);
        },
    },
};
</script>