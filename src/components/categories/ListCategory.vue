<template>
  <div id="list-categories">
    <div class="header-table">
      <div id="search-bar">
        <SearchBar @updateKeyword="search($event)" :totalResult="totalResult" />
      </div>
      <div id="select-perpage">
        <div>
          <b-form-select
            v-model="perPage"
            :options="arrayPerPage"
          ></b-form-select>
        </div>
      </div>
      <div id="btn-add">
        <AddButton @showModal="showCatModal" />
      </div>
    </div>
    <div id="table-data">
      <b-table
        :items="catListRender"
        head-variant="light"
        :fields="catFields"
        :fixed="true"
        :hover="true"
        :outlined="true"
        :no-border-collapse="true"
      >
        <br />
        <template #cell(catFile)="data">
          {{ data.item.catFile.name }}
        </template>
        <template #cell(operations)="row">
          <!-- <b-button variant="primary-fill" size="sm">
            <b-icon-pencil-square
              variant="primary"
              @click="editItem(row.item)"
            ></b-icon-pencil-square>
          </b-button> -->

          <md-button
            class="md-icon-button md-dense md-raised md-primary"
            @click="editItem(row.item)"
          >
            <md-icon>edit</md-icon>
          </md-button>
          <md-button
            class="md-icon-button md-dense md-raised md-accent"
            @click="showConfirmDialog(row.item)"
          >
            <md-icon>clear</md-icon>
          </md-button>
          <md-button
            class="md-icon-button md-dense"
            style="background: #ffa000"
          >
            <md-icon style="color: #f1f8e9">attach_file</md-icon>
          </md-button>
          <md-button
            class="md-icon-button md-dense"
            style="background: #607d8b"
          >
            <md-icon style="color: #f1f8e9">visibility</md-icon>
          </md-button>
        </template>
      </b-table>
    </div>
    <!-- <div>
      Sorting By: <b>{{ sortBy }}</b
      >, Sort Direction:
      <b>{{ sortDesc ? "Descending" : "Ascending" }}</b>
    </div> -->
    <!-- <ModalBase>
      <b-form slot="body-modal">
        <b-form-group
          label="Category name:"
          label-for="input-name-category"
          description="We'll never share your email with anyone else."
        >
          <b-form-input
            id="input-name-category"
            v-model="editedItem.category_name"
          ></b-form-input>
        </b-form-group>
        <b-form-group label="Category image:" label-for="btn-select-file">
          <b-form-file
            id="btn-select-file"
            v-model="editedItem.catFile"
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
    </ModalBase> -->
    <category-modal :editedItem="editedItem">
      <template slot="modal-title">{{ formTitle }}</template>
    </category-modal>
    <!-- <div id="modal-add-edit">
      <b-modal
        size="md"
        id="category-modal"
        hide-footer
        header-bg-variant="light"
      >
        <template #modal-title>{{ formTitle }}</template>
        <b-form>
          <b-form-group
            label="Category name:"
            label-for="input-name-category"
            description="We'll never share your email with anyone else."
          >
            <b-form-input
              id="input-name-category"
              v-model="editedItem.category_name"
            ></b-form-input>
          </b-form-group>
          <b-form-group label="Category image:" label-for="btn-select-file">
            <b-form-file
              id="btn-select-file"
              v-model="editedItem.catFile"
              class="mt-3"
              plain
            ></b-form-file>
          </b-form-group>
          <div id="btn-form">
            <b-button variant="primary" class="mr-2" @click="save()"
              >Submit</b-button
            >
            <b-button class="ml-2" type="reset" variant="danger"
              >Reset</b-button
            >
          </div>
        </b-form>
      </b-modal>
    </div> -->
    <!-- <div id="modal-comfirm">
      <ConfirmModal
        @deleteConfirm="deleteCatItem()"
        @closeDelete="closeDelete()"
      />
    </div> -->

    <Pagination
      :perPage="selectPerPage"
      :totalRows="totalRows"
      @updateCurentPage="updateCurentPage($event)"
    />
  </div>
</template>

