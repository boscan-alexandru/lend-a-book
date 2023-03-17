<template>
    <div>
        <div class="bg-gray-50 py-[100px]">
            <div class="mx-3 py-3 px-[10%] sm:container grid gap-5">
                <h2 class="text-gray-700 text-4xl font-bold">My borrowed books</h2>
                <div :class="gridIfBooks">
                    <template v-if="borrowed_books.length > 0">
                        <div
                            v-for="(book, index) in borrowed_books"
                            :key="`book_${index}`"
                            class="border-4 border-transparent hover:border-orange-400 h-[400px] rounded-3xl bg-cover bg-top relative"
                            :style="`background-image: url(${book.cover})`"
                            @mouseover="hoveredBook(index)"
                            @mouseleave="showBookName = ''"
                        >
                            <template v-if="showBookName == `show_book_name_${index}`">
                                <div class="absolute top-0 right-0 left-0 bottom-0 bg-purple-700 opacity-50 rounded-3xl z-10"></div>
                                <div class="absolute top-0 right-0 left-0 bottom-0 z-20 p-5 grid">
                                    <div class="flex justify-end h-fit">
                                        <div class="z-30 h-[55px] bg-white rounded-full items-center p-2">
                                            <!-- Remove Button -->
                                            <div @click="openConfirmReturnBookModal(book)" class="rounded-full bg-orange-500 hover:bg-orange-400 hover:cursor-pointer h-10 w-10 p-3">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" class="w-4 h-4 stroke-white">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 15l6-6m0 0l-6-6m6 6H9a6 6 0 000 12h3" />
                                                </svg>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="flex h-full items-end">
                                        <div class="z-30 w-full bg-white p-2 h-fit rounded-xl">
                                            <p class="text-purple-700 font-bold text-center wrap line-clamp-2">{{ book.name }}</p>
                                        </div>
                                    </div>
                                </div>
                            </template>
                        </div>
                    </template>
                    <template v-else>
                        <div class="border-2 border-dashed border-gray-400 h-[400px] rounded-3xl bg-gray-100 relative grid h-fit gap-5 py-10 px-8">
                            <div class="flex justify-center h-fit">
                                <div class="h-[100px] w-[100px] bg-contain bg-no-repeat invert opacity-20" style="background-image: url('src/assets/images/no_books.png')" />
                            </div>
                            <h3 class="text-gray-700 text-3xl font-bold text-center">You did not borrowed any book yet!</h3>
                            <p class="text-gray-700 text-md text-center">Please choose a book from the main page and borrow it in order to see content here.</p>
                        </div>
                    </template>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import { mapGetters } from 'vuex'
export default {
    name: 'ClientDashboard',
    components: {},
    computed: {
        ...mapGetters(['borrowed_books']),
        gridIfBooks() {
            if (this.borrowed_books.length > 0) {
                return 'grid lg:grid-cols-4 gap-5 pt-10'
            } else {
                return 'grid lg:grid-cols-3 gap-5 pt-10'
            }
        },
    },
    data() {
        return {
            book: {
                name: '',
                cover: '',
                quantity: 0,
            },
            showBookName: '',

            deleteBookModal: false,
        }
    },
    created() {
        this.$store.dispatch('getBorrowedBooks', 1)
    },
    methods: {
        openConfirmReturnBookModal(book) {
            this.$store.dispatch('toggleConfirmReturnBookModal', { opened: true, itemToReturn: book })
        },

        hoveredBook(index) {
            this.showBookName = `show_book_name_${index}`
        },
    },
}
</script>
