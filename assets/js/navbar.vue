<template>
  <nav class="navbar navbar-expand-lg bg-body-tertiary navbar-custom">
    <div class="container-fluid">
      <span class="navbar-brand text-logo">Grill Master</span>
      <button
        class="navbar-toggler"
        type="button"
        data-bs-toggle="collapse"
        data-bs-target="#navbarNavDropdown"
        aria-controls="navbarNavDropdown"
        aria-expanded="false"
        aria-label="Toggle navigation"
      >
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" href="/boutique">Nos Produits</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/avantages">Mes Avantages</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/menus">Nos Menus</a>
          </li>
        </ul>
        <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
          <div v-if="user.id==null">
            <li>
              <a href="/login" class="btn btn-outline-light" style="margin-left: 10px">Me connecter</a>
            </li>
          </div>
          <div v-else>
            <li>
              <a href="/user" class="btn btn-outline-primary">Mon compte</a>
              <a href="/panier" class="btn btn-outline-light" style="margin-left: 5px"><img width="22" src="/build/images/panier.png"></a>
            </li>
          </div>
        </ul>
      </div>
    </div>
  </nav>
</template>

<script>
export default {
  el: "#vue-navbar",
  data() {
    return {
      lesarticles: [],
      user: {id: null}
    };
  },
  methods: {
  },

  mounted() {
    fetch("/api/getArticles")
      .then((response) => response.json())
      .then((data) => {
        this.lesarticles = data;
      });
      fetch("/api/getUser")
      .then((response) => response.json())
      .then((data) => {
        this.user = data;
      });
  },
};
</script>