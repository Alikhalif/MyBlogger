<script setup>
import { toRefs, reactive } from 'vue';
import { Link, router } from '@inertiajs/vue3';

import AccountMultiple from 'vue-material-design-icons/AccountMultiple.vue'
import ThumbUp from 'vue-material-design-icons/ThumbUp.vue'
import Delete from 'vue-material-design-icons/Delete.vue'
import Send from 'vue-material-design-icons/Send.vue'

import { useGeneralStore } from '@/stores/general';
import { storeToRefs } from 'pinia';

const useGeneral = useGeneralStore()
const { isImageDisplay } = storeToRefs(useGeneral)
const form = reactive({ comment: null })
const props = defineProps({
    user: Object,
    post: Object,
    comments: Object,
    likes: Object,
});
const { post, user, comments, likes } = toRefs(props)
const createComment = () => {
    router.post('/comment', {
        post_id: post.value.id,
        text: form.comment
    },
    {
        preserveScroll: true,
    })
}
const deleteComment = (id) => {
    router.delete('/comment/' + id, {
        preserveScroll: true
    })
}
const deletePost = (id) => {
    router.delete('/post/' + id, {
        preserveScroll: true
    })
}
const isUser = () => {
    router.get('/user/' + user.value.id)
}

// const likePost = (id) => {
//     router.get('/like/' + id,{
//         preserveScroll: true
//     })
// }

const likePost = () => {
    router.post('/like',{
        post_id: post.value.id,
    },
    {
        preserveScroll: true
    })
    // console.log(post.value.id);
}


</script>

<template>

    <div id="Post" class="w-full bg-white rounded-lg my-4 shadow-md">
        <div class="flex items-center py-3 px-3">
            <button class="mr-2" @click="isUser">
                <img class="rounded-full ml-1 min-w-[42px] max-w-[42px]" :src="user.image">
            </button>
            <div class="flex items-center justify-between p-2 rounded-full w-full">
                <div>
                    <div class="font-extrabold text-[15px]">{{ user.name }}</div>
                    <div class="flex items-center text-[12px] text-gray-600">
                        {{post.created_at}} <AccountMultiple class="ml-1" :size="15" fillColor="#64676B"/>
                    </div>
                </div>
                <div class="flex">
                    <button
                        v-if="$page.props.auth.user.id === post.user.id"
                        class="rounded-full p-1 cursor-pointer"
                        @click="deletePost(post.id)"
                    >

                        <Delete fillColor="#64676B"/>
                    </button>
                </div>
            </div>
        </div>
        <div class="px-5 pb-2 text-[17px] font-semibold">
            {{ post.text }}
        </div>
        <img class="mx-auto " :src="'/images/'+post.image" >
        <div id="Likes" class="px-5">
            <div class="flex items-center justify-between py-3 border-b">
                <button

                    @click="likePost()"
                    class="flex">
                    <ThumbUp fillColor="#1D72E2" :size="18"/> <div class="pl-2">{{ likes.length }} Like</div>
                </button>




                <div class="text-sm text-gray-600">{{comments.length}} comments</div>
            </div>
        </div>

        <div id="Comments" class="px-3">
            <div id="CreateComment" class="flex items-center justify-between py-2">
                <div class="flex items-center w-full">
                    <Link class="mr-2" :href="route('user.show', {id:$page.props.auth.user.id})">
                        <img class="rounded-full ml-1 min-w-[36px] max-h-[36px]" :src="$page.props.auth.user.image">
                    </Link>
                    <div class="flex items-center justify-center bg-[#EFF2F5] p-2 rounded-full w-full">
                        <input
                            v-model="form.comment"
                            class="w-full mx-1 border-none p-0 text-sm bg-[#EFF2F5] placeholder-[#64676B] ring-0 focus:ring-0"
                            placeholder="Write a public comment..."
                            type="text"
                        >
                        <button
                            @click="createComment"
                            type="button"
                            class="flex items-center text-sm px-2 rounded-full bg-blue-500 hover:bg-blue-600 text-white font-bold"
                            >
                            <Send :size="20"/>
                        </button>
                    </div>
                </div>
            </div>

        </div>

        <div v-if="comments" id="Comments" class="max-h-[120px] overflow-auto pb-2 px-4">
            <div
                class=" items-center justify-between pb-2"
                v-for="comment in comments" :key="comment"
            >
                <div class="flex items-center w-full mb-1">
                    <Link class="mr-2">
                        <img class="rounded-full ml-1 min-w-[30px] max-h-[30px]" :src="comment.user.image" alt="">
                    </Link>
                    <div class="flex items-center justify-center w-full">
                        <div class="flex items-center bg-[#EFF2F5] text-xs p-2 rounded-lg w-full">
                            {{ comment.text }}
                        </div>
                        <button
                            v-if="$page.props.auth.user.id === comment.user.id"
                            @click="deleteComment(comment.id)"
                            class="rounded-full p-1 ml-2 cursor-pointer"
                            >
                            <Delete :size="18" fillColor="#64676B"/>
                        </button>
                    </div>
                </div>

            </div>

        </div>

    </div>
</template>
