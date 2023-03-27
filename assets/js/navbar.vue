<template>
  <nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">GrillMaster</a>
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
            <a class="nav-link active" aria-current="page" href="#">Accueil</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Nos Produits</a>
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
        <button class="btn btn-outline-dark">
          <i class="bi-cart-fill me-1"></i>
          Mon panier
          <span class="badge bg-dark text-white ms-1 rounded-pill">0</span>
        </button>
        <button class="btn btn-outline-warning" style="margin-left: 10px">Me connecter</button>
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