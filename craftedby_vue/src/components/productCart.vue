<script setup>
import axios from '@/plugins/axios'; // Ajusta la ruta según tu estructura de proyecto
import { ref, onMounted } from 'vue';

// Define una variable reactiva para almacenar los productos
const products = ref([]);

// Función para obtener los productos de la API
const fetchProducts = async () => {
  try {
    const response = await axios.get('/products');
    products.value = response.data.data;
    console.log('Productos obtenidos:', products.value); // Log para depuración
  } catch (error) {
    console.error('Error al obtener los productos', error);
  }
};

// Llama a fetchProducts cuando el componente se monta
onMounted(fetchProducts);
</script>

<template>
  <div class="flex justify-center p-2">
    <div class="flex flex-wrap gap-4 justify-center p-2">
      <div v-for="product in products" :key="product.id" class="w-full md:w-1/3">
        <!-- Contenido de la tarjeta de producto -->
        <router-link :to="'/ProductDetail/' + product.id">
          <!-- Product card -->
          <div class="p-4 border rounded-lg shadow-md">
            <!-- Product image -->
            <img class="h-40 w-40 mx-auto my-auto p-5" :src="product.image_path" alt="Product Image" />
            <div class="p-6">
              <!-- Product title -->
              <div class="title-container w-full">
                <h3 class="text-lg font-semibold text-gray-900">
                  {{ product.name.substring(0, 50) }}
                </h3>
              </div>
              <!-- Product description -->
              <div class="description-container h-20 w-full">
                <p class="mt-1 text-sm text-gray-500">
                  {{ product.description.substring(0, 100) }}...
                </p>
              </div>
              <!-- Product price -->
              <p class="mt-2 text-lg font-semibold text-gray-900 text-center mx-auto">{{ product.price }}$</p>
            </div>
          </div>
        </router-link>
      </div>
    </div>
  </div>
</template>

<style scoped>
/* Scoped styles for the product list */
</style>

