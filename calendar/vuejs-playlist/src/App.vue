<template>
  <div>
    <app-header v-bind:title="title" v-on:changeTitle="updateTitle($event)"></app-header>
    <app-dawgs v-bind:dawgs="dawgs"></app-dawgs>
    <app-footer v-bind:title="title"></app-footer>
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
      dawgs: [
        { name: "Jason", speciality: "Piper", show: false },
        { name: "Mochi", speciality: "Loaf", show: false },
        { name: "Tripp", speciality: "Energize", show: false },
        { name: "Sadie", speciality: "Chill", show: false },
        { name: "Hank", speciality: "Furry", show: false },
        { name: "Nova", speciality: "Rua", show: false }
      ],
      title: "Vue Dawgs"
    };
  },
  methods: {
    updateTitle: function(newTitle) {
      this.title = newTitle;
    }
  }
};
</script>

<style lang="scss">
</style>
