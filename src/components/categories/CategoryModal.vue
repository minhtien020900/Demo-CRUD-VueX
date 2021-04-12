<template>
  <div>
    <b-modal
      size="md"
      id="category-modal"
      hide-footer
      header-bg-variant="light"
    >
      <template #modal-title>Add new category</template>
      <b-form>
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
      </b-form>
    </b-modal>

    
  </div>
</template>

<script>
import { eventBus } from "../main";
export default {
  props: {
    maxId: {},
  },
  data() {
    return {
      isShow: false,
      catName: "",
      catFile: [],
      catItemDefault: {
        id: 0,
        category_name: "",
        catImage: "",
      },
    };
  },
  methods: {
    submitForm() {
      alert(1);
    },
    addCategory() {
      
      let emptyObj = Object.assign({}, this.catItemDefault);
      if (this.catName != "" && this.catFile.length != 0) {
        this.catItemDefault.category_name = this.catName;
        this.catItemDefault.catImage = this.catFile.name;
        this.catItemDefault.id = this.maxId + 1;
        this.$emit("addCategory", this.catItemDefault);

        // Gán lại giá trị rỗng cho modal
        this.catName = "";
        this.catFile = [];

        this.catItemDefault = Object.assign({}, emptyObj);
      }

      this.$bvModal.hide("category-modal");
      
    },
  },
  created() {
    eventBus.$once("showCategoryModal", () => {
      this.$bvModal.show("category-modal");
    });
  },
};
</script>

<style>
#btn-form {
  display: flex;
  justify-content: center;
}
</style>