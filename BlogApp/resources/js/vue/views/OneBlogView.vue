<script setup>
import { onMounted, ref } from 'vue';
import { useRoute } from 'vue-router';

const route = useRoute();

const BlogTitle = ref('');
const BlogContent = ref('');
onMounted(()=>{
    BlogTitle.value = route.params.title
    BlogContent.value = route.params.text
    console.log("title" +BlogTitle.value + "text: "  + BlogContent.value)
})
</script>

<template>
    <div class="blog-post">
        <h1 class="blog-title">{{ BlogTitle }}</h1>
        <textarea readonly class="blog-content">{{ BlogContent }}</textarea>
  </div>
</template>

<style scoped>
.blog-post {
  max-width: 800px;
  margin: auto;
  padding: 20px;
}

.blog-title {
  margin-bottom: 20px;
}

.blog-content {
  width: 100%;
  height: 400px;
  padding: 10px;
  border: 1px solid #ccc;
  border-radius: 5px;
}
</style>
