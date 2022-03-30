<template>
  <div>
      <select class="form-control w-50 mb-3">
          <option value="">Filter by Category</option>
          <option v-for="category in categories" value="{{ category.id }}">{{ category.name }}</option>
      </select>
    <table class="table">
      <thead>
        <tr>
          <td>ID</td>
          <td>Title</td>
          <td>Category</td>
          <td>Content</td>
          <td>Created At</td>
        </tr>
      </thead>
      <tbody>
        <tr v-for="post in posts.data">
          <td>{{ post.id }}</td>
          <td>{{ post.title }}</td>
          <td>{{ post.category }}</td>
          <td>{{ post.content }}</td>
          <td>{{ post.created_at }}</td>
        </tr>
      </tbody>
    </table>
    <Pagination :data="posts" @pagination-change-page="fetchPosts" />
  </div>
</template>

<script>
export default {
  data() {
    return {
      posts: [],
      categories: [],
    };
  },

  mounted() {
    this.fetchPosts();
    this.fetchCategories();
  },

  methods: {
    fetchPosts(page = 1) {
      axios
        .get("/api/posts?page=" + page)
        .then((response) => (this.posts = response.data))
        .catch((error) => console.log(error));
    },
    fetchCategories() {
      axios
        .get("/api/categories")
        .then((response) => (this.categories = response.data.data))
        .catch((error) => console.log(error));
    },
  },
};
</script>