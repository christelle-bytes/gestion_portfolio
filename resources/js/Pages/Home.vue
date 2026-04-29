<script setup>
import { Link, router , Head } from '@inertiajs/vue3'
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
 
</script>
<template>
  <AuthenticatedLayout>
 <Head title="Accueil" />
    <div class="p-6">
      <h1 class="text-2xl font-bold">Accueil</h1>
 
      <Link href="/portfolios" class="text-blue-500 underline">
        Voir les portfolios
    </Link>
    </div>
  </AuthenticatedLayout>
</template>
 