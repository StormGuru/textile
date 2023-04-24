<template>
<div>
  <div class="single_org segoe" v-if="order">
    <span> 👁 <span class="view">{{order.view}}</span></span>
    <p><div class="segoe">Категория:  <span class="blue">{{order.category.name}}</span></div></p>
    <p>Дата создания: {{order.created_at.substring(0, 10)}}</p>
    <p class="b">Описание:</p>
    <div class="single_ord_text">{{order.text}}</div>
   </div>
 </div>
</template>

<script>


  export default{
    name: "SingleOrder",

   data(){
      return{
       order: null  
      }
   },

   created(){
   
   },

    mounted()
    {
        
        this.getSingleOrder();
        this.incrementOrder();
    },

    methods: {

      getSingleOrder(){

          axios.get('/api/order/' + this.$route.params.id)
          .then(res => {
                 console.log(res);
                 this.order = res.data
              })  
         },

       incrementOrder(){

          axios.get('/api/order/count/' + this.$route.params.id)
          .then(res => {
                 console.log(res);
            
              })  
         }  


      }

  
  }
</script>