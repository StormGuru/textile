<template>
 <div class="register">
  <div class="register_box">
  <div class="segoe red" v-for="e in errors">{{e}}</div>
   <p class="radio">
       <input type="radio"  value="2" v-model="user_type"  name="user_type"><span class="mr_5">Я заказчик</span>
       <input type="radio"  value="3" v-model="user_type" name="user_type">Я производитель 
     </p>
     <p><input class="input" v-model="name" type="text" placeholder="Имя"></p>
     <p><input class="input" v-model="email" type="email" placeholder="Почта"></p>
     <p><input class="input" v-model="password" type="password" placeholder="пароль"></p>
     <p><input class="input" v-model="password_confirmation" type="password" placeholder="подтвердите пароль"></p>
     <p><input @click.prevent="reg" type="submit" value="Зарегистрироваться" class="s_btn"></p>
  </div>
 </div>
</template>

<script>
  export default{

    name: "Register",
    
    data(){

       return{
          name: null,
          email: null,
          password: null,
          password_confirmation: null,
          user_type: null,
          errors: []
       }

    },

    methods: {
      reg(){
     
                  axios.get('/sanctum/csrf-cookie')
            .then(response => {

              axios.post('/register', { 
              name: this.name,
              email: this.email,
              password: this.password,
              password_confirmation: this.password_confirmation,
            user_type: this.user_type
              }
              
              )
              .then(res => {
              
                  console.log(res+'hhh');
                 localStorage.setItem('x_xsrf_token', res.config.headers['X-XSRF-TOKEN']);
                  location.reload('/personal/info');
              
              })  
              .catch(error=>{            
                  console.log(error);
                  if(this.name == null||this.password == null|| this.password_confirmation == null){
                    this.errors.push('Заполните все поля пожалуйста!');
                    console.log(this.errors)
                  }else if(this.user_type == null ){
                     this.errors.push('Выберите роль пожалуйста!');
                  }else if(this.name.length <= 2 ){
                     this.errors.push('Имя должно быть более двух символов!');
                  }else if(this.password.length < 8){
                    this.errors.push('Пароль должен быть 8 и более символов!');
                  }else if(this.password !== this.password_confirmation){

                        this.errors.push('Пароли не совпадают!');
                  }
                  else{
                    this.errors.push('Такая почта уже зарегистрирована');
                  }
            })
          
      })
              
    }

    }

  }
</script>