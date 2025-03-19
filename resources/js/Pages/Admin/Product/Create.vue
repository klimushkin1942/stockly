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

        <div>
            <div class="mb-4">
                <input type="text"
                       v-model="entries.product.title"
                       class="border border-gray-600 p-2 rounded w-1/4"
                       placeholder="Заголовок"
                >
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
                <select class="border border-gray-600 p-2 rounded w-1/4" v-model="entries.product.category_id">
                    <option :value="null" disabled selected>Выберите категорию</option>
                    <option v-for="category in categories" :value="category.id">
                        {{ category.title }}
                    </option>
                </select>
            </div>
            <div class="mb-4">
                <select class="border border-gray-600 p-2 rounded w-1/4" v-model="entries.product.product_group_id">
                    <option :value="null" disabled selected>Выберите группу товаров</option>
                    <option v-for="productGroup in productGroups" :value="productGroup.id">
                        {{ productGroup.title }}
                    </option>
                </select>
            </div>
            <!--            <div class="mb-4">-->
            <!--                <input type="file"-->
            <!--                       v-model="entries.images"-->
            <!--                       class="border border-gray-600 p-2 rounded w-1/4"-->
            <!--                >-->
            <!--            </div>-->
            <!--            <div class="mb-4">-->
            <!--                <select class="border border-gray-600 p-2 rounded w-1/4" v-model="entries.params">-->
            <!--                    <option :value="null" disabled selected>Выберите родительский товар</option>-->
            <!--                    <option v-for="productGroup in productGroups" :value="productGroup.id">-->
            <!--                        {{ productGroup.title }}-->
            <!--                    </option>-->
            <!--                </select>-->
            <!--            </div>-->
            <div>
                <div class="mb-4">
                    <a href="#"
                       @click.prevent="storeProduct"
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
        categories: Array,
        productGroups: Array
    },

    data() {
        return {
            entries: {
                product: {
                    category_id: null,
                    product_group_id: null
                },
                images: null,
                params: []
            },
            success: false
        }
    },

    methods: {
        storeProduct() {
            axios.post(route('admin.products.store'), this.entries)
                .then(response => {
                    console.log(response);
                    this.entries.product = {
                        category_id: null,
                        product_group_id: null
                    }
                })
        }
    }
}
</script>


<style>

</style>
