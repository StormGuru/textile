<template>
<div>
  <h1 class="all_orders_h">Список всех заявок</h1>   
<div class="client_req" v-for="allOrder in allOrders">
    <div class="client_req_box">
           <div class="req_left">
                  <div class="req_info">
            <div class="req_info_category">{{allOrder.category.name}}</div>
            <div>Дата публикации: {{allOrder.created_at.substring(0, 10)}}</div>
            </div>
            <div class="req_text">{{allOrder.text.substring(0, 150)}}...</div>
           </div>
          <div class="req_right">
                <router-link :to = "{path: '/order/'+ allOrder.id}" class="podrobnee">Подробнее</router-link>
          </div> </div>
      </div>
  <div>

        <div class="pagination segoe">
          <span @click.prevent="getAllOrders(this.current_page-1)" v-if="this.current_page !== 1">предыдущий</span>
          <template v-for="link in links">
           <template v-if="Number(link.label)
           && this.current_page - link.label < 2
           &&this.current_page - link.label >  -2
           || Number(link.label) === 1|| Number(link.label) === this.last_page">
          <span :class="link.active ? 'active' : '' " @click.prevent="getAllOrders(link.label)">{{link.label}}</span>
           </template>
          </template>
           <span @click.prevent="getAllOrders(this.current_page+1)" v-if="this.current_page !== this.last_page">следующий</span>
        </div>


       <div>
         
       </div>

  </div>

</div>
</template>

<script>
  export default{
    name: "AllOrders",
    

   data(){
      return{
       allOrders: null,
       current_page: null,
       last_page: null,
       links: null
      }
   },
   created(){
   
   },

     mounted()
    {
        this.getAllOrders();
    },

    methods: {
     getAllOrders(page=1){
        axios.post('/api/all/orders', {page: page})
         .then( res => {
               this.current_page = res.data.current_page
               this.last_page = res.data.last_page
               this.allOrders = res.data.data
               console.log(this.allOrders);
                this.links = res.data.links
         })
      }
    },

   

  }
</script>