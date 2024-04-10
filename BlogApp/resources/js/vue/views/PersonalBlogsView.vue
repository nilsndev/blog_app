<script setup>
import { onMounted, ref } from 'vue';
import AddBlogView from './AddBlogView.vue'
import UpdateBlogView from './UpdateBlogView.vue';
import axios from 'axios';
import { useStore } from 'vuex';

const store = useStore();

const updateFormVisible = ref(false);
const addFormVisible = ref(false);
const blogToUpdate = ref({});
let uID  = 0;

onMounted(()=>{
    loadAllBlogs();
})

const blogs = ref([]);
const loadAllBlogs = () =>{
    uID = store.getters.getActiveUserID
    axios.get(`api/blogs/byuser/${uID}`)
    .then(response =>{
        console.log("New blogs")
        console.log(response.data.blogs);
        blogs.value = response.data.blogs;
    })
    .catch(error =>{
        console.error(error)
    })
}
const deleteABlog = (id) =>{
    axios.delete(`api/blogs/${id}`)
    .then(response =>{
        console.log(`Blog Deleted with ID: ${id}  Response: ${response}`);
        loadAllBlogs();
    })
    .catch(error =>{
        console.error(error);
    })
}

</script>
<template>
    <div>
        <div id="blogView" class="ms-5 mt-10">
            <h1>Blog List</h1>
            <ul class="list-group ">
                <li v-for="(blog,index) in blogs" :key="index" class="list-group-item d-flex justify-content-between w-75">
                    <div class="blog_content">{{ blog.titel }}</div>
                    <div class="button_group">
                        <input type="button" class="btn btn-danger" value="delete" @click="deleteABlog(blog.id)">
                        <input type="button" class="btn btn-primary" value="Update" @click="updateFormVisible = true; blogToUpdate=blog">
                    </div>
                </li>
            </ul>
            <br>
            <input class="btn btn-success" type="button" value="Add new Blog" v-if="!addFormVisible" @click="addFormVisible = true">
        </div>
        <div class="overlay" v-if="updateFormVisible || addFormVisible" />
        <AddBlogView
            @newBlogAdded="loadAllBlogs();
            addFormVisible = false"
            v-if="addFormVisible"
            @addFormClosed="addFormVisible = false"
        />

        <UpdateBlogView
            v-if="updateFormVisible"
            @formClosed="updateFormVisible = false"
            @BlogUpdated="loadAllBlogs(); updateFormVisible = false"
            :defaultTitle="blogToUpdate.titel"
            :defaultBlogContent="blogToUpdate.blogContent"
            :IDofBlog="blogToUpdate.id"
        />

    </div>

</template>
<style scoped>

    .overlay {
        z-index: 99;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
    }
</style>
