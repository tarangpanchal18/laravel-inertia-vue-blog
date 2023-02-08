<script setup>
import { useForm } from '@inertiajs/inertia-vue3';
import Swal from 'sweetalert2/dist/sweetalert2';
import TextInputError from '../Forms/TextInputError.vue';

const form = useForm({
    blog_csv: null,
});

const processUpload = () => {
    form.post(route('blog.import'), {
            onSuccess: () => {
                $("#blog-import-form").trigger("reset");
                $("#import-user-modal").hide();
                Swal.fire("Success!", " File has been imported.", "success");
            },
        });
}

</script>
<template>
    <div id="import-user-modal" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-modal md:h-full">
        <div class="flex h-screen justify-center items-center">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <button type="button" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white" data-dismiss="modal">
                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                    <span id="close-modal" class="sr-only">Close modal</span>
                </button>
                <div class="px-6 py-6 lg:px-8">
                    <h3 class="mb-4 text-xl font-medium text-gray-900 dark:text-white">Import Blogs</h3>
                    <form @submit.prevent="submit" enctype="multipart/form-data" class="space-y-6" id="blog-import-form">
                        <div>
                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Select CSV With Blog Data</label>
                            <input type="file" name="blog_csv" @input="form.blog_csv = $event.target.files[0]" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white">
                            <small><a download target="_blank" :href="'/storage/examples/sample-blogs.csv'">Download Sample CSV</a></small>
                            <progress v-if="form.progress" :value="form.progress.percentage" max="100">
                            {{ form.progress.percentage }}%
                            </progress>
                            <TextInputError class="mt-0" :message="form.errors.blog_csv" />
                        </div>
                        <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" @click="processUpload">Procced</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>
