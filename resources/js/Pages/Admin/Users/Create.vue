<template>
    <admin-layout>
        <template #header>
            <div class="md:flex md:items-center md:justify-between">
                <div class="flex-1 min-w-0">
                    <h1 class="text-2xl font-semibold leading-tight text-gray-800">
                        Thêm người dùng mới
                    </h1>
                </div>
            </div>
        </template>
        <div class="py-12">
            <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
                <form @submit.prevent="createUser">
                    <div class="bg-white overflow-hidden shadow sm:rounded-lg">
                        <!-- Input -->
                        <div class="p-6 bg-white">
                            <div class="grid grid-cols-1 gap-6">
                                <!-- Name -->
                                <div class="block">
                                    <bolt-label
                                        for="name"
                                        value="Họ và Tên"
                                    />
                                    <bolt-input
                                        id="name"
                                        v-model="userForm.name"
                                        type="text"
                                        class="mt-1 block w-full"
                                    />
                                    <bolt-input-error
                                        :message="userForm.errors.name"
                                        class="mt-2"
                                    />
                                </div>

                                <!-- Email -->
                                <div class="block">
                                    <bolt-label
                                        for="email"
                                        value="Email"
                                    />
                                    <bolt-input
                                        id="email"
                                        v-model="userForm.email"
                                        type="email"
                                        class="mt-1 block w-full"
                                    />
                                    <bolt-input-error
                                        :message="userForm.errors.email"
                                        class="mt-2"
                                    />
                                </div>

                                <!-- Phone -->
                                <div class="block">
                                    <bolt-label
                                        for="phone"
                                        value="Điện thoại"
                                    />
                                    <bolt-input
                                        id="phone"
                                        v-model="userForm.phone"
                                        type="number"
                                        class="mt-1 block w-full no-spinners"
                                    />
                                    <bolt-input-error
                                        :message="userForm.errors.phone"
                                        class="mt-2"
                                    />
                                </div>

                                <!-- Address -->
                                <div class="block">
                                    <bolt-label
                                        for="address"
                                        value="Địa chỉ"
                                    />
                                    <bolt-textarea
                                        id="address"
                                        v-model="userForm.address"
                                        class="mt-1 block w-full"
                                    />
                                    <bolt-input-error
                                        :message="userForm.errors.address"
                                        class="mt-2"
                                    />
                                </div>

                                <!-- Password -->
                                <div class="block">
                                    <bolt-label
                                        for="password"
                                        value="Mật khẩu"
                                    />
                                    <bolt-input
                                        id="password"
                                        v-model="userForm.password"
                                        type="password"
                                        class="mt-1 block w-full"
                                    />
                                    <bolt-input-error
                                        :message="userForm.errors.password"
                                        class="mt-2"
                                    />
                                </div>

                                <!-- Password confirmation -->
                                <div class="block">
                                    <bolt-label
                                        for="password_confirmation"
                                        value="Xác nhận mật khẩu"
                                    />
                                    <bolt-input
                                        id="password_confirmation"
                                        v-model="userForm.password_confirmation"
                                        type="password"
                                        class="mt-1 block w-full"
                                    />
                                    <bolt-input-error
                                        :message="userForm.errors.password_confirmation"
                                        class="mt-2"
                                    />
                                </div>

                                <!-- Verify email -->
                                <div class="block">
                                    <div class="mt-2">
                                        <label class="inline-flex items-center">
                                            <input
                                                v-model="userForm.email_verified"
                                                type="checkbox"
                                                class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                                :checked="userForm.email_verified"
                                            >
                                            <span class="ml-2">Đã xác nhận email</span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Action -->
                        <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                            <bolt-primary-button
                                :class="{ 'opacity-25': userForm.processing }"
                                :disabled="userForm.processing"
                            >
                                Lưu lại
                            </bolt-primary-button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </admin-layout>
</template>

<script>
    import AdminLayout from "@/Layouts/AdminLayout";
    import BoltLabel from "@/Components/Label";
    import BoltInput from "@/Components/Input";
    import BoltTextarea from "@/Components/Textarea";
    import BoltInputError from "@/Components/InputError";
    import BoltPrimaryButton from "@/Components/PrimaryButton";

    export default {
        name: "UserCreate",
        components: {AdminLayout, BoltLabel, BoltInput, BoltTextarea, BoltInputError, BoltPrimaryButton},
        data() {
            return {
                userForm: this.$inertia.form({
                    name: null,
                    email: null,
                    phone: null,
                    address: null,
                    password: null,
                    password_confirmation: null,
                    email_verified: false,
                }),
            };
        },
        methods: {
            createUser() {
                this.userForm.post(route('admin.users.store'), {
                    preserveScroll: true,
                    onSuccess: () => {
                        this.userForm.reset();
                    },
                });
            },
        },
    };
</script>
