<?php
include('koneksi.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Diagnosa Penyakit</title>
    <style>
        * {
            font-family: 'Arial', sans-serif;
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f9;
            color: #333;
        }

        .container {
            max-width: 1300px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .gejala-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 12px 15px;
            border: 1px solid #ddd;
            text-align: left;
        }

        tr:nth-child(even) {
            background-color: #f4f4f9;
        }

        .button {
            display: inline-block;
            padding: 12px 24px;
            font-size: 16px;
            color: #fff;
            background-color: #3C5B6F;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .button:hover {
            background-color: #2e4657;
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

        .gejala-group .tongkol,
        .gejala-group .Daun,
        .gejala-group .batang,
        .gejala-group .biji {
            padding: 20px;
        }

        .container-2 {
            background-color: #3C5B6F;
            color: #fff;
            display: flex;
            justify-content: space-between;
            align-items: center;
            height: 650px;
        }

        .container-2 .text-1 {
            max-width: 50%;
            padding: 40px;
            font-size: 20px;
        }

        .container-2 .text-1 .judul,
        .container-2 .text-1 .tema,
        .container-2 .text-1 .penjelasan,
        .container-2 .text-1 .mulaidiagnosa {
            text-align: center;
            padding-bottom: 20px;
        }

        .container-2 .text-1 .mulaidiagnosa a {
            text-decoration: none;
            color: #3C5B6F;
            display: inline-block;
            padding: 10px 20px;
            background-color: white;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .container-2 .text-1 .mulaidiagnosa a:hover {
            background-color: #2e4657;
            color: white;
        }

        .container-2 .images {
            max-width: 50%;
            display: flex;
            justify-content: center; 
            align-items: center;
            padding: 60px;
        }

        .container-2 .images img {
            max-width: 100%;
            height: auto;
            margin: 0 10px;
        }

        @media (max-width: 1024px) {
            .container-2 {
                flex-direction: column; 
                padding: 40px;
                height: auto;
            }

            .container-2 .text-1, 
            .container-2 .images {
                max-width: 100%;
                padding: 20px;
            }

            .container {
                max-width: 90%;
                margin: 50px auto;
                padding: 20px;
            }

            .button {
                font-size: 14px;
                padding: 10px 20px;
            }
        }

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

        @media (max-width: 480px) {
            .container-2 .text-1, 
            .container-2 .images {
                padding: 10px;
            }
        }
    </style>
</head>

<body>
<div class="nav">
    <div class="menu-toggle" onclick="toggleMenu()">&#9776;</div>
    <ul id="menu">
        <li><a href="#home">Home</a></li>
        <li><a href="#diagnosa">Diagnosa</a></li>
        <!-- <li><a href="#about">Riwayat</a></li> -->
        <li><a href="daftarpenyakit.php">Daftar Penyakit</a></li>
    </ul>
</div>
<div id="home">
    <div class="container-2">
        <div class="text-1">
            <h2 class="judul">SISTEM PAKAR</h2>
            <h3 class="tema">Diagnosa Penyakit Jagung</h3>
            <h5 class="penjelasan">Sistem ini akan membantu anda mengetahui jenis penyakit pada tanaman jagung beserta cara pengendalian dan penanggulangannya sesuai dengan gejala yang ada</h5>
            <h5 class="mulaidiagnosa"><a href="#diagnosa">Mulai Mendiagnosa</a></h5>
        </div>
        <div class="images">
            <img src="./img/tanamanjagung.jpg" alt="Gambar 1">
        </div>
    </div>
</div>
<div id="diagnosa">
    <h2 style="text-align: center; margin: 15px 0;">Diagnosa Penyakit Jagung</h2>
    <div class="container">
        <form method="post" action="hasil_diagnosa.php">
            <div class="gejala-container">
                <div class="gejala-group">
                    <div class="Daun">
                        <?php
                        echo "<label><strong>DAUN</strong></label><br>";
                        $tampil = "select * from gejala where daerah='Daun'";
                        $query = mysqli_query($konek_db, $tampil);
                        if ($query) {
                            while ($hasil = mysqli_fetch_array($query)) {
                                echo "<input type='checkbox' value='" . $hasil['gejala'] . "' name='gejala[]' /> " . $hasil['gejala'] . "<br>";
                            }
                        } else {
                            echo "Error: " . mysqli_error($konek_db);
                        }
                        ?>
                    </div>
                    <div class="tongkol">
                        <?php
                        echo "<label><strong>TONGKOL</strong></label><br>";
                        $tampil = "select * from gejala where daerah='Tongkol'";
                        $query = mysqli_query($konek_db, $tampil);
                        if ($query) {
                            while ($hasil = mysqli_fetch_array($query)) {
                                echo "<input type='checkbox' value='" . $hasil['gejala'] . "' name='gejala[]' /> " . $hasil['gejala'] . "<br>";
                            }
                        } else {
                            echo "Error: " . mysqli_error($konek_db);
                        }
                        ?>
                    </div>
                </div>
                <div class="gejala-group">
                    <div class="batang">
                        <?php
                        echo "<label><strong>BATANG</strong></label><br>";
                        $tampil = "select * from gejala where daerah='Batang'";
                        $query = mysqli_query($konek_db, $tampil);
                        if ($query) {
                            while ($hasil = mysqli_fetch_array($query)) {
                                echo "<input type='checkbox' value='" . $hasil['gejala'] . "' name='gejala[]' /> " . $hasil['gejala'] . "<br>";
                            }
                        } else {
                            echo "Error: " . mysqli_error($konek_db);
                        }
                        ?>
                    </div>
                    <div class="biji">
                        <?php
                        echo "<label><strong>BIJI</strong></label><br>";
                        $tampil = "select * from gejala where daerah='Biji'";
                        $query = mysqli_query($konek_db, $tampil);
                        if ($query) {
                            while ($hasil = mysqli_fetch_array($query)) {
                                echo "<input type='checkbox' value='" . $hasil['gejala'] . "' name='gejala[]' /> " . $hasil['gejala'] . "<br>";
                            }
                        } else {
                            echo "Error: " . mysqli_error($konek_db);
                        }
                        ?>
                    </div>
                </div>
            </div>
            <button type="submit" name="submit" class="button" style="margin: 20px 0;" onclick="return checkDiagnosa()">Diagnosa</button>
        </form>
    </div>
</div>

<script language="JavaScript" type="text/javascript">
function checkDiagnosa() {
    return confirm('Apakah sudah benar gejalanya?');
}

function toggleMenu() {
    var menu = document.getElementById('menu');
    if (menu.classList.contains('showing')) {
        menu.classList.remove('showing');
    } else {
        menu.classList.add('showing');
    }
}
</script>
</body>
</html>
