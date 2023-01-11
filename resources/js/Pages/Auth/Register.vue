<script setup>
import Navbar from '../Partials/NavbarAuthenticated.vue';
import InputError from '@/Components/Forms/TextInputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/Forms/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/inertia-vue3';
import ContainerLayout from '@/Components/Layout/ContainerLayout.vue'
import Button from '@/Components/Button.vue';
import Breadcrumb from '@/Components/Layout/Breadcrumb.vue';

defineProps({
    canLogin: Boolean,
    canRegister: Boolean,
});

const form = useForm({
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
    terms: false,
});

const submit = () => {
    form.post(route('register'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};
</script>

<template>

    <Head title="Register" />
    <Navbar :canLogin="canLogin" :canRegister="canRegister"></Navbar>
    <Breadcrumb :routelink="['register']" :text="['Register']"></Breadcrumb>
    <ContainerLayout>
        <div class="container mt-8">
            <form @submit.prevent="submit">
                <div class="mt-3">
                    <InputLabel for="name" value="Name" />
                    <TextInput
                        id="name"
                        type="text"
                        v-model="form.name"
                        autofocus
                        autocomplete="name"
                    />
                    <InputError class="text-danger" :message="form.errors.name" />
                </div>

                <div class="mt-3">
                    <InputLabel for="email" value="Email" />
                    <TextInput
                        id="email"
                        type="email"
                        v-model="form.email"
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
                        autocomplete="new-password"
                    />
                    <InputError class="text-danger" :message="form.errors.password" />
                </div>

                <div class="mt-3">
                    <InputLabel for="password_confirmation" value="Confirm Password" />
                    <TextInput
                        id="password_confirmation"
                        type="password"
                        v-model="form.password_confirmation"
                        autocomplete="new-password"
                    />
                    <InputError class="text-danger" :message="form.errors.password_confirmation" />
                </div>

                <div>
                    <Button type="submit" :variant="'success'" class="border border-teal-500 bg-teal-500 text-white rounded-md px-3 py-1 mt-4 transition duration-500 ease select-none hover:bg-teal-600 focus:outline-none focus:shadow-outline mr-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                        Register
                    </Button>
                    <Link :class="'btn btn-sm btn-default'" :href="route('login')">  Already registered?</Link>
                </div>
            </form>
        </div>
    </ContainerLayout>
</template>
