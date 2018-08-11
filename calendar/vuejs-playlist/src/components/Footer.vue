<template>
	<footer>
		<p>{{title}}{{copyright}}</p>
	</footer>
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
    return {
      copyright: " By Rui Huang"
    };
  },
  created() {
    bus.$on("titleChanged", data => {
      this.title = data;
    });
  }
};
</script>

<style scoped lang="scss">
footer {
  background: #333333;
  padding: 10px;
}
p {
  color: #4dd0e1;
  text-align: center;
}
</style>
