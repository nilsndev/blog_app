<script setup>
import { onMounted, ref } from 'vue';
import { useRouter } from 'vue-router';
import AddBlogView from './AddBlogView.vue'
import UpdateBlogView from './UpdateBlogView.vue';
import axios from 'axios';

const router = useRouter()

onMounted(()=>{
    loadAllBlogs();
})

const blogs = ref([]);
const loadAllBlogs = () =>{
    axios.get('api/blogs')
    .then(response =>{
        console.log("New blogs")
        console.log(response.data.blogs);
        blogs.value = response.data.blogs;
    })
    .catch(error =>{
        console.error(error)
    })
}
const showSingleBlog = (blog) =>{
    router.push({
        path: `/oneBlog/${blog.titel}/${blog.blogContent}`,
    })
}

</script>
<template>
    <div>
        <div id="blogView" class="ms-5 mt-10">
            <h1>Blog List</h1>
            <ul class="list-group ">
                <li v-for="(blog,index) in blogs" :key="index" class="list-group-item d-flex justify-content-between w-75" @click="showSingleBlog(blog)">
                    <div class="blog_content">{{ blog.titel }}</div>
                </li>
            </ul>
            <br>
        </div>
    </div>
</template>
