<template>
	<header>
		<h1>{{title}}</h1>
	</header>

</template>

<script>
export default {
  data() {
    return {
      title: "My App"
    };
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
