<script setup>
import MainNavLayout from '@/Layouts/MainNavLayout.vue';
import { Head, usePage, Link } from '@inertiajs/vue3';
import CreatePostBox from '@/Components/CreatePostBox.vue';
import CreatePostForm from '@/Components/CreatePostForm.vue';
import Post from '@/Components/Post.vue';

import Magnify from 'vue-material-design-icons/Magnify.vue'
import Home from 'vue-material-design-icons/Home.vue'
import HomeOutline from 'vue-material-design-icons/HomeOutline.vue'
import DotsGrid from 'vue-material-design-icons/DotsGrid.vue'
import FacebookMessenger from 'vue-material-design-icons/FacebookMessenger.vue'
import Bell from 'vue-material-design-icons/Bell.vue'
import Logout from 'vue-material-design-icons/Logout.vue'

const user = usePage().props.auth.user

const props = defineProps({
    categories: Object,
    posts:Object,
    result:Object,
    likecom:Object
})

</script>

<template>
    <Head title="Posts"/>
    <MainNavLayout>
        <div class="w-full pt-12 ">
            <div class=" grid grid-rows-3 grid-flow-col w-full max-w-[1600px]  h-[calc(100%-50px)] mx-auto px-4 bg-[#F1F2F5]">
                <!-- left -->
                <div id="LeftSection" class="xl:w-[300px] lg:block hidden">
                    <div class="pt-4 max-w-[320px] pr-4">
                        <div class="font-semibold">Category</div>
                        <Link
                            v-for="cat in categories"
                            href="/"
                            class="flex items-center justify-start w-full cursor-pointer hover:bg-[#E5E6E9] p-2 rounded-md"
                            >
                            <div class="text-[15px] text-gray-800 font-extrabold pl-3">{{cat.title}}</div>
                        </Link>

                    </div>
                </div>

                <!-- post -->
                <div id="PostsSection" class="row-span-6 max-w-[500px] lg:mx-0 mx-auto overflow-auto ">
                    <CreatePostForm
                        :categories=categories
                        :likecom=likecom
                    />
                    <!-- <CreatePostBox
                        image="https://ps.w.org/user-avatar-reloaded/assets/icon-256x256.png?rev=2540745"
                        placeholder="What's on your mind?"
                    /> -->

                    <div>
                        <div v-if="result" v-for="res in result.data" :key="res">
                            <Post :user="res.user" :post="res" :comments="res.comments" :likes="res.likes" />
                        </div>
                        <div v-else v-for="post in posts.data" :key="post">
                            <Post :user="post.user" :post="post" :comments="post.comments" :likes="post.likes" />
                        </div>
                    </div>


                </div>

                <div id="PostsSection" class="pl-4 md:block h-[100vh-] hidden">
                    <div class="max-w-[340px] min-w-[250px] mx-auto pt-4">
                        <!-- <div class="font-semibold">Contacts</div> -->
                        <!-- <div class="h-[calc(100vh-100px)] overflow-auto pt-2">
                            <div class="flex items-center justify-start cursor-pointer hover:bg-[#E5E6E9] py-2 rounded-md">
                                <img class="rounded-full ml-1 min-w-[38px] max-h-[38px]" src="https://ps.w.org/user-avatar-reloaded/assets/icon-256x256.png?rev=2540745" alt="">
                                <div class="ml-3 font-extrabold">Ahmed bourra</div>
                            </div>

                            <div class="flex items-center justify-start cursor-pointer hover:bg-[#E5E6E9] py-2 rounded-md">
                                <img class="rounded-full ml-1 min-w-[38px] max-h-[38px]" src="https://ps.w.org/user-avatar-reloaded/assets/icon-256x256.png?rev=2540745" alt="">
                                <div class="ml-3 font-extrabold">Ahmed bourra</div>
                            </div>

                            <div class="flex items-center justify-start cursor-pointer hover:bg-[#E5E6E9] py-2 rounded-md">
                                <img class="rounded-full ml-1 min-w-[38px] max-h-[38px]" src="https://ps.w.org/user-avatar-reloaded/assets/icon-256x256.png?rev=2540745" alt="">
                                <div class="ml-3 font-extrabold">Ahmed bourra</div>
                            </div>

                            <div class="flex items-center justify-start cursor-pointer hover:bg-[#E5E6E9] py-2 rounded-md">
                                <img class="rounded-full ml-1 min-w-[38px] max-h-[38px]" src="https://ps.w.org/user-avatar-reloaded/assets/icon-256x256.png?rev=2540745" alt="">
                                <div class="ml-3 font-extrabold">Ahmed bourra</div>
                            </div>

                            <div class="flex items-center justify-start cursor-pointer hover:bg-[#E5E6E9] py-2 rounded-md">
                                <img class="rounded-full ml-1 min-w-[38px] max-h-[38px]" src="https://ps.w.org/user-avatar-reloaded/assets/icon-256x256.png?rev=2540745" alt="">
                                <div class="ml-3 font-extrabold">Ahmed bourra</div>
                            </div>

                            <div class="flex items-center justify-start cursor-pointer hover:bg-[#E5E6E9] py-2 rounded-md">
                                <img class="rounded-full ml-1 min-w-[38px] max-h-[38px]" src="https://ps.w.org/user-avatar-reloaded/assets/icon-256x256.png?rev=2540745" alt="">
                                <div class="ml-3 font-extrabold">Ahmed bourra</div>
                            </div>

                            <div class="flex items-center justify-start cursor-pointer hover:bg-[#E5E6E9] py-2 rounded-md">
                                <img class="rounded-full ml-1 min-w-[38px] max-h-[38px]" src="https://ps.w.org/user-avatar-reloaded/assets/icon-256x256.png?rev=2540745" alt="">
                                <div class="ml-3 font-extrabold">Ahmed bourra</div>
                            </div>

                            <div class="flex items-center justify-start cursor-pointer hover:bg-[#E5E6E9] py-2 rounded-md">
                                <img class="rounded-full ml-1 min-w-[38px] max-h-[38px]" src="https://ps.w.org/user-avatar-reloaded/assets/icon-256x256.png?rev=2540745" alt="">
                                <div class="ml-3 font-extrabold">Ahmed bourra</div>
                            </div>

                            <div class="flex items-center justify-start cursor-pointer hover:bg-[#E5E6E9] py-2 rounded-md">
                                <img class="rounded-full ml-1 min-w-[38px] max-h-[38px]" src="https://ps.w.org/user-avatar-reloaded/assets/icon-256x256.png?rev=2540745" alt="">
                                <div class="ml-3 font-extrabold">Ahmed bourra</div>
                            </div>
                            <div class="flex items-center justify-start cursor-pointer hover:bg-[#E5E6E9] py-2 rounded-md">
                                <img class="rounded-full ml-1 min-w-[38px] max-h-[38px]" src="https://ps.w.org/user-avatar-reloaded/assets/icon-256x256.png?rev=2540745" alt="">
                                <div class="ml-3 font-extrabold">Ahmed bourra</div>
                            </div>
                        </div> -->
                    </div>
                </div>
            </div>
        </div>
    </MainNavLayout>

</template>
