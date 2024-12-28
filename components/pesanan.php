<?php 
include 'koneksiDb/koneksi.php';
?>

<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<div class="bg-white rounded-xl shadow-sm p-6">
    <!-- Order Header -->
    <div class="flex justify-between items-start mb-6">
        <div>
            <h2 class="text-xl font-semibold text-gray-900"><span id="customerName">Fajar's</span> Order</h2>
            <p class="text-sm text-gray-500">Order Number: #005</p>
        </div>
        <button onclick="editCustomerName()" class="text-gray-400 hover:text-gray-500 transition-colors">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
            </svg>
        </button>
    </div>

    <!-- Table Selection -->
    <div class="flex justify-between items-center mb-6">
        <div class="relative w-1/2">
            <select class="block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm rounded-md">
                <option>Table 05</option>
                <option>Table 06</option>
                <option>Table 07</option>
            </select>
        </div>
        <div class="relative w-1/2 ml-4">
            <select class="block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm rounded-md">
                <option>Dine In</option>
                <option>Take Away</option>
            </select>
        </div>
    </div>

    <!-- Order Items -->
    <div class="space-y-4 mb-6">
        <!-- Example item, will be replaced by JavaScript -->
        <div class="flex items-start space-x-4 py-3 border-b border-gray-100 last:border-0" style="display: none;">
            <img src="" alt="" class="w-14 h-14 rounded-lg object-cover flex-shrink-0">
            <div class="flex-1 min-w-0">
                <div class="flex justify-between items-start gap-2">
                    <div>
                        <h3 class="text-sm font-medium text-gray-900 leading-tight truncate max-w-[150px]"></h3>
                        <p class="text-xs text-gray-500 mt-0.5"></p>
                    </div>
                    <div class="flex items-center space-x-1.5">
                        <button class="w-6 h-6 rounded-full border border-gray-200 flex items-center justify-center text-gray-500 hover:border-gray-300">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd" />
                            </svg>
                        </button>
                        <span class="quantity w-4 text-center text-sm text-gray-600">1</span>
                        <button class="w-6 h-6 rounded-full border border-gray-200 flex items-center justify-center text-gray-500 hover:border-gray-300">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    </div>
                </div>
                <p class="text-xs text-gray-500 mt-1">$0.00 × <span class="quantity">1</span> = <span class="item-total">$0.00</span></p>
            </div>
        </div>
    </div>

    <!-- Order Summary -->
    <div class="border-t border-gray-200 pt-4 space-y-2">
        <div class="flex justify-between text-sm">
            <span class="text-gray-500">Subtotal</span>
            <span class="subtotal-value text-gray-900">$0.00</span>
        </div>
        <div class="flex justify-between text-sm">
            <span class="text-gray-500">Tax (10%)</span>
            <span class="tax-value text-gray-900">$0.00</span>
        </div>
        <div class="flex justify-between text-sm">
            <span class="text-gray-500">Discount</span>
            <span class="discount-value text-gray-900">-$1.00</span>
        </div>
        <div class="flex justify-between text-sm font-medium">
            <span class="text-gray-900">Total</span>
            <span class="total-value text-gray-900">$0.00</span>
        </div>
    </div>

    <!-- Order Now Button -->
    <button onclick="showOrderAlert()" class="w-full mt-6 bg-blue-500 text-white py-3 px-4 rounded-xl font-medium hover:bg-blue-600 transition-colors flex items-center justify-center space-x-2">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
            <path d="M3 1a1 1 0 000 2h1.22l.305 1.222a.997.997 0 00.01.042l1.358 5.43-.893.892C3.74 11.846 4.632 14 6.414 14H15a1 1 0 000-2H6.414l1-1H14a1 1 0 00.894-.553l3-6A1 1 0 0017 3H6.28l-.31-1.243A1 1 0 005 1H3zM16 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM6.5 18a1.5 1.5 0 100-3 1.5 1.5 0 000 3z" />
        </svg>
        <span>Order Now</span>
    </button>
</div>

<script>
function showOrderAlert() {
    Swal.fire({
        title: 'Fitur Belum Tersedia',
        text: 'Mohon maaf, fitur ini masih dalam tahap pengembangan',
        icon: 'info',
        confirmButtonText: 'OK',
        confirmButtonColor: '#3B82F6',
        showClass: {
            popup: 'animate__animated animate__fadeInDown'
        },
        hideClass: {
            popup: 'animate__animated animate__fadeOutUp'
        }
    });
}

function editCustomerName() {
    const currentName = document.getElementById('customerName').textContent.replace("'s", "");
    
    Swal.fire({
        title: 'Edit Customer Name',
        input: 'text',
        inputValue: currentName,
        inputAttributes: {
            autocapitalize: 'off'
        },
        showCancelButton: true,
        confirmButtonText: 'Save',
        cancelButtonText: 'Cancel',
        confirmButtonColor: '#3B82F6',
        showClass: {
            popup: 'animate__animated animate__fadeInDown'
        },
        hideClass: {
            popup: 'animate__animated animate__fadeOutUp'
        },
        preConfirm: (name) => {
            if (!name) {
                Swal.showValidationMessage('Please enter a name');
                return false;
            }
            return name;
        }
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById('customerName').textContent = result.value + "'s";
            Swal.fire({
                title: 'Success!',
                text: 'Customer name has been updated',
                icon: 'success',
                confirmButtonColor: '#3B82F6',
                timer: 1500,
                showConfirmButton: false
            });
        }
    });
}
</script>

<!-- Animate.css untuk animasi yang lebih smooth -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />