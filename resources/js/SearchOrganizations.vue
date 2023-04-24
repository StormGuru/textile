<template>
<div class="ml_8 mt_3 segoe">
 <div>     
    <router-link :to="'/search/organizations/' + this.$route.params.text" class="links mr_2">Организации</router-link>
    <router-link :to="'/search/orders/' + this.$route.params.text" class="links mr_2">Заявки</router-link>           
  </div>

   <h3>Производители по запросу "{{this.$route.params.text}}"</h3>

   <div class="organization_personal_box" v-if = "searchOrganizations" v-for = "searchOrganization in searchOrganizations">
        
        <div class="organization_personal_box_info">
            <div class = "organization_personal_box_name mb_2"><router-link :to = "{path: '/organization/'+searchOrganization.id}" class="blue">{{searchOrganization.name}}</router-link></div>
            <div class="organization_personal_box_contacts">
               <div>
                 <p>Адрес:</p>
                 <p><span class="organization_personal_box_contacts_item">{{searchOrganization.adress}}</span></p>
               </div>
               <div>
                 <p>Телефон:</p>
                 <p><span class="organization_personal_box_contacts_item">{{searchOrganization.tel}}</span></p>
               </div>
            </div>
            <div class = "organization_personal_box_description">{{searchOrganization.description.substring(0, 150)}}...</div>
            <div class = "organization_personal_box_site" v-if="searchOrganization.site"> Сайт: <a class="organization_personal_box_contacts_item">{{searchOrganization.site}}</a></div>
        </div>

         <div class = "organization_personal_box_img" v-if="searchOrganization.images" v-for="img in searchOrganization.images">
              <img :src = "img.url" :alt="img.name">             
        </div>
       </div>

 </div>
</template>

<script>
  export default{
    name: "SearchOrganizations",

   data(){
      return{
       searchOrganizations: null
      }
   },
   created(){
   
   },

     mounted()
    {
        this.showSearchOrganizations();
    },

    methods: {
     showSearchOrganizations(){
        axios.get(`/api/search/orgs/${this.$route.params.text}`)
         .then( res => {
          console.log(this.$route.params.text);
             console.log('proverka');
               this.searchOrganizations = res.data.data

                 console.log(this.searchOrganizations);
         })
      }
    },

   

  }
</script>