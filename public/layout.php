<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?php echo isset($title) ? $title : 'Grit & Grind'; ?></title>
    <?php
    $currentFile = basename($filePath);

    if ($currentFile === 'Login.php' || $currentFile === 'Register.php' || $currentFile === 'Premium.php') {
        echo '<link rel="stylesheet" href="/UTS/public/styles/globalAuth.css">';
    } else {
        echo '<link rel="stylesheet" href="/UTS/public/styles/global.css">';
    }
    ?>
    <link rel="stylesheet" href="/UTS/public/styles/font.css">
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.css" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/UTS/public/styles/Navbar.css">
    <link rel="stylesheet" href="/UTS/public/styles/Home.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,600;1,600&display=swap" rel="stylesheet">
</head>

<body>
    <?php
    // Menampilkan Navbar jika bukan halaman Login, Daftar, atau Admin
    if ($currentFile !== 'Login.php' && $currentFile !== 'Register.php' && $currentFile !== 'Premium.php') {
        include('./client/components/Navbar.php');
    }
    ?>

    <div id="content">
        <?php
        // Memasukkan file konten yang sesuai jika file tersebut ada
        if (file_exists($filePath)) {
            include($filePath);
        }
        ?>
    </div>

    <?php
    // Menampilkan Footer jika bukan halaman Login, Register, atau Admin
    if ($currentFile !== 'Login.php' && $currentFile !== 'Register.php' && $currentFile !== 'Premium.php') {
        include('./client/components/Footer.php');
    }
    ?>

    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.1/dist/flowbite.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="/UTS/public/js/input.js"></script>
    <script src="/UTS/public/js/stepper.js"></script>
</body>

</html>