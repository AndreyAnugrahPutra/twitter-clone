<script setup>
import { Head } from '@inertiajs/vue3';
import TwitterLayout from '@/Layouts/TwitterLayout.vue'

// import components
import Tweet from '@/Components/Tweet.vue'

defineProps({ tweets : Array })
</script>

<template>
    <Head title="HomePage" />

    <TwitterLayout>
        <div class="text-white">
            <div class="flex border-b border-b-gray-800" v-for="tweet in tweets" :key="tweet">
                <Tweet :tweet="tweet"/>
            </div>
            <!-- <div class="border-b border-b-gray-800 mt-2"></div> -->
        </div>
    </TwitterLayout>
</template>

<style>

</style>
