<template>
  <home-layout>
    <b-row class="mb-5">
      <b-colxx xxs="12">
        <div>
          <b-navbar
            variant="faded"
            type="light"
            class="fixed-top px-5"
            style="height: 75px;"
          >
            <b-navbar-brand tag="h1" class="mb-0"
              >ORDER MANAGEMENT SYSTEM</b-navbar-brand
            >
            <b-navbar-nav class="ml-auto">
              <h4 class="mt-2">
                Order Total:
                <strong class="text-danger">Rs.{{ netTotal }}</strong>
              </h4>
              <b-button
                @click="openOrderSummary('modalright')"
                class="mb-1 ml-4"
                variant="primary"
                :disabled="netTotal <= 0"
                >ORDER SUMMARY</b-button
              >
              <b-button
                class="mb-1 ml-2"
                variant="outline-primary"
                @click="goToLogin()"
                >LOGIN</b-button
              >
            </b-navbar-nav>
          </b-navbar>
        </div>
      </b-colxx>
    </b-row>

    <b-row style="margin-top: 80px;">
      <b-colxx xx="12">
        <div>
          <b-tabs content-class="mt-3" justified>
            <b-tab
              v-for="(category, i) in categories"
              :key="i"
              :title="category.title"
              :active="category.id === 1"
            >
              <b-container fluid>
                <b-row>
                  <b-col
                    cols="12"
                    md="3"
                    sm="6"
                    v-for="(product, j) in category.products"
                    :key="j"
                  >
                    <b-card class="my-2" no-body>
                      <div class="position-relative">
                        <img
                          :src="img + product.image"
                          class="card-img-top"
                        />
                        <b-badge
                          variant="danger"
                          pill
                          class="position-absolute badge-top-left-2 price-tag"
                          >PRICE: {{ product.price }}</b-badge
                        >
                      </div>
                      <b-card-body class="py-3">
                        <h4 class="card-subtitle">
                          {{ product.title }}
                        </h4>
                        <hr />
                        <div
                          class="d-flex justify-content-around align-items-center"
                        >
                          <b-button
                            class="btn-circle btn-xl"
                            variant="danger"
                            @click="changeQuantity(product, 'decrease')"
                          >
                            <div class="iconsminds-remove glyph-icon " />
                          </b-button>
                          <p style="font-size: 2rem;" class="mt-3">
                            {{ product.quantity ? product.quantity : 0 }}
                          </p>
                          <b-button
                            class="btn-circle btn-xl"
                            variant="success"
                            @click="changeQuantity(product, 'increase')"
                          >
                            <div class="iconsminds-add glyph-icon " />
                          </b-button>
                        </div>
                      </b-card-body>
                    </b-card>
                  </b-col>
                </b-row>
              </b-container>
            </b-tab>
          </b-tabs>
        </div>
      </b-colxx>
      <b-modal
        id="modalright"
        ref="modalright"
        title="ORDER SUMMARY"
        modal-class="modal-right"
        size="lg"
      >
        <b-table hover :fields="productTable.fields" :items="products">
          <template #cell(action)="row">
            <b-button
              variant="link"
              class="p-0 text-danger text-left"
              block
              @click="removeItem(row.item.id)"
            >
              X
            </b-button>
          </template>
        </b-table>
        <hr />
        <div class="text-right mr-4">
          <h2>
            Net Total:
            <span class="text-danger font-weight-bold">Rs.{{ netTotal }}</span>
          </h2>
        </div>
        <template slot="modal-footer">
          <b-button variant="primary" @click="placeOrder()" class="mr-1"
            >Place Order</b-button
          >
          <b-button variant="secondary" @click="hideModal('modalright')"
            >Cancel</b-button
          >
        </template>
      </b-modal>
      <b-modal ref="orderPlacedModal" size="sm" hide-footer hide-header>
        <div class="text-center">
          <h3>Your Order has been placed successfully!</h3>
          <p>Please note your Order ID</p>
          <h1 style="font-size: 4rem;" class="text-danger font-weight-bold">
            {{ orderId }}
          </h1>
        </div>
      </b-modal>
    </b-row>
  </home-layout>
