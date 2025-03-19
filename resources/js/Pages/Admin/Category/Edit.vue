<template>
    <div>
        <div class="mb-4">
            <Link
                :href="route('admin.categories.index')"
                class="inline-block py-2 px-3 bg-blue-500 border-sky-700 text-white rounded hover:bg-blue-600 transition duration-200"
            >
                Назад
            </Link>
        </div>
        <transition name="fade">
            <div v-if="success" class="p-4 bg-green-500 rounded mb-4 text-white">
                Успешное обновление!
            </div>
        </transition>

        <div>
            <div class="mb-4">
                <input type="text"
                       v-model="category.title"
                       class="border border-gray-600 p-2 rounded w-1/4"
                       placeholder="Заголовок">
            </div>
            <div class="mb-4">
                <select class="border border-gray-600 p-2 rounded w-1/4" v-model="category.parent_id">
                    <option :value="null" disabled selected>Выберите категорию</option>
                    <option v-for="category in categories" :key="category.id" :value="category.id">
                        {{ category.title }}
                    </option>
                </select>
            </div>
            <div>
                <div class="mb-4">
                    <a href="#"
                       @click.prevent="updateCategory"
                       class="inline-block py-2 px-3 bg-blue-500 border-sky-700 text-white rounded hover:bg-blue-600 transition duration-200"
                    >
                        Обновить
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
    name: 'Edit',

    layout: AdminLayout,
    components: {
        Link
    },

    props: {
        category: Object,
        categories: Array
    },
    data() {
        return {
            success: false
        }
    },
    methods: {
        updateCategory() {
            axios.put(route('admin.categories.update', this.category), this.category)
                .then(response => {
                    this.success = true;
                    setTimeout(() => {
                        this.success = false;
                    }, 2000);
                })
        },

        deleteCategory() {
            axios.delete(route('admin.categories.destroy', this.category))
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


<style scoped>
.fade-enter-active, .fade-leave-active {
    transition: opacity 0.5s ease-in-out;
}

.fade-enter-from, .fade-leave-to {
    opacity: 0;
}
</style>
