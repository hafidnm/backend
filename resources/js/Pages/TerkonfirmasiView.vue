<template>
    <div class="flex">
      <!-- Sidebar -->
      <aside class="w-64 bg-gray-800 text-white h-screen p-4">
        <h2 class="text-xl font-semibold mb-6">Admin Dashboard</h2>
        <nav>
          <ul>
            <li><a href="/admin/dashboard" class="block py-2 px-4 hover:bg-gray-700 rounded">Menunggu Konfirmasi</a></li>
            <li><a href="/admin/terkonfirmasi" class="block py-2 px-4 hover:bg-gray-700 rounded">Terkonfirmasi</a></li>
            <li><a href="#" @click="logout" class="block py-2 px-4 mt-6 bg-red-600 hover:bg-red-500 rounded">Logout</a></li>
          </ul>
        </nav>
      </aside>
  
      <!-- Main Content Area -->
      <main class="flex-1 p-6 bg-gray-100">Terkonfrmasi
        <table class="min-w-full bg-white mt-4 border border-gray-300">
          <thead>
            <tr class="bg-gray-200">
              <th class="py-2 px-4 border-b">ID Booking</th>
              <th class="py-2 px-4 border-b">Nama Ketua</th>
              <th class="py-2 px-4 border-b">NIK Ketua</th>
              <th class="py-2 px-4 border-b">Telepon Ketua</th>
              <th class="py-2 px-4 border-b">Tanggal Reservasi</th>
              <th class="py-2 px-4 border-b">Bukti Pembayaran</th>
              <th class="py-2 px-4 border-b">Aksi</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="reservasi in reservasis" :key="reservasi.id">
              <td class="py-2 px-4 border-b">{{ reservasi.id }}</td>
              <td class="py-2 px-4 border-b">{{ reservasi.nama_ketua }}</td>
              <td class="py-2 px-4 border-b">{{ reservasi.nik_ketua }}</td>
              <td class="py-2 px-4 border-b">{{ reservasi.telepon_ketua }}</td>
              <td class="py-2 px-4 border-b">{{ formatDate(reservasi.tanggal_reservasi) }}</td>
              <td class="py-2 px-4 border-b">
                <img v-if="reservasi.bukti_pembayaran" 
                     :src="`/storage/${reservasi.bukti_pembayaran}`" 
                     alt="Bukti Pembayaran" 
                     class="w-16 h-16 cursor-pointer"
                     @click="viewImage(`/storage/${reservasi.bukti_pembayaran}`)" />
                <p v-else class="text-red-500">Belum Upload</p>
              </td>
              <td class="py-2 px-4 border-b flex space-x-2">
                <button @click="viewDetails(reservasi.id)" class="bg-gray-500 hover:bg-gray-400 text-white px-2 py-1 rounded">Detail</button>
                <button @click="confirmEdit(reservasi.id)" class="bg-blue-500 hover:bg-blue-400 text-white px-2 py-1 rounded">Edit</button>
                <button @click="confirmDelete(reservasi.id)" class="bg-red-500 hover:bg-red-400 text-white px-2 py-1 rounded">Delete</button>
              </td>
            </tr>
          </tbody>
        </table>
      </main>
    </div>
  </template>
  
  <script>
  import { Inertia } from '@inertiajs/inertia';
  
  export default {
    props: {
      reservasis: Array, // Data reservasi yang dikirim dari backend
    },
    data() {
      return {
        selectedReservation: null,
        selectedImage: null, // URL gambar yang dipilih
      };
    },
    methods: {
      formatDate(date) {
        return new Date(date).toLocaleDateString(); // Format tanggal
      },
      viewImage(imageUrl) {
        this.selectedImage = imageUrl;
      },
      closeImage() {
        this.selectedImage = null;
      },
      viewDetails(id) {
        Inertia.visit(`/admin/reservations/${id}/edit`); // Redirect ke halaman edit jika diperlukan
      },
      confirmEdit(id) {
        Inertia.visit(`/admin/reservations/${id}/edit`);
      },
      confirmDelete(id) {
        if (confirm('Are you sure you want to delete this reservation?')) {
          Inertia.delete(`/admin/reservations/${id}`);
        }
      }
    }
  };
  </script>
  
  