</template>

<script>
import axios from "axios";
import HomeLayoutVue from "../../layouts/HomeLayout.vue";
import UserLayout from "../../layouts/UserLayout";
import ImageCards from "../../containers/ui/ImageCards";
import { baseUrl, imageBaseUrl } from "../../constants/config";
import ListPageListing from "../../containers/pages/ListPageListing";
import { iconsmind, simplelineicons } from "../../data/icons";

export default {
  components: {
    "list-page-listing": ListPageListing,
    "user-layout": UserLayout,
    "image-cards": ImageCards,
    "home-layout": HomeLayoutVue,
  },
  data() {
    return {
      categories: [],
      products: [],
      netTotal: 0,
      orderId: "",
      img: imageBaseUrl,
      simplelineicons,
      iconsmind,
      productTable: {
        selected: [],
        selectMode: "multi",
        fields: [
          {
            key: "title",
            label: "Product",
            sortable: true,
            sortDirection: "asc",
          },
          {
            key: "price",
            label: "Price",
            sortable: true,
            tdClass: "text-muted text-center",
          },
          {
            key: "quantity",
            label: "Quantity",
            sortable: true,
            tdClass: "text-muted text-center",
          },
          {
            key: "total",
            label: "Total",
            sortable: true,
            tdClass: "font-weight-semibold text-center",
          },
          {
            key: "action",
            label: "Action",
            tdClass: "font-weight-bold text-left text-danger",
          },
        ],
      },
    };
  },
  methods: {
    placeOrder() {
      const vm = this;
      axios
        .post(baseUrl + "place/order", {
          products: this.products,
          netTotal: this.netTotal,
        })
        .then((response) => {
          const res = response.data;
          if (res.success) {
            vm.$notify("success", "Order Success", res.result.message, {
              duration: 3000,
              permanent: false,
            });
            vm.orderId = res.result.orderId;
            vm.$refs["orderPlacedModal"].show();
            vm.$refs["modalright"].hide();
            vm.products = [];
            vm.netTotal = 0;
            vm.categories.map((category) => {
              category.products.map((product) => {
                product.quantity = 0;
              });
            });
          }
        });
    },
    removeItem(id) {
      const index = this.products.findIndex((product) => product.id === id);
      this.products.splice(index, 1);
      this.categories.map((category) => {
        category.products.map((product) => {
          if (product.id === id) {
            product.quantity = 0;
          }
        });
      });
      this.prepareSummary();
    },
    prepareSummary() {
      this.products = [];
      let netTotal = 0;
      this.categories.map((category) => {
        category.products.map((product) => {
          if (product.quantity > 0) {
            product.total = product.price * product.quantity;
            this.products.push(product);
            netTotal += product.total;
          }
        });
      });
      this.netTotal = netTotal;
    },
    openOrderSummary(refname) {
      this.$refs[refname].show();
    },
    hideModal(refname) {
      this.$refs[refname].hide();
    },
    goToLogin() {
      this.$router.push("/user");
    },
    fetchProducts() {
      axios.get(baseUrl + "get/products").then((res) => {
        res.data.result.map((category) => {
          category.products.map((product) => {
            product.quantity = 0;
          });
          this.categories.push(category);
        });
      });
    },
    changeQuantity(item, operator) {
      this.categories.map((category) => {
        return category.products.map((product) => {
          if (product.id === item.id) {
            operator == "increase"
              ? product.quantity++
              : product.quantity === 0
              ? 0
              : product.quantity--;
          }
        });
      });
      this.prepareSummary();
    },
  },
  mounted() {
    this.fetchProducts();
  },
};
</script>
<style>
.modal-right .modal-dialog {
  max-width: 680px;
}
</style>
