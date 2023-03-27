<template>
  <header class="bg-dark py-5">
    <div class="container px-4 px-lg-5 my-5">
      <div class="text-center text-white">
        <h1 class="display-4 fw-bolder">Nos Produits</h1>
        <p class="lead fw-normal text-white-50 mb-0">
          Voici la liste complète des produits en vente.
        </p>
      </div>
    </div>
  </header>

  <section class="py-5">
    <div class="container px-4 px-lg-5 mt-5">
      <div
        class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center"
      >
        <div class="col mb-5" v-for="article in lesarticles" :key="article.id">
          <div class="card h-100">
            <img class="card-img-top" style="max-height: 50%" v-bind:src="article.image">
            <div class="card-body p-4">
              <div class="text-center">
                <h5 class="fw-bolder">{{article.libelle}}</h5>
                {{article.prix_euro}}€ / {{article.prix_fidelite}} Points
              </div>
            </div>
            <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
              <div class="text-center">
                <a class="btn btn-outline-dark mt-auto" href="#"
                  >Ajouter au panier</a
                >
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
  el: "#liste-produit",
  data() {
    return {
      lesarticles: [],
    };
  },
  methods: {},

  mounted() {
    fetch("/api/getArticles")
      .then((response) => response.json())
      .then((data) => {
        this.lesarticles = data;
      });
  },
};
</script>