<template>

<div class="main">

 <div class="search">
 <input type="text" placeholder="Я ищу" v-model="searchText" maxlength="50"><button @click.prevent="search" type="submit" class="pointer"> найти </button>
 </div>
 <h1>АГРЕГАТОР ТЕКСТИЛЯ КЫРГЫЗСТАНА</h1>
</div>

  <div class="img_box">
    <div class="list_box">
      <ul>
         <li class="list_h">Покупателям</li>
         <li>Товары и услуги</li>
         <li><router-link  to="organizations/all" class="list_router">Список производителей и поставщиков</router-link></li>
         <li>Создать тендер</li>
         <li class="list_h">Поставщикам</li>
         <li><router-link  to="login" class="list_router">Добавить компанию</router-link></li>
         <li><router-link  to="orders/all" class="list_router">Список актуальных заказов</router-link></li>
      </ul>
    </div>
    
    <div class="img_box_img">
       <div class="img_box_h">Лёгкая промышленность Кыргызстана на одном сайте</div>
    </div>

  
  </div>

  <div class = "icons">

    <div class = "icons_i">
     <img src="storage/ic1.png">
     <div>От поставщиков пуговиц до любого вида продукции</div>
    </div>

    <div class = "icons_i">
      <img src="storage/ic2.png">
      <div>Проверенные поставщики и швейные предприятия</div>
    </div>

    <div class = "icons_i">
     <img src="storage/ic3.png">
     <div>Конкурентная стоимость товаров и услуг</div>
    </div>

  </div>

  <div class="info_main">
    <p class="info_text_main"><span style="color: #2D80F8;"><b>АГРЕГАТОР ТЕКСТИЛЯ</b></span> - современная онлайн-платформа, связывающая заказчиков и производителей
    текстильной продукции, а также заказчиков и поставщиков швейной фурнитуры и тканей.</p>
   <div class="info_statistics">
     <p>➤ Более 15 категорий в Товарах и Услугах.</p>
     <p>➤ Контроль качества продукции.</p>
     <p>➤ Современная верификация пользователей.</p>
   </div>
  </div>

  <div class="count">

    <div class="count_item">
      <div class="count_item1">259</div>
      <div class="count_item2">Зарегистрированных производителей и поставщиков</div>
    </div>

    <div class="count_item">
      <div class="count_item1">120</div>
      <div class="count_item2">Заявок и тендеров ежемесячно</div>
    </div>

    <div class="count_item">
      <div class="count_item1">1,56</div>
      <div class="count_item2">млн. сомов - общая сумма сделок на портале АГРЕГАТОР ТЕКСТИЛЯ</div>
    </div>
  </div>

  <h2 class="lider_h">ЛИДЕРЫ СРЕДИ ПРОИЗВОДИТЕЛЕЙ</h2>

  <div class="liders">
  
    <div class="lider_box">
      <img src="#">
      <p>Category</p>
      <p>Название компании</p>
    </div>

  <div class="lider_box">
      <img src="#">
      <p>Category</p>
      <p>Название компании</p>
    </div>

      <div class="lider_box">
      <img src="#">
      <p>Category</p>
      <p>Название компании</p>
    </div>

      <div class="lider_box">
      <img src="#">
      <p>Category</p>
      <p>Название компании</p>
    </div>

      <div class="lider_box">
      <img src="#">
      <p>Category</p>
      <p>Название компании</p>
    </div>


  </div>

  <p class="list_link"> <router-link  class="list_link" to="organizations/all">Список всех компаний >>></router-link></p>

  <h2 class="lider_h">ПОСЛЕДНИЕ ЗАЯВКИ ОТ ЗАКАЗЧИКОВ</h2>

  <div class="client_req">
     <div class="client_req_box"  v-for = "lastOrder in lastOrders">

       <div class="req_left">
         <div class="req_info">
            <div class="req_info_category">{{lastOrder.category}}</div>
            <div>Дата публикации: {{lastOrder.created_at.substring(0, 10)}}</div>
         </div>
          <div class="req_text">{{lastOrder.text.substring(0, 150)}}...</div>
       </div>

       <div class="req_right">
          <router-link :to = "{path: '/order/'+lastOrder.id}" class="podrobnee">Подробнее</router-link>
       </div>
     </div>

     <div class="client_req_foot">
        <p class="list_link"><router-link  class="list_link" to="orders/all">Список всех заявок >>></router-link></p>
        <router-link  class="btn" to="order-add">Подать заявку</router-link>
         <router-link  class="btn" to="/">Создать тендер</router-link>
     </div>
  </div>


