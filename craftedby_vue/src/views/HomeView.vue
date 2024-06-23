<script setup lang="ts">

import Footer_home from '@/components/footerHome.vue'
import NavbarHome from '@/components/navbar/navbarHome.vue'
import Product from '@/components/productCart.vue'


</script>

<template>
  <body>
    <header><NavbarHome /></header>
    <main>
      <Product />
    </main>

    <footer><Footer_home /></footer>
  </body>
</template>

<style>
.PopoverTrigger {
  background-color: white;
  border-radius: 4px;
}

.PopoverContent {
  border-radius: 4px;
  padding: 20px;
  width: 260px;
  background-color: white;
}

.PopoverArrow {
  background-color: white;
}
</style>