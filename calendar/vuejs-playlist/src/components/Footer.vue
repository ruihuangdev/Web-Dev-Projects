<template>
	<footer>
		<p>{{copyright}}</p>
	</footer>
</template>

<script>
export default {
  data() {
    return {
      copyright: "By Rui Huang"
    };
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
