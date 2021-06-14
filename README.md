#   TemuBuku

TemuBuku adalah aplikasi web semantik untuk pencarian buku menggunakan RDF dan SPARQL

Aplikasi ini dibuat menggunakan Symfony 5 PHP Framework

Sumber data buku : https://shopee.co.id/cerdas.media

## Kelompok

| NPM           | Name              | Role                                  |
| ------------- |-------------------|---------------------------------------|
| 140810180015  | Meira Dwiana A    | Front End Developer dan UI/UX         |
| 140810180059  | Anne Audistya F   | Back End Developer dan Dataset RDF    |

## Cara Penggunaan Aplikasi

  1. Menjalankan Fuseki Server
      - Jalankan fuseki server dengan command dibawah pada folder fuseki server pada cmd/terminal.
        Pada sistem operasi Windows 10 : fuseki-server
      - Akses server management di http://localhost:3030 
      - Tambahkan dataset dengan nama TemuBuku
      - Upload data temubuku.ttl yang ada pada folder database dengan melakukan clone dari https://github.com/meiradwianaa/webtemubuku
  2. Menjalankan website
      - Install framework symfony. Download framework symfony di https://symfony.com/download dan install.
      - Buka folder TemuBuku,  jalankan command composer require bordercloud/sparql yang dilanjutkan dengan composer install untuk menginstall library BorderCloud SPARQL yang menghubungkan antara PHP dengan Apache Fuseki. 
      - Jalankan command symfony server pada cmd/terminal agar server dapat berjalan
      - Akses server management di http://localhost:8000 dan website sudah dapat digunakan.
