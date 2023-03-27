<script setup>
defineProps({
    type: {
        type: String,
        default: 'submit',
    },
});
</script>

<template>
    <button
        :type="type"
        class="text-white bg-[#17A9FD] hover:bg-blue-400 font-bold p-2 rounded-lg"
    >
        <slot />
    </button>
</template>
