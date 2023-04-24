<template>
<div class="header">

   <div class="header_r">
     <router-link class="mr_20" to="/"><div class="header_logo mr_20">Logo</div></router-link>
     <div class="social">
          <div class="mr_20"><img src="storage/insta.png" width="20"></div>
            <div class="mr_20"><img src="storage/tg.png" width="20"></div>
              <div><img src="storage/fb.png" width="20"></div>
     </div>

   </div>

     <div class="header_l">
     <Router-Link v-if="!token" to="/login" class="header_button"><div >Опубликовать свою компанию</div></Router-Link>
     <Router-Link v-if="!token" to="/login" class="header_button"><div >Войти</div></Router-Link>
     <Router-Link  v-if="!token" to="/register" class="header_button"><div >Зарегистрироваться</div></Router-Link>
     <Router-Link v-if="token" to="/personal" class="header_button"><div>Личный</div></Router-Link>
     <a v-if="token" @click.prevent = "logout" href="#" class="header_button">Выйти</a>
   </div>

</div>

<div>
 <router-view :key="$route.fullPath" ></router-view>  
 </div>
</template>

<script>
  export default{
    name: "App",

    data(){
      return{
         token: null
      }
    },

    mounted(){
      this.getToken()
    },

     updated(){
       this.getToken()
     },

    methods: {
      getToken(){
          this.token = localStorage.getItem('x_xsrf_token')
      },

      logout(){
        axios.post('/logout')
         .then( res => {
               localStorage.removeItem('x_xsrf_token');
               localStorage.removeItem('token');
           window.location.href = "/login"
         })
      }
    }
  }
</script>