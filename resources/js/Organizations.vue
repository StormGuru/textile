<template>
<div>
 <div class="organization_personal">
 <div class="mb_5"><router-link to="add-organization" class="add_btn mb_5">Добавить организацию</router-link></div>
   
      <div class="organization_personal_box" v-if="organizations" v-for="organization in organizations">
        
        <div class="organization_personal_box_info">
            <div class = "organization_personal_box_name mb_2"><router-link :to = "{path: '/organization/'+organization.id}" class="blue">{{organization.name}}</router-link></div>
            <div class="organization_personal_box_contacts">
               <div>
                 <p>Адрес:</p>
                 <p><span class="organization_personal_box_contacts_item">{{organization.adress}}</span></p>
               </div>
               <div>
                 <p>Телефон:</p>
                 <p><span class="organization_personal_box_contacts_item">{{organization.tel}}</span></p>
               </div>
            </div>
            <div class = "organization_personal_box_description">{{organization.description.substring(1, 150)}}...</div>
            <div class = "organization_personal_box_site"> Сайт: <a v-if="!organization.site == 'null'" class="organization_personal_box_contacts_item">{{organization.site}}</a></div>
            <p><router-link :to = "{path: '/redact/organization/'+organization.id}" class="add_btn">Редактировать</router-link>
            <span class="add_btn red_bg pointer" @click.prevent="deleteOrganization(organization.id)">Удалить</span>
            </p>
        </div>

         <div class = "organization_personal_box_img" v-for="img in organization.images">
              <img :src = "img.url" :alt="img.name">
              
        </div>
       </div>

    </div> 
 </div>
</template>

<script>
  export default{
    name: "Organizations",

   data(){
      return{
       organizations: null,
    
      }
   },
   created(){
   
   },

     mounted()
    {
        this.userOrganizations();
    },


    methods: {

       userOrganizations(){
        axios.get('/api/user/organization')
         .then( res => {
          console.log(res);
               if(res.data !== null){
               this.organizations = res.data;
               console.log(res);
               console.log(this.organizations);
               }
             
         })
      },

        deleteOrganization(id){

        axios.delete(`/api/organization/delete/${id}`)
           .then( res => {
            this.userOrganizations();
               console.log(res);
               
         })
      },
 
    }

   

  }
</script>