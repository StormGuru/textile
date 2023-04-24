<template>
<div>
  
     
     <div v-if="roles.has('admin')" class="profile">
        <div class="profile_left">
        <p> Административная панель </p>
        <div class="mt_3 admin_panel_btn">{{current_user.name}}</div>
             <p><router-link to="/admin/users">Пользователи</router-link></p>
              <p><router-link to="/admin/categories">Категории</router-link></p>
             <p><router-link to="/admin/news">Новости</router-link></p>
                
        </div>

         <div><router-view :key="$route.fullPath"></router-view></div>
        
     </div>


 </div>
</template>

<script>

  export default{
    name: "Admin",

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