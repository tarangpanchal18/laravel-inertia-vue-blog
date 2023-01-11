<script setup>
import { Link }  from '@inertiajs/inertia-vue3';

defineProps({
    data: {
        type: Object,
        default: () => ({}),
    },
    class: String
});
</script>


<template>
    <nav aria-label="Page navigation example" v-if="data.links.length > 3" :class=class>
		<ul class="inline-flex -space-x-px">
			<li v-for="(link, k) in data.links">
                <Link
                    v-bind:class="{'bg-blue-500 text-white': link.active}"
                    :class="'bg-white border border-gray-300 text-gray-500 hover:bg-gray-100 hover:text-gray-700 leading-tight py-2 px-3 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white'"
                    :key="k"
                    :href="link.url"
                    v-html="link.label"
                />
			</li>
		</ul>
	</nav>
</template>
