<template>
    <table class="table table-dark">
        <thead>
            <tr>
                <th scope="col"> <button @click="getapiCrossref()" class="btn btn-primary text-white">GetNCBIAPI</button></th>
                <th scope="col"> Pubmed Article </th>
           </tr>
        </thead>
        <tbody>
            <tr>
                <th scope="row"></th>
                <td>{{ncbiAPIinfoRefapi}}</td>
            </tr>
        </tbody>
    </table>
</template>

<script>
    import axios from 'axios';
    export default {
        data() {
            return {
                ncbiAPIinfoRefapi: null,
            }
        },
        filters: {
            pretty: function (value) {
                return JSON.stringify(value, null, 4);
            }

        },
        methods: {
            deleteinfoCros(index) {
                this.$delete(this.ncbiAPIinfoRefapi, index);
            },
            getinfo() {
                axios.get('http://localhost/JMIR_API/jmir-proj/src/index.php')
                    .then(res => this.ncbiAPIinfoRefapi = res.data.message.reference)
                    .catch(err => console.log(err));
            },
            getapiCrossref() {
                axios({
                        method: 'GET',
                        url: 'https://eutils.ncbi.nlm.nih.gov/entrez/eutils/efetch.fcgi?db=pubmed&id=31115346',
                    })
                    .then(res => this.ncbiAPIinfoRefapi = res.data)
                    .catch(err => console.log(err));
            }
        },
        // same filter option for the json object from pumbed 
        //but due to the not being able to acess information i didnt build the search term
        computed: {
            filterjsonOb: function () {
                return this.ncbiAPIinfoRefapi.filter((ncbiAPIinfoRefapi) => {
                    return ncbiAPIinfoRefapi.match(this.search);
                });
            }
        }
    }
</script>

<style scoped>

</style>