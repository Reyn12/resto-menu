<?php
// Query untuk mengambil data menu dari database
$query = "SELECT menu.*, kategori.nama_kategori 
          FROM menu 
          JOIN kategori ON menu.id_kategori = kategori.id_kategori
          WHERE menu.status = 'tersedia'";
$result = mysqli_query($koneksi, $query);

// Array gambar dari internet sebagai fallback
$default_images = [
    'Sandwich' => 'https://images.unsplash.com/photo-1628840042765-356cda07504e?w=500&h=400&fit=crop',
    'Pastry' => 'https://images.unsplash.com/photo-1555507036-ab1f4038808a?w=500&h=400&fit=crop',
    'Donut' => 'https://images.unsplash.com/photo-1551024601-bec78aea704b?w=500&h=400&fit=crop',
    'Cake' => 'https://images.unsplash.com/photo-1565958011703-44f9829ba187?w=500&h=400&fit=crop',
    'Bread' => 'https://images.unsplash.com/photo-1586444248902-2f64eddc13df?w=500&h=400&fit=crop',
    'Tart' => 'https://images.unsplash.com/photo-1626803775151-61d756612f97?w=500&h=400&fit=crop'
];
?>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
    <?php while($menu = mysqli_fetch_assoc($result)): 
        // Gunakan gambar dari database jika ada, jika tidak gunakan default image berdasarkan kategori
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
                        onclick="addToOrder(<?php echo $menu['id_menu']; ?>, '<?php echo htmlspecialchars(addslashes($menu['nama_menu'])); ?>', <?php echo $menu['harga']; ?>, '<?php echo htmlspecialchars(addslashes($image)); ?>')">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
                    </svg>
                </button>
            </div>
        </div>
    </div>
    <?php endwhile; ?>
</div>

<script>
function addToOrder(menuId, menuName, price, image) {
    // Cari container pesanan
    const orderItems = document.querySelector('.space-y-4');
    if (!orderItems) return;

    // Cek apakah item sudah ada di pesanan
    const existingItem = orderItems.querySelector(`[data-menu-id="${menuId}"]`);
    
    if (existingItem) {
        // Jika item sudah ada, tambah quantity
        const qtyElement = existingItem.querySelector('.quantity');
        const currentQty = parseInt(qtyElement.textContent);
        qtyElement.textContent = currentQty + 1;
        
        // Update total harga item
        updateItemTotal(existingItem, price, currentQty + 1);
    } else {
        // Jika item belum ada, buat element baru
        const orderItem = document.createElement('div');
        orderItem.className = 'flex items-start space-x-4 py-3 border-b border-gray-100 last:border-0';
        orderItem.setAttribute('data-menu-id', menuId);
        
        orderItem.innerHTML = `
            <img src="${image}" alt="${menuName}" class="w-14 h-14 rounded-lg object-cover flex-shrink-0">
            <div class="flex-1 min-w-0">
                <div class="flex justify-between items-start gap-2">
                    <div>
                        <h3 class="text-sm font-medium text-gray-900 leading-tight truncate max-w-[150px]">${menuName}</h3>
                        <p class="text-xs text-gray-500 mt-0.5">$${price.toFixed(2)}</p>
                    </div>
                    <div class="flex items-center space-x-1.5">
                        <button onclick="updateQuantity(${menuId}, -1)" class="w-6 h-6 rounded-full border border-gray-200 flex items-center justify-center text-gray-500 hover:border-gray-300">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd" />
                            </svg>
                        </button>
                        <span class="quantity w-4 text-center text-sm text-gray-600">1</span>
                        <button onclick="updateQuantity(${menuId}, 1)" class="w-6 h-6 rounded-full border border-gray-200 flex items-center justify-center text-gray-500 hover:border-gray-300">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    </div>
                </div>
                <p class="text-xs text-gray-500 mt-1">$${price.toFixed(2)} × <span class="quantity">1</span> = <span class="item-total">$${price.toFixed(2)}</span></p>
            </div>
        `;
        
        orderItems.appendChild(orderItem);
    }
    
    updateTotal();
}

function updateQuantity(menuId, change) {
    const item = document.querySelector(`[data-menu-id="${menuId}"]`);
    const qtyElements = item.querySelectorAll('.quantity');
    const basePrice = parseFloat(item.querySelector('p').textContent.split('$')[1].split(' ')[0]);
    
    let qty = parseInt(qtyElements[0].textContent) + change;
    
    if (qty <= 0) {
        item.remove();
    } else {
        // Update all quantity elements
        qtyElements.forEach(el => el.textContent = qty);
        updateItemTotal(item, basePrice, qty);
    }
    
    updateTotal();
}

function updateItemTotal(item, price, quantity) {
    const totalElement = item.querySelector('.item-total');
    totalElement.textContent = `$${(price * quantity).toFixed(2)}`;
}

function updateTotal() {
    const totals = Array.from(document.querySelectorAll('.item-total')).map(el => {
        const price = el.textContent.replace('$', '');
        return parseFloat(price) || 0;
    });
    
    const subtotal = totals.reduce((a, b) => a + b, 0);
    const tax = subtotal * 0.1; // 10% tax
    const discount = subtotal > 0 ? -1.00 : 0; // $1 discount only if there are items
    const total = Math.max(0, subtotal + tax + discount); // Ensure total is not negative
    
    const summaryContainer = document.querySelector('.border-t');
    if (summaryContainer) {
        summaryContainer.querySelector('.subtotal-value').textContent = `$${subtotal.toFixed(2)}`;
        summaryContainer.querySelector('.tax-value').textContent = `$${tax.toFixed(2)}`;
        summaryContainer.querySelector('.discount-value').textContent = `-$${Math.abs(discount).toFixed(2)}`;
        summaryContainer.querySelector('.total-value').textContent = `$${total.toFixed(2)}`;
    }
}
</script>