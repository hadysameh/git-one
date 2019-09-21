<template>
    <div id='main' class=''>
    	<h2>Choose A Day</h2>
      <select v-model='day' v-on:change='go(day)' class="custom-select my-2" >
  			<option v-bind:value="today">{{today}}</option>
  			<option v-bind:value='tom'>{{tom}}</option>
  			<option v-bind:value='after'>{{after}}</option>
		  </select>
    </div>
</template>

<script>
    export default {
       props: ['today','tom','after','date'],

        mounted() {
            //console.log('Component mounted.')
        },
        data:function(){
          return{
            day:this.date ,
    
          }
        },
        methods:{
           go:function(day){
            console.log(day);
            if(day==this.today){
              window.location.href='/';
            }
            else{
              window.location.href='/'+this.day;
            }
            
           }
        },
        computed:{
          
        }
    }
</script>


<style>


</style>