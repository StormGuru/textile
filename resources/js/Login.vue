<template>
 <div class="register">
    <div class="register_box">
     
     <p class="no_accaunt"> Еще нет аккаунта? <router-link to="/register">Зарегистрироваться</router-link></p>
     <p class="segoe r" v-if="error">Введены неправильные данные</p>
     <p><input v-model="email" type="email" placeholder="Ваша почта" class="input mb_2"></p>
     <p><input v-model="password" type="password" placeholder="Ваш пароль"  class="input mb_2"></p>
     <p><input @click.prevent="login" type="submit" class="s_btn" value="Войти"></p>
    </div>
 </div>
</template>

<script>
  export default{
    name: "Login",
    
    data(){
       return{
        email: null,
        password: null,
        error: null
       }
    },

    methods: {

      login(){
        axios.get('/sanctum/csrf-cookie')
         .then(response => {
            axios.post('/login', {email: this.email, password: this.password})
            .then(r =>{
            
              console.log(r.config.headers['X-XSRF-TOKEN']);
              localStorage.setItem('x_xsrf_token', r.config.headers['X-XSRF-TOKEN']);
              location.reload('/personal/info');
            
        
            })
              .catch( er => {
                this.error = true;
              })

        })
      }

    },

 
  }
</script>