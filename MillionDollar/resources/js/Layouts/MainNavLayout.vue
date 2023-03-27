<script setup>
import { ref } from 'vue';
import { router, Link, usePage  } from '@inertiajs/vue3';
import CreatePostForm from '@/Components/CreatePostForm.vue'

import Magnify from 'vue-material-design-icons/Magnify.vue'
import Home from 'vue-material-design-icons/Home.vue'
import HomeOutline from 'vue-material-design-icons/HomeOutline.vue'
import DotsGrid from 'vue-material-design-icons/DotsGrid.vue'
import FacebookMessenger from 'vue-material-design-icons/FacebookMessenger.vue'
import Bell from 'vue-material-design-icons/Bell.vue'
import Logout from 'vue-material-design-icons/Logout.vue'

import { useGeneralStore } from '@/stores/general';
import { storeToRefs } from 'pinia';
const useGeneral = useGeneralStore()
const { isPostForm } = storeToRefs(useGeneral)

const user = usePage().props.auth.user

let showMenu = ref(false)

const searchPost = (event) => {
    router.post('/search', {
        key : event.target.value,

    });
    // console.log(event.target.value);
}

</script>

<template>

    <div id="MainNav" class="fixed w-full flex items-center justify-between h-[56px] bg-white shadow-xl">
        <div id="NavLeft" class="flex items-center justify-start w-[260px]">
            <Link class="pl-3 " href="/">
                <img class="w-[40px]" src="/images/icons/icon-youbook.png" alt="">
            </Link>
            <div class="flex items-center justify-center bg-[#EFF2F5] p-1 rounded-full h-[40px] ml-2">
                <Magnify class="p-1" :size="22" />
                <input
                    v-model="inputValue"
                    @input="searchPost"
                    class="lg:block hidden border-none p-0 bg-[#EFF2F5] focus:ring-0"
                    type="text"
                    placeholder="Search Youbook">
            </div>
        </div>

        <div class="flex items-center justify-end w-2/12 mr-4">

            <!-- <button class="rounded-full bg-[#E3E6EA] p-2 hover:bg-gray-300 mx-1 cursor-pointer">
                <FacebookMessenger :size="23" fillColor="#050505"/>
            </button>
            <button class="rounded-full bg-[#E3E6EA] p-2 hover:bg-gray-300 mx-1 cursor-pointer">
                <Bell :size="23" fillColor="#050505"/>
            </button> -->
            <div class="flex items-center justify-center relative ">
                <button @click="showMenu = !showMenu">
                    <img class="rounded-full ml-1 min-w-[40px] max-h-[40px] cursor-pointer" :src="user.image">
                </button>
                <div
                    v-if="showMenu"
                    class="absolute bg-white shadow-xl top-10 right-0 w-[330px] rounded-lg p-1 border mt-1 z-40"
                >
                    <Link :href="route('user.show', { id: user.id })"  @click="showMenu = !showMenu">
                        <div class="flex items-center gap-3 hover:bg-gray-200 p-2 rounded-lg">
                            <img class="rounded-full ml-1 min-w-[35px] max-h-[35px] cursor-pointer" :src="user.image">
                            <span>{{user.name}}</span>
                        </div>
                    </Link>
                    <Link
                        class="w-full"
                        :href="route('logout')"
                        as="button"
                        method="post"
                    >
                        <div class="flex items-center gap-3 hover:bg-gray-200 px-2 py-2.5 rounded-lg">
                            <Logout class="pl-2" :size="30"/>
                            <span>Logout</span>
                        </div>
                    </Link>

                </div>
            </div>
        </div>
    </div>
    <slot />

    <CreatePostForm
        v-if="isPostForm"
        @showModal="isPostForm = false"
    />
</template>
