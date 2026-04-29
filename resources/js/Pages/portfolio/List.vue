<script setup>
import { Link, router , Head } from '@inertiajs/vue3'
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';

 
defineProps({
  portfolios: Array,
  auth: Object
})
 
const deletePortfolio = (id) => {
  if (confirm('Supprimer ce portfolio ?')) {
    router.delete(`/portfolios/${id}`)
  }
}
</script>


 
<template>
  <Head title="ListPortfolio" />
<AuthenticatedLayout>
  <div class="p-8 bg-gray-50 min-h-screen">
 
    <!-- Header -->
    <div class="flex justify-between items-center mb-8">
      <h1 class="text-3xl font-bold text-gray-800">Portfolios</h1>

      <Link href="home">
        retour a l'acceuil
      </Link>
 
      <Link
        href="/portfolios/create"
        class="bg-red-600 text-white px-4 py-2 rounded-lg shadow hover:bg-indigo-700 transition"
      >
        + Créer un portfolio
      </Link>
    </div>
 
    <!-- Grid -->
    <div class="grid md:grid-cols-3 gap-6">
 
      <div
        v-for="p in portfolios"
        :key="p.id"
        class="bg-white rounded-2xl shadow hover:shadow-lg transition overflow-hidden"
      >
 
        <!-- Image -->
         <!-- <div>{{ p }}</div> -->
        <div v-if="p.portfolio_image && p.portfolio_image.length">
          <img
            :src="`/storage/${p.portfolio_image[0].path}`"
            class="h-40 w-full object-cover"
          />
        </div>
 
        <div class="p-5">
 
          <h2 class="text-xl font-bold text-gray-800">
            {{ p.title }}
          </h2>
 
          <p class="text-gray-600 mt-2 line-clamp-2">
            {{ p.description }}
          </p>
 
          <div class="flex flex-wrap gap-2 mt-4">
            <span
              v-for="(lang, i) in p.languages"
              :key="i"
              class="bg-indigo-100 text-indigo-700 px-2 py-1 rounded-full text-xs"
            >
              {{ lang }}
            </span>
          </div>
 
          <p class="mt-4 text-sm text-gray-500">
            👤 By <span class="font-medium">{{ p.user.name }}</span>
          </p>
 
          <!-- Actions -->
          <div class="mt-4 flex justify-between items-center">
            
            <Link v-if="auth && auth.user.id==p.user_id"
              :href="`/portfolios/${p.id}/edit`"
              class="text-indigo-600 hover:underline text-sm"
            >
              Edit
            </Link>
 
            <Link
              :href="`/portfolios/${p.id}`"
              class="text-gray-600 hover:underline text-sm"
            >
              View
            </Link>
 
            <!-- DELETE BUTTON (ADMIN ONLY) -->
            <button
              v-if="auth.user?.role === 'admin'"
              @click="deletePortfolio(p.id)"
              class="text-red-600 hover:underline text-sm"
            >
              Delete
            </button>
 
          </div>
 
        </div>
      </div>
 
    </div>
  </div>
</AuthenticatedLayout>
</template>

