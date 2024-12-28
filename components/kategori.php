<?php
include 'koneksiDb/koneksi.php';

$query = "SELECT * FROM kategori WHERE LOWER(nama_kategori) != 'all menu' ORDER BY id_kategori";
$result = mysqli_query($koneksi, $query);

// Hitung total menu
$total_query = "SELECT COUNT(*) as total FROM menu WHERE status = 'tersedia'";
$total_result = mysqli_query($koneksi, $total_query);
$total_menu = mysqli_fetch_assoc($total_result)['total'];
?>

<div class="flex space-x-4 mb-6 overflow-x-auto pb-2">
    <!-- All Menu button -->
    <button onclick="filterByCategory(0)" 
            class="category-btn flex items-center space-x-2 px-4 py-2 bg-white rounded-full hover:bg-blue-50 transition-colors">
        <span class="text-xl">🍽️</span>
        <div class="flex flex-col items-start">
            <span class="font-medium text-gray-900">All Menu</span>
            <span class="items-count text-xs text-gray-500"><?php echo $total_menu; ?> items</span>
        </div>
    </button>

    <?php while($kategori = mysqli_fetch_assoc($result)): ?>
    <button onclick="filterByCategory(<?php echo $kategori['id_kategori']; ?>)" 
            class="category-btn flex items-center space-x-2 px-4 py-2 bg-white rounded-full hover:bg-blue-50 transition-colors">
        <span class="text-xl"><?php echo $kategori['icon']; ?></span>
        <div class="flex flex-col items-start">
            <span class="font-medium text-gray-900"><?php echo htmlspecialchars($kategori['nama_kategori']); ?></span>
            <span class="items-count text-xs text-gray-500"><?php echo $kategori['jumlah_item']; ?> items</span>
        </div>
    </button>
    <?php endwhile; ?>
</div>

<script>
// Load semua menu saat pertama kali dan aktifkan tombol All Menu
document.addEventListener('DOMContentLoaded', function() {
    filterByCategory(0);
    // Aktifkan tombol All Menu
    const allMenuBtn = document.querySelector('.category-btn');
    if (allMenuBtn) {
        allMenuBtn.classList.remove('bg-white');
        allMenuBtn.classList.add('bg-blue-500', 'text-white');
        allMenuBtn.querySelector('.font-medium').classList.remove('text-gray-900');
        allMenuBtn.querySelector('.font-medium').classList.add('text-white');
        allMenuBtn.querySelector('.items-count').classList.remove('text-gray-500');
        allMenuBtn.querySelector('.items-count').classList.add('text-white', 'opacity-75');
    }
});

function filterByCategory(categoryId) {
    fetch(`filter_menu.php?kategori=${categoryId}`)
        .then(response => response.text())
        .then(html => {
            document.querySelector('.grid').innerHTML = html;
        })
        .catch(error => console.error('Error:', error));
}

// Tambahkan class active untuk kategori yang dipilih
document.querySelectorAll('.category-btn').forEach(button => {
    button.addEventListener('click', function() {
        // Reset semua tombol
        document.querySelectorAll('.category-btn').forEach(btn => {
            btn.classList.remove('bg-blue-500', 'text-white');
            btn.classList.add('bg-white');
            // Reset text colors
            btn.querySelector('.font-medium').classList.remove('text-white');
            btn.querySelector('.font-medium').classList.add('text-gray-900');
            btn.querySelector('.items-count').classList.remove('text-white', 'opacity-75');
            btn.querySelector('.items-count').classList.add('text-gray-500');
        });
        
        // Set active button colors
        this.classList.remove('bg-white');
        this.classList.add('bg-blue-500', 'text-white');
        // Update text colors
        this.querySelector('.font-medium').classList.remove('text-gray-900');
        this.querySelector('.font-medium').classList.add('text-white');
        this.querySelector('.items-count').classList.remove('text-gray-500');
        this.querySelector('.items-count').classList.add('text-white', 'opacity-75');
    });
});
</script>