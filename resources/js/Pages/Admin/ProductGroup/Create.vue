<template>
    <div>
        <div class="mb-4">
            <Link
                :href="route('admin.product-groups.index')"
                class="inline-block py-2 px-3 bg-blue-500 border-sky-700 text-white rounded hover:bg-blue-600 transition duration-200"
            >
                Назад
            </Link>
        </div>
        <transition name="fade">
            <div v-if="success" class="p-4 bg-green-500 rounded mb-4 text-white">
                Успешное создание!
            </div>
        </transition>

        <div>
            <div class="mb-4">
                <input type="text"
                       v-model="productGroup.title"
                       class="border border-gray-600 p-2 rounded w-1/4"
                       placeholder="Заголовок">
            </div>

            <div>
                <div class="mb-4">
                    <a href="#"
                       @click.prevent="storeProductGroup"
                       class="inline-block py-2 px-3 bg-blue-500 border-sky-700 text-white rounded hover:bg-blue-600 transition duration-200"
                    >
                        Создать
                    </a>
                </div>
            </div>
        </div>
    </div>
</template>


<script>
import AdminLayout from "@/Layouts/AdminLayout.vue";
import {Link} from "@inertiajs/vue3";

export default {
    name: 'Create',

    layout: AdminLayout,
    components: {
        Link
    },

    props: {
        filterTypes: Array
    },

    data() {
        return {
            productGroup: {},
            success: false
        }
    },

    methods: {
        storeProductGroup() {
            axios.post(route('admin.product-groups.store'), this.productGroup)
                .then(response => {
                    this.productGroup = {}

                    this.success = true;
                    setTimeout(() => {
                        this.success = false;
                    }, 2000);
                })
        }
    },

    watch: {
        param: {
            handler(newVal, oldVal) {
                this.success = false;
            },
            deep: true
        }
    }
}
</script>


<style>
.fade-enter-active, .fade-leave-active {
    transition: opacity 0.5s ease-in-out;
}

.fade-enter-from, .fade-leave-to {
    opacity: 0;
}
</style>
