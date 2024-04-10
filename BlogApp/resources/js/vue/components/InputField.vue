<script setup>
import {ref} from 'vue'
const props = defineProps({
    modelValue:{
            type: String
        },
        label:{
            type: String,
            required: true
        },
        inputType:{
            type: String,
            default: "text"
        },
})

</script>
<template>
    <div>
        <label> {{ props.label }}</label>
        <br>
        <input :value="props.modelValue" :type="props.inputType" @input="$emit('update:modelValue',$event.target.value)">
    </div>
</template>
