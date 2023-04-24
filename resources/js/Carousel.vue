<template>
<div class="slide_wrapper">
   <div class="slider" :style="{'margin-left': '-' + (100 * currentSlideIndex) + '%'}">
  <Item v-for=" item in carousel_data" :key="item.id" :item_data="item"
  
  ></Item>
  </div>

  <button class="sb1" @click ="prevSlide"> &laquo;</button>
  <button class="sb2" @click ="nextSlide"> &raquo; </button>
 </div>
</template>

<script>

import Item from "./Item.vue";

  export default{
    name: "Carousel",
    
    components: {
       Item
   },
    
    data(){
      return{
        currentSlideIndex: 0
      }
    },  

    props: {
       carousel_data: {
        type: Array,
        default: () =>[]
       }
    },

    methods: {

      logout(){
        axios.post('/logout')
         .then( res => {
               this.$router.push('login');
         })
      },

      prevSlide(){
        if(this.currentSlideIndex > 0){
          this.currentSlideIndex--
          
        }
        console.log(this.currentSlideIndex)
         console.log("hi")
      },

       nextSlide(){
        if(this.currentSlideIndex >= this.carousel_data.length - 1){
          this.currentSlideIndex = 0
        } else{
             this.currentSlideIndex++
        }
       
          
      }

    },

   

  }
</script>