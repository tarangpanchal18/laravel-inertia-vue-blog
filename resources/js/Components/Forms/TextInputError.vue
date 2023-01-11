<script setup>
defineProps(['message']);
</script>

<template>
    <div v-show="message">
        <p class="italic text-red-700">
            {{ message }}
        </p>
    </div>
</template>
