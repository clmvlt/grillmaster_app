<template>
    <div>
    <h1>Articles</h1>

    <table>
        <thead>
        <tr>
            <th>ID</th>
            <th>Nom</th>
            <th>Image</th>
        </tr>
        </thead>
        <tbody>
            <div v-for="article in lesarticles" :key="article.id">
                <tr>
                    <td>{{article.id}}</td>
                    <td>{{article.libelle}}</td>
                    <td><img v-bind:src="article.image" /></td>
                </tr>
            </div>
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

