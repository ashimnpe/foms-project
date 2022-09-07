<template>
  <div>
    <b-row>
      <b-colxx xxs="12">
        <piaf-breadcrumb heading="CATEGORIES" />
        <b-button
          variant="success"
          class="float-right"
          @click="showModal('new', null)"
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
                  <img
                    class="category-image"
                    style="width: 96px"
                    :src="`${img}/storage${category.image}`"
                  />
                </td>
                <td>{{ category.title }}</td>
                <td>
                  <b-button @click="showModal('edit', category.id)"
                    >Edit</b-button
                  >
                  <b-button
                    @click="deleteCategory(category.id)"
                    variant="danger"
                    >Delete</b-button
                  >
                </td>
              </tr>
            </tbody>
          </table>
        </b-card>
      </b-colxx>
    </b-row>

    <b-modal ref="categoryModal" :title="modalTitle" hide-footer>
        <b-form ref="categoryForm" @submit="submitCategory">
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
          <div class="mb  -3">
            <label class="form-label">Image</label>
            <b-form-file
              v-model="categoryForm.image"
              :state="Boolean(categoryForm.image)"
              placeholder="Choose a file or drop it here..."
              drop-placeholder="Drop file here..."
            ></b-form-file>
            <div class="mt-3">
              Selected file:
              {{
                categoryForm.image && type === "new"
                  ? categoryForm.image.name
                  : categoryForm.image
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
import {
  getCategories,
  createCategory,
  updateCategory,
  deleteCategory,
} from "@/api/categories";
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
        type: "",
      modalTitle: "",
      selectedCategoryId: "",
    };
  },
  methods: {
    fetchAllCategories() {
      getCategories().then((res) => {
        this.categories = res.result;
      });
    },
    showModal(type, id) {
      this.selectedCategoryId = "";
      this.type = type;
      if (type === "new") {
        this.modalTitle = "Create New Category";
      } else {
        this.modalTitle = "Edit Category";
        if (id !== null) {
          this.selectedCategoryId = id;
          const category = this.categories.filter((item) => item.id === id)[0];
          this.categoryForm.title = category.title;
          this.categoryForm.image = category.image;
        }
      }
      this.$refs["categoryModal"].show();
    },
    submitCategory(e) {
      e.preventDefault();
      const formData = new FormData();
      formData.append("image", this.categoryForm.image);
      formData.append("title", this.categoryForm.title);
      if (this.type === "new") {
        createCategory(formData, {
          headers: {
            headers: {
              "Content-Type": "multipart/form-data",
            },
          },
        }).then((res) => {
          if (res.success) {
            this.fetchAllCategories();
            this.$refs["categoryModal"].hide();
            this.categoryForm = {};
            this.$notify("success", "Success", res.result, {
              duration: 3000,
              permanent: false,
            });
          }
          else{
            this.$notify("success", message, res.result, {
              duration: 3000,
              permanent: false,
            });
          }
        });
      } else {
        formData.append("id", this.selectedCategoryId);
        updateCategory(formData, {
          headers: {
            headers: {
              "Content-Type": "multipart/form-data",
            },
          },
        }).then((res) => {
          if (res.success) {
            this.fetchAllCategories();
            this.$refs["categoryModal"].hide();
            this.categoryForm = {};
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
            deleteCategory({
              id: id,
            }).then((res) => {
              if (res.success) {
                this.fetchAllCategories();
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
.category-image {
  width: 96px;
  height: 64px;
  object-fit: cover;
}
</style>