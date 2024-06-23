<template>
  <div class="flex items-center justify-center min-h-screen bg-gray-100">
    <div class="bg-white p-8 rounded shadow-md w-full max-w-md">
      <!-- Formulario de login -->
      <form @submit.prevent="handleLogin">
        <div class="mb-4">
          <!-- Label e input para el email -->
          <label for="email" class="block text-gray-700">Email</label>
          <input type="text" id="email" v-model="email" required class="w-full px-3 py-2 border rounded" />
        </div>
        <div class="mb-4">
          <!-- Label e input para la contraseña -->
          <label for="password" class="block text-gray-700">Contraseña</label>
          <input type="password" id="password" v-model="password" required class="w-full px-3 py-2 border rounded" />
        </div>
        <!-- Botón de submit para el formulario de login -->
        <button type="submit" class="w-full bg-blue-500 text-white py-2 rounded">Login</button>
      </form>
    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue';
import { useUserStore } from '../stores/UserStore.js';
import { useRouter } from 'vue-router';


// // Define variables reactivas para el email y la contraseña
const email = ref('');
const password = ref('');

const userStore = useUserStore();
const router = useRouter();




// Función para manejar el proceso de login
const handleLogin = async () => {
  try {
    await userStore.login(email.value, password.value);

      router.push('/account')
      console.log('Login exitoso. Redirigiendo a la página de cuenta...');

  } catch (error) {
    console.error('Error al iniciar sesión:', error.message);
  }
};


</script>

<style scoped>
/* Estilos para la página de login */
</style>
