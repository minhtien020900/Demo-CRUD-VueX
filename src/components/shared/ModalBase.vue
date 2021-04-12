<template>
  <b-modal size="md" id="category-modal" hide-footer header-bg-variant="light">
    <template #modal-title>{{ modalTitle }}</template>
    <v-slot name="body-modal"></v-slot>

    <!-- <b-form>
        <b-form-group
          label="Category name:"
          label-for="input-name-category"
          description="We'll never share your email with anyone else."
        >
          <b-form-input
            id="input-name-category"
            v-model="catName"
          ></b-form-input>
        </b-form-group>
        <b-form-group label="Category image:" label-for="btn-select-file">
          <b-form-file
            id="btn-select-file"
            v-model="catFile"
            class="mt-3"
            plain
          ></b-form-file>
        </b-form-group>
        <div id="btn-form">
          <b-button variant="primary" class="mr-2" @click="addCategory()"
            >Submit</b-button
          >
          <b-button class="ml-2" type="reset" variant="danger">Reset</b-button>
        </div>
      </b-form> -->
  </b-modal>
</template>

<script>
export default {
  name: "modal-base",
  props: {
    idModal: {
      type: null,
    },
    modalTitle: {
      type: null,
    },
  },
//   created: {
//     showCatModal() {
//       this.$bvModal.show(this.idModal);
//     },
//   },
};
</script>

<style>
</style>