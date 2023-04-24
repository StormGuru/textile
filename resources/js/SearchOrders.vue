<template>
<div>
 <div class="ml_8 mt_3 segoe">     
    <router-link :to="'/search/organizations/' + this.$route.params.text" class="links mr_2">Организации</router-link>
    <router-link :to="'/search/orders/' + this.$route.params.text" class="links mr_2">Заявки</router-link>           
  </div>

   <h3 class="ml_8 mt_3 segoe mb_5">Заявки по запросу "{{this.$route.params.text}}"</h3>
   <div v-if = "searchOrders" class="client_req_box"  v-for = "order in searchOrders">

       <div class="req_left">
         <div class="req_info">
            <div class="req_info_category">{{order.category.name}}</div>
            <div>Дата публикации: {{order.created_at.substring(0, 10)}}</div>
         </div>
          <div class="req_text">{{order.text.substring(1, 150)}}</div>
       </div>

       <div class="req_right">
          <router-link :to = "{path: '/order/'+order.id}" class="podrobnee">Подробнее</router-link>

       </div>

     </div>
 </div>
</template>

<script>
  export default{
    name: "SearchOrders",

   data(){
      return{
       searchOrders: null
      }
   },
   created(){
   
   },

     mounted()
    {
        this.showSearchOrders();
    },

    methods: {
     showSearchOrders(){
        axios.get(`/api/search/orders/${this.$route.params.text}`)
         .then( res => {
               
               this.searchOrders = res.data.data;
               console.log(this.searchOrders);
         })
      }
    },

   

  }
</script>