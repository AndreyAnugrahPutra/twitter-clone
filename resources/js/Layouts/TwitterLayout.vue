<script setup>
import { ref } from 'vue';
import { router } from '@inertiajs/vue3';

// import icon
import TwitterIcon from 'vue-material-design-icons/Twitter.vue'
import MagnifyIcon from 'vue-material-design-icons/Magnify.vue'
import DotsHorizontalIcon from 'vue-material-design-icons/DotsHorizontal.vue'
import FeatherIcon from 'vue-material-design-icons/Feather.vue'
import CloseIcon from 'vue-material-design-icons/Close.vue'
import ChevronDownIcon from 'vue-material-design-icons/ChevronDown.vue'
import EarthIcon from 'vue-material-design-icons/Earth.vue'
import ImageOutlineIcon from 'vue-material-design-icons/ImageOutline.vue'
import FileGifBoxIcon from 'vue-material-design-icons/FileGifBox.vue'
import EmoticonIcon from 'vue-material-design-icons/Emoticon.vue'
import ArrowLeftIcon from 'vue-material-design-icons/ArrowLeft.vue'

// import components
import MenuItem from '@/Components/MenuItem.vue'

// variable
let createTweet = ref(false)
let tweet = ref('')
let file = ref('')
let showUpload = ref('')
let uploadType = ref('')
let textarea = ref(null)
let randImg1 = ref(`https://picsum.photos/id/${(Math.random() * 200).toFixed(0)}/100`)
let randImg2 = ref(`https://picsum.photos/id/${(Math.random() * 200).toFixed(0)}/100`)

const getFile = (e) =>
{
    file.value = e.target.files[0]
    showUpload.value = URL.createObjectURL(e.target.files[0])
    uploadType.value = file.value.name.split('.').pop()
}

const closeMessageBox = () =>
{
    createTweet.value = false
    tweet.value = ''
    showUpload.value = ''
    uploadType.value = ''
}

const textareaInput = (e) =>
{
    textarea.value.style.height = "auto"
    textarea.value.style.height = `${e.target.scrollHeight}px`
}

const addTweet = () =>
{
    if(!tweet.value) return

    let data = new FormData()

    data.append('tweet', tweet.value)
    data.append('file', file.value)

    router.post('/tweets', data)

    closeMessageBox()
}
</script>

