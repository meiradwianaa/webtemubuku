<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DETAIL BUKU</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="css/detail.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Adamina&family=Cormorant+Infant&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
</head>
<body>
  <nav class="navbar navbar-expand-lg">
		<div class="container-fluid">
			<a class="navbar-brand" href="#">
				<img class="img-fluid" src="images/temubuku logo.png">
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
							<a class="nav-link active" aria-current="page" href="home.php">Beranda</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="about.php">About</a>
						</li>
					</ul>
				</form>
			</div>
		</div>
	</nav>
  <br><br>

  <!--Backend-->
  <?php
		use BorderCloud\SPARQL\SparqlClient;
		require_once('../vendor/autoload.php');
						
		//Error Handling
        $id = false;
        $judul = false;
        $penulis = false;
        $penerbit = false;
        $kategori = false;
        $tahun_terbit = false;
        $harga = false;
        $stok = false;
        $halaman = false;
        $isbn = false;
        $urlFoto = false;
        $data=false;

        
		$id=$_GET['id'];
        
          //Error Handling
			    $fuseki_server = "http://localhost:3030"; // fuseki server address 
				$fuseki_sparql_db = "temubuku"; // fuseki Sparql database 
				$endpoint = $fuseki_server . "/" . $fuseki_sparql_db . "/query";	
				$sc = new SparqlClient();
				$sc->setEndpointRead($endpoint);
				$q = "PREFIX data:<http://example.com/>
                PREFIX rdf: <http://www.w3.org/1999/02/22-rdf-syntax-ns#> 
                SELECT ?id ?judul ?penulis ?penerbit ?kategori ?tahun_terbit ?harga ?stok ?halaman ?isbn ?urlFoto
                WHERE{
                  ?sub rdf:type data:buku.
                  ?sub data:id '$id'.
                  ?sub data:judul ?judul.
                  ?sub data:penulis ?penulis.
                  ?sub data:penerbit ?penerbit.
                  ?sub data:kategori ?kategori.
                  ?sub data:tahun_terbit ?tahun_terbit.
                  ?sub data:harga ?harga.
                  ?sub data:stok ?stok.
                  ?sub data:halaman ?halaman.
                  ?sub data:isbn ?isbn.
                  ?sub data:urlFoto ?urlFoto.
                  }
                ";
              $data = $sc->query($q, 'data');
              $row = $data['result']['rows'][0];
              $err = $sc->getErrors();
              if ($err) {
              print_r($err);
              throw new Exception(print_r($err, true));
              }
              echo"
                <div class='row'>
                        <div class='col-sm-2'></div>
                        <div class='col-sm-6'>
                        <h2>DETAIL BUKU</h2>
                        <br>
                        <div class='card'>
                            <div class='card-body'>
                                <table class='table table-responsive'>
                                    <tr>
                                        <td cellpadding='10' scope='col'>id</td>
                                        <td>: $id</td>
                                    </tr>
                                    <tr>
                                        <td cellpadding='10' scope='col'>Judul Buku</td>
                                        <td>: {$row['judul']}</td>
                                    </tr>
                                    <tr>
                                        <td cellpadding='10' scope='col'>Penulis</td>
                                        <td>: {$row['penulis']}</td>
                                    </tr>
                                    <tr>
                                        <td>Penerbit</td>
                                        <td>: {$row['penerbit']}</td>
                                    </tr>
                                    <tr>
                                        <td>Kategori :</td>
                                        <td>: {$row['kategori']}</td>
                                    </tr>
                                    <tr>
                                        <td>Tahun Terbit</td>
                                        <td>: {$row['tahun_terbit']}</td>
                                    </tr>
                                    <tr>
                                        <td>Stok</td>
                                        <td>: {$row['stok']}</td>
                                    </tr>
                                    <tr>
                                        <td>Halaman</td>
                                        <td>: {$row['halaman']}</td>
                                    </tr>
                                    <tr>
                                        <td>Harga</td>
                                        <td>: {$row['harga']}</td>
                                    </tr>
                                    <tr>
                                        <td>ISBN</td>
                                        <td>: {$row['isbn']}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        </div>
                        <div class='col-sm-4'>
                            <div class='card-foto' style='width: 18rem; max-height: 60%;'>
                                <div class='card-body'>
                                <img class='img-fluid'  src='{$row['urlFoto']}' alt='book' >
                                </div>
                            </div>
                        </div>
                    </div>
    </div>
    <br><br>
    <footer class='text-center'>
      <br>
      <p>Copyright 2021  • All Right Reserved • TemuBuku</p>
      <br>
    </footer>";?>
</body>
</html>