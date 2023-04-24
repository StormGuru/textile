<template>
<div class="mt_3 mb_5">
    <h3 class="blue">Пользователи</h3>
      <div>
        <table class="mt_3">
           <tr>
               <th>ID</th>
               <th>ИМЯ</th>
               <th>ПОЧТА</th>
               <th>РЕГИСТРАЦИЯ</th>
               <th>РОЛЬ ПОЛЬЗОВАТЕЛЯ</th>
               <th></th>
           </tr>
        
           <tr v-for="client in clients" class="user_table">
               <td>{{client.id}}</td>
               <td class="blue">{{client.name}}</td>
               <td>{{client.email}}</td>
               <td>{{client.created_at.substring(0, 10)}}  {{client.created_at.substring(11, 19)}}</td>
               <td class="blue" v-if ="client.role === 'admin'" >администратор</td>
               <td class="blue" v-else-if ="client.role === 'client'" >заказчик</td>
               <td class="blue" v-else-if ="client.role === 'fabricator'" >поставщик</td>
               <td  v-if="client.role !== 'admin'"><button class="add_btn little pointer bn" @click.prevent="setRoleAdmin(client.id)">Назначить администратором</button></td>
           </tr>
        </table>
      </div>
     
 </div>
</template>

<script>
  export default{
    name: "Users",

   data(){
      return{
       clients: null,
    
      }
   },
   created(){
   
   },

     mounted()
    {
        this.users();
    },

    methods: {
       users(){
        axios.get('/api/polzovateli')
         .then( res => {
               
               this.clients = res.data;
             
         })
      },

      setRoleAdmin(id){
          axios.patch(`/api/role/update/${id}`)
         .then( res => {
               this.users();
               console.log(res);
             
         })
      }
 
    },

   

  }
</script>