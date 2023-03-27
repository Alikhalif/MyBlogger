<script setup>
import { Link, Head } from '@inertiajs/vue3';
import MainNavLayout from '@/Layouts/MainNavLayout.vue';
import CreatePostBox from '@/Components/CreatePostBox.vue';
import CreatePostForm from '@/Components/CreatePostForm.vue';
import Post from '@/Components/Post.vue';

import Camera from 'vue-material-design-icons/Camera.vue'
import Pen from 'vue-material-design-icons/Pen.vue'

import { useGeneralStore } from '@/stores/general';
import { storeToRefs } from 'pinia';

const useGeneral = useGeneralStore()
const { isCropperModal, isImageDisplay } = storeToRefs(useGeneral)
defineProps({ posts: Object, user: Object, categories:Object })
</script>

<template>
    <Head title="Users"/>
    <MainNavLayout>
        <div class="w-full min-h-[100vh] pb-20 bg-[#F1F2F5]">
            <div class="flex flex-col items-center pt-8 bg-white">
                <div class="mt-9">
                    <img class="rounded-full w-[125px] h-[125px] border-4 border-white "
                        :src="user.image" alt="">

                    <!-- <button
                        v-if="$page.props.auth.user.id === user.id"
                        class="absolute right-0 top-[100px] bg-gray-200 p-1.5 rounded-full right-5"
                    >
                        <Camera :size="25"/>
                    </button> -->
                </div>
                <div class="font-extrabold text-[20px] pt-1">
                    {{ user.name }}
                </div>
                <Link
                    v-if="$page.props.auth.user.id === user.id"
                    :href="route('profile.edit')"
                    class="flex justify-center my-4 bg-gray-200 hover:bg-gray-300 rounded-lg cursor-pointer"
                >
                    <button class="flex items-center px-5 py-2 font-bold">
                        <Pen class="mr-2" :size="22"/> Edit profile
                    </button>
                </Link>
            </div>


            <div class="flex items-center w-full border-t h-[50px] py-[4px] bg-white">
                <button class="w-[85px]">
                    <div
                        class="flex items-center justify-center text-[15px] h-[45px] text-blue-500 hover:bg-[#F2F2F2] w-full font-bold rounded-lg"
                    >
                        Posts
                    </div>
                </button>
            </div>

            <div id="PostsSection" class="max-w-[600px] mx-auto overflow-auto">
                <!-- <CreatePostBox
                        v-if="$page.props.auth.user.id === user.id"
                        :image="user.image"
                        :placeholder="'What\'s on your mind ' + user.name + ' ?'"
                /> -->

                <CreatePostForm
                    v-if="$page.props.auth.user.id === user.id"
                    :categories=categories
                />

                <div v-for="post in posts.data" :key="post">
                    <Post :user="post.user" :post="post" :comments="post.comments" :likes="post.likes" />
                </div>
            </div>
        </div>
    </MainNavLayout>
</template>
