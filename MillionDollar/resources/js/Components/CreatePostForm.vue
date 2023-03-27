<script setup>
import { ref, reactive } from 'vue'
import { router, usePage } from '@inertiajs/vue3';

import Image from 'vue-material-design-icons/Image.vue'

// import { useGeneralStore } from '@/stores/general';
// import { storeToRefs } from 'pinia';
// const useGeneral = useGeneralStore()
// const { isPostForm } = storeToRefs(useGeneral)

const emit = defineEmits(['showModal'])
const user = usePage().props.auth.user
let imageDisplay = ref('')

const selectedCategories = ref([]);

const props = defineProps({
    categories: Object
})

const form = reactive({
    text: null,
    image: null,
    category: [],
})

let error = ref(null)

const createPost = () => {
    router.post('/post', form, {
        forceFormData: true,
        preserveScroll: true,
        onError: errors => {
            errors && errors.text ? error.value = errors.text : ''
            errors && errors.image ? error.value = errors.image : ''
        },
        onSuccess: () => {
            form.text = null
            form.image = null
            form.category = null
            // imageDisplay.value = null
            emit('showModal', false)
        }
    })
}
const getUploadedImage = (e) => {
    imageDisplay.value = URL.createObjectURL(e.target.files[0])
    form.image = e.target.files[0]
}

</script>

<template>

<div id="CreatePostForm" class="w-full bg-white rounded-lg px-3 mt-4 shadow-md">
    <!-- <div class=""> -->
        <div class="bg-white w-full max-w-[600px] mx-auto ">
            <div class="flex items-center  mx-1">
                <div class="text-[22px] font-extrabold w-full text-center p-2">
                    Create Post
                </div>

            </div>

            <div class="border-t border-t-gray-300">
                <div class="p-4">
                    <div class="max-h-[450px]">
                        <textarea
                            v-model="form.text"
                            class="w-fill border-0 mt-4 focus:ring-0 text-[22px]"
                            placeholder="What's on your mind?"
                            cols="30"
                            rows="3"
                        ></textarea>

                        <!-- {{ categories }} -->
                        <div v-for="cat in categories" class="flex">
                            <div class="p-1">
                                <input
                                    v-model="form.category"
                                    type="checkbox"
                                    :value="cat.id">
                                <label for="">{{cat.title}}</label>
                            </div>
                        </div>


                        <div class="border-2 rounded-xl mt-4 shadow-sm flex items-center justify-between">
                            <div class="font-extrabold p-4">
                                Add to your post
                            </div>
                            <div class="flex items-center">
                                <label
                                    for="image"
                                    class="hover:bg-gray-200 rounded-full p-2 cursor-pointer"
                                >
                                    <Image :size="27" fillColor="#43BE62"/>
                                </label>

                                <input
                                    id="image"
                                    type="file"
                                    class="hidden"
                                    @input="getUploadedImage($event)"
                                >

                            </div>
                        </div>

                        <div v-if="error">
                            <div class="w-full bg-red-100 text-red-700 rounded-lg mt-3 text-center">
                                <div class="p-0.5">
                                    {{ error }}
                                </div>
                            </div>
                        </div>

                        <button
                            @click="createPost"
                            class="w-full bg-blue-500 hover:bg-blue-600 text-white font-extrabold p-1.5 mt-3 rounded-lg"
                            >
                            Post
                        </button>
                    </div>

                </div>
            </div>
        </div>

    <!-- </div> -->
</div>
</template>
