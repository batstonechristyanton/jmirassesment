
<template>
  <table class="table table-dark">
    <thead>
             <tr>
        <th scope="col"> <button @click="getapiCrossref()" class="btn btn-primary text-white">GetcrossrefAPI </button></th>
        <th scope="col"> Author First Name</th>
        <th scope="col"> Author Last Name </th>
        <th scope="col">Sequence</th>
      </tr>
    </thead>
    <tbody>

        <th scope="col"> <button @click="Postinfo()" class="btn btn-primary text-white">Post info </button></th>
      <tr v-for="infoFromCross in infoFromCrossRefapi" :key="infoFromCross.key">
        <th scope="row"></th>
        <td >{{infoFromCross.given}}</td>
        <td>{{infoFromCross.family}}</td>
        <td>{{infoFromCross.sequence}}</td>
      </tr>
    </tbody>
  </table>
</template>

<script>
  import axios from 'axios';
  export default {
     /* 
     * the data is the area where i can store an 
     aray to receive the api request and then use this array in displaying my information in the vue modules
     */ 

    data() {
      return {
        infoFromCrossRefapi: [],

        given:"",
       

      }
    },

    filters: {

      pretty: function (value) {
        return JSON.stringify(value, null, 4);
      }

    },

    /** 
     * in the methods area here i can produce the necessary methods or api requests and then 
     * pass them up to the data method above
     */ 
    methods: {
      deleteinfoCros(index) {
        this.$delete(this.infoFromCrossRefapi, index);
      },

    /* 
     * api call to the databse as when i developed it 
     * i needed to use local host please do change this if you are using in a diffrent enviroment 
     */ 
      getinfo() {

        axios.get('http://localhost/JMIR_API/jmir-proj/src/index.php')
          .then(res => this.infoFromCrossRefapi = res.data.message.reference)
          .catch(err => console.log(err));

          
      },

      Postinfo(){
        axios.post('http://api.co', {
          name: this.infoFromCrossRefapi,
        },{
          headers: {
            'Content-Type': 'application/form-data'
          }
        })

        .then(function(response){
          console.log(response)
        })
      },
     /* 
     * making the api call to cross ref api
      and storing the response into the infofromcrossrfapi array then using it in the vue modules to display the information  
     */
      getapiCrossref() {

        axios({
            method: 'GET',
            url: 'https://api.crossref.org/works/10.2196/12121',
        
          })
          .then(res => this.infoFromCrossRefapi = res.data.message.author)
          .catch(err => console.log(err));



      }
    }


  }
</script>

<style scoped>

</style>