<template>
  <AdminLayout title="Kelola Karang Taruna">
    <div class="space-y-6">

      <!-- Header Action Bar -->
      <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 bg-white rounded-2xl p-6 border border-[#3A4A4C]/10 shadow-xs">
        <div class="space-y-1">
          <h2 class="font-display font-bold text-xl text-[#1F5C6B]">Daftar Pengurus Karang Taruna</h2>
          <p class="text-xs text-[#5E6E6E]">Kelola struktur kepengurusan dan informasi pengurus Karang Taruna Dusun Tunggularum.</p>
        </div>

        <button
          @click="openCreateModal"
          type="button"
          class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-[#1F5C6B] hover:bg-[#5FA8B5] text-white font-bold text-sm shadow-md transition-all shrink-0 cursor-pointer"
        >
          <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
          </svg>
          Tambah Pengurus Baru
        </button>
      </div>

      <!-- Search Filter Bar -->
      <div class="bg-white rounded-2xl p-4 border border-[#3A4A4C]/10 shadow-xs">
        <div class="relative">
          <svg class="w-5 h-5 text-[#5E6E6E] absolute left-3.5 top-1/2 -translate-y-1/2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
          </svg>
          <input
            v-model="searchQuery"
            type="text"
            placeholder="Cari berdasarkan nama atau jabatan pengurus..."
            class="w-full pl-11 pr-4 py-2.5 rounded-xl bg-[#EEF3F3]/60 border border-[#3A4A4C]/15 text-sm text-[#1F5C6B] placeholder-[#5E6E6E]/60 focus:outline-hidden focus:border-[#1F5C6B]"
          />
        </div>
      </div>

      <!-- Members Table Card -->
      <div class="bg-white rounded-2xl border border-[#3A4A4C]/10 shadow-xs overflow-hidden">
        <div class="overflow-x-auto">
          <table class="w-full text-left text-sm">
            <thead class="bg-[#1F5C6B]/5 text-[#1F5C6B] uppercase text-xs font-bold border-b border-[#3A4A4C]/10">
              <tr>
                <th class="px-6 py-4">Foto Profil</th>
                <th class="px-6 py-4">Nama Lengkap</th>
                <th class="px-6 py-4">Jabatan</th>
                <th class="px-6 py-4">Deskripsi Singkat</th>
                <th class="px-6 py-4 text-center">Aksi Pengelolaan</th>
              </tr>
            </thead>
            <tbody class="divide-y divide-[#3A4A4C]/10">
              <tr v-for="member in filteredMembers" :key="member.id" class="hover:bg-[#EEF3F3]/50 transition-colors">
                <!-- Foto Thumbnail -->
                <td class="px-6 py-4">
                  <div class="w-12 h-12 rounded-full bg-[#1F5C6B]/10 overflow-hidden border border-[#1F5C6B]/20 flex items-center justify-center shrink-0 shadow-2xs">
                    <img
                      v-if="member.foto"
                      :src="'/storage/' + member.foto"
                      :alt="member.nama"
                      class="w-full h-full object-cover"
                    />
                    <svg v-else class="w-6 h-6 text-[#1F5C6B]/40" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                  </div>
                </td>

                <!-- Nama -->
                <td class="px-6 py-4 font-bold text-[#1F5C6B]">
                  {{ member.nama }}
                </td>

                <!-- Jabatan Badge -->
                <td class="px-6 py-4">
                  <span class="px-3 py-1 rounded-full bg-[#5FA8B5]/20 text-[#1F5C6B] text-xs font-bold">
                    {{ member.jabatan }}
                  </span>
                </td>

                <!-- Deskripsi -->
                <td class="px-6 py-4 text-xs text-[#5E6E6E] max-w-xs truncate">
                  {{ member.deskripsi || '-' }}
                </td>

                <!-- Action Buttons -->
                <td class="px-6 py-4 text-center">
                  <div class="flex items-center justify-center gap-2">
                    <button
                      @click="openEditModal(member)"
                      type="button"
                      class="p-2 rounded-xl bg-[#5FA8B5]/20 text-[#1F5C6B] hover:bg-[#5FA8B5] hover:text-white transition-colors"
                      title="Edit Data Pengurus"
                    >
                      <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                      </svg>
                    </button>

                    <button
                      @click="deleteMember(member)"
                      type="button"
                      class="p-2 rounded-xl bg-red-100 text-red-600 hover:bg-red-600 hover:text-white transition-colors"
                      title="Hapus Data Pengurus"
                    >
                      <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                      </svg>
                    </button>
                  </div>
                </td>
              </tr>

              <tr v-if="filteredMembers.length === 0">
                <td colspan="5" class="px-6 py-10 text-center text-xs text-[#5E6E6E]">
                  Tidak ada data pengurus Karang Taruna ditemukan.
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>

    </div>

    <!-- Modal Form (Tambah / Edit) -->
    <transition
      enter-active-class="transition duration-200 ease-out"
      enter-from-class="opacity-0 scale-95"
      enter-to-class="opacity-100 scale-100"
      leave-active-class="transition duration-150 ease-in"
      leave-from-class="opacity-100 scale-100"
      leave-to-class="opacity-0 scale-95"
    >
      <div v-if="showModal" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/60 backdrop-blur-xs">
        <div class="bg-white rounded-3xl p-6 sm:p-8 max-w-lg w-full shadow-2xl space-y-5 border border-[#3A4A4C]/10 relative overflow-hidden">
          <div class="flex items-center justify-between border-b border-[#3A4A4C]/10 pb-4">
            <h3 class="font-display font-bold text-xl text-[#1F5C6B]">
              {{ isEditing ? 'Edit Data Pengurus' : 'Tambah Pengurus Baru' }}
            </h3>
            <button @click="closeModal" class="p-1.5 rounded-xl text-[#5E6E6E] hover:bg-[#EEF3F3] transition-colors">
              <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
              </svg>
            </button>
          </div>

          <form @submit.prevent="submitForm" class="space-y-4">
            <!-- Nama Input -->
            <div>
              <label class="block text-xs font-bold uppercase tracking-wider text-[#1F5C6B] mb-1.5">Nama Lengkap</label>
              <input
                v-model="form.nama"
                type="text"
                required
                placeholder="Contoh: Budi Santoso"
                class="w-full px-4 py-3 rounded-xl bg-[#EEF3F3]/50 border border-[#3A4A4C]/15 text-sm text-[#1F5C6B] focus:outline-hidden focus:border-[#1F5C6B]"
              />
              <p v-if="form.errors.nama" class="text-xs text-red-600 mt-1 font-medium">{{ form.errors.nama }}</p>
            </div>

            <!-- Jabatan Input -->
            <div>
              <label class="block text-xs font-bold uppercase tracking-wider text-[#1F5C6B] mb-1.5">Jabatan Kepengurusan</label>
              <input
                v-model="form.jabatan"
                type="text"
                required
                placeholder="Contoh: Ketua / Sekretaris / Bendahara"
                class="w-full px-4 py-3 rounded-xl bg-[#EEF3F3]/50 border border-[#3A4A4C]/15 text-sm text-[#1F5C6B] focus:outline-hidden focus:border-[#1F5C6B]"
              />
              <p v-if="form.errors.jabatan" class="text-xs text-red-600 mt-1 font-medium">{{ form.errors.jabatan }}</p>
            </div>

            <!-- Foto Upload Input -->
            <div>
              <label class="block text-xs font-bold uppercase tracking-wider text-[#1F5C6B] mb-1.5">Foto Profil (Opsional)</label>
              <input
                @change="handleFileChange"
                type="file"
                accept="image/*"
                class="w-full text-xs text-[#5E6E6E] file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-[#1F5C6B] file:text-white hover:file:bg-[#5FA8B5] cursor-pointer"
              />
              <p v-if="form.errors.foto" class="text-xs text-red-600 mt-1 font-medium">{{ form.errors.foto }}</p>
            </div>

            <!-- Deskripsi Input -->
            <div>
              <label class="block text-xs font-bold uppercase tracking-wider text-[#1F5C6B] mb-1.5">Deskripsi Singkat</label>
              <textarea
                v-model="form.deskripsi"
                rows="3"
                placeholder="Tuliskan peran atau deskripsi singkat pengurus..."
                class="w-full px-4 py-3 rounded-xl bg-[#EEF3F3]/50 border border-[#3A4A4C]/15 text-sm text-[#1F5C6B] focus:outline-hidden focus:border-[#1F5C6B]"
              ></textarea>
              <p v-if="form.errors.deskripsi" class="text-xs text-red-600 mt-1 font-medium">{{ form.errors.deskripsi }}</p>
            </div>

            <!-- Form Actions Footer -->
            <div class="flex items-center justify-end gap-3 pt-4 border-t border-[#3A4A4C]/10">
              <button
                @click="closeModal"
                type="button"
                class="px-5 py-2.5 rounded-xl border border-[#3A4A4C]/20 text-xs font-bold text-[#5E6E6E] hover:bg-[#EEF3F3] transition-colors"
              >
                Batal
              </button>

              <button
                type="submit"
                :disabled="form.processing"
                class="px-6 py-2.5 rounded-xl bg-[#1F5C6B] text-white text-xs font-bold hover:bg-[#5FA8B5] shadow-md transition-all disabled:opacity-50"
              >
                {{ form.processing ? 'Menyimpan...' : 'Simpan Data' }}
              </button>
            </div>
          </form>
        </div>
      </div>
    </transition>
  </AdminLayout>
</template>

<script setup>
import { ref, computed } from 'vue';
import { useForm, router } from '@inertiajs/vue3';
import AdminLayout from '../../../Layouts/AdminLayout.vue';

const props = defineProps({
  members: Array,
});

const searchQuery = ref('');
const showModal = ref(false);
const isEditing = ref(false);
const editingId = ref(null);

const form = useForm({
  nama: '',
  jabatan: '',
  foto: null,
  deskripsi: '',
});

const filteredMembers = computed(() => {
  if (!searchQuery.value) return props.members || [];
  const q = searchQuery.value.toLowerCase();
  return (props.members || []).filter(
    (m) => m.nama.toLowerCase().includes(q) || m.jabatan.toLowerCase().includes(q)
  );
});

function openCreateModal() {
  isEditing.value = false;
  editingId.value = null;
  form.reset();
  form.clearErrors();
  showModal.value = true;
}

function openEditModal(member) {
  isEditing.value = true;
  editingId.value = member.id;
  form.nama = member.nama;
  form.jabatan = member.jabatan;
  form.foto = null;
  form.deskripsi = member.deskripsi || '';
  form.clearErrors();
  showModal.value = true;
}

function closeModal() {
  showModal.value = false;
  form.reset();
}

function handleFileChange(event) {
  form.foto = event.target.files[0] || null;
}

function submitForm() {
  if (isEditing.value) {
    form.post(`/admin/karang-taruna/${editingId.value}`, {
      preserveScroll: true,
      onSuccess: () => closeModal(),
    });
  } else {
    form.post('/admin/karang-taruna', {
      preserveScroll: true,
      onSuccess: () => closeModal(),
    });
  }
}

function deleteMember(member) {
  if (confirm(`Apakah Anda yakin ingin menghapus data pengurus "${member.nama}"?`)) {
    router.delete(`/admin/karang-taruna/${member.id}`, {
      preserveScroll: true,
    });
  }
}
</script>
