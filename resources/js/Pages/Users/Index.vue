<script setup>
import Pagination from '@/Components/Pagination.vue';
import { Head } from '@inertiajs/inertia-vue3';
import { Link } from '@inertiajs/inertia-vue3'
import NavbarVue from '../Partials/NavbarAuthenticated.vue';
import ContainerLayout from '@/Components/Layout/ContainerLayout.vue';
import TableLayout from '@/Components/Layout/TableLayout.vue';
import LinkButton from '@/Components/Forms/LinkButton.vue';
import Breadcrumb from '@/Components/Layout/Breadcrumb.vue';
defineProps({
    usersList: Object,
});
</script>

<template>
    <Head title="Users list" />

    <NavbarVue />
    <Breadcrumb :routelink="['dashboard','user.index']" :text="['Dashboard','All User']"></Breadcrumb>
    <ContainerLayout>

        <div class="container">
            <TableLayout
                :buttonLink="''"
                :tableTitle="'Users List'"
                :tableHeads="['Name', 'Email', 'Created At', 'Action']"
            >
                <tbody v-if="usersList.data.length!=0">
                    <tr v-for="user in usersList.data">
                        <th class="px-6 bg-slate-100 align-middle border border-solid py-3 text-sm text-center">{{ user.name }}</th>
                        <td class="px-6 bg-slate-100 align-middle border border-solid py-3 text-sm text-center">{{ user.email }}</td>
                        <td class="px-6 bg-slate-100 align-middle border border-solid py-3 text-sm text-center">{{ user.created_at }}</td>
                        <td class="px-6 bg-slate-100 align-middle border border-solid py-3 text-sm text-center">
                            <LinkButton class="border border-teal-500 bg-teal-500 text-white rounded-md px-3 py-1 mt-4 transition duration-500 ease select-none hover:bg-teal-600 focus:outline-none focus:shadow-outline mr-4"  :variant="'success'" :href="route('user.edit', { 'id' : user.id})">Edit</LinkButton>
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
            <Pagination :class="'content-center'" :data="usersList" />
        </div>
    </ContainerLayout>
</template>
