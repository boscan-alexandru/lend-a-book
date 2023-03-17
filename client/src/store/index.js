// store/index.js
import { createStore } from 'vuex'
import modals from './modules/modals'
import books from './modules/books'

export default createStore({
    modules: {
        modals,
        books,
    },
})
