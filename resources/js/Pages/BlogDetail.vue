<script setup>
import { onMounted } from 'vue';
import { Head, Link } from '@inertiajs/inertia-vue3';
import Navbar from "./Partials/NavbarAuthenticated.vue";
import Breadcrumb from '@/Components/Layout/Breadcrumb.vue';
import BasicLayout from '@/Components/Layout/ContainerLayout.vue';
import { Inertia } from '@inertiajs/inertia';
import CommentSection from '@/Components/Layout/CommentSection.vue';

const props = defineProps({
    blogData: Object,
});

onMounted(() => {
    Inertia.post(route('blog.updateView', props.blogData.id))
})
</script>
<template>
    <Head title="Welcome" />
    <Navbar />
    <Breadcrumb :routelink="['blog.index']" :text="['View Blog']"></Breadcrumb>
    <div class="py-20" style="background: linear-gradient(90deg, #667eea 0%, #764ba2 100%)">
        <div class="container mx-auto px-6 text-center">
            <h2 class="text-4xl font-bold mb-2 text-white">{{ blogData.title }}</h2>
            <h3 class="text-xl mb-2 text-gray-200">Created by : {{ blogData.user.name }} | Updated On : {{ blogData.updated_at }}</h3>
            <h3 class="text-2xl mb-8 text-white">{{ blogData.view }} Views</h3>
            <Link :class="'mb-2 border border-white-500 text-white rounded px-3 py-1 mt-3 mr-3 transition duration-500 ease select-none hover:bg-white hover:text-black focus:outline-none focus:shadow-outline'" :href="route('homepage')">Back</Link>
        </div>
    </div>
    <BasicLayout>
        <div class="container mt-6">
            <div class="flex flex-wrap mb-5">
                <div class="w-full">
                    <div class="bg-white rounded py-2">
                        <div class="text-gray-800 text-base px-6">
                            <div v-html=blogData.description></div>
                            <CommentSection :commentData="blogData.comment" :blogId="blogData.id"  />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </BasicLayout>
</template>
