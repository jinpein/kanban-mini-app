<template>
    <div
        class="column bg-white shadow-md rounded p-4"
        @dragover.prevent
        @drop="handleDrop"
    >
        <h2 class="text-xl font-bold mb-4">{{ title }}</h2>
        <ul>
            <Task
                v-for="task in localTasks"
                :key="task.id"
                :task="task"
                :users="users"
                draggable="true"
                @dragstart="handleDragStart(task)"
                @edit-task="editTask"
                @delete-task="deleteTask"
                @assign-user="assignUser"
            />
        </ul>
        <button
            class="mt-4 bg-blue-500 text-white px-4 py-2 rounded"
            @click="openAddTaskModal"
        >
            Add Task
        </button>

        <!-- Modal for adding a task -->
        <div v-if="isModalOpen" class="modal-overlay">
            <div class="modal-content">
                <textarea
                    v-model="modalContent"
                    class="w-full h-40 p-2 border rounded"
                    placeholder="Enter task content..."
                ></textarea>
                <div class="flex justify-end gap-2 mt-4">
                    <button
                        class="bg-blue-500 text-white px-4 py-2 rounded"
                        @click="saveNewTask"
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
        users: {
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
            isModalOpen: false,
            modalContent: '',
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
        openAddTaskModal() {
            this.modalContent = '';
            this.isModalOpen = true;
        },
        saveNewTask() {
            if (this.modalContent.trim()) {
                const newTask = {
                    id: Date.now(),
                    content: this.modalContent,
                    timestamp: new Date().toLocaleString(),
                    status: 'Added',
                    user: null,
                    history: [`Task created with content: "${this.modalContent}"`],
                };
                this.localTasks.push(newTask);
                this.$emit('add-task', this.modalContent, this.$props.title);
                this.closeModal();
            }
        },
        closeModal() {
            this.isModalOpen = false;
        },
        editTask(taskId, newContent) {
            const task = this.localTasks.find(task => task.id === taskId);
            if (task) {
                task.content = newContent;
                task.timestamp = new Date().toLocaleString();
                task.status = 'Modified';
            }
            this.$emit('edit-task', taskId, newContent);
        },
        deleteTask(taskId) {
            this.localTasks = this.localTasks.filter(task => task.id !== taskId);
            this.$emit('delete-task', taskId);
        },
        handleDragStart(task) {
            event.dataTransfer.setData('task', JSON.stringify(task));
        },
        handleDrop(event) {
            const task = JSON.parse(event.dataTransfer.getData('task'));
            const confirmTransfer = confirm(
                `Are you sure you want to move this task to the "${this.title}" column?`
            );
            if (confirmTransfer) {
                this.localTasks.push(task);
                this.$emit('move-task', task.id, this.title); // Notify the parent to move the task
            }
        },
    },
};
</script>