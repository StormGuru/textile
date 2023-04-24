<template>
<div>

  <div class="info">
   <p>Имя пользователя:  <span class="user_data">{{current_user.name}}</span></p>
   <p>Дата регистрации: <span class="user_data">{{current_user.created_at.substring(0, 10)}}</span></p>
   <p>Почта: <span class="user_data">{{current_user.email}}</span></p>
   <p>Роль: 
   <span v-if="roles.has('admin')" class="user_data">Администратор</span>
   <span v-if="roles.has('client')" class="user_data">Заказчик</span>
   <span v-if="roles.has('fabricator')" class="user_data">Производитель</span>
   </p>
  </div>
 </div>
</template>

<script>
  export default{
    name: "Info",

   data(){
      return{
          current_user: null,
          roles: new Set()
      }
   },
   updated(){
      this.current_user = window.user

       window.user_roles.forEach(r=>{
         this.roles.add(r.role);
     })
     },

   created(){
     console.log('USERS');
     console.log(window.user);
     console.log(window.user_roles);
     this.current_user = window.user,
window.user_roles.forEach(r=>{
         this.roles.add(r.role);
     })

     },

    methods: {
      logout(){
        axios.post('/logout')
         .then( res => {
               this.$router.push('login');
         })
      }
    },

   

  }
</script>