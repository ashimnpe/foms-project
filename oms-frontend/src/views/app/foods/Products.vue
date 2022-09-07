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
                <td><img style="width: 150px" :src="img + product.image" /></td>
                <td>{{ product.title }}</td>
                <td>{{ product.price }}</td>
                <!-- <td>
                  <b-button @click="showModal('edit', product.id)"
                    >Edit</b-button
                  >
                  <b-button
                    @click="deleteCategory(product.id)"
                    variant="danger"
                    >Delete</b-button
                  >
                </td> -->
              </tr>
            </tbody>
          </table>
        </b-card>
      </b-colxx>
    </b-row>

    <!-- Modal view -->
    <!-- <b-modal ref="ProductModal" :title="modalTitle" hide-footer>
      <b-form ref="productForm" @submit="submitProduct">
        <div class="mb-3">
                  <label class="form-label">Category</label>
                    <select name="" id="" class="form-control">
                      <option value=""></option>
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
                : productForm.image
            }}
          </div>
        </div>

        <b-button variant="primary" type="submit" class="mr-1">
          <template v-if="type === 'new'">Create</template>
          <template v-else>Update</template>
        </b-button>
      </b-form>
    </b-modal> -->


    <b-modal ref="productModal" :title="modalTitle" hide-footer>
      <b-form ref="productForm">
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
                : productForm.image
            }}
          </div>
        </div>

        <b-button variant="primary" type="submit" class="mr-1">
          <template v-if="type === 'new'">Create</template>
          <template v-else>Update</template>
        </b-button>
      </b-form>
    </b-modal>
  </div>
</template>

<script>
import { getProducts } from "@/api/products";
import { baseUrl, imageBaseUrl } from "@/constants/config";

export default {
  data() {
    return {
      products: [],
      img: imageBaseUrl,
      productForm: {
        category_id: "",
        title: "",
        price: "",
        image: "",
      },
      type: "",
      modalTitle: "",
      selectedProductId: "",
    };
  },
  methods: {
    fetchAllProducts() {
      getProducts().then((res) => {
        this.products = res.result;
      });
    },
    showModal(type, id) {
      this.selectedProductId = "";
      this.type = type;
      if (type === "new") {
        this.modalTitle = "Add New Product";
      } else {
        this.modalTitle = "Edit Product";
        if (id !== null) {
          this.selectedProductId = id;
          const product = this.product.filter((item) => item.id === id)[0];
          this.productForm.category_id = category.category_id;
          this.productForm.title = category.title;
          this.productForm.price = category.price;
          this.productForm.image = category.image;
        }
      }
      this.$ref["productModal"].show();
    },
    // submitProduct(){
    //   console.log('hello');
    // }
    
  },
  mounted() {
    this.fetchAllProducts();
  },
};
</script>

<style>
</style>