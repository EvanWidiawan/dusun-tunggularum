<template>
  <div class="min-h-screen flex items-center justify-center bg-[#EEF3F3] p-4 text-[#5E6E6E] font-body selection:bg-[#1F5C6B] selection:text-white">
    <div class="w-full max-w-md bg-white rounded-3xl p-8 sm:p-10 shadow-xl border border-[#3A4A4C]/15 space-y-8 relative overflow-hidden">
      <!-- Top Decorative Accent Bar -->
      <div class="absolute top-0 left-0 right-0 h-2 bg-[#1F5C6B]"></div>

      <!-- Header & Branding -->
      <div class="text-center space-y-3">
        <div class="inline-flex items-center justify-center w-14 h-14 rounded-2xl bg-[#1F5C6B] text-white shadow-md mb-2">
          <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
          </svg>
        </div>
        <h1 class="font-display font-bold text-3xl text-[#1F5C6B]">Login Admin</h1>
        <p class="text-sm text-[#5E6E6E]">
          Masuk ke Dashboard Pengelola Website Dusun Tunggularum
        </p>
      </div>

      <!-- Login Form -->
      <form @submit.prevent="submit" class="space-y-5">
        <!-- Username Input -->
        <div>
          <label for="username" class="block text-xs font-bold uppercase tracking-wider text-[#1F5C6B] mb-2">
            Username Admin
          </label>
          <input
            id="username"
            v-model="form.username"
            type="text"
            required
            placeholder="Contoh: admin"
            class="w-full px-4 py-3 rounded-xl bg-[#EEF3F3]/60 border border-[#3A4A4C]/20 text-[#1F5C6B] placeholder-[#5E6E6E]/50 focus:outline-hidden focus:border-[#1F5C6B] focus:ring-2 focus:ring-[#1F5C6B]/20 transition-all"
            :class="{ 'border-red-500 ring-2 ring-red-500/20': form.errors.username }"
          />
          <p v-if="form.errors.username" class="mt-1.5 text-xs text-red-600 font-medium">
            {{ form.errors.username }}
          </p>
        </div>

        <!-- Password Input -->
        <div>
          <label for="password" class="block text-xs font-bold uppercase tracking-wider text-[#1F5C6B] mb-2">
            Kata Sandi / Password
          </label>
          <input
            id="password"
            v-model="form.password"
            type="password"
            required
            placeholder="••••••••"
            class="w-full px-4 py-3 rounded-xl bg-[#EEF3F3]/60 border border-[#3A4A4C]/20 text-[#1F5C6B] placeholder-[#5E6E6E]/50 focus:outline-hidden focus:border-[#1F5C6B] focus:ring-2 focus:ring-[#1F5C6B]/20 transition-all"
            :class="{ 'border-red-500 ring-2 ring-red-500/20': form.errors.password }"
          />
          <p v-if="form.errors.password" class="mt-1.5 text-xs text-red-600 font-medium">
            {{ form.errors.password }}
          </p>
        </div>

        <!-- Remember Me Checkbox -->
        <div class="flex items-center justify-between">
          <label class="flex items-center gap-2 cursor-pointer">
            <input
              v-model="form.remember"
              type="checkbox"
              class="w-4 h-4 rounded border-[#3A4A4C]/30 text-[#1F5C6B] focus:ring-[#1F5C6B]"
            />
            <span class="text-xs text-[#5E6E6E]">Ingat Saya</span>
          </label>
        </div>

        <!-- Submit Button -->
        <button
          type="submit"
          :disabled="form.processing"
          class="w-full py-3.5 px-6 rounded-xl bg-[#1F5C6B] hover:bg-[#5FA8B5] text-white font-bold text-base shadow-md hover:shadow-lg transition-all transform hover:-translate-y-0.5 disabled:opacity-50 disabled:pointer-events-none flex items-center justify-center gap-2 cursor-pointer"
        >
          <svg v-if="form.processing" class="animate-spin h-5 w-5 text-white" fill="none" viewBox="0 0 24 24">
            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
          </svg>
          <span>{{ form.processing ? 'Memproses...' : 'Masuk Dashboard' }}</span>
        </button>
      </form>

      <!-- Back to Public Site Link -->
      <div class="text-center pt-2">
        <Link href="/" class="text-xs text-[#5E6E6E] hover:text-[#1F5C6B] underline transition-colors">
          &larr; Kembali ke Website Utama Dusun
        </Link>
      </div>
    </div>
  </div>
</template>

<script setup>
import { useForm, Link } from '@inertiajs/vue3';

const form = useForm({
  username: '',
  password: '',
  remember: false,
});

function submit() {
  form.post('/login', {
    onFinish: () => form.reset('password'),
  });
}
</script>
