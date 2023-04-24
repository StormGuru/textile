<template>
<div>
   <div class="m5 ml_8"><router-link to="add-order" class="add_btn">Добавить заявку</router-link></div>

    <div v-if = "orders" class="client_req_box"  v-for = "order in orders">

       <div class="req_left">
         <div class="req_info">
            <div class="req_info_category">{{order.category}}</div>
            <div>Дата публикации: {{order.created_at.substring(0, 10)}}</div>
         </div>
          <div class="req_text">{{order.text.substring(1, 150)}}</div>
          <p><router-link :to = "{path: '/redact/order/'+order.id}" class="add_btn">Редактировать</router-link>
          <span class="add_btn red_bg pointer" @click.prevent="deleteOrder(order.id)">Удалить</span>
          </p>
       </div>

       <div class="req_right">
          <router-link :to = "{path: '/order/'+order.id}" class="podrobnee">Подробнее</router-link>

       </div>

     </div>


 </div>
</template>

<script>
  export default{
    name: "Order",

   data(){
      return{
       orders: null
      }
   },
   created(){
   
   },

     mounted()
    {
        this.showOrders();
    },

    methods: {
     showOrders(){
        axios.get('/api/user/order')
         .then( res => {
               console.log(res.data);
               this.orders = res.data;
         })
      },

       deleteOrder(id){
         console.log(id);
        axios.delete(`/api/order/delete/${id}`)
        
           .then( res => {
             this.showOrders();
               console.log(res);
               
         })
      }


    },

   

  }
</script>