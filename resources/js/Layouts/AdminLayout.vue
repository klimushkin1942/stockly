<template>
    <section class="w-full p-4 border-b border-gray-100">
        <header>
            <nav class="flex justify-between items-center">
                <strong>Stockly Admin</strong>
                <!-- Кнопка бургер (видна всегда) -->
                <button @click="toggleSidebar" class="p-2 focus:outline-none">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
            </nav>
        </header>
    </section>
    <section class="flex">
        <!-- Боковая панель -->
        <aside
            :class="[
        'transition-all duration-300 ease-in-out',
        isSidebarOpen ? 'w-1/6' : 'w-16',
        'min-h-screen dark:bg-slate-800 rounded-sm'
      ]"
        >
            <nav>
                <!-- Ссылки -->
                <Link
                    v-for="link in links"
                    :key="link.name"
                    :href="route(link.route)"
                    class="block p-4 text-gray-50 border-b border-gray-600 transition-all duration-200 ease-in-out transform hover:bg-slate-700 active:scale-95 active:bg-slate-600"
                >
                    {{ isSidebarOpen ? link.name : link.icon }} <!-- Показываем иконку или текст -->
                </Link>
            </nav>
        </aside>
        <!-- Основной контент -->
        <article class="flex-1 bg-gray-50 p-4">
            <slot />
        </article>
    </section>
    <section>
        <footer></footer>
    </section>
</template>

<script setup>
import { ref } from 'vue';
import { Link } from '@inertiajs/vue3';

// Состояние для управления видимостью боковой панели
const isSidebarOpen = ref(true);

// Функция для переключения состояния
const toggleSidebar = () => {
    isSidebarOpen.value = !isSidebarOpen.value;
};

// Ссылки для боковой панели
const links = [
    { name: 'Дашбоард', route: 'dashboard', icon: '🏠' },
    { name: 'Группа товаров', route: 'admin.product-groups.index', icon: '📦' },
    { name: 'Товары', route: 'admin.products.index', icon: '🛒' },
    { name: 'Категории', route: 'admin.categories.index', icon: '📂' },
    { name: 'Параметры поиска', route: 'admin.params.index', icon: '🔍' },
];
</script>

<style scoped>
/* Дополнительные стили, если нужно */
</style>
