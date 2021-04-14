<template>
  <div>
    <b-nav >
      <b-nav-item>
        <router-link :to="{ name: 'Products' }">Products</router-link>
      </b-nav-item>
      <b-nav-item
        ><router-link :to="{ name: 'Categories' }"
          >Categories</router-link
        ></b-nav-item
      >
    </b-nav>
    <router-view />
  </div>
</template>

<script>
export default {

}
</script>

<style>

</style>