<template>
<div>
  <div v-if="organization" class="single_org segoe">
   <span>👁 {{organization.view}}</span>
     <div  class="single_org_box">
    
       <div class="single_org_l">
         
           <h2>{{organization.name}}</h2>
           <p>Категория: <span class="organization_personal_box_contacts_item">{{organization.category.name}}</span></p>
           <p>Телефон: <span class="organization_personal_box_contacts_item">{{organization.tel}}</span></p>
           <p>Адрес: <span class="organization_personal_box_contacts_item">{{organization.adress}}</span></p>
           <p>Сайт: <span class="organization_personal_box_contacts_item">{{organization.site}}</span></p>
           <div>Описание:
             <p>{{organization.description}}</p>
           </div>
       </div>
       <div class="single_org_r" v-if="organization.images" v-for="img in organization.images">
           <img :src="img.url">
       </div>
        <div class="single_org_r" v-if="organization.images.length== 0">
         Пока нет фотографий
       </div>
      </div>
   </div>
 </div>
</template>

<script>


  export default{
    name: "SingleOrganization",

   data(){
      return{
       organization: null
    
     
      }
   },

   created(){
   
   },

    mounted()
    {
          this.organizationCount();
        this.getSingleOrganization();
      
    },

    methods: {

         getSingleOrganization(){

          axios.get('/api/organization/' + this.$route.params.id)
          .then(res => {
                
                 this.organization = res.data
                  console.log(this.organization);
              })  
         },  


         organizationCount(){

          axios.get('/api/organization/count/' + this.$route.params.id)
          .then(res => {
                
                 this.organization = res.data
                
              })  
         }

      }

  
  }
</script>