<script setup>
import { useForm } from '@inertiajs/vue3'
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { ref } from 'vue';

 const props=defineProps({


    portfolio: Object
 })
 const current=ref(props.portfolio.languages.join(','));

const form = useForm({
  title:props.portfolio.title,
  description:props.portfolio.description,
  languages:props.portfolio.languages,
  images:[]
})
 
function submit(){
  form.put(route('portfolios.update',props.portfolio.id),{
  })
}
</script>
 
<template>
    <AuthenticatedLayout>

<div class="p-8 max-w-xl mx-auto">
    <pre>{{ portfolio }}</pre>
    <h1 class="text-2xl font-bold mb-4">Modifier</h1>
    <form @submit.prevent="submit" class="space-y-4" >
 
        <input v-model="form.title"
            placeholder="Title"
            class="w-full border p-2 rounded">
            <span v-if="form.errors.title" class="text-red-500">{{ form.errors.title }}</span>


        <textarea v-model="form.description"
            placeholder="Description"
            class="w-full border p-2 rounded"></textarea>
            <span v-if="form.errors.title" class="text-red-500">{{ form.errors.description }}</span>


        <input type="text"
        :value="form.languages"
            placeholder="Langages séparés par virgule"
            @change="e => form.languages = e.target.value.split(',')"
            class="w-full border p-2 rounded">
                <span v-if="form.errors.title" class="text-red-500">{{ form.errors.languages}}</span>

               <img :src="`/storage/${portfolio.portfolio_image[0].path}`" alt="image du portfolio"> 

        <input type="file"
            multiple
            @change="e => form.images = e.target.files">
 
        <button  :disabled="form.processing"
            class="bg-red-600 text-white px-4 py-2 rounded">
           Modifier
        </button>
 
    </form>
</div>
</AuthenticatedLayout>

</template>