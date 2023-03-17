<template>
    <VueModal v-if="showModal" type="info" width="basis-full sm:basis-9/12 md:basis-8/12 lg:basis-8/12 xl:basis-8/12" @close="closeModal()">
        <template v-slot:title><span></span> </template>
        <template v-slot:content>
            <div class="grid lg:grid-cols-3 gap-5 mb-5">
                <div
                    class="lg:col-span-1 border-4 border-orange-400 h-[300px] lg:h-[400px] rounded-3xl bg-cover bg-top relative"
                    :style="`background-image: url(${show_modal.itemToShow.cover})`"
                ></div>
                <div class="lg:col-span-2">
                    <h3 class="text-gray-700 text-4xl font-bold mb-5">{{ show_modal.itemToShow.name }}</h3>

                    <p class="text-gray-400 text-xl mb-5">
                        Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer
                        took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining
                        essentially unchanged. It was popularised in the 1960s with the release
                    </p>
                    <p class="text-gray-400 text-xl">
                        Available copies:
                        <template v-if="show_modal.itemToShow.quantity > 0">
                            <span class="text-gray-700 font-bold">{{ show_modal.itemToShow.quantity }}</span>
                        </template>
                        <template v-else>
                            <span class="text-red-500 font-bold text-2xl">Out of copies!</span>
                        </template>
                    </p>
                    <template v-if="show_modal.itemToShow.quantity > 0">
                        <div class="w-fit pt-10">
                            <div @click="saveBook()" class="rounded-xl bg-green-500 hover:bg-green-400 hover:cursor-pointer items-center py-3 px-10 flex justify-center w-fit gap-2 text-white">
                                <svg class="w-8 h-8 stroke-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5">
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M12 9l-3 3m0 0l3 3m-3-3h12.75"
                                    />
                                </svg>
                                <p>Borrow now</p>
                            </div>
                            <template v-if="error">
                                <div class="text-red-500 bg-red-100 border border-red-500 py-2 w-fit rounded-lg px-4 mt-3">
                                    {{ error }}
                                </div>
                            </template>
                        </div>
                    </template>
                </div>
            </div>
        </template>
    </VueModal>
</template>
<script>
import { mapGetters } from 'vuex'
import VueModal from './VueModal.vue'
export default {
    name: 'ShowModal',
    components: {
        VueModal,
    },
    computed: {
        ...mapGetters(['show_modal']),
    },
    props: {
        open: {
            type: Boolean,
            default: false,
        },
        error: {
            type: String,
            default: null,
        },
    },
    data() {
        return {
            showModal: false,
        }
    },
    created() {},
    watch: {
        open: function () {
            this.showModal = this.open
            return this.open
        },
        error: function () {
            return this.error
        },
    },
    methods: {
        closeModal() {
            this.$emit('closed')
            this.showModal = false
        },
        saveBook() {
            this.$emit('borrowed', this.show_modal.itemToShow)
        },
    },
}
</script>
