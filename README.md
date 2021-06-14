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

Link Aplikasi : https://webtemubuku.herokuapp.com/

Secara <i>Local</i> :

  1. Menjalankan Fuseki Server
      - Jalankan fuseki server dengan command dibawah pada folder fuseki server pada cmd/terminal.
        Pada sistem operasi Windows 10 : <i>fuseki-server</i>
      - Akses server management di http://localhost:3030 
      - Tambahkan dataset dengan nama TemuBuku
      - Upload data temubuku.ttl yang ada pada folder database dengan melakukan clone dari https://github.com/meiradwianaa/webtemubuku
  2. Menjalankan website
      - Install framework symfony. Download framework symfony di https://symfony.com/download dan install.
      - Buka folder TemuBuku,  jalankan command <i>composer require bordercloud/sparql</i> yang dilanjutkan dengan <i>composer install</i> untuk menginstall library BorderCloud SPARQL yang menghubungkan antara PHP dengan Apache Fuseki. 
      - Jalankan command <i>symfony server</i> pada cmd/terminal agar server dapat berjalan
      - Akses server management di http://localhost:8000 dan website sudah dapat digunakan.
