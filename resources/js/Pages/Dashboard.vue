<script setup>
import { Head } from '@inertiajs/inertia-vue3';
import { Link } from '@inertiajs/inertia-vue3'
import NavbarVue from './Partials/NavbarAuthenticated.vue';
import BasicLayout from '@/Components/Layout/ContainerLayout.vue';
import LinkButton from '@/Components/Forms/LinkButton.vue';
import Breadcrumb from '@/Components/Layout/Breadcrumb.vue';
import Quotesblock from '@/Components/Layout/QuotesBlock.vue';

defineProps({
    totalActiveBlog: Number,
    totalInActiveBlog: Number,
    latestBlog: Object,
});
</script>

<template>
    <Head title="Dashboard" />

    <NavbarVue />
    <Breadcrumb :routelink="['dashboard']" :text="['Dashboard']"></Breadcrumb>
    <BasicLayout>
        <Quotesblock></Quotesblock>
        <div class="items-center text-gray-800">
            <!-- Cards section -->
            <div class="pt-4 w-full">
                <div class="grid grid-cols-12 gap-4">
                    <div class="col-span-12 sm:col-span-6 md:col-span-6 border drop-shadow-lg rounded-lg">
                        <div class="flex flex-row bg-white shadow-sm rounded p-4">
                        <div class="flex items-center justify-center flex-shrink-0 h-12 w-12 rounded-xl bg-blue-100 text-blue-500">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                        </div>
                        <div class="flex flex-col flex-grow ml-4">
                            <div class="text-sm text-gray-500">Total Active Blog Count</div>
                            <div class="font-bold text-lg">{{totalActiveBlog}} <small>Blogs</small></div>
                        </div>
                        </div>
                    </div>
                    <div class="col-span-12 sm:col-span-6 md:col-span-6 border drop-shadow-lg rounded-lg">
                        <div class="flex flex-row bg-white shadow-sm rounded p-4">
                        <div class="flex items-center justify-center flex-shrink-0 h-12 w-12 rounded-xl bg-green-100 text-green-500">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                        </div>
                        <div class="flex flex-col flex-grow ml-4">
                            <div class="text-sm text-gray-500">Total InActive Blog Count</div>
                            <div class="font-bold text-lg">{{ totalInActiveBlog }} <small>Blogs</small></div>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Table Section -->
            <section class="flex py-1 bg-blueGray-50">
                <div class="w-full mt-8">
                    <div class="relative flex flex-col min-w-0 break-words bg-white w-full mb-6 shadow-lg rounded border">
                        <div class="rounded-t mb-0 px-4 py-3 border-0 bg-slate-200">
                            <div class="flex flex-wrap items-center">
                                <div class="relative w-full px-4 max-w-full flex-grow flex-1">
                                    <h3 class="text-lg">My Blogs List</h3>
                                </div>
                            </div>
                        </div>
                        <div class="block w-full overflow-x-auto">
                            <table class="items-center bg-transparent w-full border-collapse">
                                <thead>
                                    <tr>
                                        <th class="px-6 bg-slate-100 align-middle py-3 text-base text-center">#</th>
                                        <th class="px-6 bg-slate-100 align-middle py-3 text-base text-center">Blog Title</th>
                                        <th class="px-6 bg-slate-100 align-middle py-3 text-base text-center">Created On</th>
                                        <th class="px-6 bg-slate-100 align-middle py-3 text-base text-center">Status</th>
                                        <th class="px-6 bg-slate-100 align-middle py-3 text-base text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody v-if="latestBlog.length!=0">
                                    <tr v-for="(blog, index) in latestBlog">
                                        <th class="px-6 bg-slate-100 align-middle border border-solid py-3 text-sm text-center">{{ index+1 }}</th>
                                        <td class="px-6 bg-slate-100 align-middle border border-solid py-3 text-sm text-center">{{ blog.title }}</td>
                                        <td class="px-6 bg-slate-100 align-middle border border-solid py-3 text-sm text-center">{{ blog.created_at }}</td>
                                        <td class="px-6 bg-slate-100 align-middle border border-solid py-3 text-sm text-center">{{ blog.status }}</td>
                                        <td class="px-6 bg-slate-100 align-middle border border-solid py-3 text-sm text-center">
                                            <LinkButton :variant="'info'" :href="route('blog.edit', {id : blog.id})" class="">Modify</LinkButton>
                                        </td>
                                    </tr>
                                </tbody>
                                <tbody v-else>
                                    <tr>
                                        <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4" colspan="5">
                                            <h3 class="">No Blog has been created yet !</h3>
                                            <h4><Link :href="route('blog.create')" class="">Create Blog Now</Link></h4>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </BasicLayout>
</template>
