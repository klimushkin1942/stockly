<template>
    <section class="w-full p-4 border-b border-gray-100">
        <header>
            <nav class="flex justify-between items-center">
                <strong class="mx-auto">Stockly Admin</strong>
                <button @click="toggleSidebar" class="p-2 focus:outline-none">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
            </nav>
        </header>
    </section>
    <section class="flex">
        <aside
            :class="[
                'transition-all duration-300 ease-in-out overflow-hidden',
                isSidebarOpen ? 'w-64' : 'w-16',
                'min-h-screen dark:bg-slate-800'
            ]"
        >
            <nav>
                <Link
                    v-for="link in links"
                    :key="link.name"
                    :href="route(link.route)"
                    class="flex items-center p-4 text-gray-50 border-b border-gray-600 transition-all duration-200 hover:bg-slate-700"
                >
                    <span class="text-lg mr-3 flex-shrink-0">{{ link.icon }}</span>
                    <span
                        class="whitespace-nowrap overflow-hidden transition-all duration-300"
                        :class="isSidebarOpen ? 'opacity-100 max-w-xs' : 'opacity-0 max-w-0'"
                    >
                        {{ link.name }}
                    </span>
                </Link>
            </nav>
        </aside>
        <article class="flex-1 bg-gray-50 p-4">
            <slot />
        </article>
    </section>
    <section>
        <footer></footer>
    </section>
</template>

<script setup>
import {ref} from 'vue';
import {Link} from '@inertiajs/vue3';

const isSidebarOpen = ref(true);

const toggleSidebar = () => {
    isSidebarOpen.value = !isSidebarOpen.value;
};

const links = [
    {name: 'Дашбоард', route: 'dashboard', icon: '🏠'},
    {name: 'Группа товаров', route: 'admin.product-groups.index', icon: '📦'},
    {name: 'Товары', route: 'admin.products.index', icon: '🛒'},
    {name: 'Категории', route: 'admin.categories.index', icon: '📂'},
    {name: 'Параметры поиска', route: 'admin.params.index', icon: '🔍'},
];
</script>

<style scoped>
/* Можно добавить дополнительные стили при необходимости */
</style>
