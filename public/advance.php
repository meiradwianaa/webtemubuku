<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TEMU BUKU - ADVANCE SEARCH</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/advance.css">
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Adamina&family=Cormorant+Infant&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
</head>
<body>
  <nav class="navbar navbar-expand-lg">
		<div class="container-fluid">
			<a class="navbar-brand" href="home.php">
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
							<a class="nav-link active" aria-current="page" href="advance.php">AdvanceSearch</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="about.php">About</a>
						</li>
					</ul>
				</form>
			</div>
		</div>
	</nav>
    <br>
	<div class="content">
	<div class="row about">
		<div class="col-md-1"></div>
		<div class="col-md-7">
			<h2>Kategori</h2> 
			<div class="card">
				<div class="card-body">
					<form action="advance.php" method="POST">
						<div class="form-group row">
						  <p>Gunakan Filter yang telah disediakan</p>
						</div>
						<div class="form-group row">
						  <label for="inputJudul" class="col-sm-2 col-form-label">Judul</label>
						  <div class="col-sm-10">
							<input type="search" name="judul" class="form-control" id="judul" placeholder="">
						  </div>
						</div>
						<br>
						<div class="form-group row">
							<label for="inputKategori" class="col-sm-2 col-form-label">Kategori</label>
							<div class="col-sm-10">
							  <input type="search" name="kategori" class="form-control" id="kategori" placeholder="">
							</div>
						  </div>
						<br>
						  <div class="form-group row">
							<label for="inputCari" class="col-sm-2 col-form-label">Penulis</label>
							<div class="col-sm-10">
							  <input type="search" name="penulis" class="form-control" id="penulis" placeholder="">
							</div>
						  </div>
                          <br>
                          <div class="form-group row">
							<label for="inputCari" class="col-sm-2 col-form-label">Penerbit</label>
							<div class="col-sm-10">
							  <input type="search" name="penerbit" class="form-control" id="penerbit" placeholder="">
							</div>
						  </div>
                          <br>
                          <div class="row">
                                <div class="col-sm-5"></div>
                                <div class="col-sm-2">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                                <div class="col-sm-5"></div>
                        </div>
					  </form>
					</div>
                </div>
            </div>
			</div>
</div>
			  <br>
              <!--Backend-->
    <?php
     use BorderCloud\SPARQL\SparqlClient;
     require_once('../vendor/autoload.php');

     $judul = false;
     $kategori = false;
     $penulis = false;
     $penerbit = false;
     
          if(isset($_POST['judul']))
              $judul=$_POST['judul'];
          if(isset($_POST['kategori']))
            $kategori=$_POST['kategori'];
          if(isset($_POST['penulis']))
            $penulis=$_POST['penulis'];
          if(isset($_POST['penerbit']))
            $penerbit=$_POST['penerbit'];
        

          //Error Handling
          if (!$judul && !$kategori && !$penulis && !$penerbit){
              echo"<p class='text-center'>Anda Belum Memasukkan Keyword yang Ingin Anda Cari!</p><br><br>";
          }
        else{
            $fuseki_server = "http://31.220.62.156:3030"; // fuseki server address 
            $fuseki_sparql_db = "temubuku"; // fuseki Sparql database 
            $endpoint = $fuseki_server . "/" . $fuseki_sparql_db . "/query"; 
            $sc = new SparqlClient();
            $sc->setEndpointRead($endpoint);
            $q = "PREFIX d:<http://example.com/data#>
                    PREFIX b:<http://example.com/buku#>
                    PREFIX rdf: <http://www.w3.org/1999/02/22-rdf-syntax-ns#> 
                    SELECT ?id ?judul ?penulis ?penerbit ?kategori ?urlFoto
                    WHERE{
                        ?d b:id ?id;
                        b:judul ?judul;
                        b:hasKategori ?namakategori;
                        b:hasPenulis ?namapenulis;
                        b:hasPenerbit ?namapenerbit;
                        b:hasTahunTerbit ?namatahun_terbit;
                        b:urlFoto ?urlFoto.
                      
                        ?namakategori b:kategori ?kategori.
                        ?namapenulis b:penulis ?penulis. 
                        ?namapenerbit b:Penerbit ?penerbit.
                        ?namatahun_terbit b:tahunterbit ?tahun_terbit.

                        FILTER contains(lcase(str(?judul)), lcase(str('$judul'))) 
                        FILTER contains(lcase(str(?kategori)), lcase(str('$kategori')))
                        FILTER contains(lcase(str(?penulis)), lcase(str('$penulis')))
                        FILTER contains(lcase(str(?penerbit)), lcase(str('$penerbit')))
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
                    <p class='text-center'>Pencarian dengan kata kunci judul : <b> $judul </b> kategori : <b>$kategori</b> penulis : <b>$penulis</b> penerbit: <b>$penerbit</b> ditemukan sebanyak $jumlah hasil.</p>
            
                    <div class='container-fluid bg-trasparent my-4 p-3' style='position: relative;'>
                        <div class='row row-cols-1 row-cols-xs-2 row-cols-sm-2 row-cols-lg-4 g-3'>";
                            foreach ($rows["result"]["rows"] as $row) {
                            echo"
                            <br>
                                <div class='col'>
                                    <div class='card h-100 shadow-sm'> <img src='{$row['urlFoto']}' class='card-img-top' alt='...'>
                                        <div class='card-body'>
                                            <div class='clearfix mb-3'> <span class='float-start badge rounded-pill bg-primary'>{$row['kategori']}</span> </div>
                                            <h6 class='card-title text-center'>{$row['judul']}</h6>
                                            <h6 class='text-center'>{$row['penulis']}</h6>
                                            <h6 class='text-center text-muted'>{$row['penerbit']}</h6>";
                                            $id = $row['id'];
                                            echo"
                                            <div class='text-center my-4'> <a href='detail.php?id=$id' class='btn btn-warning'>Detail</a> </div>
                                        </div>
                                    </div>
                                </div>";};};
                        ?>
                        </div>
    </div>
	<footer class="text-center">
		<br>
		<p>Copyright 2021  • All Right Reserved • TemuBuku</p>
		<br>
	</footer>
</body>
</html>