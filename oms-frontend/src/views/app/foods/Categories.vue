<template>
    <div>
        <b-row>
            <b-colxx xxs="12">
            <piaf-breadcrumb heading="CATEGORIES" />
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
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(category, i) in categories" :key="i">
                                <td>{{category.id}}</td>
                                <td>{{category.image}}</td>
                                <td>{{category.title}}</td>
                            </tr>
                        </tbody>
                    </table>
                </b-card>
            </b-colxx>
        </b-row>
    </div>
</template>

<script>
import { getCategories } from '@/api/categories';
export default {
    data(){
        return{
            categories: []
        };
    },
    methods: {
        fetchAllCategories(){
            getCategories().then((res) => {
                this.categories = res.result;
            });
        }
    },
    mounted(){
        this.fetchAllCategories();
    }
}
</script>

<style>

</style>