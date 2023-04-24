<template>
<div>
   Добавление новости
  <div v-for="e in errors">{{e}}</div>
   <p><input type="text" placeholder="Заголовок" v-model="title" class="add_input"></p>   
    
     <div ref="dropzone2" class="drop">
      Загрузить фотографию
      </div>

   <p><textarea v-model="news_text" cols="70" rows="7">Текст новости</textarea></p>
 
   <p><span  @click.prevent="addNews" class="add_btn pointer">Опубликовать</span></p>
   
   
 </div>
</template>

<script>
import Dropzone from 'dropzone';

  export default{
    name: "AddNews",

   data(){
      return{
       dropzone2:null,
       title: null,
       image: null,
       news_text: null,
       errors: []
     
      }
   },

   created(){
   
   },

    mounted()
    {

        this.dropzone2 = new Dropzone(this.$refs.dropzone2, {
            url: "/file/post",
           autoProcessQueue: false
        });
        console.log('dp');
        
    },

    methods: {

      addNews(){
           
           const data2 =  new FormData();
           const files = this.dropzone2.getAcceptedFiles();

           files.forEach(file => {
               data2.append('image[]', file);
               this.dropzone2.removeFile(file);
           });

           data2.append('title', this.title);
           data2.append('news_text', this.news_text)

            axios.post('/api/news/add', data2
              )
              .then(res => {
                 console.log(res);
              if(res.status === 201){
                window.location.href = "/admin/news";
                }else{
                 console.log(res.data); 
                 this.errors.push(res.data);
                }
                
              })
              .catch(er => {
                  if( this.title == null||this.news_text == null){
                    this.errors.push('Заполните все поля пожалуйста!');
                    console.log(this.errors)
                  }else if(this.news_text.length < 20){
                    this.errors.push('Текст должен быть не менее 20ти символов!');
                  }else if(this.title.length < 2){
                    this.errors.push('Заголово должен быть не менее двух символов!');
                  }else if(this.news_text.length >13000){

                        this.errors.push('Текст должен быть не более 13000 символов!');
                  }
                  else{
                   this.errors.push('Фотография должна быть не более 2 мегабайт!');
                  }
              }) 
           },

        

           
         }

  
  }
</script>