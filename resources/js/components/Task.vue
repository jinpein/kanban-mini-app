<template>
    <li
        class="task"
        draggable="true"
        @dragstart="handleDragStart"
    >
        <!-- History Icon -->
        <img
            src="/public/icons/pending-tasks.png"
            alt="History"
            @click="openHistoryModal"
        />

        <div class="task-content" v-html="formattedContent"></div>
        <div class="flex">
            <div class="flex gap-2">
                <select
                    class="border rounded px-2 py-1"
                    v-model="selectedUser"
                    @change="assignUser"
                >
                    <option disabled value="">Assign User...</option>
                    <option
                        v-for="user in users"
                        :key="user.id"
                        :value="user.id"
                    >
                        {{ user.name }}
                    </option>
                </select>
                <button
                    class="bg-yellow-500 text-white"
                    @click="openModal"
                >
                    Edit
                </button>
                <button
                    class="bg-red-500 text-white"
                    @click="confirmDeleteTask"
                >
                    Delete
                </button>
            </div>
        </div>
        <div class="text-xs">
            <p v-if="task.user">Assigned to: {{ task.user.name }}</p>
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
                        class="bg-blue-500 text-white"
                        @click="saveModalContent"
                    >
                        Save
                    </button>
                    <button
                        class="bg-gray-500 text-white"
                        @click="closeModal"
                    >
                        Cancel
                    </button>
                </div>
            </div>
        </div>

        <!-- Modal for task history -->
        <div v-if="isHistoryModalOpen" class="modal-overlay">
            <div class="modal-content">
                <h3 class="text-lg font-bold mb-4">Task History</h3>
                <ul class="list-disc pl-5">
                    <li v-for="(log, index) in task.history" :key="index">
                        {{ log }}
                    </li>
                </ul>
                <div class="flex justify-end gap-2 mt-4">
                    <button
                        class="bg-gray-500 text-white"
                        @click="closeHistoryModal"
                    >
                        Close
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
        users: {
            type: Array,
            required: true,
        },
    },
    data() {
        return {
            isModalOpen: false,
            isHistoryModalOpen: false,
            modalContent: '',
            selectedUser: this.task.user ? this.task.user.id : '',
        };
    },
    computed: {
        formattedContent() {
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
        assignUser() {
            const user = this.users.find(user => user.id === this.selectedUser);
            if (user) {
                this.task.history.push(`Assigned to user: ${user.name}`);
                this.$emit('assign-user', this.task.id, this.selectedUser);
            }
        },
        openModal() {
            this.modalContent = this.task.content;
            this.isModalOpen = true;
        },
        closeModal() {
            this.isModalOpen = false;
        },
        saveModalContent() {
            if (this.modalContent !== this.task.content) {
                this.task.history.push(`Content changed to: "${this.modalContent}"`);
            }
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
        openHistoryModal() {
            this.isHistoryModalOpen = true;
        },
        closeHistoryModal() {
            this.isHistoryModalOpen = false;
        },
    },
};
</script>