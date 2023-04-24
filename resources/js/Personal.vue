<template>
<div>

     
     <div v-if="roles.has('client')" class="profile">
        <div class="profile_left">
             <div class="user_name_main">{{current_user.name}}</div>
             <p><router-link to="/personal/info">Информацияо пользователе</router-link></p>
             <p><router-link to="/personal/order">Мои заявки</router-link></p>
                
                </div>

                <div class="profile_right"><router-view :key="$route.fullPath"></router-view></div>
     </div>

     <div v-if="roles.has('fabricator')" class="profile">
     <div class="profile_left">
             <div class="user_name_main"> Мой профиль {{current_user.name}}</div>
             <p><router-link to="/personal/info">Информацияо пользователе</router-link></p>
             <p><router-link to="/personal/organizations">Мои организации</router-link></p>
                
                </div>

                <div class="profile_right"><router-view :key="$route.fullPath"></router-view></div>
     </div>

     <div v-if="roles.has('admin')" class="profile">
     <div class="profile_left">
     
            <div class="user_name_main"> Мой профиль  {{current_user.name}}</div>
            <p class="admin_panel_btn" v-if="roles.has('admin')"><router-link to="/admin" class="admin_panel_btn">Административная панель</router-link></p>
             <p><router-link to="/personal/info">Информацияо пользователе</router-link></p>
             <p><router-link to="/personal/organizations">Мои организации</router-link></p>
              <p><router-link to="/personal/order">Мои заявки</router-link></p>
                
                </div>

                <div class="profile_right"><router-view :key="$route.fullPath"></router-view></div>
     </div>

 </div>
</template>

<script>
import Order from "./Order.vue";
  export default{
    name: "Personal",

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