<script setup>
import { ref } from 'vue';
import Swal from 'sweetalert2';
import { Link, useForm } from '@inertiajs/inertia-vue3';

const success = ref(false)
const props = defineProps({
    blogId: Number,
    commentData: Object
});

const form = useForm({
    title: '',
    blog_id: props.blogId,
})
const commentForm = useForm({
    id: null,
    title: null,
    blog_id: props.blogId,
})
const closeNotification = () => {
    success.value = false;
}

const postComment = () => {
    form.post(route('comment.store'), {
        preserveScroll: true,
        onSuccess: () => {
            success.value = true;
            form.reset('title');
        },
    });
};

const editComment = (item) => {
    if (item.is_editing)
        item.is_editing = false;
    else
        item.is_editing = true
}

const removeComment = (id) => {
    if (id)
        Swal.fire({
            title: 'Are you sure ?',
            text: 'Comment will be removed. You won\'t be able to revert this',
            imageUrl: 'https://media.tenor.com/EWZCUGkCcIsAAAAd/old-man-my-computer.gif',
            imageWidth: 400,
            imageHeight: 200,
            showCancelButton: true,
            backdrop: `
                rgba(255, 51, 51, 0.4)
                left top
                no-repeat
            `
        }).then((result) => {
            if (result.isConfirmed) {
                commentForm.delete(route('comment.destroy', {id: id}), {
                    preserveScroll: true,
                    onError: () => {
                        Swal.fire('Whoops !', 'Something went wrong', 'danger');
                    }
                })
            }
        })
}

const saveEditedComment = (item) => {
    commentForm.title = props.commentData[item].title
    commentForm.id = props.commentData[item].id

    if(commentForm.title.trim().length < 3 || commentForm.title.trim().length > 50) {
        Swal.fire('Whoops !', 'Please Add Proper Comment. (Min:3 Max:50).', 'danger');
        return false;
    }

    commentForm.patch(route('comment.update', {
        id: commentForm.id,
    }), {
        preserveScroll: true,
        onSuccess: () => {
            Swal.fire('Success!', 'Comment Updated Successfully.', 'success');
        },
        onError: () => {
            Swal.fire('Whoops !', `Comment has not been updated !
                <br>
                <ul style="text-align:left;margin-top:5px">
                    <li><b>Possible Cause :</b></li>
                    <li>- Min Length(3), Max Length(50) is not followed</li>
                    <li>- Server Error</li>
                    <li>- Please Try after sometime</li>
                </ul>`,
            'danger');
        }
    });
}

</script>
<template>
    <!-- comment form -->
    <div class="mx-auto items-center justify-center rounded-md mt-10 shadow-xl p-4">
        <h2 class="text-2xl mb-2">Comment Section</h2>

        <!-- Comments Listing -->
        <div class="mb-4" v-if="commentData.length > 0">
            <div class="relative grid grid-cols-1 gap-4 p-4 mb-1 border rounded-lg bg-white" v-for="(comment, i) in commentData">
                <div class="relative flex gap-4">
                    <div class="flex flex-col w-full">
                        <div>
                            <input v-if="comment.is_editing" type="text" v-model="comment.title" required>
                            <p v-if="!comment.is_editing" class="relative text-md whitespace-nowrap truncate overflow-hidden">{{ comment.title }}</p>
                            <a class="text-gray-500 text-sm" href="#"><i class="fa-solid fa-trash"></i></a>
                        </div>
                        <span v-if="comment.is_editing" class="text-red-400 text-sm">{{ commentForm.errors.title }}</span>
                        <div>
                            <small class="text-gray-400 text-sm group cursor-pointer">By {{ comment.user.name }} on <i>{{ comment.created_at }}</i>
                            </small>
                            <div v-if="$page.props.auth.user && ($page.props.auth.user.id == comment.user_id)">
                                <span v-if="!comment.is_editing" class="cursor-pointer text-blue-400 hover:text-blue-600" @click="editComment(comment)"> Edit</span>
                                <span v-if="!comment.is_editing" class="cursor-pointer text-red-400 hover:text-red-600" @click="removeComment(comment.id)"> Delete</span>
                                <span v-if="comment.is_editing" class="cursor-pointer text-blue-400 hover:text-blue-600" @click="saveEditedComment(i)"> Save</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div v-else>
            <div class="relative grid grid-cols-1 gap-4 p-4 mb-1 rounded-lg bg-white">
                <div class="relative flex gap-4">
                    <div class="flex flex-col w-full">
                        <div class="flex flex-row justify-between">
                            <p class="relative text-md whitespace-nowrap truncate overflow-hidden">No Comments has been added yet.</p>
                            <a class="text-gray-500 text-sm" href="#"><i class="fa-solid fa-trash"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Comment Alert -->
        <div v-if="success" class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
            <strong class="font-bold">Comment Added Successfully !</strong>
            <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                <svg class="fill-current h-6 w-6 text-red-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                    <title>Close</title>
                    <path @click="closeNotification" d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/>
                </svg>
            </span>
        </div>

        <!-- Form For Add Comment Start -->
        <form class="w-full bg-white rounded-lg" @submit.prevent="submit" id="postComment" v-if="$page.props.auth.user">
            <div class="flex flex-wrap -mx-3 mb-6">
                <div class="w-full md:w-full px-3 mb-2 mt-2">
                    <input v-model="form.title" type="text" class="bg-gray-100 rounded border border-gray-400 leading-normal resize-none w-full h-10 py-2 px-3 font-medium placeholder-gray-400 focus:outline-none focus:bg-white" name="title" placeholder='Enter Your Comment...' required />
                    <span class="text-red-400 text-sm">{{ form.errors.title }}</span>
                </div>
                <input type="hidden" name="blog_id" v-model="form.blog_id">
                <div class="w-full md:w-full flex items-start md:w-full px-3">
                    <div class="flex items-start w-1/2 text-gray-700 mr-auto">
                        <input type='submit' class="bg-white text-gray-700 font-medium py-1 px-4 border border-gray-400 rounded-lg tracking-wide hover:bg-gray-100 cursor-pointer" value='Add Comment' @click="postComment()">
                    </div>
                </div>
            </div>
        </form>
        <div v-else>
            <p><Link class="text-blue-600 underline underline-offset-1" :href="route('login')">Sign in</Link> now to post Comment</p>
        </div>
    </div>
</template>
