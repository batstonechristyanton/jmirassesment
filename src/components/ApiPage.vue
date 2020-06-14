<template>
  <table class="table table-dark">
    <thead>
      <tr>
        <th scope="col"> <button @click="getapiCrossref()" class="btn btn-primary text-white">GetcrossrefAPI </button>
        </th>
        <th scope="col"> Author First Name</th>
        <th scope="col"> Author Last Name </th>
        <th scope="col">Sequence</th>
        <th scope="col"><input type="text" v-model="search" placeholder="searchauthorfirstname" /></th>
        <th scope="col"> <button @click="Postinfo()" class="btn btn-primary text-white">Post info to Database </button>
        </th>
      </tr>
    </thead>
    <tbody>
      <tr v-for="(infoFromCross,index) in filteredaFname" :key="infoFromCross.key">
        <th scope="row"><button @click="deleteinfoCros(index)" class="btn btn-danger text-white">Del</button></th>
        <td>{{infoFromCross.given}}</td>
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
        given: "",
        search: ''

      }
    }, // thought i needed to prety the json obj values but didnt end up using it
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
       * this method was built to retrieve the get information from the database
       *  but i do alot of the pulling from api in the vueframework 
       */
      getinfo() {

        axios.get('http://localhost/JMIR_API/jmir-proj/src/index.php')
          .then(res => this.infoFromCrossRefapi = res.data.message.reference)
          .catch(err => console.log(err));


      },
         /* 
       * api calls to the local database using xampp 
       * i needed to use local host please do change this if you are using in a diffrent enviroment
       * this method is build to send the post requests.  
       */

      Postinfo() {
        axios.post('http://localhost/JMIR_API/jmir-proj/src/index.php', {
            name: this.infoFromCrossRefapi,
          }, {
            headers: {
              'Content-Type': 'application/form-data'
            }
          })

          .then(function (response) {
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
    },
    /* 
      * this computer property allows for the search 
      filter to be present and lets the user search the author given names 
      */

    computed: {
      filteredaFname: function () {
        return this.infoFromCrossRefapi.filter((infoFromCrossRefapi) => {
          return infoFromCrossRefapi.given.match(this.search);

        });


      }
    }
  }
</script>

<style scoped>

</style>