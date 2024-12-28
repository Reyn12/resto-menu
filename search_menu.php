<?php
include 'koneksiDb/koneksi.php';

$search = isset($_GET['q']) ? $_GET['q'] : '';
$search = mysqli_real_escape_string($koneksi, $search);

$query = "SELECT menu.*, kategori.nama_kategori 
          FROM menu 
          JOIN kategori ON menu.id_kategori = kategori.id_kategori
          WHERE menu.status = 'tersedia' 
          AND (menu.nama_menu LIKE '%$search%' 
               OR kategori.nama_kategori LIKE '%$search%'
               OR menu.deskripsi LIKE '%$search%')";

$result = mysqli_query($koneksi, $query);

// Array gambar default sama seperti di menu.php
$default_images = [
    'Sandwich' => 'https://images.unsplash.com/photo-1594212699903-ec8a3eca50f5?w=500&h=400&fit=crop',
    'Pastry' => 'https://images.unsplash.com/photo-1555507036-ab1f4038808a?w=500&h=400&fit=crop',
    'Donut' => 'https://images.unsplash.com/photo-1551024601-bec78aea704b?w=500&h=400&fit=crop',
    'Cake' => 'https://images.unsplash.com/photo-1565958011703-44f9829ba187?w=500&h=400&fit=crop',
    'Bread' => 'https://images.unsplash.com/photo-1549931319-a545dcf3bc73?w=500&h=400&fit=crop',
    'Tart' => 'https://images.unsplash.com/photo-1626803775151-61d756612f97?w=500&h=400&fit=crop'
];

while($menu = mysqli_fetch_assoc($result)): 
    $image = $menu['gambar'] ?? $default_images[$menu['nama_kategori']] ?? 'https://images.unsplash.com/photo-1495147466023-ac5c588e2e94?w=500&h=400&fit=crop';
?>
    <div class="bg-white rounded-xl overflow-hidden shadow-sm hover:shadow-md transition-shadow">
        <div class="relative h-48">
            <img src="<?php echo $image; ?>" 
                 alt="<?php echo htmlspecialchars($menu['nama_menu']); ?>" 
                 class="w-full h-full object-cover">
        </div>
        <div class="p-4">
            <h3 class="font-medium text-gray-900"><?php echo htmlspecialchars($menu['nama_menu']); ?></h3>
            <p class="text-sm text-gray-500 mt-1"><?php echo htmlspecialchars($menu['nama_kategori']); ?></p>
            <div class="flex justify-between items-center mt-3">
                <span class="font-bold text-gray-900">$<?php echo number_format($menu['harga'], 2); ?></span>
                <button class="w-8 h-8 rounded-full bg-blue-500 text-white flex items-center justify-center hover:bg-blue-600 transition-colors"
                        onclick="addToOrder(<?php echo $menu['id_menu']; ?>, '<?php echo htmlspecialchars($menu['nama_menu']); ?>', <?php echo $menu['harga']; ?>)">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
                    </svg>
                </button>
            </div>
        </div>
    </div>
<?php endwhile; ?>
