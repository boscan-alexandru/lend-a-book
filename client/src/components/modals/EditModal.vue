<template>
    <VueModal v-if="showModal" type="info" width="basis-full sm:basis-9/12 md:basis-6/12 lg:basis-5/12 xl:basis-4/12" @close="closeModal()">
        <template v-slot:title>
            <p>Edit</p>
        </template>
        <template v-slot:content>
            <div class="grid gap-5">
                <input
                    v-model="edit_modal.itemToEdit.name"
                    type="text"
                    class="rounded-full border-2 border-gray-300 focus-visible:ring-none focus-visible:outline-none py-2 px-4 focus-visible:border-orange-400 focus:border-orange-400 w-full"
                    placeholder="Book name"
                />
                <input
                    v-model="edit_modal.itemToEdit.quantity"
                    type="number"
                    min="0"
                    class="rounded-full border-2 border-gray-300 focus-visible:ring-none focus-visible:outline-none py-2 px-4 focus-visible:border-orange-400 focus:border-orange-400 w-full"
                    placeholder="Book quantity"
                />
                <input
                    type="file"
                    class="rounded-full border-2 border-gray-300 focus-visible:ring-none focus-visible:outline-none py-2 px-4 focus-visible:border-orange-400 focus:border-orange-400 w-full"
                    @change="handleImage"
                />
            </div>
        </template>
        <template v-slot:footer>
            <div class="flex gap-4 justify-end pt-10">
                <div @click="saveBook()" class="rounded-xl bg-green-500 hover:bg-green-400 hover:cursor-pointer items-center p-3 flex gap-3 text-white">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" class="w-4 h-4 stroke-white">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <p>Save</p>
                </div>
            </div>
        </template>
    </VueModal>
</template>
<script>
import { mapGetters } from 'vuex'
import VueModal from './VueModal.vue'
export default {
    name: 'EditModal',
    components: {
        VueModal,
    },
    computed: {
        ...mapGetters(['edit_modal']),
    },
    props: {
        open: {
            type: Boolean,
            default: false,
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
    },
    methods: {
        handleImage: function (event) {
            this.edit_modal.itemToEdit.cover = event.target.files[0]
        },
        closeModal() {
            this.$emit('closed')
            this.showModal = false
        },
        saveBook() {
            this.$emit('saved', this.edit_modal.itemToEdit)
        },
    },
}
</script>
