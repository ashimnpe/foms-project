<template>
    <div>
        <b-row>
            <b-colxx xxs="12">
            <piaf-breadcrumb heading="CATEGORIES" />
           <b-button variant="success" class="float-right" @click="newCategory()">Create Category</b-button>
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
                                <td>{{category.id}}</td>
                                <td>
                                    <img style="width: 150px;" :src="img + category.image"/>
                                </td>
                                <td>{{category.title}}</td>
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

        <b-modal ref="newCat" title="Create Category">
            <div class="mb-3">
                <label class="form-label">Category Name</label>
                <input type="text" class="form-control" placeholder="Category Name" aria-label="Full name">
            </div>
            <div class="mb-3">
                <label class="form-label">Image</label>
                <input type="file" class="form-control" id="inputGroupFile01">
            </div>
            
            <template slot="modal-footer">
                <b-button variant="primary" @click="createCategory()" class="mr-1"
                    >Create</b-button
                >
            </template>
        </b-modal> 

    </div>
</template>

<script>
import { getCategories } from '@/api/categories';
import { imageBaseUrl } from "@/constants/config";

export default {
    data(){
        return{
            categories: [],
            img: imageBaseUrl,
            fields: [
                
            ],
        };
    },
    methods: {
        fetchAllCategories(){
            getCategories().then((res) => {
                this.categories = res.result;
            });
        },
        newCategory(){
            this.$refs["newCat"].show();
        },
        createCategory(){
            console.log('hello');
        }
    },
    mounted(){
        this.fetchAllCategories();
    }
}
</script>

<style>

</style>