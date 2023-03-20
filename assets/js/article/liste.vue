<template>
    <div>
    <h1>Articles</h1>
    <a class="btn btn-primary" href="/article/create">Créer</a>

    <table>
        <thead>
        <tr>
            <th>ID</th>
            <th>Nom</th>
            <th>Image</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
                <tr v-for="article in lesarticles" :key="article.id">
                    <td>{{article.id}}</td>
                    <td>{{article.libelle}}</td>
                    <td><img style="width: 60px" v-bind:src="article.image"></td>
                    <td><a class="btn btn-warning" v-bind:href="'/article/edit/'+article.id">Modifier</a><a class="btn btn-danger" v-bind:href="'/article/delete/'+article.id">Supprimer</a></td>
                </tr>
        </tbody>
    </table>
    </div>
</template>

<script>
export default {
    el: "#liste-article",
  data() {
    return {
      lesarticles: []
    }
  },
  methods: {
    
  },

  mounted() {
    fetch("/api/getArticles")
      .then((response) => response.json())
      .then((data) => {
          this.lesarticles = data;
      });
  },
}
</script>

