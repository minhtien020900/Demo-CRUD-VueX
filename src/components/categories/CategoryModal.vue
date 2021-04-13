<template>
  <div>
    <b-modal
      size="md"
      id="category-modal"
      hide-footer
      header-bg-variant="light"
      @hidden="toggleModal()"
    >
      <template #modal-title>
        <slot name="modal-title"></slot>
      </template>

      <b-form>
        <b-form-group
          label="Category name:"
          label-for="input-name-category"
          description="We'll never share your email with anyone else."
        >
          <b-form-input
            id="input-name-category"
            v-model="catItem.category_name"
          ></b-form-input>
        </b-form-group>
        <b-form-group label="Category image:" label-for="btn-select-file">
          <b-form-file
            id="btn-select-file"
            v-model="catItem.catFile"
            class="mt-3"
            plain
          ></b-form-file>
        </b-form-group>
        <div id="btn-form">
          <b-button variant="primary" class="mr-2" @click="save()"
            >Submit</b-button
          >
          <b-button class="ml-2" type="reset" variant="danger">Reset</b-button>
        </div>
      </b-form>
    </b-modal>
  </div>
</template>

<script>
export default {
  name: "category-modal",
  props: ["editedItem"],

  data() {
    return {
      catItem: { id: 0, category_name: "", catFile: [] },
    };
  },
  watch: {
    editedItem: function () {
      return (this.catItem = Object.assign({}, this.editedItem));
    },
  },
  methods: {
    submitForm() {
      alert(1);
    },
    save() {
      if (
        this.catItem.category_name.length > 0 &&
        this.catItem.catFile.name != undefined
      ) {
        this.$emit("save", this.catItem);
      }
    },
    toggleModal() {
      this.catItem = { id: 0, category_name: "", catFile: [] };
    },
  },
  mounted() {
    this.toggleModal();
  },
};
</script>

<style>
#btn-form {
  display: flex;
  justify-content: center;
}
</style>
