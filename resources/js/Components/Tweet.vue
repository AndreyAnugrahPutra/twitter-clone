<script setup>
import { onMounted, ref } from 'vue'
import { Link } from '@inertiajs/vue3';

// import icons
import HeartOutlineIcon from 'vue-material-design-icons/HeartOutline.vue'
import HeartIcon from 'vue-material-design-icons/Heart.vue'
import ChartBarIcon from 'vue-material-design-icons/ChartBar.vue'
import MessageOutlineIcon from 'vue-material-design-icons/MessageOutline.vue'
import SyncIcon from 'vue-material-design-icons/Sync.vue'
import DotsHorizontalIcon from 'vue-material-design-icons/DotsHorizontal.vue'
import TrashCanOutlineIcon from 'vue-material-design-icons/TrashCanOutline.vue'

defineProps({tweet : Object})
// variables
let openOptions = ref(false)
const isLiked = ref(false)

function liked()
{
    isLiked.value = !isLiked.value
}

function closeOptions()
{
    openOptions.value = false
}

</script>

<template>
    <div class="min-w-[60px]">
        <img :src="tweet.image" class="rounded-full m-2 mt-3" width="50">
    </div>
    <div class="p-2 w-full" @click="closeOptions()">
        <div class="font-extrabold flex items-center justify-between mt-0.5 mb-1.5">
            <div class="flex items-center">
                <span class="text-[14px] md:text-[18px]">{{ tweet.name }}</span>
                <span class="font-[300] text-[12px] md:text-[15px] text-gray-500 pl-2">{{ tweet.handle }}</span>
            </div>
            <div class="hover:bg-gray-800 rounded-full cursor-pointer relative">
                <button type="button" class="block p-2">
                    <DotsHorizontalIcon @click="openOptions = !openOptions"/>
                </button>

                <div class="absolute p-3 mt-1 right-0 w-[300px] bg-black border border-gray-700 rounded-lg shadow-lg" v-if="openOptions">
                    <Link as="button" method="delete" :href="route('tweets.destroy', {id:tweet.id})" class="flex items-center cursor-pointer">
                        <TrashCanOutlineIcon class="pr-3" fillColor="#dc2626" :size="18"/>
                        <span class="text-red-600 font-extrabold">Delete Tweet</span>
                    </Link>
                </div>
            </div>
        </div>

        <div class="pb-3">{{ tweet.tweet }}</div>

        <div v-if="tweet.file">
            <div v-if="!tweet.is_video" class="rounded-xl">
                <img :src="tweet.file" class="mt-2 object-fill rounded-xl w-full">
            </div>
            <div v-else>
                <video :src="tweet.file" class="rounded-xl" controls></video>
            </div>
        </div>

        <div class="flex items-center justify-between mt-4 w-4/5">
            <div class="flex">
                <MessageOutlineIcon fillColor="#5e5c5c" :size="18"/>
                <span class="text-xs font-extrabold text-[#5e5c5c] ml-3">{{ tweet.comments }}</span>
            </div>
            <div class="flex">
                <SyncIcon fillColor="#5e5c5c" :size="18"/>
                <span class="text-xs font-extrabold text-[#5e5c5c] ml-3">{{ tweet.retweets }}</span>
            </div>
            <div class="flex cursor-pointer">
                <HeartIcon fillColor="#f16060" :size="18" v-if="isLiked" @click="liked"/>
                <HeartOutlineIcon fillColor="#5e5c5c" :size="18" v-else @click="liked"/>
                <span class="text-xs font-extrabold text-[#5e5c5c] ml-3">{{ tweet.likes }}</span>
            </div>
            <div class="flex">
                <ChartBarIcon fillColor="#5e5c5c" :size="18"/>
                <span class="text-xs font-extrabold text-[#5e5c5c] ml-3">{{ tweet.analytics }}</span>
            </div>

        </div>
    </div>
</template>

<style scoped>
</style>