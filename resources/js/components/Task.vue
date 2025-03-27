<template>
    <div class="task bg-gray-100 p-2 rounded shadow-sm">
        {{ content }}
    </div>
</template>

<script>
export default {
    name: 'Task',
    props: {
        content: {
            type: String,
            required: true,
        },
    },
};
</script>

<style scoped>
.task {
    cursor: grab;
}
</style>
