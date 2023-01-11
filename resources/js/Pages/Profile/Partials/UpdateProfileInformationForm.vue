<script setup>
import InputError from '@/Components/Forms/TextInputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/Forms/TextInput.vue';
import { Link, useForm, usePage } from '@inertiajs/inertia-vue3';
import { ref } from 'vue';

const props = defineProps({
    mustVerifyEmail: Boolean,
    status: String,
});

const user = usePage().props.value.auth.user;

const form = useForm({
    name: user.name,
    email: user.email,
});
</script>

<template>
    <section>
        <div class="panel panel-default">
            <div class="panel-heading">Profile Information</div>
            <div class="panel-body">
                <form @submit.prevent="form.patch(route('profile.update'))" class="mt-6 space-y-6">
                    <div class="form-group">
                        <InputLabel for="name" value="Name" />
                        <TextInput
                            id="name"
                            type="text"
                            v-model="form.name"
                            required
                            autofocus
                            autocomplete="name"
                        />
                        <InputError class="mt-2" :message="form.errors.name" />
                    </div>

                    <div class="form-group">
                        <InputLabel for="email" value="Email" />
                        <TextInput
                            id="email"
                            type="email"
                            v-model="form.email"
                            required
                            autocomplete="email"
                        />
                        <InputError class="mt-2" :message="form.errors.email" />
                    </div>

                    <div class="flex items-center gap-4">
                        <PrimaryButton class="btn btn-sm btn-success" :disabled="form.processing">Update Profile</PrimaryButton>
                        <Transition enter-from-class="opacity-0" leave-to-class="opacity-0" class="transition ease-in-out">
                            <p v-if="form.recentlySuccessful" class="text-danger">Saved.</p>
                        </Transition>
                    </div>
                </form>
            </div>
        </div>
    </section>
</template>
