<template>
  <div>
    <b-row>
      <b-colxx xxs="12">
        <piaf-breadcrumb heading="USERS" />
        <b-button class="float-right" @click="showModal('new', null)"
          >Create User</b-button
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
                <th scope="col">Full Name</th>
                <th scope="col">Email</th>
                <th scope="col">Role</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="(user, i) in users" :key="i">
                <td>{{ user.id }}</td>
                <td>{{ user.name }}</td>
                <td>{{ user.email }}</td>
                <td class="text-uppercase">{{ user.role }}</td>
                <td>
                  <b-button @click="showModal('edit', user.id)">Edit</b-button>
                  <b-button @click="deleteUser(user.id)" variant="danger"
                    >Delete</b-button
                  >
                </td>
              </tr>
            </tbody>
          </table>
        </b-card>
      </b-colxx>
    </b-row>

    <b-modal ref="UserModal" :title="modalTitle" hide-footer>
      <b-form ref="categoryForm" @submit="submitUser">
        <div class="mb-3">
          <label class="form-label">Full Name</label>
          <input
            type="text"
            v-model="userForm.name"
            class="form-control"
            placeholder="Full Name"
            aria-label="Full name"
          />
        </div>
        <div class="mb-3">
          <label class="form-label">Email</label>
          <input
            type="text"
            v-model="userForm.email"
            class="form-control"
            placeholder="Email"
            aria-label="Full name"
          />
        </div>
        <div v-if="type === 'new'" class="mb-3">
          <label class="form-label">Password</label>
          <input
            type="password"
            v-model="userForm.password"
            class="form-control"
            placeholder="Password"
            aria-label="Full name"
          />
        </div>
        <div class="mb-3">
          <label class="form-label">Role</label>
          <select v-model="userForm.role" class="form-select form-control">
            <option value="1" >Staff</option>
            <option value="2">Chef</option>
          </select>

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
import { getUsers , createUser, updateUser, deleteUser} from "@/api/users";

export default {
  data() {
    return {
      users: [],
      type: "",
      modalTitle: "",
      userForm: {
        name: "",
        email: "",
        password: "",
        role: "",
      },
      selectedCategoryId: "",
    };
  },
  methods: {
    fetchAllUsers() {
      getUsers().then((res) => {
        this.users = res.result;
      });
    },
    showModal(type, id) {   
        this.selectedUserId = "";
      this.type = type;
      if (type === "new") {
        this.modalTitle = "Create New User";
      } else {
        this.modalTitle = "Edit User";
        if (id !== null) {
          this.selectedUserId = id;
          const user= this.users.filter((item) => item.id === id)[0];
          this.userForm.name = user.name;
          this.userForm.email = user.email;
          this.userForm.password= user.password;
          this.userForm.role= user.role;
        }
      }
      this.$refs["UserModal"].show();
    },
    submitUser(e) {
      e.preventDefault();
      const formData = new FormData();
      formData.append("name", this.userForm.name);
      formData.append("title", this.userForm.email);
      formData.append("password", this.userForm.password);
      formData.append("role", this.userForm.role);
      if (this.type === "new") {
        createUser(formData, {
          headers: {
            headers: {
              "Content-Type": "multipart/form-data",
            },
          },
        }).then((res) => {
          if (res.success) {
            this.fetchAllUsers();
            this.$refs["userModal"].hide();
            this.userForm = {};
            this.$notify("success", "Success", res.result, {
              duration: 3000,
              permanent: false,
            });
          }
        });
      } else {
        formData.append("id", this.selectedUserId);
        updateUser(formData, {
          headers: {
            headers: {
              "Content-Type": "multipart/form-data",
            },
          },
        }).then((res) => {
          if (res.success) {
            this.fetchAllUsers();
            this.$refs["userModal"].hide();
            this.userForm = {};
            this.$notify("success", "Success", res.result, {
              duration: 3000,
              permanent: false,
            });
          }
        });
      }
    },
    deleteUser(id) {
      this.$bvModal
        .msgBoxConfirm("Are you sure want to Delete?")
        .then((value) => {
          if (value) {
            deleteUser({
              id: id,
            }).then((res) => {
              if (res.success) {
                this.fetchAllUsers();
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
    this.fetchAllUsers();
  },
};
</script>