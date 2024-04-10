<script setup>
import axios from 'axios';
import InputField from '../components/InputField.vue';
import { useStore } from 'vuex';
import {ref, defineEmits} from 'vue';

const store = useStore()
const title = ref('')
const blogValue = ref('')
const emits = defineEmits(['newBlogAdded','addFormClosed'])
const addBlog = () =>{
    axios.post('api/blogs',{
        id:0,
        userID: store.getters.getActiveUserID,
        titel: title.value,
        blogContent: blogValue.value,
    })
    .then(response =>{
        console.log(response)
        emits('newBlogAdded');
    })
    .catch(error =>{
        console.log(error)
    })
}
</script>
<template>
    <div class="add-form">
        <h1>Add a New Blog</h1>
        <InputField v-model="title" label="Blog Title"></InputField>
        <label>BlogContent: </label>
        <br>
        <textarea v-model="blogValue" rows="5"></textarea>
        <div class="button-group">
            <input type="button" class="btn btn-success" value="Add The Blog" @click="addBlog()">
            <input type="button" class="btn btn-danger" value="Close" @click="emits('addFormClosed')">
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
.add-form {
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
