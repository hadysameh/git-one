<template>
  <div class="row">  
    <div class="d-flex flex-column align-items-center col-lg-8">
      
      
       <table class=" text-center mt-4">
         <tr>
           <th>#</th>
           <th v-for='column in columns'>{{column}}</th>
         </tr>

         <tr v-for='row in rows'>
            <td>{{row}}</td>  
            <td  v-for='column in columns'>
              <myButton v-bind:seatNum='row+column' :uid="userid"></myButton>
            </td>
         </tr>
       </table> 
       
       <div class="screen bg-primary text-white my-5 text-center"><h2>screen</h2></div>
       
    </div>
    <seatsDetails v-bind:name='name' v-bind:movieid='id' class='col-lg-4 mt-4'></seatsDetails>
</div>
</template>

<script>
    export default {
       props: ['movieid','moviename','userid'],
        // props:{
          
        //   movieid:Number,
        //   moviename:String
        // },
        data:function(){
          return{
            rows:['A','B','C','D','E','F','G','H','I','J'],
            columns:[1,2,3,4,5,6,7,8,9,10,11,12],
            name:this.moviename,
            id:this.movieid,

            days:[]
          }
        },
        mounted() {
          
          // axios.get('/api/show/6/2019-07-06/1/4').
          // then(function(data){
          //    console.log(data.data.data);
          // });
            //console.log('Component mounted.')
        }
        ,
        
        methods:{
           
        },
        computed:{
          
        }
    }
</script>

<style>
th{
  width:50px;
}
td{
  height:35px;
}

.screen{
  width:80%;

}
</style>
