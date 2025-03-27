<template>
    <li class="task bg-gray-100 p-2 rounded mb-2 relative">
        <div
            class="task-content"
            contenteditable="true"
            @input="updateTaskContent"
            @keydown="handleShortcuts"
        >
            {{ task.content }}
        </div>
        <div class="flex justify-end gap-2 mt-2">
            <button
                class="bg-yellow-500 text-white px-2 py-1 rounded"
                @click="promptEditTask"
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
        updateTaskContent(event) {
            const newContent = event.target.innerHTML;
            this.$emit('edit-task', this.task.id, newContent);
        },
        handleShortcuts(event) {
            if (event.ctrlKey) {
                event.preventDefault();
                const selection = window.getSelection();
                if (!selection.rangeCount) return;
                const range = selection.getRangeAt(0);
                const selectedText = range.toString();

                if (event.key === 'b') {
                    document.execCommand('bold');
                } else if (event.key === 'i') {
                    document.execCommand('italic');
                } else if (event.key === 'u') {
                    document.execCommand('underline');
                } else if (event.key === 'k') {
                    const url = prompt('Enter URL:', 'https://');
                    if (url) {
                        document.execCommand('createLink', false, url);
                    }
                }
            }
        },
        promptEditTask() {
            const newContent = prompt('Edit task content:', this.task.content);
            if (newContent) {
                this.$emit('edit-task', this.task.id, newContent);
            }
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

<style>
.task {
    list-style: none;
    position: relative;
    padding-bottom: 1.5rem; /* Add space for the timestamp and status */
}

.task-content {
    word-wrap: break-word; /* Ensure long text wraps */
    white-space: pre-wrap; /* Preserve whitespace and wrap text */
    outline: none; /* Remove default outline for contenteditable */
    border: 1px solid transparent; /* Add a border for better focus indication */
    padding: 0.5rem;
    border-radius: 4px;
}

.task-content:focus {
    border-color: #3182ce; /* Highlight border on focus */
}
</style>