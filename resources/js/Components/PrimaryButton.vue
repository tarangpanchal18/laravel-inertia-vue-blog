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
        class="border border-green-500 bg-green-500 text-white rounded-md px-3 py-1 mt-3 mr-3 transition duration-500 ease select-none hover:bg-green-600 focus:outline-none focus:shadow-outline"
    >
        <slot />
    </button>
</template>
