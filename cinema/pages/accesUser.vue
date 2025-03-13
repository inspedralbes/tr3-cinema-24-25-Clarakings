<template>
    <NuxtLayout name="navbar" />
    <div class="min-h-screen bg-neutral-900 py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md mx-auto">
            <!-- Header -->
            <div class="text-center mb-10">
                <h2 class="text-4xl font-bold text-white mb-2">Bienvenido a CinesKings</h2>
                <p class="text-gray-400">Tu portal de entretenimiento cinematográfico</p>
            </div>

            <!-- Login Form -->
            <div v-if="!showRegister" class="bg-neutral-800 rounded-xl shadow-2xl p-8 mb-6">
                <h3 class="text-2xl font-bold text-white mb-6 text-center">Iniciar Sesión</h3>
                <div class="space-y-4">
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-300 mb-2">Correo electrónico</label>
                        <input v-model="email" type="email" id="email" 
                            class="w-full px-4 py-2 bg-neutral-700 border border-neutral-600 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent transition duration-200"
                            placeholder="ejemplo@email.com">
                    </div>
                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-300 mb-2">Contraseña</label>
                        <input v-model="password" type="password" id="password"
                            class="w-full px-4 py-2 bg-neutral-700 border border-neutral-600 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent transition duration-200"
                            placeholder="••••••••">
                    </div>
                    <button @click="postLoginForm()"
                        class="w-full bg-red-600 text-white py-2 px-4 rounded-lg hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 focus:ring-offset-neutral-800 transition duration-200">
                        Iniciar Sesión
                    </button>
                </div>
                <div class="mt-6 text-center">
                    <p class="text-gray-400">¿No tienes una cuenta? 
                        <button @click="showRegister = true" class="text-red-500 hover:text-red-400 font-medium">
                            Regístrate aquí
                        </button>
                    </p>
                </div>
            </div>

            <!-- Register Form -->
            <div v-else class="bg-neutral-800 rounded-xl shadow-2xl p-8 mb-6">
                <h3 class="text-2xl font-bold text-white mb-6 text-center">Crear Cuenta</h3>
                <div class="space-y-4">
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label for="first_name" class="block text-sm font-medium text-gray-300 mb-2">Nombre</label>
                            <input v-model="firstName" type="text" id="first_name"
                                class="w-full px-4 py-2 bg-neutral-700 border border-neutral-600 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent transition duration-200"
                                placeholder="Juan">
                        </div>
                        <div>
                            <label for="last_name" class="block text-sm font-medium text-gray-300 mb-2">Apellido</label>
                            <input v-model="lastName" type="text" id="last_name"
                                class="w-full px-4 py-2 bg-neutral-700 border border-neutral-600 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent transition duration-200"
                                placeholder="Pérez">
                        </div>
                    </div>
                    <div>
                        <label for="birthday" class="block text-sm font-medium text-gray-300 mb-2">Fecha de nacimiento</label>
                        <input v-model="birthday" type="date" id="birthday"
                            class="w-full px-4 py-2 bg-neutral-700 border border-neutral-600 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent transition duration-200">
                    </div>
                    <div>
                        <label for="phone_number" class="block text-sm font-medium text-gray-300 mb-2">Teléfono</label>
                        <input v-model="phoneNumber" type="tel" id="phone_number"
                            class="w-full px-4 py-2 bg-neutral-700 border border-neutral-600 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent transition duration-200"
                            placeholder="+34 600 000 000">
                    </div>
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-300 mb-2">Correo electrónico</label>
                        <input v-model="email" type="email" id="email"
                            class="w-full px-4 py-2 bg-neutral-700 border border-neutral-600 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent transition duration-200"
                            placeholder="ejemplo@email.com">
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label for="password" class="block text-sm font-medium text-gray-300 mb-2">Contraseña</label>
                            <input v-model="password" type="password" id="password"
                                class="w-full px-4 py-2 bg-neutral-700 border border-neutral-600 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent transition duration-200"
                                placeholder="••••••••">
                        </div>
                        <div>
                            <label for="password_confirmation" class="block text-sm font-medium text-gray-300 mb-2">Confirmar contraseña</label>
                            <input v-model="passwordConfirmation" type="password" id="password_confirmation"
                                class="w-full px-4 py-2 bg-neutral-700 border border-neutral-600 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent transition duration-200"
                                placeholder="••••••••">
                        </div>
                    </div>
                    <button @click="postRegisterForm()"
                        class="w-full bg-red-600 text-white py-2 px-4 rounded-lg hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 focus:ring-offset-neutral-800 transition duration-200">
                        Crear Cuenta
                    </button>
                </div>
                <div class="mt-6 text-center">
                    <p class="text-gray-400">¿Ya tienes una cuenta? 
                        <button @click="showRegister = false" class="text-red-500 hover:text-red-400 font-medium">
                            Inicia sesión
                        </button>
                    </p>
                </div>
            </div>
        </div>

        <!-- Error Alert -->
        <div v-show="errorAlert" class="fixed top-4 right-4 max-w-sm">
            <div class="bg-red-600 text-white px-6 py-4 rounded-lg shadow-lg">
                <p class="font-medium">{{ error }}</p>
            </div>
        </div>
    </div>
</template>

<script>
import { useAppStore } from '../store/index';
import { postLogin, postRegister } from '../services/communicationManager';

export default {
    data() {
        return {
            password: '',
            firstName: '',
            lastName: '',
            birthday: '',
            phoneNumber: '',
            email: '',
            passwordConfirmation: '',
            error: '',
            showRegister: false,
            errorAlert: false
        };
    },
    methods: {
        showError(message) {
            this.error = message;
            this.errorAlert = true;
            setTimeout(() => {
                this.error = '';
                this.errorAlert = false;
            }, 15000);
        },
        postLoginForm() {
            const store = useAppStore();
            if (this.email == '' || this.password == '') {
                this.showError('Por favor, completa todos los campos');
            } else {
                let user = {
                    email: this.email,
                    password: this.password,
                    password_confirmation: this.password
                };
                postLogin(user).then(response => {
                    store.setUser(response.user);
                    store.setToken(response.token);
                    this.$router.push('/');
                }).catch(error => {
                    this.showError('Error al iniciar sesión. Por favor, verifica tus credenciales.');
                    console.error(error);
                });
            }
        },
        postRegisterForm() {
            const store = useAppStore();
            if (this.firstName == '' || this.lastName == '' || this.phoneNumber == '' || 
                this.email == '' || this.password == '' || this.passwordConfirmation == '') {
                this.showError('Por favor, completa todos los campos obligatorios');
            } else if (this.password !== this.passwordConfirmation) {
                this.showError('Las contraseñas no coinciden');
            } else {
                let user = {
                    first_name: this.firstName,
                    last_name: this.lastName,
                    birthday: this.birthday,
                    phone_number: this.phoneNumber,
                    email: this.email,
                    password: this.password,
                    password_confirmation: this.passwordConfirmation
                };
                postRegister(user).then((response) => {
                    store.setUser(response.user);
                    store.setToken(response.token);
                    this.$router.push('/');                 
                }).catch((error) => {
                    this.showError('Error al registrar la cuenta. Por favor, inténtalo de nuevo.');
                    console.error(error);
                });
            }
        }
    }
}
</script>