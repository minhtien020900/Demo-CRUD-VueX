<template>
  <div id="app">

    <div class="container">
      <!-- <HelloWorld msg="Welcome to Your Vue.js App"/> -->
      <Navbar></Navbar>
    </div>
  </div>
</template>

<script>
// import HelloWorld from './components/HelloWorld.vue'
import Navbar from "./components/Navbar.vue";
// import SearchBar from "./components/SearchBar.vue";
// import TableData from "./components/GridViewData";
export default {
  name: "App",
  components: {
    Navbar,
  },
};
</script>

<style>
#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;

  color: #2c3e50;
  margin-top: 60px;
}
</style>
