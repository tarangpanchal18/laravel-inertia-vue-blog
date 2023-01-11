<script setup>
import Checkbox from '@/Components/Checkbox.vue';
import Navbar from '../Partials/NavbarAuthenticated.vue';
import InputError from '@/Components/Forms/TextInputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/Forms/TextInput.vue';
import ContainerLayout from '@/Components/Layout/ContainerLayout.vue'
import { Head, Link, useForm } from '@inertiajs/inertia-vue3';
import Button from '@/Components/Button.vue';
import Breadcrumb from '@/Components/Layout/Breadcrumb.vue';

defineProps({
    canLogin: Boolean,
    canRegister: Boolean,
    canResetPassword: Boolean,
    status: String,
});
const form = useForm({
    email: '',
    password: '',
    remember: false,
});

const submit = () => {
    form.post(route('login'), {
        onFinish: () => form.reset('password'),
    });
};
</script>

<template>

    <Head title="Log in" />
    <Navbar :canLogin="canLogin" :canRegister="canRegister"></Navbar>
    <Breadcrumb :routelink="['login']" :text="['Login']"></Breadcrumb>
    <ContainerLayout>
        <div class="container mt-8">
            <form @submit.prevent="submit">
                <div class="mt-4">
                    <InputLabel for="email" value="Email" />
                    <TextInput
                        id="email"
                        type="email"
                        v-model="form.email"
                        autofocus
                        autocomplete="username"
                    />
                    <InputError class="text-danger" :message="form.errors.email" />
                </div>

                <div class="mt-3">
                    <InputLabel for="password" value="Password" />
                    <TextInput
                        id="password"
                        type="password"
                        v-model="form.password"
                        autocomplete="current-password"
                    />
                    <InputError class="text-danger" :message="form.errors.password" />
                </div>

                <div class="mt-4">
                    <label>
                        <Checkbox name="remember" v-model:checked="form.remember" />
                        <span> Remember me</span>
                    </label>
                </div>

                <div>
                    <Button type="submit" class="border border-teal-500 bg-teal-500 text-white rounded-md px-3 py-1 mt-4 transition duration-500 ease select-none hover:bg-teal-600 focus:outline-none focus:shadow-outline mr-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing"> Log in </Button>
                    <Link :href="route('register')"> Not Have Account Yet ?</Link>
                </div>
            </form>
        </div>
    </ContainerLayout>
</template>
