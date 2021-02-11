<?php 
include "connection.php";
include "libs.php";
$query = mysqli_query($conn, "SELECT `uri` FROM posts");
$base_url = "{$main_url}/post/";
header("Content-Type: application/xml; charset=utf-8");
echo '<?xml version="1.0" encoding="UTF-8"?>'.PHP_EOL;
echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">'.PHP_EOL;

echo "<url>".PHP_EOL;
echo '<loc>'.$base.'</loc>'.PHP_EOL;
echo "<changefreq>always</changefreq>".PHP_EOL;
echo "</url>".PHP_EOL;

echo "<url>".PHP_EOL;
echo '<loc>'.$base.'order</loc>'.PHP_EOL;
echo "<changefreq>never</changefreq>".PHP_EOL;
echo "</url>".PHP_EOL;

while ($row=mysqli_fetch_array($query)) {
	echo "<url>".PHP_EOL;
	echo '<loc>'.$base.$row['uri'].'</loc>'.PHP_EOL;
	echo "<changefreq>daily</changefreq>".PHP_EOL;
	echo "</url>".PHP_EOL;
}
echo '</urlset>'.PHP_EOL;
 ?>