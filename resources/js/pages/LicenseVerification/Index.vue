<template>
  <div class="flex flex-col md:flex-row bg-white shadow-lg rounded-xl max-w-7xl mx-auto mt-10 border border-gray-100 min-h-[600px]">
    <div class="md:w-1/2 p-8 flex flex-col">
      <component :is="currentComponent" />
    </div>
    <div class="md:w-1/2 p-8 flex flex-col justify-center bg-gray-50 border-t md:border-t-0 md:border-l border-gray-200">
      <h1 class="text-2xl font-extrabold mb-6 text-blue-700 text-center tracking-tight">Gaming License Verification</h1>
      <nav class="space-y-4 mb-8">
        <button @click="currentPage = 'VerifyLicense'" :class="navClass('VerifyLicense')">License authenticity verification</button>
        <button @click="currentPage = 'AvailableRegions'" :class="navClass('AvailableRegions')">GDPR compliance for regions</button>
        <button @click="currentPage = 'CheckRestrictions'" :class="navClass('CheckRestrictions')">Regional restriction checking</button>
        <button @click="currentPage = 'ValidateAge'" :class="navClass('ValidateAge')">Age rating validation</button>
      </nav>
      <div class="bg-gray-50 p-4 rounded-lg border border-gray-200">
        <h2 class="text-lg font-bold mb-2 text-gray-800">Testing Guidelines</h2>
        <ul class="list-disc pl-5 text-gray-700">
          <li>Use <span class="font-mono bg-gray-200 px-2 py-1 rounded">game-1</span> or <span class="font-mono bg-gray-200 px-2 py-1 rounded">game-2</span> as Game ID for all features.</li>
          <li>For <strong>License authenticity verification</strong>, enter a valid Game ID and Region (e.g., <span class="font-mono bg-gray-200 px-2 py-1 rounded">US</span>, <span class="font-mono bg-gray-200 px-2 py-1 rounded">EU</span>, <span class="font-mono bg-gray-200 px-2 py-1 rounded">JP</span>).</li>
          <li>For <strong>GDPR compliance for regions</strong>, enter a valid Game ID and click "Get Regions".</li>
          <li>For <strong>Regional restriction checking</strong>, enter a valid Game ID and click "Check".</li>
          <li>For <strong>Age rating validation</strong>, enter a valid Game ID and User ID (e.g., <span class="font-mono bg-gray-200 px-2 py-1 rounded">1</span> or <span class="font-mono bg-gray-200 px-2 py-1 rounded">2</span>).</li>
          <li>All forms have client-side validation. Try submitting with empty fields to see error messages.</li>
        </ul>
      </div>
    </div>
  </div>
</template>

<script lang="ts">
import { ref, defineComponent, computed } from 'vue';
import AvailableRegions from './AvailableRegions.vue';
import CheckRestrictions from './CheckRestrictions.vue';
import ValidateAge from './ValidateAge.vue';
import VerifyLicense from './VerifyLicense.vue';

export default defineComponent({
  name: 'LicenseVerificationIndex',
  components: {
    AvailableRegions,
    CheckRestrictions,
    ValidateAge,
    VerifyLicense,
  },
  setup() {
    const currentPage = ref('VerifyLicense');
    const currentComponent = computed(() => {
      return currentPage.value;
    });
    const navClass = (page: string) =>
      `w-full text-left px-4 py-3 rounded-lg font-semibold shadow transition border border-gray-200 cursor-pointer ${
        currentPage.value === page
          ? 'bg-blue-500 text-white' 
          : 'bg-gray-100 hover:bg-blue-100 text-blue-700'
      }`;
    return { currentPage, currentComponent, navClass };
  },
});
</script>

<style scoped>
body {
  background: linear-gradient(135deg, #e0e7ff 0%, #f8fafc 100%);
}
</style>
