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
          <span class="refresh-icon" @click="reloadPage">
            <i class="simple-icon-refresh"></i>
          </span>
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

    <b-modal ref="userModal" :title="modalTitle" hide-footer>
      <b-form ref="userForm" @submit="submitUser">
        <div class="mb-3">
          <label class="form-label">Full Name</label>
          <input
            type="text"
            v-model="userForm.name"
            class="form-control"
            placeholder="Full Name"
          />
        </div>
        <div class="mb-3">
          <label class="form-label">Email</label>
          <input
          :disabled="type === 'edit'"
            type="text"
            v-model="userForm.email"
            autocomplete="false"
            class="form-control"
            placeholder="Email"
          />
        </div>  
        <div class="mb-3">
          <label class="form-label">Password</label>
          <input
            :disabled="type === 'edit'"
            type="password"
            v-model="userForm.password"
            class="form-control"
            placeholder="Password"
          />
        </div>
        <div class="mb-3">
          <!-- <label class="form-label">Role</label>
          <input
            type="text"
            v-model="userForm.role"
            class="form-control"
            placeholder="Role"
          /> -->
          <label class="form-label">Role</label>
          <b-form-select v-model="userForm.role" :options="roles"></b-form-select>

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
      userForm: {
        name: "",
        email: "",
        password: "",
        role: null,
      },
      type: "",
      modalTitle: "",
      selectedUserId: "",
      
      roles: [
        {value: null, text: '--Select a Role--'},
        {value: 'admin', text: 'Admin'},
        {value: 'staff', text: 'Staff'},
        {value: 'chef', text: 'Chef'},
      ]
    };
  },
  methods: {
    fetchAllUsers() {
      getUsers().then((res) => {
        this.users = res.result;
      });
    },
    reloadPage() {
      window.location.reload();
    },
    showModal(type, id) {
      this.selectedUserId = "";
      this.type = type;
      if (type === "new") {
        this.modalTitle = "Create New User";
        this.userForm = {};

      } else {
        this.modalTitle = "Edit User";
        if (id !== null) {
          this.selectedUserId = id;
          const user = this.users.filter((item) => item.id === id)[0];
          this.userForm.name = user.name;
          this.userForm.email = user.email;
          this.userForm.password= user.password;
          this.userForm.role= user.role;
        }
      }
      this.$refs["userModal"].show();
    },
    submitUser(e) {
      e.preventDefault();
      const formData = new FormData();
      formData.append("name", this.userForm.name);
      formData.append("email", this.userForm.email);
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
          }else {
              this.$notify("error", "Error", res.result, {
                duration: 3000,
                permanent: false,
              });
            }
        }).catch(err => {
          // const errors = err.response.data
          // this.errors = errors.errors
          const errors = "User already exists!"
          this.$notify("error", "Error", errors, {
              duration: 3000,
              permanent: false,
            });
        })
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
    this.moment = moment;
  },
};
</script>

<style>
  .refresh-icon {
  cursor: pointer;
  float: right;
}
</style>