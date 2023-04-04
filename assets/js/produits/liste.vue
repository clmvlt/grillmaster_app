<template>
  <div class="container px-4 px-lg-5 my-5">
    <div class="text-center text-dark">
      <h1 class="display-4 fw-bolder">Nos Produits</h1>
      <p class="lead fw-normal text-dark-50 mb-0">
        Voici la liste complète des produits en vente.
      </p>
    </div>
  </div>

  <section class="py-5">
    <div class="container px-4 px-lg-5 mt-5">
      <div
        class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center"
      >
        <div class="col mb-5" v-for="article in lesarticles" :key="article.id">
          <div class="card h-100">
            <img
              class="card-img-top"
              style="max-height: 50%"
              v-bind:src="article.image"
            />
            <div class="card-body p-4">
              <div class="text-center">
                <h5 class="fw-bolder">{{ article.libelle }}</h5>
                {{ article.prix_euro }}€ / {{ article.prix_fidelite }} Points
              </div>
            </div>
            <div class="card-footer p-4 pt-0 border-top-0">
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
                  @click="addPanier(article.id)"
                  class="btn btn-outline-dark mt-auto"
                >
                  Ajouter au panier<span
                    class="badge bg-dark text-white ms-1 rounded-pill"
                    >{{ countInPanier(article.id) }}</span
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
  el: "#liste-produit",
  data() {
    return {
      lesarticles: [],
      panier: [],
      user: {id: null}
    };
  },
  methods: {
    addPanier(id) {
      fetch("/api/addPanier/" + id);
      this.panier.push(this.lesarticles.find((x) => x.id == id));
    },
    countInPanier(id) {
      return this.panier.filter((x) => x.id == id).length;
    },
  },

  mounted() {
    fetch("/api/getArticles")
      .then((response) => response.json())
      .then((data) => {
        this.lesarticles = data;
      });
    fetch("/api/getPanier")
      .then((response) => response.json())
      .then((data) => {
        this.panier = data;
      });
    fetch("/api/getUser")
      .then((response) => response.json())
      .then((data) => {
        this.user = data;
      });
  },
};
</script>