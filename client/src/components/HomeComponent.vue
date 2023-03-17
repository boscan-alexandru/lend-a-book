<template>
    <div>
        <div class="w-full h-[900px] grid items-center bg-cover bg-center" style="background-image: url('/src/assets/images/bg.jpg')">
            <div class="mx-3 py-3 sm:mx-auto sm:container grid lg:grid-cols-3">
                <div class="lg:col-span-2 grid gap-4 bg-white drop-shadow-[0_20px_20px_rgba(126,34,206,0.50)] rounded-3xl py-20 px-24 w-fit">
                    <div>
                        <p class="text-orange-400 font-bold">sfdghfghdfghdfgh</p>
                        <h1 class="text-gray-700 text-7xl font-bold">
                            Borrow your <br />
                            favorite book now
                        </h1>
                    </div>
                    <p class="text-gray-400">sfdghfghdfghdfgh</p>
                    <a class="bg-orange-400 hover:bg-orange-500 py-2 px-8 rounded-full text-white text-center w-fit mt-10" href="#books">Borrow Now</a>
                </div>
            </div>
        </div>
        <div class="bg-white grid grid-cols-6">
            <div class="col-span-4 col-start-2">
                <div class="mx-3 py-20 sm:mx-auto sm:container items-center grid lg:grid-cols-2">
                    <h2 class="text-gray-700 text-4xl font-bold">
                        Need help choosing a book? <br />
                        We can help <span class="text-orange-400">you choose!</span>
                    </h2>
                    <div class="place-self-end grid gap-3 py-8 px-20 rounded-xl relative bg-purple-700 w-fit">
                        <div class="absolute z-10 top-3 left-14 rounded-full h-10 w-10 bg-orange-400"></div>
                        <p class="text-white z-20 text-2xl font-bold">Call Us : +00 568 468</p>
                        <small class="text-white z-20 text-right">For a choice advice</small>
                    </div>
                </div>
            </div>
        </div>
        <div class="bg-gray-50 py-[100px]">
            <div class="mx-3 py-3 sm:mx-auto sm:container grid gap-5">
                <h2 class="text-gray-700 text-4xl text-center font-bold">
                    Choose your next<br />
                    <span class="text-orange-400"> big adventure </span>
                </h2>
                <div class="grid grid-cols-6">
                    <div class="col-span-2 col-start-3">
                        <p class="text-gray-400 text-center">
                            Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore fugiat sunt culpa officia deserunt mollit anim est laborum.
                        </p>
                    </div>
                </div>
                <div id="books" class="grid lg:grid-cols-4 gap-5 pt-10">
                    <template v-if="books.length > 0">
                        <div
                            v-for="(book, index) in books"
                            :key="`book_${index}`"
                            class="border-4 border-transparent hover:border-orange-400 h-[400px] rounded-3xl bg-cover bg-top relative grid items-end"
                            :style="`background-image: url(${book.cover})`"
                            @mouseover="hoveredBook(index)"
                            @mouseleave="hoverExit()"
                        >
                            <template v-if="showBookName == `show_book_name_${index}`">
                                <div class="absolute top-0 right-0 left-0 bottom-0 bg-purple-700 opacity-50 rounded-3xl z-10"></div>
                                <div class="z-20 bg-white grid grid-cols-6 items-center p-2 rounded-xl mx-3 mb-3">
                                    <p class="col-span-5 text-purple-700 font-bold">{{ book.name }}</p>
                                    <div class="col-span-1">
                                        <button @click="openShowModal(book)" class="rounded-full bg-orange-400 hover:bg-orange-500 hover:cursor-pointer h-10 w-10 p-3">
                                            <svg class="w-4 h-4 stroke-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12h15m0 0l-6.75-6.75M19.5 12l-6.75 6.75" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </template>
                        </div>
                    </template>
                    <template v-else>
                        <div class="border-2 border-dashed border-gray-400 h-[400px] rounded-3xl bg-gray-100 relative grid h-fit gap-5 py-10 px-8">
                            <div class="flex justify-center h-fit">
                                <div class="h-[100px] w-[100px] bg-contain bg-no-repeat invert opacity-20" style="background-image: url('src/assets/images/no_books.png')"></div>
                            </div>
                            <h3 class="text-gray-700 text-3xl font-bold text-center">No books found!</h3>
                            <p class="text-gray-700 text-md text-center">We are sorry for the inconvenience! <br />Please check again in a few hours</p>
                        </div>
                        <div class="border-4 border-transparent h-[400px] rounded-3xl bg-purple-700 relative grid py-10 px-8">
                            <h3 class="text-white text-3xl font-bold text-center">New book?</h3>
                            <p class="text-white text-md text-center">If you are an admin, please click the next button to upload a new book</p>
                            <div class="flex justify-center">
                                <button class="rounded-full bg-orange-400 hover:bg-orange-500 hover:cursor-pointer h-20 w-20 items-center flex justify-center">
                                    <svg class="w-10 h-10 stroke-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m6-6H6" />
                                    </svg>
                                </button>
                            </div>
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
    name: 'HomeComponent',
    computed: {
        ...mapGetters(['books']),
    },
    data() {
        return {
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
            showBookName: '',
        }
    },
    created() {
        this.$store.dispatch('getBooks')
    },
    methods: {
        openShowModal(book) {
            this.$store.dispatch('toggleShowModal', { opened: true, itemToShow: book })
        },
        hoveredBook(index) {
            this.showBookName = `show_book_name_${index}`
        },
        hoverExit() {
            this.showBookName = ''
        },
    },
}
</script>
