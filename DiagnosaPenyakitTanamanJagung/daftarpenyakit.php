<?php
include('koneksi.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Daftar Penyakit</title>
     <style>
         * {
             font-family: 'Arial', sans-serif;
             box-sizing: border-box;
             margin: 0;
             padding: 0;
         }
         .container {
             margin: 50px;
         }
         table {
             font-family: arial, sans-serif;
             border-collapse: collapse;
             width: 100%;
             font-size: 14px;
         }
         td, th {
             border: 1px solid #dddddd;
             text-align: left;
             padding: 8px;
         }
         header {
             display: inline;
         }
         tr:nth-child(even) {
             background-color: #dce1e6;
         }
         .button {
             display: inline-block;
             padding: 10px 20px;
             font-size: 16px;
             text-align: center;
             text-decoration: none;
             border: none;
             border-radius: 5px;
             cursor: pointer;
             color: #fff;
             background-color: #3C5B6F;
             transition: background-color 0.3s ease;
         }
         .button:hover {
             background-color: #3C5B6F;
         }
         .detail img {
             width: 20px;
             display: block;
             margin-left: auto;
             margin-right: auto;
         }
         /* Responsif untuk tablet */
         @media (max-width: 768px) {
             .container {
                 margin: 20px;
             }
             .gejala-group {
                 min-width: 100%;
                 padding: 5px;
             }
             .button {
                 font-size: 14px;
                 padding: 8px 16px;
             }
         }
         .nav {
             background-color: #3C5B6F;
             color: #fff;
             padding: 20px;
             display: flex;
             justify-content: space-between;
             align-items: center;
             position: sticky;
             top: 0;
             z-index: 1000;
             box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
         }
         .nav ul {
             display: flex;
             gap: 2rem;
             list-style: none;
         }
         .nav ul li a {
             text-decoration: none;
             font-size: 18px;
             color: #fff;
             padding: 10px;
             transition: color 0.3s ease, background-color 0.3s ease;
         }
         .nav ul li a:hover {
             background-color: #2e4657;
             border-radius: 3px;
         }
         .menu-toggle {
             display: none;
             cursor: pointer;
             font-size: 24px;
             color: #fff;
         }
         /* Responsif */
         @media (max-width: 768px) {
             .nav ul {
                 flex-direction: column;
                 display: none;
                 width: 100%;
                 background-color: #3C5B6F;
             }
             .nav ul.showing {
                 display: flex;
             }
             .menu-toggle {
                 display: block;
             }
         }
         @media (max-width: 768px) {
             .container {
                 max-width: 90%;
                 margin: 50px auto;
                 padding: 20px;
             }
         }
         @media (max-width: 480px) {
             .container {
                 max-width: 90%;
                 margin: 50px auto;
                 padding: 20px;
             }
         }
         /* Responsif untuk smartphone */
         @media (max-width: 480px) {
             .container {
                 margin: 10px;
             }
             .gejala-group {
                 min-width: 100%;
                 padding: 5px;
             }
             table {
                 font-size: 12px;
             }
             .button {
                 font-size: 12px;
                 padding: 6px 12px;
             }
             h2 {
                 font-size: 18px;
             }
         }
     </style>
</head>
<body>
<div class="nav">
    <div class="menu-toggle" onclick="toggleMenu()">&#9776;</div>
    <ul id="menu">
        <li><a href="diagnosa.php">Home</a></li>
        <li><a href="diagnosa.php#diagnosa">Diagnosa</a></li>
        <li><a href="daftarpenyakit.php">Daftar Penyakit</a></li>
    </ul>
</div>
<div class="container">
    <div class="row" style="border-radius: 5px; border: 1px solid #3C5B6F; padding-bottom: 25px;">
        <div class="header-row">
            <h3 style="color: white; background-color:#3C5B6F; margin-top:0px; padding:15px; text-align:center; border-radius: 5px; border: 1px solid #3C5B6F;">Daftar Penyakit Jagung</h3>
        </div>
        <div class="main-row-1" style="margin-top: 20px; margin-bottom: 20px; margin-left: 10px; margin-right: 20px;">
            <table>
                <tr>
                    <th>Gambar</th>
                    <th>Nama Penyakit</th>
                    <th>Penyebab</th>
                    <th>Bagian Yang Diserang</th>
                    <th>Pengendalian</th>
                    <th>Pencegahan</th>
                </tr>
                <?php
                $query = "SELECT * FROM penyakit";
                $result = mysqli_query($konek_db, $query);
                if ($result) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td><img src='./img/" . strtolower(str_replace(' ', '', $row['namapenyakit'])) . ".jpg' alt='" . $row['namapenyakit'] . "' width='100' height='70'></td>";
                        echo "<td>" . $row['namapenyakit'] . "</td>";
                        echo "<td>" . $row['penyebab'] . "</td>";
                        echo "<td>" . $row['bagian_yg_diserang'] . "</td>";
                        echo "<td>" . $row['pengendalian'] . "</td>";
                        echo "<td>" . $row['pencegahan'] . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "Error: " . mysqli_error($konek_db);
                }
                ?>
            </table>
        </div>
    </div>
</div>
<script>
    function toggleMenu() {
        var menu = document.getElementById('menu');
        menu.classList.toggle('showing');
    }
</script>
</body>
</html>
