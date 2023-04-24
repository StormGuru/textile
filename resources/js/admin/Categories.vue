<template>
   <div>
         <div class="mt_3 mb_2"><button :class="switcher ? 'dn' :''" @click.prevent="changeSwitcher" class="add_btn bn pointer">Добавить категорию</button></div>
         <div :class="switcher ? '' :'dn'">
            <p><input type="text" v-model="add_ctg_name" placeholder="Название категории" class="add_input"></p>
            <button @click.prevent = "addCategory" class="add_btn bn mb_2">Добавить</button>
         </div>

          <div>
            <table>
               <tr>
                 <th>ID</th>
                 <th>Категория</th>
                 <th>Дата создания</th>
                 <th>Редактировать</th>
                 <th>Удалить</th>
               </tr>
               
            <template v-for="category in categories">
               <tr :class="isEdit(category.id) ? 'dn' :''">
                  <td>{{category.id}}</td>
                  <td>{{category.name}}</td>
                  <td>{{category.created_at}}</td>
                  <td><button class="blue pointer" @click.prevent="changeEditCtgId(category.id, category.name)">Изменить</button></td>
                   <td><button class="red_bg pointer" @click.prevent="deleteCategory(category.id)">Удалить</button></td>
               </tr>
                <tr :class="isEdit(category.id) ? '' :'dn'">
                  <td><input type="text" v-model="ctg_name"></td>
                  <td>{{category.name}}</td>
                  <td><button  @click.prevent="updateCategory(category.id)">Сохранить</button></td>
               </tr>
               </template>
            </table>
          </div>
     
 </div>
</template>

<script>
  export default{
    name: "Categories",

   data(){
      return{
       switcher: null,
       add_ctg_name: null,
       categories: null,
       editCtgId: null,
       ctg_name: null
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

      changeEditCtgId(id, name){
         this.editCtgId = id;
         this.ctg_name = name 
      },

      isEdit(id){
        return this.editCtgId === id;
      },

      updateCategory(id){
        this.editCtgId = null;
        axios.patch(`/api/category/update/${id}`, { name: this.ctg_name})
           .then( res => {
            this.showCategory();
               console.log(res);
               
         })
      },

        deleteCategory(id){

        axios.delete(`/api/category/delete/${id}`)
           .then( res => {
            this.showCategory();
               console.log(res);
               
         })
      },

      changeSwitcher(){
         this.switcher = 1
         console.log(this.switcher)
      },

      addCategory(){
           this.switcher = null;
          

           axios.post('/api/category/add/', { 'name': this.add_ctg_name})
              .then( res => {
            this.showCategory();
               console.log('Добавлено');
               
         });
      }
 
    },

   

  }
</script>