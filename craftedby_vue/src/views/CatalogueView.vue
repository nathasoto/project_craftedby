<script setup>
import Navbar_home from '@/components/navbar/navbarHome.vue'
import Footer_home from '@/components/footerHome.vue'
import Product from '@/components/productCart.vue'

</script>

<template>
  <body>
  <header>
    <Navbar_home />

  </header>

  <main>
    <Product />
  </main>


  <footer>
    <Footer_home />
  </footer>
  </body>
</template>