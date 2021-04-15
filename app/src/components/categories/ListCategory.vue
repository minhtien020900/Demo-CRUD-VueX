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
          <b-img
          thumbnail
            rounded
            center
            :src="`http://localhost:8000/${data.item.image}`"
          />
        </template>
        <template #cell(operations)="row">
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
    <category-modal :editedItem="editedItem" @save="save">
      <template slot="modal-title">{{ formTitle }}</template>
    </category-modal>

    <div id="modal-comfirm">
      <ConfirmModal
        @deleteConfirm="deleteCatItem()"
        @closeDelete="closeDelete()"
        :title="'You want delete this category?'"
      />
    </div>

    <Pagination
      :perPage="selectPerPage"
      :totalRows="totalRows"
      @updateCurentPage="updateCurentPage($event)"
    />
  </div>
</template>

<script>
  import ConfirmModal from "../shared/ConfirmModal";
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
      ConfirmModal,
    },
    props: {},

    data() {
      return {
        editedIndex: -1,
        editedItem: {},
        catFields: [
          { key: "id", label: "#", sortable: true },
          { key: "name", label: "Category name", sortable: true },

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
      this.$store.dispatch("fetchCatList");
      this.renderCatList();
      this.totalRow = this.catList.length;
    },
    mounted() {},
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
      catList() {
        return this.$store.getters.getCatList;
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
    },
    methods: {
      showConfirmDialog(item) {
        eventBus.$emit("showConfirmDialog");
        this.editedIndex = item.id;
      },
      showCatModal() {
        this.$bvModal.show("category-modal");
      },
      closeCatModal() {
        this.$bvModal.hide("category-modal");
        this.$nextTick(() => {
          this.editedItem = {};
          this.editedIndex = -1;
        });
      },
      closeDelete() {
        this.$nextTick(() => {
          this.editedItem = {};
          this.editedIndex = -1;
        });
      },
      editItem(item) {
        this.editedIndex = item.id;
        this.editedItem = Object.assign({}, item);
        this.showCatModal();
      },
      deleteCatItem() {
        if (this.editedIndex > -1) {
          this.$store.dispatch("deleteCat", this.editedIndex);
        }
        this.closeDelete();
      },
      save(data) {
        if (this.editedIndex > -1) {
          let payload = { id: this.editedIndex, data: data };
          this.$store.dispatch("editCat", payload);
        } else {
          this.$store.dispatch("addCat", data);
        }
        this.closeCatModal();
      },
      renderCatList() {
        let baseList = [];
        this.catListSearch = this.catList.filter((catItem) => {
          return catItem.name.search(this.keyword) != -1;
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
  img {
  width: 40%;
  height: 40%;
  }
</style>
