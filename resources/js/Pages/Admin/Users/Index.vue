<template>
    <admin-layout>
        <template #header>
            <div class="md:flex md:items-center md:justify-between">
                <div class="flex-1 min-w-0">
                    <h1 class="text-2xl font-semibold leading-tight text-gray-800">
                        Người dùng
                    </h1>
                </div>
                <div class="mt-4 flex md:mt-0 md:ml-4">
                    <inertia-link
                        :href="route('admin.users.create')"
                        class="inline-flex items-center px-3 py-2 border border-transparent leading-4 rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                    >
                        <svg
                            class="-ml-0.5 mr-2 w-4 h-4"
                            xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 20 20"
                            fill="currentColor"
                        >
                            <path
                                fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v2H7a1 1 0 100 2h2v2a1 1 0 102 0v-2h2a1 1 0 100-2h-2V7z"
                                clip-rule="evenodd"
                            />
                        </svg>
                        Thêm mới
                    </inertia-link>
                </div>
            </div>
        </template>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="-ml-4 -mt-4 px-4 sm:px-0 flex justify-between items-center flex-wrap sm:flex-no-wrap">
                    <div class="ml-4 my-4 w-full max-w-md">
                        <bolt-search-filter
                            v-model="form.search"
                            @reset="reset"
                        />
                    </div>
                </div>

                <div class="overflow-hidden shadow sm:rounded-lg">
                    <div class="relative">
                        <div class="overflow-hidden overflow-x-auto relative">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th
                                            scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                                        >
                                            Thông tin
                                        </th>
                                        <th
                                            scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                                        >
                                            Điện thoại
                                        </th>
                                        <th
                                            scope="col"
                                            class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider"
                                        >
                                            Đơn hàng
                                        </th>
                                        <th
                                            scope="col"
                                            class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider"
                                        >
                                            Tham gia
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    <tr
                                        v-for="user in users.data"
                                        :key="user.id"
                                        class="hover:bg-gray-100 focus-within:bg-gray-100"
                                    >
                                        <td class="whitespace-nowrap">
                                            <inertia-link
                                                :href="route('admin.users.show', user.id)"
                                                class="px-6 py-4 flex items-center"
                                            >
                                                <div class="flex-shrink-0 h-10 w-10">
                                                    <svg
                                                        class="h-10 w-10 fill-current text-gray-400 rounded-full bg-gray-200 p-1"
                                                        xmlns="http://www.w3.org/2000/svg"
                                                        fill="none"
                                                        viewBox="0 0 24 24"
                                                        stroke="currentColor"
                                                    >
                                                        <path
                                                            stroke-linecap="round"
                                                            stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"
                                                        />
                                                    </svg>
                                                </div>
                                                <div class="ml-4">
                                                    <div class="text-sm font-medium text-gray-900">
                                                        {{ user.name }}
                                                    </div>
                                                    <div class="flex items-center text-sm text-gray-500">
                                                        <span
                                                            v-if="user.email_verified_at != null"
                                                            class="inline-block h-4 w-4 rounded-full text-green-400"
                                                        >
                                                            <svg
                                                                xmlns="http://www.w3.org/2000/svg"
                                                                fill="none"
                                                                viewBox="0 0 24 24"
                                                                stroke="currentColor"
                                                            >
                                                                <path
                                                                    stroke-linecap="round"
                                                                    stroke-linejoin="round"
                                                                    stroke-width="2"
                                                                    d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"
                                                                />
                                                            </svg>
                                                        </span>
                                                        <span class="ml-1">
                                                            {{ user.email }}
                                                        </span>
                                                    </div>
                                                </div>
                                            </inertia-link>
                                        </td>
                                        <td class="whitespace-nowrap tabular-nums">
                                            <inertia-link
                                                :href="route('admin.users.show', user.id)"
                                                class="px-6 py-4 flex items-center"
                                            >
                                                {{ user.phone }}
                                            </inertia-link>
                                        </td>
                                        <td class="whitespace-nowrap tabular-nums">
                                            <inertia-link
                                                :href="route('admin.users.show', user.id)"
                                                class="px-6 py-4 flex items-center justify-center"
                                            >
                                                {{ user.orders_count }}
                                            </inertia-link>
                                        </td>
                                        <td class="whitespace-nowrap tabular-nums">
                                            <inertia-link
                                                :href="route('admin.users.show', user.id)"
                                                class="px-6 py-4 flex items-center justify-end"
                                            >
                                                {{ dateFilter(user.created_at) }}
                                            </inertia-link>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <!-- Pagination -->
                        <bolt-pagination-simple
                            :from="users.from"
                            :to="users.to"
                            :total="users.total"
                            :prev-page-url="users.prev_page_url"
                            :next-page-url="users.next_page_url"
                        />
                    </div>
                </div>
            </div>
        </div>
    </admin-layout>
</template>

<script>
    import AdminLayout from "@/Layouts/AdminLayout";
    import BoltSearchFilter from "@/Components/SearchFilter";
    import BoltPaginationSimple from "@/Components/PaginationSimple";
    import dateFilter from "@/Filters/date";
    import throttle from "lodash/throttle";
    import pickBy from "lodash/pickBy";
    import mapValues from "lodash/mapValues";

    export default {
        name: "UserIndex",
        components: {AdminLayout, BoltSearchFilter, BoltPaginationSimple},
        props: ["users", "filters"],
        data() {
            return {
                form: {
                    search: this.filters.search,
                },
            };
        },
        watch: {
            form: {
                handler: throttle(function () {
                    let query = pickBy(this.form);
                    this.$inertia.replace(route('admin.users.index', Object.keys(query).length ? query : {}));
                }, 500),
                deep: true,
            },
        },
        methods: {
            dateFilter,
            reset() {
                this.form = mapValues(this.form, () => null);
            },
        },
    };
</script>
