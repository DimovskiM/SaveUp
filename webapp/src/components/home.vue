<template>
    <div> 
        <table class="table">
            <thead class="thead-light">
                <tr class="row">
                    <th scope="col" class="col-md-3"> </th>
                    <th scope="col" class="col-md-3"> Name </th>
                    <th scope="col" class="col-md-3"> Price </th>
                    <th scope="col" class="col-md-3"> Details </th>
                </tr>
            </thead>
            <tbody>
                <tr class="row" v-for="product in products" :prop="product" :key="product.name"> 
                    <td class="col-md-3"> <img :src="product.imageUrl" /></td>
                    <td class="col-md-3"> <div class="txt-dark"> {{ product.name }} </div></td>
                    <td class="col-md-3"> <div class="txt-dark"> {{ product.price | moneyFilter }} </div></td>
                    <td class="col-md-3"> <button class="btn btn-dark"> Details </button></td>
                </tr>
            </tbody>
        </table>
    </div>
</template>
<script>
export default {
    name: "Home",
    data() {
        return {
            products: [
                {
                    name: 'Monitor 27" MSI MAG271CV LED Gaming 1ms, 144Hz, USBx3, HDMIx2, DP, Curved',
                    price: 100,
                    imageUrl: 'https://d1a68gwbwfmqto.cloudfront.net/img/products/full/thumbs/mia3grey.jpg'
                }
            ]
        }
    }
}
</script>