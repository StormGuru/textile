<template>
<div>
 <h1 class="all_orgs_h">Список всех организаций</h1>

 <div class="organization_personal">
   
      <div class="organization_personal_box segoe"  v-for="allOrganization in allOrganizations">
        
        <div class="organization_personal_box_info">
            <div class = "organization_personal_box_name mb_2"><router-link :to = "{path: '/organization/'+allOrganization.id}" class="blue">{{allOrganization.name}}</router-link></div>
            <div class="organization_personal_box_contacts">
               <div>
                 <p>Адрес:</p>
                 <p><span class="organization_personal_box_contacts_item">{{allOrganization.adress}}</span></p>
               </div>
               <div>
                 <p>Телефон:</p>
                 <p><span class="organization_personal_box_contacts_item">{{allOrganization.tel}}</span></p>
               </div>
            </div>
            <div class = "organization_personal_box_description">{{allOrganization.description.substring(0, 150)}}...</div>
            <div class = "organization_personal_box_site"> Сайт: <a class="organization_personal_box_contacts_item">{{allOrganization.site}}</a></div>
        </div>

         <div v-if="allOrganization.images" class = "organization_personal_box_img" v-for="img in allOrganization.images">
             <img :src="img.url">
        </div>

       </div>

         <div class="pagination segoe">
          <span @click.prevent="getAllOrganizations(this.current_page-1)" v-if="this.current_page !== 1">предыдущий</span>
          <template v-for="link in links">
           <template v-if="Number(link.label)
           && this.current_page - link.label < 2
           &&this.current_page - link.label >  -2
           || Number(link.label) === 1|| Number(link.label) === this.last_page">
          <span :class="link.active ? 'active' : '' " @click.prevent="getAllOrganizations(link.label)">{{link.label}}</span>
           </template>
          </template>
           <span @click.prevent="getAllOrganizations(this.current_page+1)" v-if="this.current_page !== this.last_page">следующий</span>
        </div>

    </div> 



    <div>
       <div>
       <span>prev</span>
       <template>
       <span></span>
        </template>
         <span>next</span>
       </div>
       
       <div>
       
       </div>
   </div>

 </div>
</template>

<script>
  export default{
    name: "AllOrganizations",

   data(){
      return{
       allOrganizations: null,
        current_page: null,
       last_page: null,
       links: null
      }
   },
   created(){
   
   },

     mounted()
    {
        this.getAllOrganizations();
    },

    methods: {
     getAllOrganizations(page = 1){
        axios.post('/api/all/organizations', {page: page})
         .then( res => {
               console.log(res.data);
            this.allOrganizations = res.data.data;
               this.current_page = res.data.current_page;
               this.last_page = res.data.last_page;
                 this.links = res.data.links
         })
      }
    },

   

  }
</script>