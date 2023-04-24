<template>
<div>

<div class="m5 news_btn"><router-link to="add-news">Добавить новость</router-link></div>
   <div class="adm_news_box m5">
   <div v-if="posts === {}">Новостей пока нет</div>
   <div v-if = "posts" v-for="post in posts">

      <div>
        <img :src="post.img_url" width="200">
      </div>
      <div>
         <p><h3 class="blue">{{post.title}}</h3></p>
         <p>Дата создания: {{post.created_at.substring(0, 10)}}</p>
         <p class="mb_5">{{post.news_text}}</p>
          <span><router-link :to = "{path: '/admin/edit-news/'+post.id}" class="add_btn mt_3">Редактировать</router-link></span><span @click.prevent="deleteNews(post.id)" class="red_bg add_btn pointer">Удалить</span>
      </div>
   </div>   
 </div>
</div>

</template>

<script>
  export default{
    name: "News",

   data(){
      return{
       posts: null
      }
   },

     mounted()
    {
        this.showNews();
    },

    methods: {
      showNews(){
          
         axios.get('/api/news')
         .then( res => {
               
               this.posts = res.data;
             
         })
 
    },

       deleteNews(id){

        axios.delete(`/api/news/delete/${id}`)
           .then( res => {
            this.showNews();
               console.log(res);
               
         })
      }

   }

  }
</script>