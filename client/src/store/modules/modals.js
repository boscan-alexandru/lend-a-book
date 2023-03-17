const modals = {
    state: () => ({
        confirm_deletion_modal: {
            opened: false,
            itemToDelete: null,
        },
        confirm_return_book_modal: {
            opened: false,
            itemToReturn: null,
        },
        show_modal: {
            opened: false,
            itemToShow: null,
        },
        edit_modal: {
            opened: false,
            itemToEdit: null,
        },
    }),
    mutations: {
        setShowModal: function (state, show_modal) {
            state.show_modal = show_modal
        },
        setEditModal: function (state, edit_modal) {
            state.edit_modal = edit_modal
        },
        setConfirmDeletionModal: function (state, delete_modal) {
            state.confirm_deletion_modal = delete_modal
        },
        setConfirmReturnBookModal: function (state, confirm_return_book_modal) {
            state.confirm_return_book_modal = confirm_return_book_modal
        },
    },
    actions: {
        toggleShowModal({ commit }, show_modal) {
            commit('setShowModal', show_modal)
        },
        toggleEditModal({ commit }, edit_modal) {
            commit('setEditModal', edit_modal)
        },
        toggleConfirmDeletionModal({ commit }, delete_modal) {
            commit('setConfirmDeletionModal', delete_modal)
        },
        toggleConfirmReturnBookModal({ commit }, return_book_modal) {
            commit('setConfirmReturnBookModal', return_book_modal)
        },
    },
    getters: {
        confirm_deletion_modal: (state) => state.confirm_deletion_modal,
        confirm_return_book_modal: (state) => state.confirm_return_book_modal,
        show_modal: (state) => state.show_modal,
        edit_modal: (state) => state.edit_modal,
    },
}
export default modals
