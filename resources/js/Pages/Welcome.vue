<script setup>
import Pagination from "@/Components/Pagination.vue";
import Navbar from "./Partials/NavbarAuthenticated.vue";
import { Head, Link, useForm } from '@inertiajs/inertia-vue3';
import BasicLayout from '@/Components/Layout/ContainerLayout.vue';

const props = defineProps({
    blogs: Object,
    auth: Object,
    search: Object
});

const form = useForm({
    q: props.search.q ?? ''
})

const filterData = () => {
    if (form.q) {
        form.get(route('homepage'));
    }
};

</script>

<template>

    <Head title="Welcome" />
    <Navbar />

    <BasicLayout>
        <div class="mx-auto px-6 py-10">
            <h2 class="text-4xl font-bold text-left text-gray-800 mb-4">Blogs List</h2>

            <div class="blog-section">
                <!-- Search Section -->
                <div class="flex items-center justify-center mb-5">
                    <form @submit.prevent="submit" id="blogForm" class="mt-6 space-y-6 w-full">
                        <div class="rounded-lg bg-gray-200 p-0">
                            <div class="flex">
                                <input type="text" v-model="form.q" class="w-full rounded-l bg-white pl-2 text-base font-semibold outline-0" placeholder="Search Blogs" id="" />
                                <input type="submit" value="Filter Blogs" class="cursor-pointer bg-blue-500 p-2 text-white font-semibold hover:bg-blue-700 transition-colors" @click="filterData()" />
                                <Link :href="route('homepage')" class="bg-blue-600 hover:bg-blue-700 p-2 rounded-tr-lg rounded-br-lg text-white font-semibold hover:bg-blue-800 transition-colors" >Reset</Link>
                            </div>
                        </div>
                    </form>
                </div>

                <!-- Blog Listing -->
                <div v-if="blogs.total">
                    <div class="flex" v-for="blog in blogs.data">
                        <div class='flex items-center mb-4 w-full'>
                            <div class="rounded-xl border p-5 shadow-md w-full bg-white">
                                <Link :href="route('blog.detail', { 'id': blog.id })" class="mb-2 cursor-pointer">
                                    <div class="mb-3 text-xl font-bold">{{ blog.title }}</div>
                                    <div class="text-sm text-neutral-600" v-html="blog.description.substring(0,1200)"></div>
                                </Link>
                                <div class="flex w-full items-center justify-between border-b pb-3 mb-3">
                                    <div class="items-center space-x-3">
                                        <div class="text-sm font-bold text-slate-400">Written by : {{ blog.user.name }}</div>
                                    </div>
                                    <!-- <div class="flex items-center space-x-8">
                                        <button class="rounded-2xl border bg-neutral-100 px-3 py-1 text-xs font-semibold">Category</button>
                                        <div class="text-xs text-neutral-500">{{ blog.created_at }}</div>
                                    </div> -->
                                </div>
                                <div>
                                    <div class="flex items-center justify-between text-slate-500">
                                        <div class="flex space-x-4 md:space-x-8">
                                            <div class="flex cursor-default items-center transition hover:text-slate-600">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="mr-1.5 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                </svg>
                                                <span>{{ blog.view }}</span>
                                            </div>
                                            <div class="flex cursor-default items-center transition hover:text-slate-600">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="mr-1.5 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z" />
                                                </svg>
                                                <span>{{ blog.comment.length }}</span>
                                            </div>
                                            <div class="flex cursor-default items-center transition">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="mr-1.5 h-5 w-5">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5m-9-6h.008v.008H12v-.008zM12 15h.008v.008H12V15zm0 2.25h.008v.008H12v-.008zM9.75 15h.008v.008H9.75V15zm0 2.25h.008v.008H9.75v-.008zM7.5 15h.008v.008H7.5V15zm0 2.25h.008v.008H7.5v-.008zm6.75-4.5h.008v.008h-.008v-.008zm0 2.25h.008v.008h-.008V15zm0 2.25h.008v.008h-.008v-.008zm2.25-4.5h.008v.008H16.5v-.008zm0 2.25h.008v.008H16.5V15z" />
                                                </svg>
                                                <span class="text-md">{{ blog.created_at }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- No Blogs Section-->
                <div class="flex flex-wrap mt-10 mb-5 " v-else>
                    <div class="w-full">
                        <div class="bg-white rounded shadow py-2">
                            <h1 class="text-xl text-gray px-6 mb-2">Whoops. ! No Blogs Found !</h1>
                        </div>
                    </div>
                </div>


                <div align="center"><Pagination :data="blogs" /></div>

            </div>
        </div>
    </BasicLayout>
</template>
