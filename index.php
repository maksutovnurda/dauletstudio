<?php include 'libs.php' ?>
<!doctype html>
<html lang="kk" prefix="og: http://ogp.me/ns#">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
		<meta name="theme-color" content="#323335">
		<meta http-equiv="Content-Language" content="kk">
		<title>Басты бет - Daulet Studio</title>
		
		<meta name="title" content="Daulet Studio - Design және IT"><!-- 12 сөз 70 символ -->
		<meta name="keywords" content="dauletstuio studio дизайн қазақша даулет студио нурдаулет максутов nurdaulet maksutov" />
		<meta name="description" content="Daulet Studio - IT және дизайн саласына арналған қазақша блог!"> <!-- 160-200 symbol -->
		<meta name="Author" content="Нурдаулет Максутов Утегенович">
		<meta name="Address" content="г. Кульсары">
		<meta name="robots" content="index, follow">
		<base <?php echo "href='{$base}'"; ?>>
		<!-- <meta name="robots" content="noindex"> -->
		
		<!-- Open graph -->
		<meta name="og:title" content="Daulet Studio - Design және IT" />
		<meta property="og:url" <?php echo "content='http://{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}'"; ?> />
		<meta property="og:type" content="website" />
		<meta property="og:description" content="Daulet Studio - IT және дизайн саласына арналған қазақша блог!" />
		<meta property="og:image" content="img/1.jpg" />
		<meta property="og:image:secure_url" content="img/1.jpg">
		
		<!-- Google+ -->
		<meta itemprop="name" content="Daulet Studio - Design және IT" />
		<meta itemprop="description" content="Daulet Studio - IT және дизайн саласына арналған қазақша блог!" />
		<meta itemprop="image" content="img/1.jpg" />
		
		<!-- Links -->
		<link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
		<link rel="stylesheet" type="text/css" href="css/style.css">
		<link rel="stylesheet" href="font-awesome/css/font-awesome.min.css">
		<script src="js/script.js"></script>
		<script src="js/prefixfree.min.js"></script>
	</head>
	<body>
		
		<?php getMenu(); ?>
		<div class="body">
			<div class="advert left"></div>
			<div class="site right">
				<div class="sidebar"><?php getSidebar() ?></div>
				<div class="continer">
					<?php addPostShow() ?>
					<div class="dffdc" id="posts">
						<?php getPosts(); ?>
					</div>
				</div>
			</div>
			<div class="advert left"></div>
		</div>
		<?php getFooter() ?>
	<script src="js/script.js"></script>
	</body>
</html>	
<!-- <div class="post">
							<a class="gradient" href="post.php"></a>
							<img src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAEALAAAAAABAAEAAAICTAEAOw==" class="b-lazy" data-src="img/1.jpg">
							<div class="content">
								<div class="dffdr" style="align-items: center;">
									<span class="info-t">1 күн бұрын</span>&nbsp;&nbsp;
									<div>
										<span class="fa fa-eye info-t"></span><span class="info-t">&nbsp;400&nbsp;&nbsp;</span>
									</div>
									<div>
										<span class="fa fa-comments info-t"></span><span class="info-t">&nbsp;15&nbsp;&nbsp;</span>
									</div>
								</div>
								<h2><a href="post.php">Top Liga Janalyktary </a></h2>
								<i class="hash">#projectbydaulet #ava</i>
							</div>
						</div> -->
