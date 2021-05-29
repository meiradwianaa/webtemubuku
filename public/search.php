<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HOME TEMU BUKU</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="css/home.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Adamina&family=Cormorant+Infant&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
</head>
<body>
  <nav class="navbar navbar-expand-lg">
  <div class="container-fluid">
   <a class="navbar-brand" href="#">
    <img src="images/temubuku logo.png">
   </a>
   <button class="navbar-dark navbar-toggler" type="button" data-bs-toggle="collapse"
    data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false"
    aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
   </button>
   <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
     <li class="nav-item">
      <a class="nav-link active" aria-current="page" href="#"></a>
     </li>
    </ul>

    <form class="d-flex">
     <ul class="navbar-nav me-auto mb-2 mb-lg-0">
      <li class="nav-item">
       <a class="nav-link active" aria-current="page" href="index.php">Beranda</a>
      </li>
      <li class="nav-item">
       <a class="nav-link" href="about.php">About</a>
      </li>
     </ul>
    </form>
   </div>
  </div>
 </nav>
  <div class="search">
  <form action="search.php" method="POST">
      <div class="row searchinput">
        <div class="col-md-4"></div>
        <div class="col-md-4">
          <div class="boxsearch">
              <div class="container-4">
                  <input name="kunci" type="search" id="search" placeholder="Search...">
                  <button class="btn btn-success" type="submit">Search</button>
              </div>
          </div>
        </div>
        <div class="col-md-4"></div>
      </div>
      </form>

    <!--Backend-->
    <?php
     use BorderCloud\SPARQL\SparqlClient;
     require_once('../vendor/autoload.php');
      
      //Error Handling
      $kunci = false;
      $judul = false;
      $id = false;
          

          if(isset($_POST['kunci']))
       $kunci=$_POST['kunci'];
              if(!$kunci){
                echo"<h1>Data Kosong!</h1>";
              }
        

          //Error Handling
     else{
       $fuseki_server = "http://localhost:3030"; // fuseki server address 
       $fuseki_sparql_db = "temubuku"; // fuseki Sparql database 
       $endpoint = $fuseki_server . "/" . $fuseki_sparql_db . "/query"; 
       $sc = new SparqlClient();
       $sc->setEndpointRead($endpoint);
       $q = "PREFIX data:<http://example.com/>
              PREFIX rdf: <http://www.w3.org/1999/02/22-rdf-syntax-ns#> 
              SELECT ?id ?judul ?penulis ?penerbit ?kategori
              WHERE{
                  ?sub rdf:type data:buku.
                  ?sub data:id ?id.
                  ?sub data:judul ?judul.
                  ?sub data:kategori ?kategori.
                  ?sub data:penulis ?penulis.
                  ?sub data:penerbit ?penerbit.
                  FILTER (regex(?judul, '$kunci', 'i') || regex(?kategori, '$kunci', 'i') || regex(?penulis, '$kunci', 'i') || regex(?penerbit, '$kunci', 'i'))
                }
                ";
              $rows = $sc->query($q, 'rows');
              $err = $sc->getErrors();
              if ($err) {
                print_r($err);
                throw new Exception(print_r($err, true));
              }
              $jumlah = count($rows["result"]["rows"]);
              echo"
              <div class='row'>
                <div class='col-sm-3'></div>
                <div class='col-sm-6'>
                    <p>Pencarian dengan Kata Kunci <b>$kunci</b> Ditemukan $jumlah Hasil</p>
                    <div id='tabel-buku' class='table-responsive'>
                    <table class='table table-bordered'>
                        <thead class='thead-light'>
                          <tr>
                            <th cellpadding='30' scope='col'>No</th>
                            <th cellpadding='30' scope='col'>Judul</th>
                            <th cellpadding='30' scope='col'>Pengarang</th>
                            <th cellpadding='30' scope='col'>Penerbit</th>
                            <th cellpadding='30' scope='col'>Kategori</th>
                            <th cellpadding='30' scope='col'>Detail</th>
                          </tr>";
                          foreach ($rows["result"]["rows"] as $row) {
                            echo"<tr>";
                            foreach ($rows["result"]["variables"] as $variable) {
                              echo "<td cellpadding='30'>$row[$variable]</td>";
                            }
                            $id = $row['id'];
                            echo "<td cellpadding='30'><a href='detail.php?id=$id' class='btn btn-primary'>Detail</td>";
                            echo "</tr>";
                          };
                          echo"
                        </thead>
                    </table>
                    </div>
                </div>
                <div class='col-sm-3'></div>
              </div>
              </div>";
            };
          ?>
<footer class="footer text-center">
      <p>Copyright 2021  • All Right Reserved • TemuBuku</p>
    </footer>
</body>
</html>