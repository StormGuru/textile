<template>
<div>
   <h4 class="mt_3">Редактировать новость</h4>
    <div v-for="e in errors">{{e}}</div>
   <p><input type="text" placeholder="Заголовок" v-model="edit_title" class="add_input"></p>
  
    <div>
       <img :src = "old_image" width="250">
    </div>
    
     <div ref="dropzone3" class="drop pointer mt_3">
      Изменить фотографию
      </div>

   <p><textarea v-model="edit_news_text" cols="80" rows="10">Текст новости</textarea></p>
 
   <p><button  @click.prevent="editNews" class="add_btn bn pointer">Изменить</button></p>
   
   
 </div>
</template>

<script>
import Dropzone from 'dropzone';

  export default{
    name: "EditNews",

   data(){
      return{
       dropzone3:null,
       edit_title: null,
       old_image: null,
       edit_image: null,
       edit_news_text: null,
       errors: []
      }
   },

   created(){
   
   },

    mounted()
    {

        this.dropzone3 = new Dropzone(this.$refs.dropzone3, {
            url: "/file/post",
           autoProcessQueue: false
        });
        console.log('dp');


        console.log(this.$route.params.id)
        
        this.getNews()
    },

    methods: {

      editNews(){
           
           const data3 =  new FormData();
           const files = this.dropzone3.getAcceptedFiles();

       
            files.forEach(file => {
               data3.append('image[]', file);
           });
         
        
            data3.append('img_url', this.old_image);
             data3.append('title', this.edit_title);
           data3.append('news_text', this.edit_news_text);
       data3.append('_method', 'PATCH');

           axios.post('/api/news/update/' + this.$route.params.id, 
           data3
              )
              .then(res => {
                 
                  if(res.status === 201){
                    window.location.href = "/admin/news";
                    }else{
                 console.log(res.data); 
                 this.errors.push(res.data);
                }
               console.log(res);
              }) 
              .catch(er => {
                  if( this.edit_title == '' || this.edit_news_text == ''){
                    this.errors.push('Заполните все поля пожалуйста!');
                    console.log('ошибка')
                  } else if(this.edit_news_text.length < 20){
                    this.errors.push('Текст должен быть не менее 20ти символов!');
                  }else if(this.edit_title.length < 2){
                    this.errors.push('Заголово должен быть не менее двух символов!');
                  }else if(this.edit_title.length > 200){
                    this.errors.push('Заголовок должен быть не более 200 символов!');
                  }else if(this.edit_news_text.length >13000){

                        this.errors.push('Текст должен быть не более 13000 символов!');
                  }
                  else{
                   this.errors.push('Фотография должна быть не более 2 мегабайт!');
                  }

              }) 
         
        
           },


         getNews(){

          axios.get('/api/get/news/' + this.$route.params.id)
          .then(res => {
                 console.log(res);
                this.edit_title = res.data.title
                this.edit_news_text = res.data.news_text
                this.old_image = res.data.img_url
              })  
         }  


      }

  
  }
</script>