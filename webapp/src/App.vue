<template>
  <div id="app">
    <div id="nav">
      <Header> </Header>
    </div>
    <router-view />
    <link rel="stylesheet" href="//fonts.googleapis.com/css?family=Roboto:400,500,700,400italic|Material+Icons">
    <footer class="row text-center"> 
      <div class="col-md-12 border-top border-primary bg-dark">
        <small class="text-white"> 
          © Mihajlo Dimovski - 2020
        </small>
      </div>
    </footer>
  </div>
</template>
<script>
import Header from "./components/header-bar.vue";
export default {
  components: {
    'Header': Header
  }
}
</script>
<style>
#app {
  width: 99%;
}
</style>