<template>
<div class="row">
    <span>Total du panier = {{totalPanier(false)}}€ ou {{totalPanier(true)}} points.</span>
    <div v-for="article in panier" :key="article.id">
      <img style="height: 30px" v-bind:src="article.image"/>
      <span>
        {{ article.libelle }}
      </span>
      <button type="button" style="border:0px;color: red;box-shadow: 0px" @click="removePanier(article.id)">Retirer</button>
    </div>
</div>
<div class="row">
  <a class="btn btn-success" type="button" href="/paiement/0">Payer en euro ({{totalPanier(false)}}€)</a>
  <a class="btn btn-warning" type="button" href="/paiement/1">Payer en points ({{totalPanier(true)}} points)</a>
</div>
</template>

<script>
export default {
  el: "#vue-panier",
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
    removePanier(id) {
      fetch("/api/removePanier/" + id);
      var article = this.panier.find((x) => x.id == id);
      var index = this.panier.indexOf(article);
      this.panier.splice(index, 1);
    },
    totalPanier(fidelite) {
        var total = 0;
        this.panier.forEach((item)=>{
          if (fidelite) {
            total += item.prix_fidelite
          } else {
            total += item.prix_euro
          }
        });
        return total;
    }
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