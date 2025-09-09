<template>
  <div class="bg-white shadow-lg rounded-xl p-6 max-w-lg w-full mx-auto mt-10 border border-gray-100">
    <h2 class="text-2xl font-extrabold mb-6 text-blue-700 text-center tracking-tight">Check Regional Restrictions</h2>
    <div class="mb-6">
      <input
        v-model="gameId"
        type="text"
        placeholder="Enter Game ID..."
        class="border border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all p-3 w-full rounded-lg text-lg outline-none text-slate-800 bg-white placeholder:text-gray-400 placeholder:font-normal"
        @keyup.enter="checkRestrictions"
      />
      <div v-if="error && error === 'Game ID is required.'" class="text-red-500 text-sm font-semibold">{{ error }}</div>
    </div>
    <button
      @click="checkRestrictions"
      class="bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 text-white px-6 py-3 rounded-lg font-semibold shadow-md transition-all duration-200 w-full mb-4 cursor-pointer"
    >
      <span class="flex items-center justify-center gap-2">
        Check
      </span>
    </button>
    <div v-if="restrictedRegions.length" class="mt-6">
      <strong class="block mb-2 text-gray-700">Restricted Regions:</strong>
      <div class="flex flex-wrap gap-2">
        <span
          v-for="region in restrictedRegions"
          :key="region"
          class="bg-red-100 text-red-700 px-3 py-1 rounded-full font-medium shadow-sm border border-red-200"
        >
          {{ region }}
        </span>
      </div>
    </div>
    <div v-else-if="!error && gameId" class="mt-6 text-gray-500 text-center font-semibold">
      No restricted regions found for this game.
    </div>
    <div v-if="error && error !== 'Game ID is required.'" class="text-red-500 text-sm font-semibold mt-4 text-center">{{ error }}</div>
  </div>
</template>

<script lang="ts">
import { defineComponent, ref } from 'vue';
import axios from 'axios';

export default defineComponent({
  setup() {
    const gameId = ref('');
    const restrictedRegions = ref<string[]>([]);
    const error = ref<string|null>(null);

    const checkRestrictions = async () => {
      error.value = null;
      restrictedRegions.value = [];
      const trimmedGameId = gameId.value.trim();
      if (!trimmedGameId) {
        error.value = 'Game ID is required.';
        return;
      }
      try {
        const response = await axios.get('/api/license/restrictions', {
          params: { game_id: trimmedGameId },
        });
        restrictedRegions.value = response.data.restricted_regions;
      } catch (e: any) {
        error.value = e.response?.data?.message || 'An error occurred';
      }
    };

    return { gameId, restrictedRegions, error, checkRestrictions };
  },
});
</script>
