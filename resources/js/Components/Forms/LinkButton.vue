<script setup>
import { Link } from '@inertiajs/inertia-vue3';

const props = defineProps({
    href: { type: String, default: ''},
    title: { type: String, default: "" },
});
</script>

<template>
    <Link
        :href="href"
        :title="title"
    >
        <slot />
    </Link>
</template>
