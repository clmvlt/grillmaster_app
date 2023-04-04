<template>
    <header class="bg-dark py-5">
      <div class="container px-4 px-lg-5 my-5">
        <div class="text-center text-white">
          <h1 class="display-4 fw-bolder">Nos Menus</h1>
          <p class="lead fw-normal text-white-50 mb-0">
            Voici la liste complète des Menus.
          </p>
        </div>
      </div>
    </header>
  
    <section class="py-5">
      <div class="container px-4 px-lg-5 mt-5">
        <div
          class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center"
        >
          <div class="col mb-5" v-for="Menu in lesmenus" :key="menu.id">
            <div class="card h-100">
          
             
                
            
            </div>
          </div>
        </div>
      </div>
    </section>
  </template>
  
  <script>
  export default {
    el: "#liste-menu",
    data() {
      return {
        lesmenus: [],
        user: {id: null}
      };
    },
    mounted() {
      fetch("/api/getmenu")
        .then((response) => response.json())
        .then((data) => {
          this.lesmenus = data;
        });
      fetch("/api/getUser")
        .then((response) => response.json())
        .then((data) => {
          this.user = data;
        });
    },
  };
  </script>