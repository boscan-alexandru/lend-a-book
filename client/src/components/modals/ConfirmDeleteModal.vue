<template>
    <VueModal v-if="showModal" type="info" width="basis-full sm:basis-9/12 md:basis-6/12 lg:basis-5/12 xl:basis-4/12" @close="closeModal()">
        <template v-slot:title>
            <p>Confirm the deletion of this book from your list?</p>
        </template>
        <template v-slot:footer>
            <div class="flex gap-4 justify-end pt-10">
                <div @click="confirmDeletion()" class="rounded-xl bg-red-500 hover:bg-red-400 hover:cursor-pointer items-center p-3 flex gap-3 text-white">
                    <svg class="w-4 h-4 stroke-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5">
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"
                        />
                    </svg>
                    <p>Delete</p>
                </div>
            </div>
        </template>
    </VueModal>
</template>
<script>
import VueModal from './VueModal.vue'
export default {
    name: 'ConfirmDeleteModal',
    components: {
        VueModal,
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
    watch: {
        open: function () {
            this.showModal = this.open
            return this.open
        },
    },
    methods: {
        closeModal() {
            this.$emit('closed')
            this.showModal = false
        },
        confirmDeletion() {
            this.$emit('confirmed')
        },
    },
}
</script>
