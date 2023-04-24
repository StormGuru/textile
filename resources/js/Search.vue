<template>
<div>
  
  <div><router-view :key="$route.fullPath"></router-view></div>

 </div>
</template>

<script>
  export default{
    name: "Search",

   data(){
      return{
       
      }
   },
   created(){
   
   },

     mounted()
    {
       
    },

    methods: {
     
    },

   

  }
</script>