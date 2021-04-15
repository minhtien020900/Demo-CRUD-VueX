<template>
  <div class="mt-3">
    <b-pagination
      v-model="currentPage"
      :total-rows="totalRows"
      :per-page="perPage"
      align="center"
    ></b-pagination>
  </div>
</template>

<script>
export default {
  data() {
    return {
      currentPage: 1,
    };
  },
  props: {
    totalRows: {
      default: null,
    },
    perPage: {
      default: null,
    },
  },
  watch: {
    currentPage: function () {
      this.$emit("updateCurentPage", this.currentPage);
    },
  },
};
</script>

<style>
</style>