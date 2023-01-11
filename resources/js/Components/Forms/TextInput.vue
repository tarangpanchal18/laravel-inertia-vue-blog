<script setup>
import { onMounted, ref } from 'vue';

defineProps(['modelValue']);

defineEmits(['update:modelValue']);

const input = ref(null);
</script>

<template>
    <input
        class="border w-full h-2 px-3 py-5 hover:outline-none focus:outline-none focus:ring-indigo-500 focus:ring-1 rounded-md"
        :value="modelValue"
        @input="$emit('update:modelValue', $event.target.value)"
        ref="input"
    />
</template>
