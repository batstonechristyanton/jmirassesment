<template>
  <div id="app">

    <ApiPage></ApiPage>
    <NcbiAPI/>
  </div>
</template>

<script>
import ApiPage from './components/ApiPage'
import NcbiAPI from './components/NcbiAPI'

export default {
  name: 'App',
  components: {
    ApiPage,
    NcbiAPI
  }
}
</script>

<style>
body{
  background-color: #000000;
}
</style>
