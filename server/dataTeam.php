<?php
$photoFolder = './data/photos/';
$dataFolder = './data/team/';

if (!file_exists($photoFolder)) {
    mkdir($photoFolder, 0777, true);
}

// Cek apakah ada data tim yang diterima
if (!isset($_POST['teamName'])) {
    echo json_encode(['success' => false, 'message' => 'No team name provided.']);
    exit;
}

// Ambil data dari POST
$teamName = preg_replace('/[^a-zA-Z0-9-_]/', '_', $_POST['teamName']); // Buat nama tim aman untuk dijadikan nama file
$captain = $_POST['captain'];
$members = [];
$roles = [];
$gameInfo = [];

// Mendapatkan anggota tim dan perannya
for ($i = 1; isset($_POST["member$i"]); $i++) {
    $members[] = preg_replace('/[^a-zA-Z0-9-_]/', '_', $_POST["member$i"]); // Buat nama anggota aman untuk dijadikan nama file
    $roles[] = $_POST["role$i"];
}

// Mendapatkan game info
for ($i = 1; isset($_POST["gameInfo$i"]); $i++) {
    $gameInfo[] = $_POST["gameInfo$i"];
}

// Simpan dokumen pembayaran tanpa mengubah nama file (jika ada)
$teamLogoInfo = [];
if (isset($_FILES['teamLogo'])) {
    $logoFileName = $photoFolder . basename($_FILES['teamLogo']['name']); // Gunakan nama file asli
    if (move_uploaded_file($_FILES['teamLogo']['tmp_name'], $logoFileName)) {
        $teamLogoInfo['teamLogo'] = $logoFileName; // Simpan path file di teamLogoInfo
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to upload logo document.']);
        exit;
    }
}

// Membuat objek data tim untuk disimpan sebagai JSON
$teamData = [
    'teamName' => $teamName,
    'captain' => $captain,
    'members' => $members,
    'roles' => $roles,
    'gameInfo' => $gameInfo,
    'teamLogoInfo' => $teamLogoInfo
];

// Simpan data tim ke file JSON
$filename = $dataFolder . $teamName . '.json';
if (file_put_contents($filename, json_encode($teamData, JSON_PRETTY_PRINT))) {
    echo json_encode(['success' => true, 'message' => 'Data and files saved successfully.']);
} else {
    echo json_encode(['success' => false, 'message' => 'Failed to save team data as JSON.']);
}
?>