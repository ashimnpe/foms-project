<template>
  <div>
    <b-row>
      <b-colxx xxs="12">
        <piaf-breadcrumb heading="PRODUCTS" />

        <b-button
          variant="success"
          class="float-right"
          @click="showModal('new', null)"
          >Add Product</b-button
        >
        <div class="separator mb-5"></div>
      </b-colxx>
    </b-row>

    <b-row>
      <b-colxx xxs="12">
        <b-card>
          <span class="refresh-icon" @click="reloadPage">
            <i class="simple-icon-refresh"></i>
          </span>
          <table class="table">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Image</th>
                <th scope="col">Product Name</th>
                <th scope="col">Price</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="(product, i) in products" :key="i">
                <td>{{ product.id }}</td>
                <td>
                  <img
                    style="width: 150px"
                    :src="`${img}/storage${product.image}`"
                  />
                </td>
                <td>{{ product.title }}</td>
                <td class="font-weight-bold">Rs. {{ product.price }}</td>
                <td>
                  <b-button @click="showModal('edit', product.id)"
                    >Edit</b-button
                  >
                  <b-button @click="deleteProduct(product.id)" variant="danger"
                    >Delete</b-button
                  >
                </td>
              </tr>
            </tbody>
          </table>
        </b-card>
      </b-colxx>
    </b-row>

    <b-modal ref="productModal" :title="modalTitle" hide-footer>
      <b-form ref="productForm" @submit="submitProduct">
        <div class="mb-3">
          <label class="form-label">Category Title</label>
          <select v-model="productForm.category_id" class="form-control">
            <option
              v-for="(category, i) in categories"
              :value="category.id"
              :key="i"
            >
              {{ category.title }}
            </option>
          </select>
        </div>

        <div class="mb-3">
          <label class="form-label">Product Name</label>
          <input
            type="text"
            v-model="productForm.title"
            class="form-control"
            placeholder="Product Name"
            aria-label="Full name"
          />
        </div>

        <div class="mb-3">
          <label class="form-label">Price</label>
          <input
            type="text"
            v-model="productForm.price"
            class="form-control"
            placeholder="Price"
            aria-label="Full name"
          />
        </div>

        <div class="mb-3">
          <label class="form-label">Image</label>
          <b-form-file
            v-model="productForm.image"
            :state="Boolean(productForm.image)"
            placeholder="Choose a file or drop it here..."
            drop-placeholder="Drop file here..."
          ></b-form-file>
          <div class="mt-3">
            Selected file:
            {{
              productForm.image && type === "new"
                ? productForm.image.name
                : productForm.url
            }}
          </div>
        </div>

        <b-button variant="primary" type="submit" class="mr-1">
          <template v-if="type === 'new'">Create</template>
          <template v-else>Update</template>
        </b-button>
      </b-form>
    </b-modal>
    <b-colxx xxs="12">
      <b-pagination-nav
            size="sm"
            align="center"
            :number-of-pages="3"
            :link-gen="linkGen"
            v-model="currentPage"
            :per-page="5"
          >
            <template v-slot:next-text>
              <i class="simple-icon-arrow-right"/>
            </template>
            <template v-slot:prev-text>
              <i class="simple-icon-arrow-left"/>
            </template>
            <template v-slot:first-text>
              <i class="simple-icon-control-start"/>
            </template>
            <template v-slot:last-text>
              <i class="simple-icon-control-end"/>
            </template>
          </b-pagination-nav>
    </b-colxx>
  </div>
</template>

 <script>
import { getCategories } from "@/api/categories";
import { createProduct, updateProduct, deleteProduct } from "@/api/products";
import { imageBaseUrl } from "@/constants/config";

export default {
  data() {
    return {
      categories: [],
      products: [],
      img: imageBaseUrl,
      productForm: {
        category_title: "",
        category_id: "",
        title: "",
        price: "",
        image: null,
        url: "",
      },
      type: "",
      modalTitle: "",
      selectedProductId: "",
      errors: [],
    };
  },
  methods: {
    linkGen(pageNum) {
      return "#page/" + pageNum + "/foobar";
    },
    fetchAllCategories() {
      getCategories().then((res) => {
        const categories = res.result;
        const products = [];
        this.categories = categories;
        categories.map((category) => {
          products.push(...category.products);
        });
        this.products = products;
      });
    },
    reloadPage() {
      window.location.reload();
    },
    showModal(type, id) {
      this.selectedProductId = "";
      this.type = type;
      if (type === "new") {
        this.modalTitle = "Add New Product";
        this.productForm = {};
      } else {
        this.modalTitle = "Edit Product";
        if (id !== null) {
          this.selectedProductId = id;
          const product = this.products.filter((item) => item.id === id)[0];
          this.productForm.category_title = product.category_title;
          this.productForm.category_id = product.category_id;
          this.productForm.title = product.title;
          this.productForm.price = product.price;
          this.productForm.url = product.image;
        }
      }
      this.$refs["productModal"].show();
    },
    submitProduct(e) {
      e.preventDefault();
      const formData = new FormData();
      formData.append("category_id", this.productForm.category_id);
      formData.append("title", this.productForm.title);
      formData.append("price", this.productForm.price);
      formData.append("image", this.productForm.image);
      if (this.type === "new") {
        createProduct(formData, {
          headers: {
            headers: {
              "Content-Type": "multipart/form-data",
            },
          },
        })
          .then((res) => {
            if (res.success) {
              this.fetchAllCategories();
              this.$refs["productModal"].hide();
              this.productForm = {};
              this.$notify("success", "Success", res.result, {
                duration: 3000,
                permanent: false,
              });
              // } else {
              //   this.$notify("error", "Error", res.result, {
              //     duration: 3000,
              //     permanent: false,
              //   });
              // }
            }
          })
          .catch((err) => {
            console.log(err);
            // const errors = err.response.data
            // this.errors = errors.errors
            const errors = "Product already exists!";
            this.$notify("error", "Error", errors, {
              duration: 3000,
              permanent: false,
            });
          });
      } else {
        formData.append("id", this.selectedProductId);
        updateProduct(formData, {
          headers: {
            headers: {
              "Content-Type": "multipart/form-data",
            },
          },
        }).then((res) => {
          if (res.success) {
            this.fetchAllCategories();
            this.$refs["productModal"].hide();
            this.productForm = {};
            this.$notify("success", "Success", res.result, {
              duration: 3000,
              permanent: false,
            });
          }
        });
      }
    },
    deleteCategory(id) {
      this.$bvModal
        .msgBoxConfirm("Are you sure want to Delete?")
        .then((value) => {
          if (value) {
            deleteProduct({
              id: id,
            }).then((res) => {
              if (res.success) {
                this.fetchAllProducts();
                this.$notify("error", "Success", res.result, {
                  duration: 3000,
                  permanent: false,
                });
              }
            });
          }
        })
        .catch((err) => {
          // An error occurred
        });
    },
  },
  mounted() {
    this.fetchAllCategories();
  },
};
</script>

<style>
.refresh-icon {
  cursor: pointer;
}
</style>