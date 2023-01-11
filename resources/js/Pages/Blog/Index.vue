<script setup>
import Swal from "sweetalert2";
import { Head } from '@inertiajs/inertia-vue3';
import { Link } from '@inertiajs/inertia-vue3'
import Button from "../../Components/Button.vue";
import Pagination from "@/Components/Pagination.vue";
import BasicLayout from '@/Components/Layout/ContainerLayout.vue';
import TableLayout from '@/Components/Layout/TableLayout.vue';
import NavbarVue from '../Partials/NavbarAuthenticated.vue';
import LinkButton from "@/Components/Forms/LinkButton.vue";
import AlertMessage from '@/Components/Layout/AlertMessage.vue';
import Breadcrumb from "@/Components/Layout/Breadcrumb.vue";
import { Inertia } from "@inertiajs/inertia";

defineProps({
    blogList: Object,
    default: {}
});

const remove = (blogData) => {
  Swal.fire({
    title: "Are you sure?",
    html: `You want to delete Following Blog<br><strong>${blogData.title}</strong>`,
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#34c38f",
    cancelButtonColor: "#f46a6a",
    confirmButtonText: "Delete",
  }).then(async (result) => {
    if (result.value) {
        Inertia.delete(route('blog.destroy', blogData.id))
    }
  });
};
</script>

<template>
    <Head title="Blog List" />

    <NavbarVue />
    <Breadcrumb :routelink="['dashboard','blog.index']" :text="['Dashboard','My Blogs']"></Breadcrumb>
    <BasicLayout>
        <div class="container">
            <AlertMessage></AlertMessage>
            <TableLayout
                :tableTitle="'My Blogs'"
                :tableHeads="['#', 'Title', 'Created At', 'Status', 'Action',]"
                :buttonLink="route('blog.create')"
            >
                <tbody v-if="blogList.data.length!=0">
                    <tr v-for="(blog, index) in blogList.data">
                        <th class="px-6 bg-slate-100 align-middle border border-solid py-3 text-sm text-center">{{ index+1 }}</th>
                        <td class="px-6 bg-slate-100 align-middle border border-solid py-3 text-sm text-center">{{ blog.title }}</td>
                        <td class="px-6 bg-slate-100 align-middle border border-solid py-3 text-sm text-center">{{ blog.created_at }}</td>
                        <td class="px-6 bg-slate-100 align-middle border border-solid py-3 text-sm text-center">
                            <span v-if="blog.status == 'Active'" class="inline-flex items-center justify-center w-14 h-2 p-3 text-sm font-medium text-green-600 bg-green-200 rounded-full dark:bg-green-900 dark:text-green-200">{{ blog.status }}</span>
                            <span v-if="blog.status == 'InActive'" class="inline-flex items-center justify-center w-18 h-2 p-3 text-sm font-medium text-red-600 bg-red-200 rounded-full dark:bg-red-900 dark:text-red-200">{{ blog.status }}</span>
                        </td>
                        <td class="px-6 bg-slate-100 align-middle border border-solid py-3 text-sm text-center">
                            <LinkButton class="border border-teal-500 bg-teal-500 text-white rounded-md px-3 py-1 mt-4 transition duration-500 ease select-none hover:bg-teal-600 focus:outline-none focus:shadow-outline mr-4" :variant="'success'" :href="route('blog.edit', { 'id' : blog.id})">Edit</LinkButton>
                            <Button
                                class="border border-red-500 bg-red-500 text-white rounded-md px-3 py-1 mt-4 transition duration-500 ease select-none hover:bg-red-600 focus:outline-none focus:shadow-outline mr-4"
                                v-if="blog.id"
                                :variant="'error'"
                                @click="remove(blog)"
                                type="submit"
                                >
                                Delete
                            </Button>
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
            </TableLayout>
            <Pagination :data="blogList" />
        </div>
    </BasicLayout>

</template>
