<template>
    <nav class="grid grid-cols-4">
        <div class="col-span-3 mx-3 bg-white py-3 sm:mx-auto sm:container grid grid-cols-2 relative">
            <router-link class="inline ml-[26%]" to="/">
                <GetABookSVGColorV class="w-[200px] mr-1" />
            </router-link>
            <div class="flex gap-6 items-center">
                <router-link class="inline pr-5" to="/admin" active-class="active">Admin Side</router-link>
                <router-link class="inline" to="/client" active-class="active">Return a book</router-link>
            </div>
        </div>
        <div class="col-span-1 grid bg-purple-700 rounded-l-full items-center pl-4">
            <router-link
                class="bg-orange-400 hover:bg-orange-500 py-2 px-8 rounded-full text-white text-center w-fit"
                to="/client"
                active-class="text-white hover:bg-transparent bg-transparent border border-white"
                >Borrowed books</router-link
            >
        </div>
    </nav>
    <router-view></router-view>
    <footer class="bg-purple-700 w-full text-white text-md py-3">
        <p class="text-xs text-center">Copyright 2023 @ All Rights Reserved.</p>
    </footer>
    <show-modal :error="borrowing_error" :open="show_modal.opened" @closed="closeModalShow()" @borrowed="borrowBook" />
    <edit-modal :open="edit_modal.opened" @closed="closeModalEdit()" @saved="editBook" />
    <confirm-delete-modal :open="confirm_deletion_modal.opened" @closed="closeModalDelete()" @confirmed="deleteBook()" />
    <confirm-return-book-modal :open="confirm_return_book_modal.opened" @closed="closeModalReturnBook()" @confirmed="returnBook()" />
</template>
<script>
import { mapGetters } from 'vuex'
import ConfirmDeleteModal from './components/modals/ConfirmDeleteModal.vue'
import ConfirmReturnBookModal from './components/modals/ConfirmReturnBookModal.vue'
import ShowModal from './components/modals/ShowModal.vue'
import EditModal from './components/modals/EditModal.vue'
import GetABookSVGColorV from '../src/assets/images/logo/lend_a_book_color_h.svg'
export default {
    name: 'AdminDashboard',
    components: {
        ShowModal,
        EditModal,
        ConfirmDeleteModal,
        ConfirmReturnBookModal,
        GetABookSVGColorV,
    },
    computed: {
        ...mapGetters(['confirm_deletion_modal', 'confirm_return_book_modal', 'edit_modal', 'show_modal']),
    },
    data() {
        return {
            borrowing_error: null,
        }
    },
    methods: {
        closeModalReturnBook() {
            this.$store.dispatch('toggleConfirmReturnBookModal', { opened: false, itemToReturn: null })
        },
        closeModalShow() {
            this.borrowing_error = null
            this.$store.dispatch('toggleShowModal', { opened: false, itemToShow: null })
        },
        closeModalEdit() {
            this.$store.dispatch('toggleEditModal', { opened: false, itemToEdit: null })
        },
        closeModalDelete() {
            this.$store.dispatch('toggleConfirmDeletionModal', { opened: false, itemToDelete: null })
        },
        handleImage: function (event) {
            this.book.cover = event
        },
        async borrowBook() {
            this.borrowing_error = null
            await this.$store
                .dispatch('borrowBook', { book_id: this.show_modal.itemToShow.id, user_id: 1 })
                .then((resp) => {
                    this.closeModalShow()
                })
                .catch((err) => {
                    this.borrowing_error = err.data
                })
        },
        editBook() {
            console.log('edit request...')
            this.$store.dispatch('editBook', this.edit_modal.itemToEdit).then((resp) => {
                this.closeModalEdit()
            })
        },
        deleteBook() {
            console.log('delete request...')
            this.$store.dispatch('deleteBook', this.confirm_deletion_modal.itemToDelete.id).then((resp) => {
                this.closeModalDelete()
            })
        },
        returnBook() {
            console.log('return book request...')
            this.$store.dispatch('returnBook', { book_id: this.confirm_return_book_modal.itemToReturn.id, user_id: 1 }).then((resp) => {
                this.closeModalReturnBook()
            })
        },
    },
}
</script>

<style lang="scss">
#app {
    @apply h-screen bg-gray-50;
}

nav {
    a.active {
        @apply block text-orange-400;
    }
}
</style>
