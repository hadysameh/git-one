<template>
    <div id='main' class=''>
    	<h2>Choose A Day</h2>
        <select class="custom-select my-2" >	
				<option>12/5/2012</option>
				<option>12/5/2012</option>
				<option>12/5/2012</option>
		</select>
		<a href=" " class="btn btn-success">get tickets</a>
    </div>
</template>

<script>
    export default {
       props: [],

        mounted() {
            //console.log('Component mounted.')
        },
        data:function(){
          return{
           
          }
        },
        methods:{
           
        },
        computed:{
          
        }
    }
</script>


<style>

.bttn{
  width:31px;
  height:24px;
}
</style>