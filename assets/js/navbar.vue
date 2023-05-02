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
            <a class="nav-link" href="/boutique"><span :class="getActive('boutique')">Nos Produits</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/avantages"><span :class="getActive('avantages')">Mes Avantages</span></a>
          </li>
          <li class="nav-item">
<<<<<<< HEAD
            <a class="nav-link" href="/menu"><span :class="getActive('menu')">Nos Menus</span></a>
=======
            <a class="nav-link" href="#">Mes Avantages</a>
          </li>
            <li class="nav-item">
            <a class="nav-link" href="/menu">Nos Menus</a>
>>>>>>> d78a7b2957d785237bec166e367fd76fabc135ab
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
              <a href="/compte" class="btn btn-outline-primary">Mon compte</a>
              <a href="/panier" class="btn btn-outline-light" style="margin-left: 5px"><img width="22" v-bind:src="getUrl('images/panier.png')"></a>
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
    getActive(routeName) {
      if(window.location.href.indexOf("/"+routeName) > -1)
      {
          return "selected";
      }
      return '';
    },
    getUrl(path) {
      return window.location.origin + "/" + path;
    }
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