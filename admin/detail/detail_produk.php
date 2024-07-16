<div class="shadow p-3 mb-3 bg-white rounded"> 
    <h5><b>Halaman Detail Produk</b></h5>
</div>

<?php
$id_produk = $_GET['id'];

$ambil = $connection->query("SELECT * FROM produk JOIN kategori ON produk.id_kategori=kategori.id_kategori WHERE id_produk='$id_produk'");

$detailproduk = $ambil->fetch_assoc();

$produk_foto = array();
$ambil = $connection->query("SELECT * FROM produk_foto WHERE id_produk='$id_produk'");

while($tiap = $ambil->fetch_assoc())

{
    $produk_foto[]=$tiap;
}

?>

<pre><?php print_r($detailproduk);?></pre>
<pre><?php print_r($produk_foto);?></pre>
