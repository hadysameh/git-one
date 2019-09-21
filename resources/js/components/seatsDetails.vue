<template>
    <div id='main' class=''>
      <!-- <h1 v-on:click='test'>test</h1> -->
        <div class="my-3">
          <h3>Movie Name : {{name}}</h3>
        </div>

        <div class="my-3 d-flex">
          <h3 class="mr-2">Day:</h3>

          <select  v-on:change='fetchEvents' v-model='day' class="form-control">
            <option v-if='days' v-for='day in days' >{{day.day}}</option>
          </select>
        </div>
<!--         <h3 v-for="day in days">{{day}} </h3>
 -->    <div class="my-3 d-flex">
          <h3 class="mr-2">Event:</h3>
          <select v-on:change='fetchHalls' v-model='event_id' class="form-control">
            <option v-if='events' v-for='event in events' v-bind:value="event.id">{{event.event_time}}</option>
          </select>
        </div>

        <div class="d-flex align-items-center my-3">
          <h3 class="mr-2">Hall:</h3>
          <select v-on:change='fetchSeats'  class="form-control"  v-model='hall_id' style="width:27rem">
             <option v-if='halls' v-for='hall in halls' v-bind:value="hall.id">{{hall.hall_name}}</option>
             
          </select>
        </div>

        <div class="my-3">
          <h3>  Selected : {{selected}}</h3>
        </div>
        <div class="my-3">
          <h3>  Price : {{30*selected}}</h3>
        </div>
        <div class="my-1">
          <button class="bttn btn btn-light border-info borderSS"></button> available 
        </div>
        <div class="my-1">
          <button class="bttn btn btn-danger"></button> taken 
        </div>
        <div class="my-1">
          <button class="bttn btn btn-secondary"></button> selected 
        </div>
        <div class="my-1">
          <button class="bttn btn btn-info"></button> your seats 
        </div>
        <div class="d-flex justify-content-center">
          <button class="my-3 btn btn-lg btn-success" @click='buy'> Buy </button>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['name','movieid'],
         // props:{//this is way to check if ninjas is array
         //    name:String,
         //    dates:{
         //      type:Object,
         //      required:true//this will make it fail if we not pass the prop
         //    }
         //  },
        data:function(){
          return{
           id:this.movieid,
           days: [],
           day:'',
           events:[],
           event_id:'',
           halls:[],
           hall_id:'',
           seats:[],
           selected:0,
           selectedSeats:[]
          }
        },
        

        mounted() {
            //console.log(this.id);
            this.fetchDays();
            EventBus.$on('select',data=>{
              //console.log(data);
              if(data[0]==1){
                // this.selected+=data[0];
                this.selectedSeats.push(data[1])
                this.selected = this.selectedSeats.length;
                //console.log(this.selectedSeats)
              }

              if(data[0]==-1){
                // this.selected+=data[0];
                
                let index = this.selectedSeats.indexOf(data[1]);
                this.selectedSeats.splice(index, 1);
                this.selected = this.selectedSeats.length;
                //console.log(this.selectedSeats)
              }              
              //console.log(this.selected);
            });
        },
        methods:{
          test2(){
            //console.log(this.event_id);
          },
          fetchDays(){
            axios.get('/api/show/'+this.id)
            .then(data=>
               {  
                  this.days = data.data.data;
                  //console.log(this.days[0].day);
                  this.day=data.data.data[0].day;
                  //console.log(data.data.data[0]);
                  this.loading(); 
                  this.fetchEvents();
                                   
               }
            );
          },
          fetchEvents(){
            axios.get('/api/show/'+this.id+'/'+this.day)
            .then(data=>
            {
              this.loading();
              this.selectedSeats=[];
              this.selected = this.selectedSeats.length;
              this.events = data.data.data;
              this.event_id=data.data.data[0].id;
              //console.log(data.data.data);
              
              this.fetchHalls();
              
            });
          },
          fetchHalls(){
            axios.get('/api/show/'+this.id+'/'+this.day+'/'+this.event_id)
            .then(data=>{
              this.selectedSeats=[];
              this.selected = this.selectedSeats.length;
              this.halls = data.data.data;
              this.hall_id=data.data.data[0].id;
               this.loading();
               this.fetchSeats();
               //console.log(data.data.data);
               
               
            });
          },
          fetchSeats(){
            this.loading();
            axios.get('/api/show/'+this.id+'/'+this.day+'/'+this.event_id+'/'+this.hall_id).
            then(data=>{
               // console.log([data.data.data,this.id,this.day,this.event_id,this.hall_id]);
               this.seats=data.data.data;
                
               this.passProps();

            });
           },

          passProps(){
               EventBus.$emit('pass',this.seats);
            },

          buy(){
              EventBus.$emit('buy',{'day':this.day,'movie_id':this.movieid,'event_id':this.event_id,'hall_id':this.hall_id});
              this.selected=0;
              this.selectedSeats=[];
              this.loading();
              this.fetchSeats();

           },
           loading(){
            EventBus.$emit('loading',true);
           }
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
.borderSS{
  border-width:1px
}
</style>