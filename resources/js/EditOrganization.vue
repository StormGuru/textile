<template>
<div>
  <div class="single_org segoe">
  <h3>Редактировать</h3>
   <div v-for="e in errors">{{e}}</div>
     <div  class="single_org_box" v-if="organization">
       <div class="single_org_l">
           <p>Название: <input type="text" v-model="edit_name"></p>
           <p>Категория:
             <select v-model="category_id">
              <option  v-for="category in categories" :value="category.id">{{category.name}}</option>
             </select>
           </p>
           <p>Телефон: <input type="text" v-model="edit_tel"></p>
           <p>Адрес: <input type="text" v-model="edit_adress"></p>
           <p>Сайт: <input type="text" v-model="edit_site"></p>
           <div>Описание:
             <p><textarea v-model="edit_description"></textarea></p>
           </div>
           
       </div>
       <div>
         <div class="single_org_r" v-if="organization.images" v-for="img in organization.images">
             <img :src="img.url">
             <template v-if="organization.images">Изменить фотографию</template>

         </div>
        <div class="single_org_r"  v-if="typeof(organization.images) === 'undefined'">
        
             <template>Добавить фотографию</template>
     
         </div>

         <div ref="dropzone4" class="drop">
              Выбрать
          </div>
        </div>
       

    
      </div>
         <p><button  @click.prevent="editOrg">Сохранить</button></p>
   </div>
 </div>
</template>

<script>
import Dropzone from 'dropzone';

  export default{
    name: "EditOrganization",

   data(){
      return{
      dropzone4: null,
       organization: {},
       edit_name: null,
       edit_adress: null,
       edit_tel: null,
       edit_site: null,
       edit_description: null,
       categories: null,
       category_id: null,
       errors: []
      }
   },

   created(){
   
   },

    mounted()
    {
      
        this.getSingleOrganization();
        this.showCategory();
                  this.dropzone4 = new Dropzone(this.$refs.dropzone4, {
                    url: "/file/post",
                   autoProcessQueue: false
        });
    },

    methods: {

        showCategory(){
        axios.get('/api/category/show')
         .then( res => {
               console.log(res.data);
               this.categories = res.data;
         })
      },


         getSingleOrganization(){

          axios.get('/api/organization/' + this.$route.params.id)
          .then(res => {
                
                 this.organization = res.data
                 this.edit_name = res.data.name;
                 this.edit_adress = res.data.adress;
                 this.edit_tel = res.data.tel;
                 this.edit_site = res.data.site;
                 this.edit_description = res.data.description;
                  console.log(this.organization);     
              })
              
         },
       
          editOrg(){
         console.log('edit');

           const data4 =  new FormData();
           const files = this.dropzone4.getAcceptedFiles();

       
            files.forEach(file => {
               data4.append('image[]', file);
           });
         
        
            data4.append('name', this.edit_name); 
            data4.append('adress', this.edit_adress);
            data4.append('tel', this.edit_tel);
            data4.append('site', this.edit_site);
             data4.append('description', this.edit_description);
            data4.append('category_id', this.category_id);

            data4.append('_method', 'PATCH');

           axios.post('/api/organization/update/' + this.$route.params.id, 
           data4
              )
              .then(res => {
                 console.log(res);
                  if(res.data != {}){
                    this.$router.push('/personal/organizations');
                   }else{
                 console.log(res.data); 
                 this.errors.push(res.data);
                }
              })
              .catch(error=>{            
                  console.log(error);
                  if( this.category_id == null||this.edit_name == null ||this.edit_adress == null||this.edit_tel == null ||this.edit_description == null){
                    this.errors.push('Заполните все поля пожалуйста!');
                    console.log(this.errors)
                  }else if(this.category_id == null ){
                     this.errors.push('Выберите категорию, пожалуйста!');
                  }else if(this.edit_description.length < 20){
                    this.errors.push('Описание должна быть не менее 20ти символов!');
                  }else if(this.edit_name.length < 2){
                    this.errors.push('Название должно быть не менее двух символов!');
                  }else if(this.edit_adress.length < 5){
                    this.errors.push('Адрес должен быть не менее пяти символов!');
                  }else if(this.edit_tel.length < 9){
                    this.errors.push('Телефон должен быть не менее 9ти символов!');
                  }else if(this.edit_adress.length > 100){
                    this.errors.push('Адрес должен быть не более 100 символов!');
                  }else if(this.edit_name.length > 100){
                    this.errors.push('Название должно быть не более 100 символов!');
                  }else if(this.edit_tel.length > 100){
                    this.errors.push('Телефон должен быть не более 100 символов!');
                  }else if(this.edit_site.length > 100){
                    this.errors.push('Сайт должен быть не более 100 символов!');
                  }else if(this.edit_description.length >1500){

                        this.errors.push('Описание должно быть не более 1500 символов!');
                  }
                  else{
                   console.log(error);
                  }
            })    
         
      }

      }

   

  
  }
</script>