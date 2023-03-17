<template>
    <div>
        <div class="mx-auto py-3 px-[10%] container grid gap-8 pt-[50px]">
            <h1 class="text-gray-700 text-3xl font-bold">Welcome, Admin!</h1>
            <div class="grid lg:grid-cols-2 h-fit gap-14">
                <div class="grid gap-4 h-fit bg-white border border-purple-700 drop-shadow-[0_20px_20px_rgba(126,34,206,0.50)] rounded-3xl py-10 px-14">
                    <div>
                        <h1 class="text-gray-700 text-3xl font-bold text-center mb-8">Upload a new book</h1>
                    </div>
                    <input
                        v-model="book.name"
                        type="text"
                        class="rounded-full border-2 border-gray-300 focus-visible:ring-none focus-visible:outline-none py-2 px-4 focus-visible:border-orange-400 focus:border-orange-400 w-full"
                        placeholder="Book name"
                    />
                    <input
                        v-model="book.quantity"
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
                    <div class="flex justify-center">
                        <button @click="addBook()" class="bg-orange-400 hover:bg-orange-500 py-2 px-8 rounded-full text-white text-center w-fit mt-10">Upload</button>
                    </div>
                </div>
                <div class="grid gap-4 h-fit bg-white border border-purple-700 drop-shadow-[0_20px_20px_rgba(126,34,206,0.50)] rounded-3xl py-10 px-14">
                    <div>
                        <h1 class="text-gray-700 text-3xl font-bold text-center">Books borrowed</h1>
                    </div>
                    <div v-for="(book, index) in books_borrowed" :key="`book_borrower_${index + 2}`" class="rounded-xl hover:bg-gray-100 grid grid-cols-4 items-center gap-3 h-fit">
                        <div
                            class="col-span-1 border-4 border-orange-400 h-[100px] w-[100px] rounded-3xl bg-cover bg-center relative grid place-content-between"
                            :style="`background-image: url(${book.cover})`"
                        />
                        <div class="col-span-3 grid gap-3 h-fit">
                            <h2 class="text-gray-700 text-xl font-bold line-clamp-1">{{ book.name }}</h2>
                            <p class="text-gray-500 text-md flex gap-1">
                                <span>Borrowed by</span>
                                <span class="font-bold text-gray-700">
                                    <div v-for="(borrower, i) in book.borrowers" :key="`book_borrower_${i + 7}`">
                                        {{ borrower.name }}
                                    </div>
                                </span>
                            </p>
                        </div>
                    </div>

                    <div class="flex justify-center">
                        <button class="text-orange-400 underline hover:no-underline py-2 px-8 rounded-full text-center w-fit mt-10">See all</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="bg-gray-50 py-[100px]">
            <div class="mx-3 py-3 px-[10%] sm:container grid gap-5">
                <h2 class="text-gray-700 text-4xl font-bold">The list of your books</h2>
                <div :class="gridIfBooks">
                    <template v-if="books.length > 0">
                        <div
                            v-for="(book, index) in books"
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
                                        <div class="z-30 h-[55px] bg-white grid rounded-full grid-cols-2 gap-2 items-center p-2">
                                            <!-- Edit Button -->
                                            <div @click="openEditModal(book)" class="rounded-full bg-gray-200 hover:bg-gray-100 hover:cursor-pointer h-10 w-10 p-3">
                                                <svg class="w-4 h-4 stroke-gray-700" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5">
                                                    <path
                                                        stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10"
                                                    />
                                                </svg>
                                            </div>
                                            <!-- Remove Button -->
                                            <div @click="openConfirmDeleteModal(book)" class="rounded-full bg-red-500 hover:bg-red-400 hover:cursor-pointer h-10 w-10 p-3">
                                                <svg class="w-4 h-4 stroke-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5">
                                                    <path
                                                        stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"
                                                    />
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
                            <h3 class="text-gray-700 text-3xl font-bold text-center">No books found in your account!</h3>
                            <p class="text-gray-700 text-md text-center">Please user the upload formular above to upload a new book the users can borrow from you!</p>
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
    name: 'AdminDashboard',
    components: {},
    computed: {
        ...mapGetters(['books', 'books_borrowed']),
        gridIfBooks() {
            if (this.books.length > 0) {
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
            // books: [
            //     {
            //         id: 0,
            //         cover: '/src/assets/images/book_covers/killer.jpg',
            //         name: 'The killer poison by Jule Martinez',
            //         quantity: 3,
            //     },
            //     {
            //         id: 1,
            //         cover: '/src/assets/images/book_covers/potter.jpg',
            //         name: 'The killer poison by Jule Martinez',
            //         quantity: 6,
            //     },
            // ],
            // borrowers: [
            //     {
            //         id: 0,
            //         book: {
            //             id: 0,
            //             name: 'The killer poison by Jule Martinez',
            //             cover: '/src/assets/images/book_covers/potter.jpg',
            //         },
            //         name: 'John Doe',
            //     },
            //     {
            //         id: 0,
            //         book: {
            //             id: 0,
            //             name: 'The killer poison by Jule Martinez',
            //             cover: '/src/assets/images/book_covers/killer.jpg',
            //         },
            //         name: 'John Doe',
            //     },
            // ],
            showBookName: '',

            deleteBookModal: false,
        }
    },
    created() {
        this.$store.dispatch('getBooks')
        this.$store.dispatch('getBooksBorrowed')
    },
    methods: {
        openConfirmDeleteModal(book) {
            this.$store.dispatch('toggleConfirmDeletionModal', { opened: true, itemToDelete: book })
        },
        openEditModal(book) {
            this.$store.dispatch('toggleEditModal', { opened: true, itemToEdit: book })
        },
        addBook() {
            let formData = new FormData()
            formData.append('name', this.book.name)
            formData.append('quantity', this.book.quantity)
            formData.append('cover', this.book.cover)

            this.$store.dispatch('createBook', formData).then((resp) => {
                // reset the object
                this.book = {
                    name: '',
                    cover: '',
                    quantity: 0,
                }
            })
        },
        handleImage: function (event) {
            this.book.cover = event.target.files[0]
        },
        hoveredBook(index) {
            this.showBookName = `show_book_name_${index}`
        },
    },
}
</script>
