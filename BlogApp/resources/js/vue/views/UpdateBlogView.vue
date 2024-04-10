<script setup>
import {  ref } from 'vue'
import { useStore } from 'vuex'
import InputField from '../components/InputField.vue'
import axios from 'axios'

const emits = defineEmits(['BlogUpdated','formClosed'])

const props = defineProps({
    defaultTitle : {
        type: String,
    },
    defaultBlogContent:{
        type: String,
    },
    IDofBlog:{
        type: Number,
        required:true,
    }
})

const store = useStore()
const title = ref(props.defaultTitle)
const blogValue = ref(props.defaultBlogContent)

const updateABlog = () =>{
    axios.patch('api/blogs',{
        id: props.IDofBlog,
        userID: store.getters.getActiveUserID,
        titel: title.value,
        blogContent: blogValue.value,
    })
    .then(response =>{
        console.log(response)
        emits('BlogUpdated');
    })
    .catch(error =>{
        console.log(error)
    })
}
</script>
<template >
    <div class="update-form" >
        <h1>Update a Blog</h1>
        <InputField v-model="title" label="Blog Title"></InputField>
        <label>BlogContent: </label>
        <br>
        <textarea v-model="blogValue" rows="5"></textarea>
        <br>
        <div class="button-group">
            <input type="button" class="btn btn-primary" value="Update Blog" @click="updateABlog()">
            <input type="button" value="Close" class="btn btn-danger" @click="emits('formClosed')">
        </div>
   </div>
</template>
<style scoped>
.button-group {
  display: flex;
  justify-content: space-between;
}
textarea{
    position: relative;
    width: 100%;
    padding: 10px;
    margin-bottom: 15px;
    border: 1px solid #ccc;
    border-radius: 5px;
}
.update-form {
    background-color:whitesmoke ;
  z-index: 100;

  position: absolute;
  left: 50%;
  top: 50%;
  transform: translate(-50%, -50%);
  padding: 20px;
  border: 1px solid #ccc;
  border-radius: 5px;
}

</style>
