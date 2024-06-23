<script setup>
import Navbar_home from '@/components/navbar/navbarHome.vue'
import Footer_home from '@/components/footerHome.vue'
import ProductDetail from '@/components/productDetail.vue'

</script>

<template>
  <body>
  <header>
    <Navbar_home />

  </header>

  <main>
    <ProductDetail />
  </main>

  <footer>
    <Footer_home />
  </footer>
  </body>
</template>