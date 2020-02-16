<template>
    <div class="dashboard"> 
        <table class="table table-md" style="width: 100%">
            <thead class="thead-light">
                <tr class="row row-no-gutters">
                    <th scope="col" class="col-md-2"> </th>
                    <th scope="col" class="col-md-6"> Name </th>
                    <th scope="col" class="col-md-3"> Price </th>
                    <th scope="col" class="col-md-1"> Details </th>
                </tr>
            </thead>
            <tbody>
                <tr class="row row-no-gutters" v-for="product in products" :prop="product" :key="product.id"> 
                    <td scope="col" class="col-md-2"> <img :src="product.imageUrl" style="padding-left: 15%"/></td>
                    <td scope="col" class="col-md-6"> <div class="txt-dark"> {{ product.name }} </div></td>
                    <td scope="col" class="col-md-3"> <div class="txt-dark"> {{ product.currentPrice | moneyFilter }} </div></td>
                    <td scope="col" class="col-md-1"> <router-link :to="{ name: 'product', params: { id: product.id } }" class="btn btn-dark btn-round btn-arrow-right"> -> </router-link></td>
                </tr>
                <div class="row row-space-top-5">
                    <h3 class="text-center col-md-12" v-if="!products || products.length === 0">
                        There are no products to display
                    </h3>
            </div>
            </tbody>
        </table>
    </div>
</template>

<script>
import * as apiService from '../services/api.service';

export default {
    name: "Home",
    data() {
        return {
            products: [],
            pageNumber: 1,
            currentPage: 1
        }
    },
    methods: {
        async loadProducts() {
            this.products = await apiService.getProducts();
        }
    },
    async mounted() {
        await this.loadProducts();
    }
}
</script>
<style>
 img:hover {
     transform : scale(1.5);
 }
</style>
