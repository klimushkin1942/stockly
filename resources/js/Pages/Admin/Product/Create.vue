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
                <input type="text"
                       v-model="entries.product.article"
                       class="border border-gray-600 p-2 rounded w-1/4"
                       placeholder="Артикул"
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
            <div class="mb-4">
                <input ref="image_input"
                       type="file"
                       multiple
                       @change="setImages"
                       class="border border-gray-600 p-2 rounded w-1/4"
                >
            </div>

            <div class="mb-4 flex">
                <div class="mr-2">
                    <select v-model="paramOption.paramObject" class="border border-gray-600 p-2 rounded p-2 pr-8">
                        <option :value="{}" disabled selected>Выберите характеристику</option>
                        <option v-for="param in params" :value="param">
                            {{ param.title }}
                        </option>
                    </select>
                </div>
                <div class="mr-2">
                    <input v-model="paramOption.value" type="text" placeholder="Значение"
                           class="border border-gray-600 p-2 rounded">
                </div>
                <div>
                    <a href="#" @click.prevent="setParam" class="inline-block bg-white border-gray-200 px-3 py-2">+</a>
                </div>
            </div>

            <div class="mb-4">
                <div v-for="paramEntries in entries.params">
                    {{ paramEntries.title }} - {{ paramEntries.value }}
                </div>
            </div>

            <div>
                <div>
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
        productGroups: Array,
        params: Array
    },

    data() {
        return {
            paramOption: {
                paramObject: {}
            },
            entries: {
                product: {
                    category_id: null,
                    product_group_id: null
                },
                images: Array,
                params: []
            },
            success: false
        }
    },

    methods: {
        storeProduct() {
            axios.post(route('admin.products.store'), this.entries, {
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
            })
                .then(response => {
                    this.entries = {
                        product: {
                            category_id: null,
                            product_group_id: null
                        },
                        images: [],
                        params: []
                    }
                    this.$refs.image_input.value = null;
                })
        },
        setImages(event) {
            this.entries.images = event.target.files;
        },
        setParam() {
            this.entries.params.push({
                id: this.paramOption.paramObject.id,
                title: this.paramOption.paramObject.title,
                value: this.paramOption.value
            })
        }
    }
}
</script>


<style>

</style>
