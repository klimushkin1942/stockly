<template>
    <div>
        <div class="mb-4">
            <Link
                :href="route('admin.products.create')"
                class="inline-block py-2 px-3 bg-blue-500 border-sky-700 text-white rounded hover:bg-blue-600 transition duration-200"
            >
                Добавить
            </Link>

            <div>
                <table class="table border-collapse table-auto w-full text-sm mt-2 rounded-lg overflow-hidden">
                    <thead>
                    <tr class="dark:bg-slate-600">
                        <th class="border-b font-medium p-4 pb-3 text-slate-400 dark:text-slate-200 text-left">
                            ID
                        </th>
                        <th class="border-b font-medium p-4 pb-3 text-slate-400 dark:text-slate-200 text-left">
                            Заголовок
                        </th>
                        <th class="border-b font-medium p-4 pb-3 text-slate-400 dark:text-slate-200 text-left">
                            Артикул
                        </th>
                        <th class="border-b font-medium p-4 pb-3 text-slate-400 dark:text-slate-200 text-left">
                            Цена
                        </th>
                        <th class="border-b font-medium p-4 pb-3 text-slate-400 dark:text-slate-200 text-left">
                            Склад
                        </th>
                        <th class="border-b font-medium p-4 pb-3 text-slate-400 dark:text-slate-200 text-left">
                            Действие
                        </th>
                    </tr>
                    </thead>
                    <tbody class="dark:bg-slate-800">
                    <tr v-for="product in productsData" :key="product.id">
                        <td class="border-b border-slate-100 dark:border-slate-700 p-4 text-slate-500 dark:text-slate-200">
                            {{ product.id }}
                        </td>
                        <td class="border-b border-slate-100 dark:border-slate-700 p-4 text-slate-500 dark:text-slate-200 hover:dark:bg-slate-600 transition duration-200">
                            <Link :href="route('admin.products.show', product.id)">
                                {{ product.title }}
                            </Link>
                        </td>
                        <td class="border-b border-slate-100 dark:border-slate-700 p-4 text-slate-500 dark:text-slate-200 hover:dark:bg-slate-600 transition duration-200">
                            {{ product.article }}
                        </td>
                        <td class="border-b border-slate-100 dark:border-slate-700 p-4 text-slate-500 dark:text-slate-200">
                            {{ product.price }} ₽
                        </td>
                        <td class="border-b border-slate-100 dark:border-slate-700 p-4 text-slate-500 dark:text-slate-200">
                            {{ product.count }}
                        </td>
                        <td class="border-b border-slate-100 dark:border-slate-700 p-4 text-slate-500 dark:text-slate-400">
                            <Link :href="route('admin.products.edit', product.id)">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                     stroke-width="1.5"
                                     stroke="currentColor" class="size-5 text-emerald-600 cursor-pointer mb-1">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                          d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10"/>
                                </svg>
                            </Link>

                            <svg @click.prevent="deleteProduct(product)" xmlns="http://www.w3.org/2000/svg"
                                 fill="none"
                                 viewBox="0 0 24 24" stroke-width="1.5"
                                 stroke="currentColor" class="size-5 cursor-pointer text-red-600">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0"/>
                            </svg>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>

<script>
import AdminLayout from "@/Layouts/AdminLayout.vue";
import {Link} from "@inertiajs/vue3";

export default {
    name: 'Index',

    layout: AdminLayout,

    props: {
        products: Array
    },
    components: {
        Link
    },
    data() {
        return {
            productsData: this.products
        }
    },
    methods: {
        deleteProduct(product) {
            axios.delete(route('admin.products.destroy', product.id))
                .then(response => {
                    this.productsData = this.productsData.filter(productData => productData.id !== product.id);
                })
        }
    }
}
</script>


<style scoped>

</style>
