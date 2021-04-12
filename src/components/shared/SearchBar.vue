<template>
  <div>
    <b-input-group size="md" class="mb-2">
      <b-input-group-prepend is-text>
        <b-icon icon="search" variant="primary"></b-icon>
      </b-input-group-prepend>
      <b-form-input
        type="search"
        placeholder="Search category"
        v-model="keyword"
      ></b-form-input>
      <br /> </b-input-group
    ><b-form-text id="password-help-block">
      Search found <strong>{{ totalResult }}</strong> results
    </b-form-text>
  </div>
</template>

<script>
export default {
  data() {
    return {
      keyword: "",
    };
  },
  props: {
    totalResult: {
      default: null,
    },
  },
  watch: {
    keyword: function () {
      this.$emit("updateKeyword", this.keyword);
    },
  },
};
</script>

<style>
#search-bar {
  width: 55%;
}
</style>