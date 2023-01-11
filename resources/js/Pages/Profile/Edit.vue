<script setup>
import { Head } from '@inertiajs/inertia-vue3';
import NavBar from '../Partials/NavbarAuthenticated.vue';
import ContainerLayout from '@/Components/Layout/ContainerLayout.vue';
import UpdatePasswordForm from './Partials/UpdatePasswordForm.vue';
import UpdateProfileInformationForm from './Partials/UpdateProfileInformationForm.vue';
defineProps({
    mustVerifyEmail: Boolean,
    status: String,
});
</script>

<template>
    <Head title="My Profile" />
    <NavBar />
    <ContainerLayout>
        <div class="container">

            <div class="py-12">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                    <div>
                        <UpdateProfileInformationForm
                            :must-verify-email="mustVerifyEmail"
                            :status="status"
                            class="max-w-xl"
                        />
                    </div>

                    <div>
                        <UpdatePasswordForm class="max-w-xl" />
                    </div>
                </div>
            </div>
        </div>
    </ContainerLayout>
</template>
