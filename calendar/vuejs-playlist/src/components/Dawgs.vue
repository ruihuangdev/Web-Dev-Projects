<template>
	<div id="dawgs">
		<ul>
			<li v-for="dawg in dawgs" v-on:click="dawg.show = !dawg.show">
				<h2>{{dawg.name}}</h2>
				<h3 v-show="dawg.show">{{dawg.speciality}}</h3>
			</li>
		</ul>
	</div>
</template>

<script>
export default {
  props: {
    dawgs: {
      type: Array,
      required: true
    }
  },
  //validation methods
  data() {
    return {};
  }
};
</script>

<style scoped lang="scss">
#dawgs {
  width: 100%;
  max-width: 70%;
  margin: 40px auto;
  padding: 0 20px;
  box-sizing: border-box;
}
ul {
  display: flex;
  flex-wrap: wrap;
  list-style-type: none;
  padding: 0;
}
li {
  flex-grow: 1;
  flex-basis: 300px;
  text-align: center;
  padding: 30px;
  border: 1px solid #333333;
}
</style>
