import axios from 'axios'
const books = {
    state: () => ({
        book: null,
        books: [],
        borrowed_books: [],
        books_borrowed: [],
    }),
    mutations: {
        addBook: function (state, book) {
            state.books.push(book)
        },
        setBook: function (state, book) {
            state.book = book
        },
        setBooks: function (state, books) {
            state.books = books
        },
        setBorrowedBooks: function (state, books) {
            state.borrowed_books = books
        },
        setBooksBorrowed: function (state, books) {
            state.books_borrowed = books
        },
        removeBook: (state, book_id) => {
            state.books.splice(
                state.books.findIndex((i) => i.id == book_id),
                1
            )
        },
        editBook: (state, book) => {
            state.books.splice(
                state.books.findIndex((i) => i.id == book.id),
                1,
                book
            )
        },
        returnBook: (state, book_id) => {
            state.borrowed_books.splice(
                state.borrowed_books.findIndex((i) => i.id == book_id),
                1
            )
        },
        setConfirmDeletionModal: function (state, delete_modal) {
            state.confirm_deletion_modal = delete_modal
        },
    },
    actions: {
        getBook({ commit }, book_id) {
            return new Promise((resolve, reject) => {
                axios
                    .get(`http://127.0.0.1:8000/api/get-book/${book_id}`)
                    .then(({ data }) => {
                        commit('setBook', data)
                        resolve(data)
                    })
                    .catch(({ response }) => {
                        reject(response)
                    })
            })
        },
        getBooksBorrowed({ commit }) {
            return new Promise((resolve, reject) => {
                axios
                    .get('http://127.0.0.1:8000/api/get-books-borrowed')
                    .then(({ data }) => {
                        commit('setBooksBorrowed', data)
                        resolve(data)
                    })
                    .catch(({ response }) => {
                        reject(response)
                    })
            })
        },
        getBooks({ commit }) {
            return new Promise((resolve, reject) => {
                axios
                    .get('http://127.0.0.1:8000/api/get-books')
                    .then(({ data }) => {
                        commit('setBooks', data)
                        resolve(data)
                    })
                    .catch(({ response }) => {
                        reject(response)
                    })
            })
        },
        deleteBook({ commit }, id) {
            return new Promise((resolve, reject) => {
                axios
                    .delete(`http://127.0.0.1:8000/api/delete-book/${id}`, {
                        method: 'DELETE',
                    })
                    .then(({ data }) => {
                        commit('removeBook', data)
                        resolve(data)
                    })
                    .catch(({ response }) => {
                        reject(response)
                    })
            })
        },
        createBook({ commit }, book) {
            return new Promise((resolve, reject) => {
                axios
                    .post(`http://127.0.0.1:8000/api/create-book/`, book, {
                        'Content-Type': 'multipart/form-data',
                    })
                    .then(({ data }) => {
                        commit('addBook', data)
                        resolve(data)
                    })
                    .catch(({ response }) => {
                        reject(response)
                    })
            })
        },
        editBook({ commit }, book) {
            return new Promise((resolve, reject) => {
                axios
                    .patch(`http://127.0.0.1:8000/api/edit-book/${book.id}`, book, {
                        method: 'PATCH',
                    })
                    .then(({ data }) => {
                        commit('editBook', data)
                        resolve(data)
                    })
                    .catch(({ response }) => {
                        reject(response)
                    })
            })
        },
        borrowBook({ commit }, bookUser) {
            return new Promise(async (resolve, reject) => {
                await axios
                    .post('http://127.0.0.1:8000/api/borrow-book/', bookUser)
                    .then(({ data }) => {
                        resolve(data)
                    })
                    .catch(({ response }) => {
                        reject(response)
                    })
            })
        },
        returnBook({ commit }, book_user) {
            return new Promise((resolve, reject) => {
                axios
                    .post('http://127.0.0.1:8000/api/return-book/', book_user)
                    .then(({ data }) => {
                        commit('returnBook', data)
                        resolve(data)
                    })
                    .catch(({ response }) => {
                        reject(response)
                    })
            })
        },
        getBorrowedBooks({ commit }, user_id) {
            return new Promise((resolve, reject) => {
                axios
                    .get(`http://127.0.0.1:8000/api/get-borrowed-books/${user_id}`)
                    .then(({ data }) => {
                        commit('setBorrowedBooks', data)
                        resolve(data)
                    })
                    .catch(({ response }) => {
                        reject(response)
                    })
            })
        },
    },
    getters: {
        book: (state) => state.book,
        books: (state) => state.books,
        borrowed_books: (state) => state.borrowed_books,
        books_borrowed: (state) => state.books_borrowed,
    },
}
export default books
