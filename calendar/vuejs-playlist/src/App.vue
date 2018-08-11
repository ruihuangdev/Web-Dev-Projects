<template>
  <div>
    <app-header></app-header>
    <app-dawgs v-bind:dawgs="dawgs"></app-dawgs>
    <app-footer></app-footer>
  </div>
</template>

<script>
import Header from "./components/Header.vue";
import Footer from "./components/Footer.vue";
import Dawgs from "./components/Dawgs.vue";

export default {
  components: {
    "app-header": Header,
    "app-footer": Footer,
    "app-dawgs": Dawgs
  },
  data() {
    return {
      title: "My App",
      dawgs: [
        { name: "Jason", speciality: "Piper", show: false },
        { name: "Mochi", speciality: "Loaf", show: false },
        { name: "Tripp", speciality: "Energize", show: false },
        { name: "Sadie", speciality: "Chill", show: false },
        { name: "Hank", speciality: "Furry", show: false },
        { name: "Nova", speciality: "Rua", show: false }
      ]
    };
  }
};
</script>

<style lang="scss">
</style>
