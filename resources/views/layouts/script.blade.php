 <!-- Core JS -->
 <script src="{{ asset('assets/js/core/popper.min.js') }}"></script>
 <script src="{{ asset('assets/js/core/bootstrap.min.js') }}"></script>
 <script src="{{ asset('assets/js/plugins/perfect-scrollbar.min.js') }}"></script>
 <script src="{{ asset('assets/js/plugins/smooth-scrollbar.min.js') }}"></script>
 <script src="{{ asset('assets/js/plugins/chartjs.min.js') }}"></script>
 <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
 <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
 <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
 <script src="{{ asset('assets/js/argon-dashboard.min.js') }}"></script>
 <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
 <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


 <script>
     var win = navigator.platform.indexOf('Win') > -1;
     if (win && document.querySelector('#sidenav-scrollbar')) {
         var options = {
             damping: '0.5'
         }
         Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
     }
 </script>




 {{-- Bulk Delete Script --}}
 {{-- <script>
     document.addEventListener("DOMContentLoaded", function() {
         const selectAllCheckbox = document.getElementById("select_all_id");
         const checkboxes = document.querySelectorAll(".checkbox_id");
         const deleteButton = document.getElementById("delete_selected");

         if (!selectAllCheckbox || !deleteButton) return;

         // **Fitur Select All**
         selectAllCheckbox.addEventListener("change", function() {
             checkboxes.forEach(checkbox => {
                 checkbox.checked = selectAllCheckbox.checked;
             });
         });

         // **Update Select All Jika Checkbox di Klik**
         checkboxes.forEach(checkbox => {
             checkbox.addEventListener("change", function() {
                 const totalChecked = document.querySelectorAll(".checkbox_id:checked").length;
                 selectAllCheckbox.checked = (totalChecked === checkboxes.length);
             });
         });

         // **Fitur Hapus Data Terpilih**
         deleteButton.addEventListener("click", function() {
             let selectedIds = Array.from(document.querySelectorAll(".checkbox_id:checked"))
                 .map(checkbox => checkbox.value);

             if (selectedIds.length === 0) {
                 alert("❌ Pilih minimal satu data untuk dihapus!");
                 return;
             }

             if (!confirm("⚠️ Anda yakin ingin menghapus data ini?")) {
                 return;
             }

             // **Tentukan route berdasarkan data-table yang sedang ditampilkan**
             let currentTable = document.getElementById("datatable");
             let tableType = currentTable.getAttribute(
                 "data-type"); // Pastikan ada atribut data-type pada tabel

             let deleteRoutes = {
                 "report": "{{ route('report.bulk-delete') }}",
                 "tracking": "{{ route('tracking.bulk-delete') }}",
                 "sparepart": "{{ route('sparepart.bulk-delete') }}",

             };

             let deleteUrl = deleteRoutes[tableType];

             if (!deleteUrl) {
                 alert("❌ Route untuk hapus tidak ditemukan.");
                 return;
             }

             // **Kirim request ke server menggunakan AJAX**
             fetch(deleteUrl, {
                     method: "POST",
                     headers: {
                         "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content,
                         "Content-Type": "application/json"
                     },
                     body: JSON.stringify({
                         ids: selectedIds
                     })
                 })
                 .then(response => response.json())
                 .then(data => {
                     if (data.success) {
                         alert("✅ Data berhasil dihapus.");
                         location.reload();
                     } else {
                         alert("❌ Terjadi kesalahan saat menghapus data.");
                     }
                 })
                 .catch(error => console.error("❌ Gagal menghapus data:", error));
         });
     });
 </script> --}}
