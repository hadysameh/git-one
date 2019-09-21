<template>
    <div>
      
      <div v-if='isLoading' class="spinner-border text-primary" role="status">
        <span class="sr-only">Loading...</span>
      </div>
      <button :class="compClasses" v-if='!isLoading'  @click='select' ></button>     
    </div>
</template>

<script>
    export default {
       props: ['seatNum','uid'], 

        mounted() {
            //console.log(this.seats)
        },
        created(){
          EventBus.$on('loading',data=>{
            if(data==true){
              this.isLoading=true;
            }
          });

          EventBus.$on('pass',data=>{
            this.isYours=false;
            this.isTaken=false;
            this.isSelected=false;
            this.isAvailable=true;

            this.seats=[];

            this.seats=data;
            this.isLoading=false;
            if(this.seats){
              for(let i=0 ;i<this.seats.length;i++){

                if(this.seats[i].includes(this.seatNum))
                {
                  
                  if(this.seats[i][1]==this.userId){
                    //console.log('true '+this.userId);
                    this.isYours=true;
                    this.isAvailable=false;
                  }
                  else{
                    this.isTaken=true;
                    this.isAvailable=false;
                  }
                  //console.log('true '+this.seatNum)
                }
                else{
                 // console.log('false')
                }

              }
            }
          });

          EventBus.$on('buy',
            data=>{
              if(this.userId){
                this.register(data);
                //location = location;
              }
              else{
                window.location.href='/login'
              }
              });

        },
        data:function(){
          return{
            seatId : this.seatNum,
            //takenSeats : this.seats,
            seats:[],
            isLoading:true,
            isAvailable:true,
            isTaken:false,
            isSelected:false,
            isYours:false,
            userId:this.uid,            
          }
        },
        methods:{
           select()
           {     
                    
                if(!this.isTaken && !this.isYours)
                {
                  if(!this.isSelected)
                  {
                    this.isAvailable=false;
                    this.isSelected=true;
                    if (this.seats.length >= 0)
                    { 
                      //this.isLoading=true;
                      EventBus.$emit('select',[1,this.seatNum]);
                    }
                  }
                  else if(this.isSelected)
                  {
                    this.isSelected=false;
                    this.isAvailable=true;
                    if (this.seats.length >= 0)
                    { 
                      EventBus.$emit('select',[-1,this.seatNum]);
                    }
                  }                
                }
              
           },
           register(data){
            if(this.isSelected){
              //console.log('posting');
              axios.post('/tickets',{'day':data.day,
                      'event_id':data.event_id,
                      'movie_id':data.movie_id,
                      'hall_id':data.hall_id,
                      'seat_num':this.seatNum})
              .then()
            }
           },          
        },
        computed:{
          compClasses(){
            return['bttn','btn',
              {
                'btn-light border-info borderSS':this.isAvailable,
                'btn-danger':this.isTaken,
                'btn-info':this.isYours,
                'btn-secondary':this.isSelected
              }
            ]
          }
          
        }
    }
</script>


<style scoped>

.bttn{
  width:31px;
  height:24px;
}
.borderSS{
  border-width:1px
}
</style>