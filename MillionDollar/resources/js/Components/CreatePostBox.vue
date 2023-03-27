<script setup>
import { toRefs } from 'vue';
import { Link, usePage } from '@inertiajs/vue3';

import Image from 'vue-material-design-icons/Image.vue'

import { useGeneralStore } from '@/stores/general';
import { storeToRefs } from 'pinia';
const useGeneral = useGeneralStore()
const { isPostForm } = storeToRefs(useGeneral)

const props = defineProps({
    image: String,
    placeholder: String,
});
const { image, placeholder } = toRefs(props)
const user = usePage().props.auth.user

</script>

<template>
    <div id="CreatePostBox" class="w-full bg-white rounded-lg px-3 mt-4 shadow-md">
        <div class="flex items-center py-3 border-b">
            <Link href="/" class="mr-2">
                <img class="rounded-full ml-1 min-w-[36px] max-w-[36px]" :src="image">
            </Link>
            <div @click="isPostForm = true"
                class="flex items-center justify-start bg-[#EFF2F5] p-2 rounded-full w-full cursor-pointer"
            >
                <div class="pl-2">{{ placeholder }}</div>
            </div>
        </div>

        <div class="py-3 border-b">
            <button @click="isPostForm = true" class="flex items-center justify-start p-1 hover:bg-[#F2F2F2] w-full rounded-lg mx-1 cursor-pointer">
                <Image :size="30" fillColor="#43BE62"/>
                <div class="text-[#6F7275]">Photo</div>
            </button>
        </div>
    </div>
</template>
