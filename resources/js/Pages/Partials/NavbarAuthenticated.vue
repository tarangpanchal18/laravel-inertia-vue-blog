<script setup>
import { Link } from '@inertiajs/inertia-vue3';

</script>
<template>
    <nav class="font-sans flex flex-col text-center sm:flex-row sm:text-left sm:justify-between py-4 px-6 bg-white shadow sm:items-baseline w-full">
        <div class="mb-2 sm:mb-0">
            <Link class="text-2xl no-underline text-grey-darkest hover:text-blue-dark" :href="'/'">Vue Interia</Link>
            <Link v-if="$page.props.auth.user" :href="route('dashboard')"  class="ml-5 mr-1.5">Dashboard</Link>
            <Link v-if="$page.props.auth.user" :href="route('blog.index')" class="m-1.5">My Blogs</Link>
            <Link v-if="$page.props.auth.user" :href="route('user.index')" class="m-1.5">All Users</Link>
        </div>
        <div>
            <Link v-if="!$page.props.auth.user" :href="route('login')" class="text-lg no-underline text-grey-darkest hover:text-blue-dark ml-2">Log in</Link>
            <Link v-if="!$page.props.auth.user" :href="route('register')" class="text-lg no-underline text-grey-darkest hover:text-blue-dark ml-2">Register</Link>
            <Link v-if="$page.props.auth.user" :href="route('profile.edit')" class="text-lg no-underline text-grey-darkest hover:text-blue-dark ml-2">Hi {{ $page.props.auth.user.name }}</Link>
            <Link as="button" method="post" v-if="$page.props.auth.user" :href="route('logout')" class="text-lg no-underline text-grey-darkest hover:text-blue-dark ml-2">Log Out</Link>
        </div>
    </nav>
</template>
