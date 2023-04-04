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
            <a class="nav-link" href="#">Mes Avantages</a>
          </li>
          <li class="nav-item dropdown">
            <a
              class="nav-link dropdown-toggle"
              href="#"
              role="button"
              data-bs-toggle="dropdown"
              aria-expanded="false"
            >
              Nos Menus
            </a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item">Menu 1</a></li>
              <li><a class="dropdown-item">Menu 2</a></li>
            </ul>
          </li>
        </ul>
        <div v-if="user.id==null">
          <a href="/login" class="btn btn-outline-warning" style="margin-left: 10px">Me connecter</a>
        </div>
        <div v-else>
          <a href="/panier" class="btn btn-outline-dark">
          <i class="bi-cart-fill me-1"></i>
          Mon panier
        </a>
          <a href="/logout" class="btn btn-outline-danger" style="margin-left: 10px">Me déconnecter</a>
          * Connecté en tant que {{user.username}} | {{user.amount_euro}}€ et {{user.amount_fidelite}} points
        </div>
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