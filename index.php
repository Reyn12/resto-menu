<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resto Menu</title>
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Custom Config Tailwind -->
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#4070f4',
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-gray-50 min-h-screen flex flex-col">
    <?php 
    include 'koneksiDb/koneksi.php';
    ?>

    <div class="flex-1 flex flex-col">
        <!-- Header -->
        <div class="flex-shrink-0">
            <?php include 'components/header.php'; ?>
        </div>

        <!-- Main Content -->
        <div class="flex-1 flex">
            <!-- Left Panel: Menu -->
            <div class="flex-1 p-6 flex flex-col">
                <div class="flex-shrink-0 mb-6">
                    <?php include 'components/search.php'; ?>
                </div>
                <div class="flex-shrink-0 mb-6">
                    <?php include 'components/kategori.php'; ?>
                </div>
                <div class="flex-1 overflow-auto">
                    <?php include 'components/menu.php'; ?>
                </div>
            </div>

            <!-- Right Panel: Order -->
            <div class="w-[400px] p-6 flex flex-col">
                <?php include 'components/pesanan.php'; ?>
            </div>
        </div>
    </div>

    <!-- Alpine.js untuk interaktivitas -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</body>
</html>