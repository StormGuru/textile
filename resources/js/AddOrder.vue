<template>
<div class="ml_8">
   <h3 class="segoe">Добавление заявки</h3>
   <p>
     <div v-for="e in errors" class="r">{{e}}</div>
     <p>Выберите категорию:<span class="r">*</span></p>
     <select v-model="category_id">
       <option  v-for="category in categories" :value="category.id" class="option">{{category.name}}</option>
     </select>
   </p>
   <p><textarea v-model="text" rows="7" cols="70" class="mb_2">Текст заявки</textarea></p>
    <p><span @click.prevent="AddOrder" type="submit"  class="add_btn pointer">создать</span></p>
 </div>
</template>

<script>
  export default{
    name: "AddOrder",

   data(){
      return{
       categories: null,
       category_id: null,
       text: null,
       errors: []
      }
   },
   created(){
   
   },

    mounted()
    {
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
      AddOrder(){
            axios.post('/api/order/add', {
              category_id: this.category_id,
              text: this.text
            })
            .then(res => {
                   console.log(res);
                   if(res.status === 201){
                    this.$router.push('order');
                   }
                   
            })
             .catch(error=>{            
                  console.log(error);
                  if( this.category_id == null||this.text == null){
                    this.errors.push('Заполните все поля пожалуйста!');
                    console.log(this.errors)
                  }else if(this.category_id == null ){
                     this.errors.push('Выберите категорию, пожалуйста!');
                  }else if(this.text.length < 20){
                    this.errors.push('Заявка должна быть не менее 20ти символов!');
                  }else if(this.text.length >1000){

                        this.errors.push('Заявка должна быть не более 1000 символов!');
                  }
                  else{
                   console.log(error);
                  }
            })


           console.log(this.category_id);
           console.log(this.text);
      }
    },

   

  }
</script>