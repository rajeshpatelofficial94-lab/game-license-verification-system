<template>
  <div class="bg-white shadow-lg rounded-xl p-6 max-w-lg w-full mx-auto mt-10 border border-gray-100">
    <h2 class="text-2xl font-extrabold mb-6 text-blue-700 text-center tracking-tight">Age rating validation</h2>
    <div class="mb-4">
      <input
        v-model="gameId"
        type="text"
        placeholder="Enter Game ID..."
        class="border border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all p-3 w-full rounded-lg text-lg outline-none text-slate-800 bg-white placeholder:text-gray-400 placeholder:font-normal"
        @keyup.enter="validateAge"
      />
      <div v-if="gameIdError" class="text-red-500 text-sm font-semibold">{{ gameIdError }}</div>
      <input
        v-model="userId"
        type="text"
        placeholder="Enter User ID..."
        class="border border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all p-3 w-full rounded-lg text-lg outline-none text-slate-800 bg-white placeholder:text-gray-400 placeholder:font-normal mt-4"
        @keyup.enter="validateAge"
      />
      <div v-if="userIdError" class="text-red-500 text-sm font-semibold">{{ userIdError }}</div>
    </div>
    <button
      @click="validateAge"
      class="bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 text-white px-6 py-3 rounded-lg font-semibold shadow-md transition-all duration-200 w-full mb-4 cursor-pointer"
    >
      <span class="flex items-center justify-center gap-2">
        Validate
      </span>
    </button>
    <div v-if="result !== null" class="mt-6 flex items-center">
      <strong class="block text-gray-700 py-1">Age Valid:</strong>
      <span :class="result ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700'" class="px-3 py-1 rounded-full font-medium shadow-sm border" :style="result ? 'border-color: #bbf7d0' : 'border-color: #fecaca'">
        {{ result }}
      </span>
    </div>
    <div v-if="error && !gameIdError && !userIdError" class="text-red-500 text-sm font-semibold mt-4 text-center">{{ error }}</div>
  </div>
</template>

<script lang="ts">
import { defineComponent, ref } from 'vue';
import axios from 'axios';

export default defineComponent({
  setup() {
    const gameId = ref('');
    const userId = ref('');
    const result = ref<boolean|null>(null);
    const error = ref<string|null>(null);
    const gameIdError = ref<string|null>(null);
    const userIdError = ref<string|null>(null);

    const validateAge = async () => {
      error.value = null;
      result.value = null;
      gameIdError.value = null;
      userIdError.value = null;
      const trimmedGameId = gameId.value.trim();
      const trimmedUserId = userId.value.trim();
      let hasError = false;
      if (!trimmedGameId) {
        gameIdError.value = 'Game ID is required.';
        hasError = true;
      }
      if (!trimmedUserId) {
        userIdError.value = 'User ID is required.';
        hasError = true;
      }
      if (hasError) return;
      try {
        const response = await axios.get('/api/license/age', {
          params: { game_id: trimmedGameId, user_id: trimmedUserId },
        });
        result.value = response.data.age_valid;
      } catch (e: any) {
        error.value = e.response?.data?.message || 'An error occurred';
      }
    };

    return { gameId, userId, result, error, validateAge, gameIdError, userIdError };
  },
});
</script>
