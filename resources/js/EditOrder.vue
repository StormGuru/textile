<template>
<div class="single_org segoe">

   <h3>Редактировать заявку</h3>
       <div v-for="e_e in e_errors">{{e_e}}</div>
    <div  class="">
            <p>Выберите категорию:</p>
            <p>
             <select v-model="category_id">
              <option  v-for="category in categories" :value="category.id">{{category.name}}</option>
             </select>
           </p>
         <div>Описание:
             <p><textarea cols="80" rows="7" v-model="edit_text" class="mb_5"></textarea></p>
         </div>

         <p><span  @click.prevent="editOrder" class="add_btn pointer mt_3">Сохранить</span></p>
           
   </div>

 </div>
</template>

<script>

  
  export default{
    name: "EditOrder",

   data(){
      return{
       order: {},
       edit_text: null,
       categories: '',
       category_id: null,
       e_errors:[]
      }
   },

   created(){
   
   },

    mounted()
    {
      
        this.getSingleOrder();
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


         getSingleOrder(){

          axios.get('/api/order/' + this.$route.params.id)
           .then(res => {
                 console.log(res); 
                 this.order = res.data;
                 this.edit_text = res.data.text;
       
              })  
         },
       
          editOrder(){
         console.log('edit order');
            axios.patch('/api/order/update/' + this.$route.params.id, 
           {category_id: this.category_id,
           text: this.edit_text}
              )
              .then(res => {
                 console.log(res);
               if(res.status === 200){
                    this.$router.push('/personal/order');
                   }
              }) 
                 .catch(error=>{   
                     console.log("error");         
                  if( this.category_id == null||this.edit_text == null){
                    this.e_errors.push('Заполните все поля пожалуйста!');
                    console.log(this.e_errors)
                  }else if(this.category_id == null ){
                     this.e_errors.push('Выберите категорию, пожалуйста!');
                  }else if(this.edit_text.length < 20){
                    this.e_errors.push('Заявка должна быть не менее 20ти символов!');
                  }else if(this.edit_text.length >1000){

                        this.e_errors.push('Заявка должна быть не более 1000 символов!');
                  }
                  else{
                   console.log(error);
                  }
            })
         }

      }

   

  
  }
</script>