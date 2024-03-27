<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Form Belanja</title>
<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f4;
    }

    .container {
        max-width: 800px;
        margin: 50px auto;
        background-color: #fff;
        border-radius: 8px;
        padding: 70px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    h1 {
        text-align: center;
        color: #333;
    }

    .form-group {
        margin-bottom: 20px;
    }

    label {
        display: block;
        font-weight: bold;
        margin-bottom: 5px;
    }

    input[type="text"],
    input[type="number"] {
        width: 100%;
        padding: 8px;
        border: 1px solid #ccc;
        border-radius: 5px;
        box-sizing: border-box;
    }

    input[type="submit"] {
        background-color: #4CAF50;
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    input[type="submit"]:hover {
        background-color: #45a049;
    }

    .result {
        margin-top: 30px;
        border-top: 1px solid #ccc;
        padding-top: 20px;
    }

    .result h2 {
        margin-top: 0;
    }
</style>
</head>
<body>
<div class="container">
    <h1>Form Belanja</h1>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <div class="form-group">
            <label for="nama_pelanggan">Nama Pelanggan:</label>
            <input type="text" id="nama_pelanggan" name="nama_pelanggan" required>
        </div>
        <div class="form-group">
            <label for="produk">Produk:</label>
            <select id="produk" name="produk" required>
                <option value="TV">TV</option>
                <option value="Kulkas">Kulkas</option>
                <option value="Meja">Meja</option>
            </select>
        </div>
        <div class="form-group">
            <label for="jumlah_beli">Jumlah Beli:</label>
            <input type="number" id="jumlah_beli" name="jumlah_beli" required>
        </div>
        <div class="form-group">
            <label for="harga_satuan">Harga Satuan:</label>
            <input type="number" id="harga_satuan" name="harga_satuan" required>
        </div>
        <div class="form-group">
            <label for="diskon">Diskon (%):</label>
            <input type="number" id="diskon" name="diskon">
        </div>
        <div class="form-group">
            <label for="ppn">PPN (%):</label>
            <input type="number" id="ppn" name="ppn">
        </div>
        <div class="form-group">
            <input type="submit" value="Hitung Total">
        </div>
    </form>
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nama_pelanggan = $_POST["nama_pelanggan"];
        $produk = $_POST["produk"];
        $jumlah_beli = $_POST["jumlah_beli"];
        
        switch ($produk) {
            case 'TV':
                $harga_satuan = 1500000;
                break;
            case 'Kulkas':
                $harga_satuan = 5000000;
                break;
            case 'Meja':
                $harga_satuan = 500000;
                break;
            default:
                $harga_satuan = 0; 
        }

        $diskon_tetap = 0.2;

        $ppn_tetap = 0.1;

        $total_belanja = $jumlah_beli * $harga_satuan;

        $total_diskon = ($diskon_tetap + ($_POST["diskon"] / 100)) * $total_belanja;

        $total_belanja_setelah_diskon = $total_belanja - $total_diskon;
        $total_ppn = $ppn_tetap * $total_belanja_setelah_diskon;

        $harga_bersih = $total_belanja - $total_diskon + $total_ppn;

        echo "<div class='result'>";
        echo "<h2>Hasil Perhitungan</h2>";
        echo "Nama Pelanggan: " . $nama_pelanggan . "<br>";
        echo "Produk: " . $produk . "<br>";
        echo "Jumlah Beli: " . $jumlah_beli . "<br>";
        echo "Harga Satuan: " . $harga_satuan . "<br>";
        echo "Total Belanja: " . $total_belanja . "<br>";
        echo "Diskon: " . $total_diskon . "<br>";
        echo "PPN: " . $total_ppn . "<br>";
        echo "Harga Bersih: " . $harga_bersih . "<br>";
        echo "</div>";
    }
    ?>
</div>
</body>
</html>
