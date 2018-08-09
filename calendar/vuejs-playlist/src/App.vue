<template>
  <div>
    <app-header></app-header>
    <app-dawgs></app-dawgs>
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
      title: "My App"
    };
  }
};
</script>

<style lang="scss">
</style>
