<template>
    <div>
        <div class="mb-4">
            <Link
                :href="route('admin.products.index')"
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
                       v-model="entries.product.title"
                       class="border border-gray-600 p-2 rounded w-1/4"
                       placeholder="Заголовок">
            </div>
            <div class="mb-4">
                <textarea type="text"
                          v-model="entries.product.description"
                          class="border border-gray-600 p-2 rounded w-1/4"
                          placeholder="Описание"
                />
            </div>
            <div class="mb-4">
                <input type="text"
                       v-model="entries.product.content"
                       class="border border-gray-600 p-2 rounded w-1/4"
                       placeholder="Контент"
                >
            </div>
            <div class="mb-4">
                <input type="number"
                       v-model="entries.product.price"
                       class="border border-gray-600 p-2 rounded w-1/4"
                       placeholder="Цена"
                >
            </div>
            <div class="mb-4">
                <input type="number"
                       v-model="entries.product.discount_price"
                       class="border border-gray-600 p-2 rounded w-1/4"
                       placeholder="Цена со скидкой"
                >
            </div>
            <div class="mb-4">
                <input type="number"
                       v-model="entries.product.count"
                       class="border border-gray-600 p-2 rounded w-1/4"
                       placeholder="Количество"
                >
            </div>
            <div class="mb-4">
                <select class="border border-gray-600 p-2 rounded w-1/4" v-model="entries.product.product_group_id">
                    <option :value="null" disabled selected>Выберите группу товаров</option>
                    <option v-for="productGroup in productGroups" :value="productGroup.id">
                        {{ productGroup.title }}
                    </option>
                </select>
            </div>
            <div class="mb-4">
                <select class="border border-gray-600 p-2 rounded w-1/4" v-model="product.category_id">
                    <option :value="null" disabled selected>Выберите категорию</option>
                    <option v-for="category in categories" :value="category.id">
                        {{ category.title }}
                    </option>
                </select>
            </div>
            <div class="mb-4">
                <input type="file"
                       multiple
                       @change="setImages"
                       class="border border-gray-600 p-2 rounded w-1/4"
                >
            </div>
            <div class="mt-6 mb-2">
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                    <div v-for="image in product.images" :key="image.id" class="relative overflow-hidden rounded-lg shadow-lg">
                        <img :src="image.url" :alt="product.title" class="w-full h-auto object-cover transition-transform duration-200 hover:scale-105" />
                    </div>
                </div>
            </div>
            <div>
                <div class="mb-4">
                    <a href="#"
                       @click.prevent="updateProduct"
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
        product: Object,
        categories: Array,
        productGroups: Array
    },
    data() {
        return {
            success: false,
            entries: {
                product: this.product,
                images: null
            }
        }
    },
    methods: {
        updateProduct() {
            axios.patch(route('admin.products.update', this.product.id), this.entries)
                .then(response => {
                    this.success = true;
                    setTimeout(() => {
                        this.success = false;
                    }, 2000);
                })
        },
        setImages(event) {
            // console.log(event.target.files);
            this.entries.images = event.target.files;
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