<script>
  // import ConfirmModal from "../components/ConfirmModal";
  import AddButton from "../shared/ButtonAdd";
  import SearchBar from "../shared/SearchBar";
  import Pagination from "../shared/Pagination";
  import CategoryModal from "./CategoryModal";
  import { eventBus } from "@/main";
  // import ModalBase from "../shared/ModalBase.vue";


  export default {
    components: {
      AddButton,
      SearchBar,
      Pagination,
      // ModalBase,
      CategoryModal,
    },
    props: {},

    data() {
      return {
        isShowModal: false,
        editedIndex: -1,
        catFile: "",
        catItemDefault: {
          id: 0,
          category_name: "",
          catFile: [],
        },
        editedItem: {
          id: 0,
          category_name: "",
          catFile: [],
        },
        catList: [
          {
            id: 1,
            category_name: "Điện thoại",
            catFile: [],
          },
          {
            id: 2,

            category_name: "Laptop",
            catFile: [],
          },

          {
            id: 3,
            category_name: "Máy tính bảng",
            catFile: [],
          },
          {
            id: 4,
            category_name: "Máy tính bảng",
            catFile: [],
          },
          {
            id: 5,
            category_name: "Máy tính bảng",
            catFile: [],
          },
          {
            id: 6,
            category_name: "Máy tính bảng",
            catFile: [],
          },
          {
            id: 7,
            category_name: "Máy tính bảng",
            catFile: [],
          },
        ],
        catFields: [
          { key: "id", label: "#", sortable: true },
          { key: "category_name", label: "Category name", sortable: true },

          { key: "catFile", label: "Image", sortable: true },
          { key: "operations", sortable: false },
        ],
        start: 0,
        perPage: 3,
        currentPage: 1,
        catListRender: [],
        arrayPerPage: [
          { value: 3, text: "Select display count" },
          { value: 3, text: "3" },
          { value: 6, text: "6" },
          { value: 9, text: "9" },
          { value: "all", text: "All" },
        ],
        totalRow: 0,
        isSearch: false,
        catListSearch: [],
        keyword: "",
      };
    },
    created() {
      this.renderCatList();
      this.totalRow = this.catList.length;
    },
    computed: {
      formTitle() {
        return this.editedIndex === -1 ? "Add new category" : "Edit category";
      },
      totalRows() {
        return this.totalRow;
      },
      selectPerPage() {
        if (this.perPage === "all") {
          return this.catList.length;
        }
        return this.perPage;
      },
      totalResult() {
        return this.keyword.length > 0 ? this.catListSearch.length : 0;
      },
    },
    watch: {
      selectPerPage: function () {
        this.renderCatList();
      },
      currentPage: function () {
        this.renderCatList();
      },
      catList: function () {
        this.renderCatList();
      },
      keyword: function () {
        this.renderCatList();
      },
      // catListSearch:function(){
      //   this.renderCatList();
      // }
    },
    methods: {
      showConfirmDialog(item) {
        eventBus.$emit("showConfirmDialog");
        this.editedIndex = this.catList.indexOf(item);
        this.editedItem = Object.assign({}, item);
      },
      showCatModal() {
        this.$bvModal.show("category-modal");
        console.log(this.$bvModal.trigger);
      },
      closeCatModal() {
        this.$bvModal.hide("category-modal");
        this.$nextTick(() => {
          this.editedItem = Object.assign({}, this.catItemDefault);
          this.editedIndex = -1;
        });
      },
      closeDelete() {
        this.$nextTick(() => {
          this.editedItem = Object.assign({}, this.catItemDefault);
          this.editedIndex = -1;
        });
      },
      editItem(item) {
        this.editedIndex = this.catList.indexOf(item);
        this.editedItem = Object.assign({}, item);
        this.showCatModal();
      },
      deleteCatItem() {
        if (this.editedIndex > -1) {
          this.catList.splice(this.editedIndex, 1);
        }
        this.closeDelete();
      },
      save() {
        if (
          this.editedItem.category_name.length > 0 &&
          this.editedItem.catFile.name != undefined
        ) {
          if (this.editedIndex > -1) {
            Object.assign(this.catList[this.editedIndex], this.editedItem);
          } else {
            this.editedItem.id = this.catList.length + 1;
            this.catList.push(this.editedItem);
          }
        }

        this.closeCatModal();
      },
      renderCatList() {
        let baseList = [];
        this.catListSearch = this.catList.filter((catItem) => {
          return catItem.category_name.search(this.keyword) != -1;
        });
        if (this.isSearch === false) {
          baseList = this.catList;
        } else {
          baseList = this.catListSearch;
        }
        this.start = (this.currentPage - 1) * this.selectPerPage;
        this.catListRender = baseList.slice(
          this.start,
          this.start + this.selectPerPage
        );
        this.totalRow = baseList.length;
      },
      updateCurentPage(currentPage) {
        this.currentPage = currentPage;
      },
      search(keyword) {
        this.keyword = keyword;
        this.isSearch = true;
        // this.renderCatList();
      },
    },
  };
</script>

<style>
  #btn-form {
    display: flex;
    justify-content: center;
  }
  .header-table {
    margin: 50px 0px 15px 0px;
    display: flex;
    justify-content: space-between;
  }
  #select-perpage {
    display: flex;
    justify-content: space-between;
  }
</style>
