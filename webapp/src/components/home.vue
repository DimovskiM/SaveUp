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
                <tr class="row"> 
                    <td class="col-md-3"> <img src="../assets/logo.png" /></td>
                    <td class="col-md-3"> <div class="txt-dark"> Laptop </div></td>
                    <td class="col-md-3"> <div class="txt-dark"> {{ "150.00" | moneyFilter }} </div></td>
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
        }
    }
}
</script>