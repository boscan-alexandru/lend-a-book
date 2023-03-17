<template>
    <div class="fixed w-full h-full top-0 left-0 flex items-center justify-center z-[999999]" v-if="open">
        <div class="bg-white overflow-hidden rounded-3xl px-4 py-4 z-[6001]" :class="width">
            <div class="flex items-center mb-2" :class="classesBySlotPresent">
                <!-- title Slot-->
                <slot name="title" />
                <div
                    @click="close"
                    class="text-2xl bg-gray-100 hover:bg-gray-200 p-3 rounded-full h-10 w-10 text-violet-500 hover:cursor-pointer select-none flex leading-none items-center flex justify-center"
                >
                    &#215;
                </div>
            </div>
            <!-- Content Slot-->
            <slot name="content" />
            <slot name="footer" />
        </div>
        <div class="absolute w-full h-full bg-gray-900 opacity-50 z-[6000]"></div>
    </div>
</template>

<script>
export default {
    name: 'VueModal',
    data() {
        return {
            open: true,
        }
    },
    props: {
        type: {
            type: String,
            default: 'info',
        },
        width: {
            type: String,
            default: 'basis-full',
        },
    },
    methods: {
        close() {
            this.open = false
            this.$emit('close')
        },
    },
    computed: {
        color() {
            return `text-${this.shade}-600`
        },
        classesBySlotPresent() {
            if (this.$slots.title) {
                return 'justify-between'
            } else {
                return 'justify-end'
            }
        },
    },
    mounted() {
        const onEscape = (e) => {
            if (e.key === 'Esc' || e.key === 'Escape') {
                this.close()
            }
        }
        document.addEventListener('keydown', onEscape)
    },
}
</script>
