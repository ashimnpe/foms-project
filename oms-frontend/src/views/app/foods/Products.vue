<template>
    <div>
        <b-row>
            <b-colxx xxs="12">
            <piaf-breadcrumb heading="PRODUCTS" />
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
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(product, i) in products" :key="i">
                                <td>{{product.id}}</td>
                                <td>{{product.image}}</td>
                                <td>{{product.title}}</td>
                                <td>{{product.price}}</td>
                            </tr>
                        </tbody>
                    </table>
                </b-card>
            </b-colxx>
        </b-row>
    </div>
</template>

<script>
import { getProducts } from '@/api/products';

export default {
    data(){
        return{
            products: []
        };
    },
    methods: {
        fetchAllProducts(){
            getProducts().then((res) => {
                this.products = res.result;
            });
        }
    },
    mounted(){
        this.fetchAllProducts();
    }
}
</script>

<style>

</style>