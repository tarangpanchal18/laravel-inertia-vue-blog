<script setup>
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/Forms/TextInput.vue';
import InputError from '@/Components/Forms/TextInputError.vue';
import Swal from "sweetalert2";
import Button from "../../Components/Button.vue";
import Navbar from '../Partials/NavbarAuthenticated.vue';
import ContainerLayout from '@/Components/Layout/ContainerLayout.vue';
import TableLayout from '@/Components/Layout/TableLayout.vue'
// import DeleteUserForm from './Partials/DeleteUserForm.vue';
// import UpdatePasswordForm from './Partials/UpdatePasswordForm.vue';
// import UpdateProfileInformationForm from './Partials/UpdateProfileInformationForm.vue';
import { Head, Link, useForm } from '@inertiajs/inertia-vue3';

const props = defineProps({
    data: Object,
});

const form = useForm({
    id: props.data.id,
    name: props.data.name,
    email: props.data.email,
});

const save = (id = null) => {
    if (id) {
        form.put(route('user.update', id), {
            onSuccess: () => {
                Swal.fire("Success!", " Data Updated Successfully.", "success");
            },
        });
    } else {
        form.post(route('user.store'), {
            onSuccess: () => {
                Swal.fire("Success!", "Item Added Successfully.", "success");
            },
        });
    }
};

const remove = (userData) => {
  Swal.fire({
    title: "Are you sure?",
    html: `You want to delete Following User<br><strong>${userData.name}</strong>`,
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#34c38f",
    cancelButtonColor: "#f46a6a",
    confirmButtonText: "Delete",
  }).then(async (result) => {
    if (result.value) {
      await axios
        .delete(route('user.destroy', userData.id))
        .then(({ data }) => {
          if (data) {
            Swal.fire(
                "Deleted!",
                `${userData.item_name} Deleted Successfully.`,
                "success"
            );

            window.location.href = route('user.index');
          }
        })
        .catch(() => Swal.fire("Error!", "Something went wrong!!!", "error"));
    }
  });
};

</script>

<template>
    <Head title="Edit User" />
    <Navbar />
    <ContainerLayout>

        <div class="container">
            <h2>Edit User</h2>

            <div class="row">
                <form @submit.prevent="submit" id="userForm" class="mt-6 space-y-6">
                    <div class="form-group">
                        <InputLabel for="name" value="Name" />
                        <TextInput
                            id="name"
                            type="text"
                            v-model="form.name"
                            required
                            autocomplete="name"
                        />
                    </div>
                    <InputError class="mt-2" :message="form.errors.name" />

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
                    <Button
                        class="border border-green-500 bg-green-500 text-white rounded-md px-3 py-1 mt-4 transition duration-500 ease select-none hover:bg-green-600 focus:outline-none focus:shadow-outline mr-4"
                        v-if="form.id"
                        variant="success"
                        @click="save(form.id)"
                        type="submit"
                        >
                        Update
                    </Button>
                    <Link class="border border-red-500 bg-red-500 text-white rounded-md px-3 py-1 mt-4 transition duration-500 ease select-none hover:bg-red-600 focus:outline-none focus:shadow-outline mr-4" :href="route('user.index')">Cancel</Link>
                </form>
            </div>
        </div>
    </ContainerLayout>
</template>
