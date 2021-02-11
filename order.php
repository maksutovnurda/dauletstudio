<?php include 'libs.php' ?>
<!doctype html>
<html lang="kk" prefix="og: http://ogp.me/ns#">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
		<meta name="theme-color" content="#333344">
		<meta http-equiv="Content-Language" content="kk">
		<title>Тапсырс беру - Daulet Studio</title>
		<base <?php echo "href='{$base}'"; ?>>
		
		<meta name="title" content="Daulet Studio - IT және Design"><!-- 12 сөз 70 символ -->
		<meta name="keywords" content="Daulet Studio тапсырыс беру нурдаулет максутов заказать заказ" />
		<meta name="description" content="Daulet Studio - IT және дизайн саласына арналған қазақша блог!"> <!-- 160-200 symbol -->
		<meta name="Author" content="Нурдаулет Максутов Утегенович">
		<meta name="Address" content="г. Кульсары">
		<meta name="robots" content="index, follow">
		<!-- <meta name="robots" content="noindex"> -->
		
		<!-- Open graph -->
		<meta name="og:title" content="Daulet Studio" />
		<meta property="og:url" <?php echo "content='http://{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}'"; ?> />
		<meta property="og:type" content="website" />
		<meta property="og:description" content="Daulet Studio - IT және дизайн саласына арналған қазақша блог!" />
		<meta property="og:image" content="img/1.jpg" />
		<meta property="og:image:secure_url" content="img/1.jpg">
		
		<!-- Google+ -->
		<meta itemprop="name" content="Daulet Studio" />
		<meta itemprop="description" content="Daulet Studio - IT және дизайн саласына арналған қазақша блог!" />
		<meta itemprop="image" content="img/1.jpg" />
		
		<!-- Links -->
		<link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
		<link rel="stylesheet" type="text/css" href="css/style.css">
		<link rel="stylesheet" href="font-awesome/css/font-awesome.min.css">
		<script src="js/script.js"></script>

	</head>
	<body>
		<?php getMenu() ?>
		<div class="body">
			<div class="advert left"></div>
			<div class="site right">
				<div class="sidebar"><?php getSidebar() ?></div>
				<div class="continer">
					<div class="signin" id="signin1">
						<div class="w300">
							<p>Тапсырыс беру</p>
							<input type="text" id="name" placeholder="Аты-жөніңіз" class="sign">
							<select  class="sign" id="product">
								<?php $getproduct = mysqli_query($conn, "SELECT * FROM `stats` WHERE `type` = 'price' AND `block` = 0 ORDER BY place ");
									while ($product =mysqli_fetch_array($getproduct)) { echo "<option value='{$product['content']}'>{$product['content']}</option>"; }
								 ?>
							</select>
							<input type="text" id="link" placeholder="Сізідң Vk Telegram Insta" class="sign">
							<input type="button" class="sign-btn" value="Тапсырыс беру" onclick="addOrder()">
							<a href="https://vk.com/write259670919" target="_blank" class="change">Вконтактеге жазу</a>
							<div id="erroforder" class="df w100p">
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="advert left"></div>
		</div>
		<?php getFooter() ?>
		<script src="js/script.js"></script>
	</body>
</html>	
