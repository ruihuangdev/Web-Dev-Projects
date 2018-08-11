<template>
	<header>
		<h1 v-on:click="changeTitle">{{title}}</h1>
	</header>

</template>

<script>
import { bus } from "../main.js";
export default {
  props: {
    title: {
      type: String
    }
  },
  data() {
    return {};
  },
  methods: {
    changeTitle: function() {
      this.title = "Vue Dawgz";
      //edit title directly in here to allow header component to listen to it
      bus.$emit("titleChanged", "Vue Dawgz");
      //event bus for handling events in other components
    }
  }
};
</script>

<style scoped lang="scss">
header {
  background: #4dd0e1;
  padding: 20px;
}
h1 {
  color: #333333;
  text-align: center;
}
</style>
