<template>
<div>
   <h3 class="mt_3">Добавление организации</h3>
   <div v-for="e in errors" class="r">{{e}}</div>
   <p><input class="add_input" type="text" placeholder="Название организации" v-model="name"></p>
   <p><input class="add_input" type="text" placeholder="Адрес организации" v-model="adress"></p>
   <p><input class="add_input" type="text" placeholder="Телефон организации" v-model="tel"></p>
   <p><input class="add_input" type="text" placeholder="Сайт организации" v-model="site"></p>
    
     <div ref="dropzone" class="drop pointer">
      Выбрать фотографию
      </div>
   <p>Описание организации:</p>
   <p><textarea v-model="description" rows="7" cols="70">Описание организации</textarea></p>
   <p class="mb_5">
    Выберите категорию:<span class="r mr_2">*</span>   
     <select v-model="category_id">
       <option class="option" v-for="category in categories" :value="category.id">{{category.name}}</option>
     </select>
   </p>
   <p><span  @click.prevent = "addOrg"  class="add_btn pointer mt_3">Опубликовать</span></p>
   
   
 </div>
</template>

<script>
import Dropzone from 'dropzone';

  export default{
    name: "AddOrganization",

   data(){
      return{
        dropzone:null,
       categories: null,
       name: null,
       adress: null,
       site: null,
       tel: null,
       description: null,
       image: null,
       category_id: null,
       errors: []
      }
   },

   created(){
   
   },

    mounted()
    {

        this.dropzone = new Dropzone(this.$refs.dropzone, {
            url: "/file/post",
           autoProcessQueue: false
        });
        console.log('dp');
        this.showCategory();
    },

    methods: {

      showCategory(){
        axios.get('/api/category/show')
         .then( res => {
               console.log(res.data);
               this.categories = res.data;
         })
      },

      addOrg(){
           
           const data =  new FormData();
           const files = this.dropzone.getAcceptedFiles();
           files.forEach(file => {
               data.append('image[]', file);
               this.dropzone.removeFile(file);
           });
           data.append('name', this.name);
           data.append('adress', this.adress);
           data.append('tel', this.tel);
           data.append('site', this.site);
           data.append('description', this.description);
           data.append('category_id', this.category_id);
           
            axios.get('/sanctum/csrf-cookie')
            .then(response => {

              axios.post('/api/add/organization', data
              )
              .then(res => {
                 console.log(res);
                   if(!res.data){
                    this.$router.push('organizations');
                   }else{
                 console.log(res.data); 
                 this.errors.push(res.data);
                }
              })
                .catch(error=>{            
                  console.log(error);
                  if( this.category_id == null||this.name == null ||this.adress == null||this.tel == null ||this.description == null){
                    this.errors.push('Заполните все поля пожалуйста!');
                    console.log(this.errors)
                  }else if(this.category_id == null ){
                     this.errors.push('Выберите категорию, пожалуйста!');
                  }else if(this.description.length < 20){
                    this.errors.push('Описание должна быть не менее 20ти символов!');
                  }else if(this.name.length < 2){
                    this.errors.push('Название должно быть не менее двух символов!');
                  }else if(this.adress.length < 2){
                    this.errors.push('Адрес должен быть не менее пяти символов!');
                  }else if(this.tel.length < 9){
                    this.errors.push('Телефон должен быть не менее 9ти символов!');
                  }else if(this.site.length < 5){
                    this.errors.push('Телефон должен быть не менее 5ти символов!');
                  }else if(this.adress.length > 100){
                    this.errors.push('Адрес должен быть не более 100 символов!');
                  }else if(this.name.length > 100){
                    this.errors.push('Название должно быть не более 100 символов!');
                  }else if(this.tel.length > 100){
                    this.errors.push('Телефон должен быть не более 100 символов!');
                  }else if(this.site.length > 100){
                    this.errors.push('Сайт должен быть не более 100 символов!');
                  }else if(this.description.length >1500){

                        this.errors.push('Описание должно быть не более 1500 символов!');
                  }
                  else{
                   console.log(error);
                  }
            })   
          
                           })







           
         }




      }

  
  }
</script>