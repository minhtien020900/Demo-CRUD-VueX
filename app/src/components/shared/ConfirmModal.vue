<template>
  <div id="confirm-modal"></div>
</template>

<script>
import { eventBus } from "@/main";

export default {
  props: {
    title: {
      default: null,
    },
  },
  data() {
    return {};
  },
  created() {
    eventBus.$on("showConfirmDialog", () => {
      this.show();
    });
  },
  beforeDestroy() {
    eventBus.$off("showConfirmDialog");
  },
  methods: {
    show() {
      this.$bvModal
        .msgBoxConfirm(this.title, {
          title: "Please Confirm",
          size: "sm",
          buttonSize: "sm",
          okVariant: "danger",
          okTitle: "YES",
          cancelTitle: "NO",
          footerClass: "p-2",
          hideHeaderClose: false,
          centered: true,
        })
        .then((value) => {
          if (value === true) {
            this.$emit("deleteConfirm");
          } else {
            this.$emit("closeDelete");
          }
        })
        .catch((err) => {
          console.log(err);
        });
    },
  },
};
</script>

<style></style>
