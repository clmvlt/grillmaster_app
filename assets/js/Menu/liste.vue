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
        <div class="col mb-5" v-for="menu in lesmenus" :key="menu.id">
          <div class="card h-100">
            <img
              class="card-img-top"
              style="max-height: 50%"
              v-bind:src="menu.image"
            />
            <div class="card-body p-4">
              <div class="text-center">
                <h5 class="fw-bolder">{{ menu.libelle }}</h5>

              </div>
            </div>
            <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
              <div class="text-center">
                <div v-if="user.id==null">
                  <a
                  type="button"
                  class="btn btn-outline-dark mt-auto"
                  href="/login"
                >Ajouter au panier</a>
                </div>
                <div v-else>
                  <button
                  type="button"
                  @click="addPanier(menu.id)"
                  class="btn btn-outline-dark mt-auto"
                >
                Ajouter au panier<span
                    class="badge bg-dark text-white ms-1 rounded-pill"
                    >{{ countInPanier(menu.id) }}</span
                  >
                </button>
                
                
                </div>
              </div>
            </div>
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
        user: {id: null},
      
      };
    },
    mounted() {
      
      fetch("/api/getMenu")
        .then((response) => response.json())
        .then((data) => {
          this.lesmenus = data;
        });
      fetch("/api/getUser")
        .then((response) => response.json())
        .then((data) => {
          this.user = data;
        })
       
      ;
    },
  };
  </script>