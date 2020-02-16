<template>
    <div class="row"> 
        <div class="col-md-6">
            <div class="row row-space-top-5">
                <div class="col-md-3">
                    <img :src="product.imageUrl"/>  
                </div>
                <div class="col-md-6">
                    <p class="lead">{{product.name}} </p>
                    <p class="lead"> Current Price : <b>{{product.currentPrice | moneyFilter }}</b> </p>
                    <a :href="product.productPage" class="lead"> Product Page </a>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <Chart :product="product"> </Chart>
        </div>
    </div>
</template>
<script>
import Chart from './chart.vue';
import * as apiService from '../services/api.service';

export default {
    name: 'Product',
    components: { 'Chart' : Chart },
    props: {
        id: {
            }
    },
    data() {
        return {
            product: { }     
        }
    },
    methods: {
        async loadProduct() {
            this.product = await apiService.getProduct(this.$props.id);
        }
    },
    async mounted() {
        await this.loadProduct();
    }
}
</script>