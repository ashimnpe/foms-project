<template>
    <div>
        <b-row>
            <b-colxx xxs="12">
                <piaf-breadcrumb heading="USERS" />
                <b-button class="float-right" @click="newUser()">Create User</b-button>
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

        <b-modal ref="addUser" title="Create User">
            <div>
                <!-- <b-row>
                <b-colxx xxs="12">
                    <b-card class="mb-4" :title="$t('forms.basic')">
                        <b-form @submit.prevent="onValitadeFormSubmit" class="av-tooltip tooltip-label-right">
                            <b-form-group :label="$t('forms.name')">
                                <b-form-input type="text" v-model.trim="$v.name.$model" :state="!$v.name.$error" />
                                <b-form-invalid-feedback>Name is required!</b-form-invalid-feedback>
                            </b-form-group>
                            <b-form-group label="Rank">
                                <b-form-input type="text" v-model.trim="$v.rank.$model" :state="!$v.rank.$error" />
                                <b-form-invalid-feedback>This is an error!</b-form-invalid-feedback>
                            </b-form-group>
                            <b-form-group label="Option">
                                <b-form-select v-model.trim="$v.select.$model" :state="!$v.select.$error" :options="selectOptions" plain />
                                <b-form-invalid-feedback>Please select an option!</b-form-invalid-feedback>
                            </b-form-group>
                            <b-form-group label="Details">
                                <b-textarea v-model.trim="$v.detail.$model" :state="!$v.detail.$error"></b-textarea>
                                <b-form-invalid-feedback>Please enter some details!</b-form-invalid-feedback>
                            </b-form-group>
                            <b-form-group label="Custom Radio Buttons" class="error-l-150">
                                <b-form-radio-group stacked v-model.trim="$v.customRadio.$model">
                                    <b-form-radio value="first">Select this custom radio</b-form-radio>
                                    <b-form-radio value="second">Or this one</b-form-radio>
                                    <b-form-radio value="third">But not this disabled one</b-form-radio>
                                </b-form-radio-group>
                                <b-form-invalid-feedback class="d-block" v-if="!$v.customRadio.required && $v.customRadio.$dirty">Please select one!</b-form-invalid-feedback>
                            </b-form-group>
                            <b-form-group label="Custom Checkboxes" class="error-l-150">
                                <b-form-checkbox-group v-model.trim="$v.customCheckbox.$model" >
                                    <b-form-checkbox value="yes">Yes</b-form-checkbox>
                                    <b-form-checkbox value="no">No</b-form-checkbox>
                                </b-form-checkbox-group>
                                <b-form-invalid-feedback class="d-block" v-if="!$v.customCheckbox.required && $v.customCheckbox.$dirty">Please select one!</b-form-invalid-feedback>
                            </b-form-group>
                            <b-button type="submit" variant="primary" class="mt-4" >{{ $t('forms.submit') }}</b-button>
                        </b-form>
                    </b-card>
                </b-colxx>
            </b-row> -->
            </div>
        </b-modal>  

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
            },
            newUser(id) {
                this.$refs["addUser"].show();
            },
        },
        mounted(){
            this.fetchAllUsers();
        }
    }
</script>