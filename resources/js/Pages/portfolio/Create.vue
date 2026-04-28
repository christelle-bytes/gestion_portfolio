<script setup>
import { useForm } from '@inertiajs/vue3'
 
const form = useForm({
  title:'',
  description:'',
  languages:[],
  images:[]
})
 
function submit(){
  form.post('/portfolios',{
    forceFormData:true
  })
}
</script>
 
<template>
<div class="p-8 max-w-xl mx-auto">
    <h1 class="text-2xl font-bold mb-4">Create Portfolio</h1>
 
    <form @submit.prevent="submit" class="space-y-4" >
 
        <input v-model="form.title"
            placeholder="Title"
            class="w-full border p-2 rounded">
 
        <textarea v-model="form.description"
            placeholder="Description"
            class="w-full border p-2 rounded"></textarea>
 
        <input type="text"
            placeholder="Langages séparés par virgule"
            @change="e => form.languages = e.target.value.split(',')"
            class="w-full border p-2 rounded">
 
        <input type="file"
            multiple
            @change="e => form.images = e.target.files">
 
        <button
            class="bg-red-600 text-white px-4 py-2 rounded">
            Save
        </button>
 
    </form>
</div>
</template>