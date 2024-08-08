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
            font-family: arial, sans-serif;
        }

        .container {
            margin: 50px;
        }

        .gejala-container {
            display: flex;
            flex-wrap: wrap;
        }

        .gejala-group {
            flex: 1;
            min-width: 50%;
            padding: 10px;
            box-sizing: border-box;
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

        img {
            width: 80px;
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

       /* Responsif untuk smartphone */
@media (max-width: 480px) {
    .container .main-row-1 {
        margin: 10px;
        padding: 10px; /* Ensure padding inside container for better spacing */
    }

    table {
        font-size: 12px;
        width: 100%; /* Ensure table takes full width */
        border-collapse: collapse; /* Ensure table borders are collapsed */
        overflow-x: auto; /* Enable horizontal scrolling if content overflows */
    }

    td, th {
        padding: 6px; /* Adjust padding for better readability on smaller screens */
        word-wrap: break-word; /* Allow text to wrap within cells */
    }

    .button {
        font-size: 12px;
        padding: 6px 12px; /* Adjust button padding for better fit */
    }

    h2 {
        font-size: 18px; /* Adjust header size for smaller screens */
        text-align: center; /* Center align the heading */
    }

    .nav ul {
        flex-direction: column;
        padding: 0;
        margin: 0;
        width: 100%; /* Ensure nav menu takes full width */
    }

    .nav ul li {
        margin-bottom: 10px; /* Add margin between nav items */
    }

    .nav ul li a {
        padding: 10px;
        font-size: 16px; /* Adjust font size for nav links */
    }

    /* Ensure that images scale appropriately */
    img {
        max-width: 100%; /* Ensure images do not overflow their container */
        height: auto; /* Maintain aspect ratio */
    }
}

    </style>
</head>

<body>
    <h2 style="text-align: center;">
        Hasil Diagnosa Penyakit Jagung
    </h2>
    <hr>
    <div class="container">
        <div class="row" style="border-radius: 5px; border: 1px solid #3C5B6F; padding-bottom: 25px;">
            <div class="header-row">
                <h3 style="color: white; background-color:#3C5B6F; margin-top:0px; padding:15px; padding-left: 10px; border-radius: 5px; border: 1px solid #3C5B6F;">Hasil Diagnosa</h3>
            </div>
            <div class="row-1" style="margin-left: 20px; margin-right: 20px; border-radius: 5px; border: 1px solid #3C5B6F; margin-bottom:50px;">
                <div class="main-row-1" style="margin-top: 20px; margin-bottom: 20px; margin-left: 10px; margin-right: 20px;">
                    <table>
                        <tr>
                            <th>No</th>
                            <th>Jenis Penyakit</th>
                            <th>Gambar Penyakit</th>
                            <th>Pengendalian</th>
                        </tr>
                        <?php
                        if (isset($_POST['submit'])) {
                            $gejala = $_POST['gejala'];
                            $jumlah_dipilih = count($gejala);
                            $penyakitList = [];
                            for ($x = 0; $x < $jumlah_dipilih; $x++) {
                                $tampil = "SELECT DISTINCT p.namapenyakit, p.penyebab, p.pengendalian, p.gambar, p.pencegahan
                                            FROM basispengetahuan b 
                                            JOIN penyakit p ON b.namapenyakit = p.namapenyakit 
                                            WHERE b.gejala='$gejala[$x]'";
                                $result = mysqli_query($konek_db, $tampil);
                                if ($result) {
                                    while ($hasil = mysqli_fetch_array($result)) {
                                        $penyakitList[] = $hasil;
                                    }
                                } else {
                                    echo "Error: " . mysqli_error($konek_db);
                                }
                            }
                            $penyakitList = array_unique($penyakitList, SORT_REGULAR);
                            foreach ($penyakitList as $index => $penyakit) {
                                // Membagi data pengendalian berdasarkan nomor urut
                                $pengendalianArray = explode("\n", $penyakit['pengendalian']);
                                $pengendalianFormatted = "<ol>";
                                foreach ($pengendalianArray as $pengendalian) {
                                    $pengendalianFormatted .= "<li>" . trim($pengendalian) . "</li>";
                                }
                                $pengendalianFormatted .= "</ol>";
                                echo "
                                    <tr>
                                        <td>" . ($index + 1) . "</td>
                                        <td>" . $penyakit['namapenyakit'] . "</td>
                                        <td><img src='./img/" . strtolower(str_replace(' ', '', $penyakit['namapenyakit'])) . ".jpg' alt='" . $penyakit['namapenyakit'] . "' class='penyakit-img'/></td>
                                        <td>" . $pengendalianFormatted . "</td>
                                    </tr>
                                ";
                            }
                        }
                        ?>
                    </table>
                </div>
            </div>
        </div>
        <div class="button" style="margin: 2%;">
            <a href="daftarpenyakit.php" style="text-decoration: none; color: white;">Daftar Penyakit</a>
        </div>
    </div>
</body>
</html>
