<template>
  <div>
    <b-row>
      <b-colxx xxs="12">
        <piaf-breadcrumb heading="CATEGORIES" />
        <b-button variant="success" class="float-right" @click="newCategory()"
          >Create Category</b-button
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
                <th scope="col">Category Name</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="(category, i) in categories" :key="i">
                <td>{{ category.id }}</td>
                <td>
                  <img style="width: 96px" :src="img + category.image" />
                </td>
                <td>{{ category.title }}</td>
                <td>
                  <b-button>Edit</b-button>
                  <b-button variant="danger">Delete</b-button>
                </td>
              </tr>
            </tbody>
          </table>
        </b-card>
      </b-colxx>
    </b-row>

    <b-modal ref="newCat" title="Create Category" hide-footer>
      <b-form ref="categoryForm" @submit="createCategory">
        <div class="mb-3">
          <label class="form-label">Category Name</label>
          <input
            type="text"
            v-model="categoryForm.title"
            class="form-control"
            placeholder="Category Name"
            aria-label="Full name"
          />
        </div>
        <div class="mb-3">
          <label class="form-label">Image</label>
          <b-form-file
            v-model="categoryForm.image"
            :state="Boolean(categoryForm.image)"
            placeholder="Choose a file or drop it here..."
            drop-placeholder="Drop file here..."
          ></b-form-file>
          <div class="mt-3">Selected file: {{ categoryForm.image ? categoryForm.image.name : "" }}</div>
        </div>

        <b-button variant="primary" type="submit" class="mr-1">Create</b-button>
      </b-form>
    </b-modal>
  </div>
</template>

<script>
import { getCategories, createCategory } from "@/api/categories";
import { imageBaseUrl } from "@/constants/config";

export default {
  data() {
    return {
      categories: [],
      img: imageBaseUrl,
      categoryForm: {
        title: "",
        image: "",
      },
    };
  },
  methods: {
    fetchAllCategories() {
      getCategories().then((res) => {
        this.categories = res.result;
      });
    },
    newCategory() {
      this.$refs["newCat"].show();
    },
    createCategory(e) {
      e.preventDefault();
      const formData = new FormData();
      formData.append('image', this.categoryForm.image)
      formData.append('title', this.categoryForm.title)
      createCategory(formData, {
        headers: {
            headers: {
                  "Content-Type": "multipart/form-data"
              }
        }
      }).then((res) => {
        console.log(res)
      })
    },
  },
  mounted() {
    this.fetchAllCategories();
  },
};
</script>

<style>
</style>