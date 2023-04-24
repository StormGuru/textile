<template>
<div>
   <div>
   <img :src="item_data.img" class="carousel_img">
  </div>
 </div>
</template>

<script>
  export default{
    name: "Item",

   props: {
       item_data: {
        type: Object,
        default: () => {}
       }
    },


    methods: {
      logout(){
        axios.post('/logout')
         .then( res => {
               this.$router.push('login');
         })
      }
    },

   

  }
</script>