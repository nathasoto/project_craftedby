<script setup>
import { ref } from 'vue';
import { useCartStore } from '../stores/cartStore.js'
import { useAddressStore } from '../stores/AddressStore.js'
import { useUserStore} from '../stores/UserStore.js'
import { useRouter } from 'vue-router'

const router = useRouter()
// Initialize the stores
const addressStore = useAddressStore()
const cartStore = useCartStore()
const userStore = useUserStore()
const showFullToken = ref(false)

const redirectToCreateAccount = () => {
  router.push('/register');
};


</script>

<template>
  <div class="flex justify-center items-center h-full">
    <div class="commande-container border border-gray-300 p-6 max-w-lg">
      <h1 class="text-3xl font-semibold mb-4">Commande</h1>

      <div class="user-info mb-6">

        <div class="flex items-center" v-if="userStore.username === null">
          <button @click="redirectToCreateAccount" class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600">Créer un compte</button>
        </div>

        <!-- Display user and Token Information -->
        <div class="flex items-start flex-col" v-if="userStore.username !== null">
          <h2 class="text-xl font-semibold mb-2">User Information</h2>
          <p><strong>User:</strong> {{ userStore.username }}</p>
<!--          <div class="mt-2">-->
<!--            <strong>Token:</strong>-->
<!--            <div v-if="userStore.token.length > 20" class="flex items-center">-->
<!--              <span>{{ showFullToken ? userStore.token : userStore.token.substring(0, 20) }}</span>-->
<!--              <button @click="showFullToken = !showFullToken" class="text-blue-500 ml-2 focus:outline-none">-->
<!--                {{ showFullToken ? 'Hide' : 'Show More' }}-->
<!--              </button>-->
<!--            </div>-->
<!--            <span v-else>{{ userStore.token }}</span>-->
<!--          </div>-->
        </div>

      </div>

      <!-- Display Address Information -->
      <div class="address-info mb-6">
        <h2 class="text-xl font-semibold mb-2">Address Information</h2>
        <p><strong>Address:</strong> {{ addressStore.address }}</p>
        <p><strong>City:</strong> {{ addressStore.city }}</p>
        <p><strong>Postal Code:</strong> {{ addressStore.postalCode }}</p>
        <p><strong>Country:</strong> {{ addressStore.country }}</p>
        <p><strong>Phone:</strong> {{ addressStore.phone }}</p>
      </div>

      <!-- Display Cart Information -->
      <div class="cart-info">
        <h2 class="text-xl font-semibold mb-2">Cart Information</h2>
        <ul>
          <li v-for="item in cartStore.items" :key="item.id" class="mb-2">
            <span class="font-semibold">{{ item.title }}</span> --- {{ item.quantity }} x ${{ item.price }}
          </li>
        </ul>
        <p class="font-semibold">Total Items: {{ cartStore.totalItems }}</p>
        <p class="font-semibold">Total Price: ${{ cartStore.totalPrice }}</p>
      </div>
    </div>

  </div>
</template>

<style scoped>

</style>