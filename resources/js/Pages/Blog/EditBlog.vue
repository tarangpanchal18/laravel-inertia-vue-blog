<script setup>
import Swal from "sweetalert2";
import { onBeforeMount, ref } from 'vue';
import Editor from '@tinymce/tinymce-vue'
import Button from "../../Components/Button.vue";
import TextInput from '@/Components/Forms/TextInput.vue';
import TextInputError from '@/Components/Forms/TextInputError.vue';
import Navbar from '../Partials/NavbarAuthenticated.vue';
import { Head, useForm } from '@inertiajs/inertia-vue3';
import BasicLayout from '@/Components/Layout/ContainerLayout.vue';
import Breadcrumb from "@/Components/Layout/Breadcrumb.vue";

const pageTitle = ref("Create");
const props = defineProps({
    data: Object,
});
const form = useForm({
    id: null,
    title: null,
    description: null,
    status: null,
});

onBeforeMount(() => {
  if(props.data && props.data.id) {
    pageTitle.value = "Edit";
    Object.keys(props.data).forEach(key => {
        form[key] = props.data[key];
    });
  }
})

const save = (id = null) => {
    if (id) {
        form.put(route('blog.update', id), {
            onSuccess: () => {
                Swal.fire("Success!", " Data Updated Successfully.", "success");
            },
        });
    } else {
        form.post(route('blog.store'), {
            onSuccess: () => {
                Swal.fire("Success!", "Item Added Successfully.", "success");
            },
        });
    }
};

</script>

<template>
    <Navbar></Navbar>
    <Head title="Edit Blog" />
    <Breadcrumb
        :routelink="[
                        'dashboard',
                        'blog.index',
                        'blog.create'
                    ]"
        :text="[
                    'Dashboard',
                    'My Blogs',
                    pageTitle + ' Blog'
                ]">
    </Breadcrumb>
    <BasicLayout>
        <div class="container mt-8">
            <h3 class="text-2xl">{{pageTitle}} Blog</h3>

            <div class="row">
                <form @submit.prevent="submit" id="blogForm" class="mt-6 space-y-6">
                    <label class="block font-semibold"> Enter Blog Title </label>
                    <TextInput
                        :type="'text'"
                        :title="'Enter Blog Title'"
                        v-model="form.title"
                    />
                    <TextInputError class="mt-0" :message="form.errors.title" />

                    <label class="block font-semibold"> Enter Blog Description </label>
                    <div class="form-group">
                        <editor
                            :init="{
                                height: 300,
                            }"
                            class="form-control"
                            type="text"
                            v-model="form.description"
                            rows="4"
                            autocomplete="description"
                            api-key="611p9h2w3z9m4uu4dg4f9hji2x1z5tzc2xrh6d5bhl6dyjyp">
                            </editor>
                        <TextInputError class="mt-0" :message="form.errors.description" />
                    </div>

                    <div class="form-group">
                        <label class="col-lg-2" style="padding-left: 0px;">Status</label>
                        <div class="col-lg-10">
                            <div class="radio">
                                <label>
                                    <input type="radio" name="status" value="Active" v-model="form.status">
                                    Mark as Active
                                </label>
                            </div>
                            <div class="radio">
                                <label>
                                    <input type="radio" name="status" value="InActive" v-model="form.status">
                                    Mark as InActive
                                </label>
                            </div>
                        </div>
                        <TextInputError class="mt-0" :message="form.errors.status" />
                    </div>

                    <Button
                        class="border border-green-500 bg-green-500 text-white rounded-md px-3 py-1 mt-4 transition duration-500 ease select-none hover:bg-green-600 focus:outline-none focus:shadow-outline mr-4"
                        v-if="!form.id"
                        :variant="'success'"
                        @click="save(form.id)"
                        >
                        Create
                    </Button>
                    <Button
                        v-else
                        class="border border-green-500 bg-green-500 text-white rounded-md px-3 py-1 mt-4 transition duration-500 ease select-none hover:bg-green-600 focus:outline-none focus:shadow-outline mr-4"
                        @click="save(form.id)"
                        type="submit"
                        >
                        Update
                    </Button>
                </form>
            </div>
        </div>
    </BasicLayout>
</template>
