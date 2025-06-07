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
                <transition-group
                    name="image-list"
                    tag="div"
                    class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4"
                >
                    <div
                        v-for="image in product.images"
                        :key="image.id"
                        class="relative overflow-hidden rounded-lg shadow-lg group image-item"
                    >
                        <img
                            :src="image.url"
                            :alt="product.title"
                            class="w-full h-auto object-cover transition-transform duration-200 hover:scale-105"
                        />

                        <button
                            class="absolute top-2 right-2 p-1 bg-white/80 rounded-full hover:bg-white transition"
                            @click.prevent="deleteImage(image)"
                        >
                            <svg
                                width="24"
                                height="24"
                                viewBox="0 0 32 32"
                                fill="red"
                                class="hover:scale-110 transition-transform"
                            >
                                <path
                                    d="M16,2A14,14,0,1,0,30,16,14,14,0,0,0,16,2Zm0,26A12,12,0,1,1,28,16,12,12,0,0,1,16,28Z"></path>
                                <polygon
                                    points="19.54 11.05 16 14.59 12.46 11.05 11.05 12.46 14.59 16 11.05 19.54 12.46 20.95 16 17.41 19.54 20.95 20.95 19.54 17.41 16 20.95 12.46 19.54 11.05"></polygon>
                            </svg>
                        </button>
                    </div>
                </transition-group>
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
                    <a href="#" @click.prevent="setParam"
                       class="inline-block py-2 px-3 bg-blue-500 border-sky-700 text-white rounded hover:bg-blue-600 transition duration-200">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                             stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/>
                        </svg>
                    </a>
                </div>
            </div>

            <div class="mb-4">
                <div v-for="paramEntries in entries.params" class="flex items-center">
                    <div class="mr-2">
                        {{ paramEntries.title }} - {{ paramEntries.value }}
                    </div>
                    <div @click.prevent="deleteParam(paramEntries)">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                             stroke="red" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="m9.75 9.75 4.5 4.5m0-4.5-4.5 4.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                        </svg>
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
        productGroups: Array,
        params: Array
    },
    data() {
        return {
            paramOption: {
                paramObject: {}
            },
            success: false,
            entries: {
                product: this.product,
                images: null,
                _method: 'patch',
                params: this.product.params
            }
        }
    },
    methods: {
        updateProduct() {
            axios.post(route('admin.products.update', this.product.id), this.entries, {
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
            })
                .then(response => {
                    this.product.images = response.data.images;

                    this.$nextTick(() => {
                        this.success = true;

                        setTimeout(() => {
                            this.success = false;
                        }, 2000);
                    });
                })
                .catch(error => {
                    console.error("Ошибка обновления:", error);
                });
        },
        setImages(event) {
            this.entries.images = event.target.files;
        },
        deleteImage(image) {
            const imageElement = event.target.closest('.image-item');
            if (imageElement) {
                imageElement.classList.add('removing');
            }

            setTimeout(() => {
                axios.delete(route('admin.images.destroy', image.id))
                    .then(() => {
                        this.product.images = this.product.images.filter(img => img.id !== image.id);
                    })
                    .catch(error => {
                        if (imageElement) imageElement.classList.remove('removing');
                        console.error("Ошибка удаления:", error);
                    });
            }, 200);
        },
        setParam() {
            this.entries.params.push({
                id: this.paramOption.paramObject.id,
                title: this.paramOption.paramObject.title,
                value: this.paramOption.value
            })
        },
        deleteParam(paramEntries) {
            this.entries.params = this.entries.params.filter(
                (param) => param !== paramEntries
            );
        }
    },

    watch: {
        entries: {
            handler() {
                this.success = false;
            },
            deep: true
        }
    }

}
</script>


<style scoped>
/* Существующие стили */
.fade-enter-active, .fade-leave-active {
    transition: opacity 0.3s ease-in-out;
}

.fade-enter-from, .fade-leave-to {
    opacity: 0;
}

/* Новые стили для анимации изображений */
.image-list-move {
    transition: transform 0.3s ease;
}

.image-item {
    transition: all 0.3s ease;
}

.image-item.removing {
    transform: scale(0.8);
    opacity: 0;
}

.image-item:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
}

.image-list-enter-active, .image-list-leave-active {
    transition: all 0.3s ease;
}

.image-list-enter-from, .image-list-leave-to {
    opacity: 0;
    transform: translateY(30px);
}
</style>