<h2 class="lider_h">ОТЗЫВЫ О ТОВАРАХ И УСЛУГАХ</h2>
  <div>
     <carousel :carousel_data = "sliderItems">
       
     </carousel>
  </div>

  <div class="partners">

    <div class="partner_box">
    <img src="storage/dg.png">
    </div>

        <div class="partner_box">
    <img src="storage/dg.png">
    </div>
        <div class="partner_box">
    <img src="storage/adidas.png">
    </div>
  </div>

   <h2 class="lider_h">НОВОСТИ И ПОЛЕЗНЫЕ СТАТЬИ</h2>

   <div class="news" v-for="lastNew in lastNews">

      <div class="news_img_box">
      <img :src="lastNew.img_url">
      </div>
  
       <div class="news_box">
        <h3>{{lastNew.title}}</h3>
        <div class="news_box_text">{{lastNew.news_text.substring(0, 300)}}...</div>
        <p> <router-link  class="news_link" to="organizations/all">Читать больше>>></router-link></p>
       </div>
   </div>

   <div class="about">
     <h3> О платформе АГРЕГАТОР ТЕКСТИЛЯ</h3>

     <p>Поиск надежных поставщиков легкой промышленности - порой сложная задача, 
     так как одновременно необходимо учитывать несколько факторов: конкретный продукт,
     который вы ищете, история компании производителя или поставщика, количество необходимого
     вам продукта, требуемые стандарты качества и так далее.</p>

      <h3> Платформа АГРЕГАТОР ТЕКСТИЛЯ решает все эти задачи:</h3>

      <p>1.На платформе представлены более 15 категорий товаров и услуг от проверенных
      производителей и поставщиков легкой промышленности Кыргызстана. Это и текстильная продукция,
      и швейная, и кожаная, и обувная, и так далее.
      </p>

      <h3> Мы ежедневно трудимся над тем, чтобы охватить как можно больше поставщиков
      и производителей Кыргызстана.</h3>
      
       <p>2.По каждому производителю или поставщику приводится актуальная информация: адрес,
       телефон, ссылка на вебсайт, а также другие важные детали: год основания, количество
       сотрудников, объем продаж, сертификаты сответствия качества(если имеется) и так далее.
      </p>
      <p>
       Мы используем современные интрументы верификации как производителей/поставщиков, так и 
       заказчиков. Ваша онлайн-безопасность - один из наших ключевых приоритетов. 
      </p>

      <h3> Преимущества платформы АГРЕГАТОР ТЕКСТИЛЯ:</h3>
      <ul>
         <li> Самая крупная база производителей и поставщиков текстильной, швейной, обувной
         промышленности Кыргызстана.
         </li>
         <li>Возможность найти анологичные предложения у разных производителей
         и поставщиков, отсортировать по цене идругим параметрам.</li>
         <li>Современная верификация пользователей</li>
         <li>Своевременное отслеживание этапов выполнения заказа на всех этапах.</li>
         <li>Реальные отзывы т пользователей платформы.</li>
      </ul>

      <p>Мы регулярно обновляем актуальный каталог и расширяем количество партнеров. Поэтому
      найти идеального поставщика илипроизводителя легкой промышленности Кыргызстана -
      максимально легко вместе с АГРЕГАТОРОМ ТЕКСТИЛЯ.
      </p>
   </div>

</template>

<script>
import Carousel from "./Carousel.vue";

 
  export default{
    name: "Main",
   
   components: {
       Carousel
   },


   data(){
       return{
         sliderItems: [
          {id: 1, img: 'storage/foto1.jpg'},
          {id: 2, img: '/storage/foto2.jpg'},
          {id: 3, img: '/storage/foto3.jpg'}
         ],
         searchText: null,
         lastOrders: null,
         lastNews: null
       }
   },

    mounted()
    {
        this.getLastOrders();
        this.getLastNews();
    },

    methods: {

      logout(){
        axios.post('/logout')
         .then( res => {
               this.$router.push('login');
         })
      },

      search(){
        this.$router.push('search/organizations/' + this.searchText);
         console.log('s');
      },

      getLastOrders(){
        axios.get('api/last/orders')
        .then( res => {
               console.log(res.data);
              this.lastOrders = res.data;
         })
      },

       getLastNews(){
        axios.get('api/last/news')
        .then( res => {
               console.log(res.data);
                 this.lastNews = res.data;
         })
      },
       getLiders(){
            axios.get('api/organization/liders')
        .then( res => {
               console.log(res.data);
         })
       }

    }
  }
</script>