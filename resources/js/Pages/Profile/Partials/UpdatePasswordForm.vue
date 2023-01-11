<script setup>
import InputError from '@/Components/Forms/TextInputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/Forms/TextInput.vue';
import { useForm } from '@inertiajs/inertia-vue3';
import { ref } from 'vue';

const passwordInput = ref(null);
const currentPasswordInput = ref(null);

const form = useForm({
    current_password: '',
    password: '',
    password_confirmation: '',
});

const updatePassword = () => {
    form.put(route('password.update'), {
        preserveScroll: true,
        onSuccess: () => form.reset(),
        onError: () => {
            if (form.errors.password) {
                form.reset('password', 'password_confirmation');
                passwordInput.value.focus();
            }
            if (form.errors.current_password) {
                form.reset('current_password');
                currentPasswordInput.value.focus();
            }
        },
    });
};
</script>

<template>
    <section>

        <div class="panel panel-default">
            <div class="panel-heading">Update Password</div>
            <div class="panel-body">
                <form @submit.prevent="updatePassword" class="mt-6 space-y-6">
                    <div class="form-group">
                        <InputLabel for="current_password" value="Current Password" />
                        <TextInput
                            id="current_password"
                            ref="currentPasswordInput"
                            v-model="form.current_password"
                            type="password"
                            autocomplete="current-password"
                        />
                        <InputError :message="form.errors.current_password" class="mt-2" />
                    </div>

                    <div class="form-group">
                        <InputLabel for="password" value="New Password" />
                        <TextInput
                            id="password"
                            ref="passwordInput"
                            v-model="form.password"
                            type="password"
                            autocomplete="new-password"
                        />
                        <InputError :message="form.errors.password" class="mt-2" />
                    </div>

                    <div class="form-group">
                        <InputLabel for="password_confirmation" value="Confirm Password" />

                        <TextInput
                            id="password_confirmation"
                            v-model="form.password_confirmation"
                            type="password"
                            autocomplete="new-password"
                        />
                        <InputError :message="form.errors.password_confirmation" class="mt-2" />
                    </div>

                    <div class="flex items-center gap-4">
                        <PrimaryButton class="btn btn-sm btn-danger" :disabled="form.processing">Update Password</PrimaryButton>

                        <Transition enter-from-class="opacity-0" leave-to-class="opacity-0" class="transition ease-in-out">
                            <p v-if="form.recentlySuccessful" class="text-danger">Saved.</p>
                        </Transition>
                    </div>
                </form>
            </div>
        </div>

    </section>
</template>
