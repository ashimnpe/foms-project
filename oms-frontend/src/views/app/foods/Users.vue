<template>
    <div>
        <b-row>
            <b-colxx xxs="12">
            <piaf-breadcrumb heading="USERS" />
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
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(user, i) in users" :key="i">
                                <td>{{user.id}}</td>
                                <td>{{user.name}}</td>
                                <td>{{user.email}}</td>
                                <td class="text-uppercase">{{user.role}}</td>
                            </tr>
                        </tbody>
                    </table>
                </b-card>
            </b-colxx>
        </b-row>
    </div>
</template>

<script>
import { getUsers } from "@/api/users";

    export default {
        data() {
            return {
                users: [],
            };
        },
        methods: {
            fetchAllUsers(){
                getUsers().then((res) => {
                    this.users = res.result;
                });
            }
        },
        mounted(){
            this.fetchAllUsers();
        }
    }
</script>