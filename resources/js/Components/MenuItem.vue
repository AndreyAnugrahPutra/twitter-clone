<script setup>
import { toRefs } from 'vue';

// import icons
import HomeIcon from 'vue-material-design-icons/Home.vue'
import PoundIcon from 'vue-material-design-icons/Pound.vue'
import BellOutlineIcon from 'vue-material-design-icons/BellOutline.vue'
import EmailOutlineIcon from 'vue-material-design-icons/EmailOutline.vue'
import AccountOutlineIcon from 'vue-material-design-icons/AccountOutline.vue'


const props = defineProps({
    iconString : String,
})

const { iconString } = toRefs(props)

let icon = null 

if(iconString.value === 'Home') icon = HomeIcon
if(iconString.value === 'Explore') icon = PoundIcon
if(iconString.value === 'Notifications') icon = BellOutlineIcon
if(iconString.value === 'Messages') icon = EmailOutlineIcon
if(iconString.value === 'Profile') icon = AccountOutlineIcon
</script>

<template>
    <div class="w-full lg:inline-block hover:bg-gray-900 py-2 px-4 lg:pr-6 rounded-full cursor-pointer transition duration-200 ease-in-out">
        <div class="flex items-center">
            <component :is="icon" fillColor="#fff" :size="30" />
            <span class="lg:block hidden text-white font-extrabold text-[23px] pl-4 mt-0.5">
                {{ iconString }}
            </span>
        </div>
    </div>
</template>

<style scoped>
</style>