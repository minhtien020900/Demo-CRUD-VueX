<template>
  <div>
    <!-- {{ componentName }} -->
    <md-button
      class="md-icon-button md-dense"
      style="background: #81c784"
      @click="showModal"
    >
      <md-icon style="color: #f1f8e9">add</md-icon>
    </md-button>
  </div>
</template>

<script>
  // import { eventBus } from "../main";
  export default {
    data() {
      return {
        // isShowModal: true,
      };
    },

    // props: {
    //   componentName: {
    //     default: null,
    //   },
    // },
    //   computed: {
    //     getComponentName: () => {
    //       return this.componentName;
    //     },
    //   },
    methods: {
      showModal() {
        this.$emit("showModal");
      },
    },
  };
</script>

<style>
  #btn-add {
  }
</style>
