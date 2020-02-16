<template>
    <div class="dashboard"> 
        <table class="table table-md" style="width: 100%">
            <thead class="thead-light">
                <tr class="row row-no-gutters">
                    <th scope="col" class="col-md-2"> </th>
                    <th scope="col" class="col-md-6"> 
                        Name 
                        <i v-bind:class="{ 'fa fa-arrow-up' : nameDirection === 'asc', 'fa fa-arrow-down' : nameDirection === 'desc' }" @click="setOrder('name')"> 
                        </i> 
                    </th>
                    <th scope="col" class="col-md-3"> 
                        Price 
                        <i v-bind:class="{ 'fa fa-arrow-up' : priceDirection === 'asc', 'fa fa-arrow-down' : priceDirection === 'desc' }" @click="setOrder('currentPrice')"> 
                        </i>
                    </th>
                    <th scope="col" class="col-md-1"> Details </th>
                </tr>
            </thead>
            <tbody>
                <tr class="row row-no-gutters" v-for="product in displayedItems" :prop="product" :key="product.id"> 
                    <td scope="col" class="col-md-2"> <img :src="product.imageUrl" style="padding-left: 15%"/></td>
                    <td scope="col" class="col-md-6"> <div class="txt-dark"> {{ product.name }} </div></td>
                    <td scope="col" class="col-md-3"> <div class="txt-dark"> {{ product.currentPrice | moneyFilter }} </div></td>
                    <td scope="col" class="col-md-1"> <router-link :to="{ name: 'product', params: { id: product.id } }" class="btn btn-dark btn-round btn-arrow-right"> <i class="fa fa-long-arrow-right"> </i> </router-link></td>
                </tr>
                <div class="row row-space-top-5" v-if="products.length === 0">
                    <h3 class="text-center col-md-12">
                        There are no products to display
                    </h3>
                </div>
                <div class="clearfix btn-group col-md-2 text-left" v-if="products.length !== 0">
                    <button type="button" class="btn btn-sm btn-outline-secondary" v-if="!(filter.currentPage <= 1)" @click="goBack()"> Back </button>
                    <button type="button" class="btn btn-sm btn-outline-secondary" @click="changePage(page)" v-for="page in filter.totalPages" v-bind:key="page"> {{ page }} </button>
                    <button type="button" @click="goForward()" v-if="filter.currentPage < filter.totalPages" class="btn btn-sm btn-outline-secondary"> Forward </button>
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
            filter: {
                totalPages: 20,
                currentPage: 1,
                itemsPerPage: 5,
                orderBy: 'name',
                direction: 'asc',
            },
            nameDirection: 'asc',
            priceDirection: 'asc'
        }
    },
    watch: {
        products() {
            this.setPage();
        }
    },
    methods: {
        async loadProducts() {
            this.products = await apiService.getProducts();
        },
        async goBack() {
            this.filter.currentPage--;
        },
        async goForward() {
            this.filter.currentPage++;
        },
        async changePage($page) {
            this.filter.currentPage = $page;
        },
        setPage() {
            this.filter.totalPages = Math.ceil(this.products.length / this.filter.itemsPerPage);
        },
        paginate (products) {
            let page = this.filter.currentPage;
            let perPage = this.filter.itemsPerPage;
            let from = (page * perPage) - perPage;
            let to = (page * perPage);
            return products.slice(from, to);
        },
        setOrder(orderBy) {
            if (this.filter.orderBy === orderBy) {
                this.filter.direction = this.filter.direction === 'asc' ? 'desc' : 'asc';

                if (orderBy === 'name') {
                    this.nameDirection = this.filter.direction;
                }
                else {
                    this.priceDirection = this.filter.direction;
                }
            }
            
            this.filter.orderBy = orderBy; 
        }
    },
    computed: {
        displayedItems() {
            return this.paginate(this.products).sort((a, b) => {
                let modifier = this.filter.direction === 'asc' ? 1 : -1;

                 if(a[this.filter.orderBy] < b[this.filter.orderBy]) {
                     return -1 * modifier;
                }

                if(a[this.filter.orderBy] > b[this.filter.orderBy]) {
                    return 1 * modifier;
                }

                return 0;
            });
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
 .fa-arrow-up:hover {
    cursor: pointer;
 }
.fa-arrow-down:hover {
    cursor: pointer;
 }
</style>
