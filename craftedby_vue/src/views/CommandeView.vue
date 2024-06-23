<script setup>
import Navbar_home from '@/components/navbar/navbarHome.vue'
import Footer_home from '@/components/footerHome.vue'
import Commande from '@/components/commande.vue'



</script>

<template>
  <body>
  <header>
    <Navbar_home />

  </header>

  <main>
    <commande />
  </main>

  <footer>
    <Footer_home />
  </footer>
  </body>
</template>