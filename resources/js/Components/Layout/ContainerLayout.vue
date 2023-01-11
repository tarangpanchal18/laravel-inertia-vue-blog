<script setup>
import NProgress from 'nprogress'
import { Inertia } from '@inertiajs/inertia'

Inertia.on('start', () => NProgress.start())
Inertia.on('finish', () => NProgress.done())

</script>

<template>
    <section class="flex flex-row">
        <div class="basis-full mx-16">
            <slot />
        </div>
    </section>
</template>
