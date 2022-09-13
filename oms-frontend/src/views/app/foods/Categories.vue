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
          <span class="refresh-icon" @click="reloadPage">
            <i class="simple-icon-refresh"></i>
          </span>
          <table class="table  table-hover">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col" class="text-center">Image</th>
                <th scope="col" class="text-center">Category Name</th>
                <th scope="col" class="text-center">Action</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="(category, i) in categories" :key="i">
                <td>{{ category.id }}</td>
                <td class="text-center">
                  <img
                    class="category-image"
                    style="width: 96px"
                    :src="`${img}/storage${category.image}`"
                  />
                </td>
                <td class="text-center">{{ category.title }}</td>
                <td class="text-center">
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
      <b-form @submit="submitCategory">
        <div class="mb-3">
          <label class="form-label">Category Name</label>
          <input
            type="text"
            v-model="categoryForm.title"
            class="form-control"
            placeholder="Category Name"
            aria-label="Full name"
          />
          <!-- <small class="text-danger" v-if="errors">
            <ul>
              <li v-for="(err, i) in errors.title" :key="i">
                {{ err }}
              </li>
            </ul>
          </small> -->
        </div>
        <div class="mb -3">
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
                : categoryForm.url
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
import moment from "moment";

export default {
  data() {
    return {
      categories: [],
      img: imageBaseUrl,
      categoryForm: {
        title: "",
        image: null,
        url: "",
      },
      type: "",
      modalTitle: "",
      selectedCategoryId: "",
      errors: [],
    };
  },
  methods: {
    fetchAllCategories() {
      getCategories().then((res) => {
        this.categories = res.result;
      });
    },
    reloadPage() {
      window.location.reload();
    },
    showModal(type, id) {
      this.selectedCategoryId = "";
      this.type = type;
      if (type === "new") {
        this.modalTitle = "Create New Category";
        this.categoryForm = {};
      } else {
        this.modalTitle = "Edit Category";
        if (id !== null) {
          this.selectedCategoryId = id;
          const category = this.categories.filter((item) => item.id === id)[0];
          this.categoryForm.title = category.title;
          this.categoryForm.url = category.image;
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
        })
          .then((res) => {
            if (res.success) {
              this.fetchAllCategories();
              this.$refs["categoryModal"].hide();
              this.categoryForm = {};
              this.$notify("success", "Success", res.result, {
                duration: 3000,
                permanent: false,
              });
            } else {
              this.$notify("error", "Error", res.result, {
                duration: 3000,
                permanent: false,
              });
            }
          })
          .catch((err) => {
            // const errors = err.response.data
            // this.errors = errors.errors
            const errors = "Category already exists!";
            this.$notify("error", "Error", errors, {
              duration: 3000,
              permanent: false,
            });
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
            // this.categoryForm = {};
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
    this.moment = moment;
  },
};
</script>

<style>
.category-image {
  width: 96px;
  height: 64px;
  object-fit: cover;
}

ul {
  list-style: none;
  font-size: 16px;
}

.err {
  border: 1px solid #f00;
}

.refresh-icon {
  cursor: pointer;
  float: right;
}
</style>