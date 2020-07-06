<template>
    <div class="w-full">
        <div class="my-2 flex sm:flex-row flex-col justify-between">
            <div class="block relative">
                <span class="h-full absolute inset-y-0 left-0 flex items-center pl-2">
                    <svg viewBox="0 0 24 24" class="h-4 w-4 fill-current text-gray-500">
                        <path d="M10 4a6 6 0 100 12 6 6 0 000-12zm-8 6a8 8 0 1114.32 4.906l5.387 5.387a1 1 0 01-1.414 1.414l-5.387-5.387A8 8 0 012 10z"/>
                    </svg>
                </span>
                <label>
                    <input v-model="query.search"
                           type="search"
                           placeholder="Search"
                           class="appearance-none rounded border border-gray-100 border-b block pl-8 pr-6 py-2 w-full bg-white text-sm placeholder-gray-400 text-gray-700 focus:bg-white focus:placeholder-gray-600 focus:text-gray-700 focus:outline-none"
                           @input="handleOnChange">
                </label>
            </div>

            <div class="flex flex-row mb-1 sm:mb-0">
                <div v-if="paginationData" class="relative">
                    <label>
                        <select
                            v-model="query.per_page"
                            class="cursor-pointer appearance-none h-full rounded border block appearance-none w-full bg-white border-gray-100 text-gray-700 py-2 px-4 pr-8 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                            @input="handleOnChange">
                            <option v-for="size in $page.staticData.paginate_sizes"
                                    :key="size"
                                    :value="size"
                                    :selected="size === paginationData.per_page"
                                    v-text="size"/>
                        </select>
                    </label>
                    <div
                        class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                            <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/>
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <div class="-mx-4 sm:-mx-8 px-4 sm:px-8 py-4">
            <div class="block min-w-full shadow rounded-lg overflow-x-auto">
                <table class="w-full leading-normal text-gray-900 ">
                    <thead>
                        <tr>
                            <th v-if="hasSnRow"
                                class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider"
                                v-text="'S.N.'"/>

                            <slot name="thead" :column="columns">
                                <th v-for="(label, key) in columns"
                                    :key="`datatable-thead-th-${key}`"
                                    class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider"
                                    v-text="label"/>
                            </slot>
                        </tr>
                    </thead>

                    <tbody>
                        <tr v-for="(row, index) in rows"
                            :key="`datatable-tbody-${index}`">
                            <td v-if="hasSnRow"
                                class="px-5 py-5 border-b border-gray-200 bg-white text-sm"
                                v-text="index + 1 + (paginationData && (paginationData.per_page * (paginationData.current_page - 1)))"/>

                            <slot name="tbody" :row="row" :index="index">
                                <td v-for="(_, key) in columns"
                                    :key="`datatable-tbody-td-${key}`"
                                    class="px-5 py-5 border-b border-gray-200 bg-white text-sm"
                                    v-text="row[key]"/>
                            </slot>
                        </tr>
                    </tbody>
                </table>

                <div v-if="paginationData && paginationData.total_pages > 1" class="px-5 py-5 bg-white border-t flex flex-col xs:flex-row items-center xs:justify-between">
                    <pagination
                        :pagination="paginationData"
                        :current-page="query.page"
                        @pagechanged="onPageChange"/>
                </div>
            </div>
        </div>
    </div>
</template>

<script type="text/ecmascript-6">
    import { isEmpty } from "lodash"
    import {
        isArray,
        isObject,
    }                  from "../../utils"
    import Pagination  from "./Pagination"

    export default {
        name: "DataTable",

        components: { Pagination },

        props: {
            tableData: { type: [Array, Object], required: true },
            queries: { type: [Object], required: false, default: () => ({}) },
            hasSnRow: { type: Boolean, required: false, default: true },
            pagination: { type: Object, required: false, default: () => ({}) },
        },

        data: () => ({
            query: {
                page: 1,
                search: "",
                per_page: 10,
            },
        }),

        watch: {
            queries: {
                handler(queries) {
                    this.$set(this, "query", { ...this.query, ...queries })
                },
                immediate: true,
            },

            paginationData: {
                handler(pagination) {
                    if (pagination) {
                        this.$set(this.query, "per_page", pagination.per_page)
                    }
                },
                immediate: true,
            },

            "query.page": {
                handler(page) {
                    this.$set(this.query, "page", parseInt(page))
                },
                immediate: true,
            },
        },

        computed: {
            columns: function() {
                if (this.rows.length === 0) {
                    return {}
                }

                return Object.entries(this.rows[0]).reduce((cols, [key, _]) => ({ ...cols, [key]: key }), {})
            },

            rows: function() {
                if (isArray(this.tableData)) {
                    return this.tableData
                }

                return Object.entries(this.tableData).reduce((rows, [key, d]) => {
                    if (key === "meta") {
                        return [...rows]
                    }

                    return [...rows, d]
                }, [])
            },

            paginationData: function() {
                if (!isEmpty(this.pagination)) {
                    return this.pagination
                }

                if (isObject(this.tableData) && this.tableData.meta) {
                    return this.tableData.meta.pagination || null
                }

                return null
            },
        },

        methods: {
            onPageChange(page) {
                this.$set(this.query, "page", page)
                this.handleOnChange()
            },

            handleOnChange() {
                this.$emit("loaddata", this.query)
            },
        },
    }
</script>