<template>
    <div class="fixed w-full">
        <div class="max-w-[1400px] flex mx-auto">
            <div class="lg:w-3/12 w-[60px] h-[100vh] max-w[350px] lg:px-4 lg:mx-auto">
                <!-- Twitter Logo -->
                <div class="py-3 px-3 mb-4">
                    <TwitterIcon fillColor="#FFF" :size="37" />
                </div>
                <!-- Menu Component -->
                <MenuItem iconString="Home"/>
                <MenuItem iconString="Explore"/>
                <MenuItem iconString="Notifications"/>
                <MenuItem iconString="Messages"/>
                <MenuItem iconString="Profile"/>

                <!-- Tweet button -->
                <button @click="createTweet = true" class="lg:w-full mt-8 ml-2 text-white font-extrabold text-[22px] bg-[#1c9cef] p-3 rounded-full cursor-pointer">
                    <span class="lg:block hidden">Tweet</span>
                    <span class="block lg:hidden"><FeatherIcon /></span>
                </button>
            </div>

            <div class="lg:w-7/12 w-11/12 border-x border-gray-800 relative">
                <div class="bg-black bg-opacity-50 backdrop-blur-md z-10 absolute w-full">
                    <div class="w-full border-b border-gray-800">
                        <div class="w-full text-white text-[22px] font-extrabold p-4">
                            Home
                        </div>
                        <div class="flex">
                            <div class="flex items-center justify-center w-full h-[60px] text-white text-[17px] font-extrabold p-4 hover:bg-gray-500 hover:bg-opacity-30 cursor-pointer transition duration-200 ease-in-out">
                                <div class="inline-block text-center border-b-4 border-b-[#1c9cef] h-[60px]">
                                    <div class="my-auto mt-4">For you</div>
                                </div>
                            </div>
                            <div class="w-full h-[60px] text-gray-500 text-[17px] font-extrabold p-4 hover:bg-gray-500 hover:bg-opacity-30 cursor-pointer transition duration-200 ease-in-out">
                                <div class="text-center">Following</div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="absolute top-0 z-0 h-full overflow-auto scrollbar-hide">
                    <div class="mt-[126px]"></div>
                    <slot />
                    <div class="pb-4"></div>
                </div>

            </div>


            <!-- right sidebar -->
            <div class="lg:block hidden lg:w-4/12 h-screen border-l border-gray-800 pl-4">
                <!-- Search input -->
                <div class="w-full py-1 mt-2 px-4 lg:flex items-center rounded-full hidden bg-[#212327]">
                    <MagnifyIcon fillColor="#5e5c5c" :size="25" />
                    <input type="text" class="appearance-none w-full border-0 py-2 bg-[#212327] text-gray-100 placeholder-gray-500 leading-tight focus:ring-0" placeholder="Search something...">
                </div>

                <!-- Trending Section -->
                <div class="w-full mt-4 rounded-lg lg:block hidden bg-[#212327] overflow-hidden">
                    <div class="w-full p-4 text-white font-extrabold mb-6 text-[20px]">
                        What's happening
                    </div>

                    <div class="h-[80px] hover:bg-gray-800 cursor-pointer transition duration-200 ease-in-out">
                        <div class="flex p-3 justify-between h-[80px]">
                            <div>
                                <div class="text-[14px] text-gray-400">Tennis Tournament LIVE</div>
                                <div class="w-full text-white font-extrabold mb-6 text-[17px]">Australia Open 2023</div>
                            </div>
                            <img :src="randImg2" alt="" class="rounded-xl">
                        </div>
                    </div>

                    <div class="hover:bg-gray-800 cursor-pointer transition duration-200 ease-in-out">
                        <div class="flex p-3 justify-between">
                            <div>
                                <div class="text-[14px] text-gray-400">Trending in Indonesia</div>
                                <div class="w-full text-white font-extrabold  text-[17px]">Debat Capres</div>
                                <div class="text-[14px] text-gray-400">2,024 Tweets</div>
                            </div>
                            <DotsHorizontalIcon fillColor="#5e5c5c"/>
                        </div>
                    </div>

                    <div class="hover:bg-gray-800 cursor-pointer transition duration-200 ease-in-out">
                        <div class="flex p-3 justify-between">
                            <div>
                                <div class="text-[14px] text-gray-400">Trending • Politics</div>
                                <div class="w-full text-white font-extrabold  text-[17px]">South Africa</div>
                                <div class="text-[14px] text-gray-400">205K Tweets</div>
                            </div>
                            <DotsHorizontalIcon fillColor="#5e5c5c"/>
                        </div>
                    </div>

                    <div class="hover:bg-gray-800 cursor-pointer transition duration-200 ease-in-out">
                        <div class="flex p-3 justify-between">
                            <div>
                                <div class="text-[14px] text-gray-400">Trending • Sports</div>
                                <div class="w-full text-white font-extrabold  text-[17px]">Magnus Carlsen</div>
                                <div class="text-[14px] text-gray-400">12,312 Tweets</div>
                            </div>
                            <DotsHorizontalIcon fillColor="#5e5c5c"/>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <div class="fixed top-0 left-0 w-full h-screen bg-black md:bg-gray-400 md:bg-opacity-30 md:p-3 overflow-y-auto" id="OverlaySection" v-if="createTweet">
        <div class="md:max-w-2xl md:mx-auto md:mt-10 md:rounded-xl bg-black">
            <div class="flex justify-between items-center md:inline-block p-2 m-2 rounded-full cursor-pointer">
                <div class="hover:bg-gray-800 inline-block p-2 rounded-full cursor-pointer" @click="closeMessageBox">
                    <CloseIcon fillColor="#FFF" :size="28" class="md:block hidden"/>
                    <ArrowLeftIcon fillColor="#FFF" :size="28" class="block md:hidden"/>
                </div>

                <button @click="addTweet()" class="md:hidden font-extrabold text-[16px] p-1.5 px-4 rounded-full cursor-pointer" :class="tweet ? 'bg-[#1c9cef] text-white' : 'bg-[#124d77] text-gray-400'" :disabled="!tweet">
                    Tweet
                </button>
            </div>

            <div class="w-full flex">
                <div class="ml-3.5 mr-2">
                    <img class="rounded-full" width="55" :src="randImg1">
                </div>
                <div class="w-[calc(100%-100px)]">
                    <div class="inline-block">
                        <div class="flex items-center border border-gray-700 rounded-full">
                            <span class="text-[#1c9cef] p-0.5 pl-3.5 font-extrabold">Everyone</span>
                            <ChevronDownIcon class="pr-2" fillColor="#1c9cef" :size="25"/>
                        </div>
                    </div>

                    <div>
                        <textarea :oninput="textareaInput" cols="30" rows="4" placeholder="What's happening?" v-model="tweet" ref="textarea" class="w-full bg-black border-0 mt-2 focus:ring-0 text-white text-[19px] font-extrabold min-h-[120px]"></textarea>
                    </div>

                    <div class="w-full">
                        <video controls v-if="uploadType === 'mp4'" :src="showUpload" class="rounded-xl"/>
                        <img v-else :src="showUpload" class="rounded-xl">
                    </div>
                    <div class="flex py-2 items-center text-[#1c9cef] font-extrabold">
                        <EarthIcon class="pr-2" fillColor="#1c9cef" :size="20"/>Everyone can reply
                    </div>
                    <div class="border-b border-b-gray-700"></div>
                    <div class="flex items-center justify-between py-2">
                        <div class="flex items-center">
                            <div class="hover:bg-gray-800 inline-block p-2 rounded-full cursor-pointer">
                                <label for="fileUpload" class="cursor-pointer">
                                    <ImageOutlineIcon fillColor="#1c9cef" :size="25"/>
                                </label>
                                <input type="file" id="fileUpload" class="hidden" @change="getFile">
                            </div>
                            <div class="hover:bg-gray-800 inline-block p-2 rounded-full cursor-pointer">
                                <FileGifBoxIcon fillColor="#1c9cef" :size="25"/>
                            </div>
                            <div class="hover:bg-gray-800 inline-block p-2 rounded-full cursor-pointer">
                                <EmoticonIcon fillColor="#1c9cef" :size="25"/>
                            </div>
                        </div>
                        <button @click="addTweet()" class="md:block hidden font-extrabold text-[16px] p-1.5 px-4 rounded-full cursor-pointer" :class="tweet ? 'bg-[#1c9cef] text-white' : 'bg-[#124d77] text-gray-400'" :disabled="!tweet">
                            Tweet
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<style>
body 
{
    background-color: black;
}
</style>