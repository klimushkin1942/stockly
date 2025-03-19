<template>
    <div>
        <div class="mb-4">
            <Link
                :href="route('admin.params.index')"
                class="inline-block py-2 px-3 bg-blue-500 border-sky-700 text-white rounded hover:bg-blue-600 transition duration-200"
            >
                Назад
            </Link>
        </div>

        <div>
            <div class="mb-4">
                <input type="text"
                       v-model="param.title"
                       class="border border-gray-600 p-2 rounded w-1/4"
                       placeholder="Заголовок">
            </div>
            <div class="mb-4">
                <select class="border border-gray-600 p-2 rounded w-1/4" v-model="param.filter_type">
                    <option :value="null" disabled selected>Выберите тип фильтра</option>
                    <option v-for="filterType in filterTypes" :value="filterType.value">
                        {{ filterType.title }}
                    </option>
                </select>
            </div>
            <div>
                <div class="mb-4">
                    <a href="#"
                       @click.prevent="storeParam"
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
            param: {
                filter_type: null,
            }
        }
    },

    methods: {
        storeParam() {
            axios.post(route('admin.params.store'), this.param)
                .then(response => {
                    console.log(response);
                    this.param = {
                        filter_type: null
                    }
                })
        }
    }
}
</script>


<style>

</style>
