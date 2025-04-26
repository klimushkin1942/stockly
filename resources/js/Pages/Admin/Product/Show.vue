<template>
    <div>
        <div class="mb-4">
            <Link
                :href="route('admin.products.index')"
                class="inline-block py-2 px-3 bg-blue-500 border-sky-700 text-white rounded hover:bg-blue-600 transition duration-200"
            >
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                     stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 15.75 3 12m0 0 3.75-3.75M3 12h18"/>
                </svg>
            </Link>

            <div class="mt-6">
                <table class="table border-collapse table-auto w-full text-sm rounded-lg overflow-hidden shadow-lg">
                    <tbody class="dark:bg-slate-800">
                    <tr>
                        <td class="border-b border-slate-100 dark:border-slate-700 p-4 text-slate-500 dark:text-slate-400">
                            ID
                        </td>
                        <td class="border-b border-slate-100 dark:border-slate-700 p-4 text-slate-500 dark:text-slate-400">
                            {{ product.id }}
                        </td>
                    </tr>

                    <tr>
                        <td class="border-b border-slate-100 dark:border-slate-700 p-4 text-slate-500 dark:text-slate-400">
                            Заголовок
                        </td>
                        <td class="border-b border-slate-100 dark:border-slate-700 p-4 text-slate-500 dark:text-slate-400">
                            {{ product.title }}
                        </td>
                    </tr>
                    <tr>
                        <td class="border-b border-slate-100 dark:border-slate-700 p-4 text-slate-500 dark:text-slate-400">
                            Артикул
                        </td>
                        <td class="border-b border-slate-100 dark:border-slate-700 p-4 text-slate-500 dark:text-slate-400">
                            {{ product.article }}
                        </td>
                    </tr>
                    <tr>
                        <td class="border-b border-slate-100 dark:border-slate-700 p-4 text-slate-500 dark:text-slate-400">
                            Описание
                        </td>
                        <td class="border-b border-slate-100 dark:border-slate-700 p-4 text-slate-500 dark:text-slate-400">
                            {{ product.description }}
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>

            <div class="mt-6">
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                    <div v-for="image in product.images" :key="image.id" class="relative overflow-hidden rounded-lg shadow-lg">
                        <img :src="image.url" :alt="product.title" class="w-full h-auto object-cover transition-transform duration-200 hover:scale-105" />
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import AdminLayout from "@/Layouts/AdminLayout.vue";
import {Link} from "@inertiajs/vue3";

export default {
    name: 'Show',

    layout: AdminLayout,

    props: {
        product: Object
    },
    components: {
        Link
    }
}
</script>

<style scoped>
/* Дополнительные стили, если необходимо */
</style>
