<?
session_start();
include_once "functions.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
	<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel Info</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../css/myStyle.css">
    <script type="text/javascript" src="https://code.jquery.com/jquery-1.11.0.min.js"></script>
	  <script type="text/javascript" src="https://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
</head>
<body>
  <?
  if (isset($_GET['hotel'])) {
      $hotel = $_GET['hotel'];
      $link = connect();
      $select = 'select * from hotels where id=' . $hotel;
      $res = mysqli_query($link, $select);
      $row = mysqli_fetch_array($res, MYSQLI_ASSOC);
      $hname = $row['hotel'];
      $hstars = $row['stars'];
      $hcost = $row['cost'];
      $hinfo = $row['info'];
			$hid =$row['id'];
      mysqli_free_result($res);
			if (isset($_COOKIE['roleid'])) {
				if ($_COOKIE['roleid'] == 1) {
					$_SESSION['radmin'];
				}else {
					$_SESSION['ruser'];
				}
			}
  }
  ?>
	<header class="header container">
		<div class="header-menu">
			<div class="row header-menu">
					<nav class="col-sm-12 col-md-12 col-lg-12">
							<?
									if (isset($_GET['page'])) {
										$page = $_GET['page'];
									}
							?>
							<ul class="nav nav-tabs nav-justified">
								<li <? echo ($page == 1) ? "class='active'" : ""?>>
									<a href="../index.php?page=1">Tours</a>
								</li>
								<? if ($_SESSION['radmin'] || $_SESSION['ruser']){ ?>
									<li <? echo ($page == 2) ? "class='active'" : ""?>>
										<a href="../index.php?page=2">Comments</a>
									</li>
								<? } ?>
								<li <? echo ($page == 3) ? "class='active'" : ""?>>
									<a href="../index.php?page=3">Registration</a>
								</li>
								<? if ($_SESSION['radmin']){ ?>
									<li <? echo ($page == 4) ? "class='active'" : ""?>>
										<a href="../index.php?page=4">Admin Forms</a>
									</li>
									<li <? echo ($page == 5) ? "class='active'" : ""?>>
										<a href="../index.php?page=5">Privat</a>
									</li>
								<? } ?>
							</ul>
					</nav>
			</div>
			<nav class="header-nav">
			  <ul class="header-nav-ul">
					<section class="col-sm-12 col-md-12 col-lg-12">
							<?
							if (isset($_GET['page'])) {
									$page = $_GET['page'];
									if ($page == 1) include_once "tours.php";
									if ($_SESSION['radmin'] || $_SESSION['ruser']) {
										if ($page == 2) include_once "comments.php";
									}
									if (isset($_SESSION[''])) {
										if ($page == 3) include_once "registration.php";
									}
									if ($_SESSION['radmin']) {
										if ($page == 4) include_once "admin.php";
										if ($page == 5) include_once "privat.php";
									}
							}
							?>
					</section>
      	</ul>
			</nav>
		</div>
		<div class="block-hname">
			<?echo '<h2 class="hname">'.$hname.'</h2>';?>
		</div>
	</header>
	<section class="main">
		<div class="gallery-left">
			<div class="gallery">
          <?
          $select = 'select imagepath from images where hotelid=' . $hotel;
          $res = mysqli_query($link, $select);
          while ($row = mysqli_fetch_array($res, MYSQLI_ASSOC)) {
              echo '<div class="slider__item"><img src="../'.$row['imagepath'].'" alt="image hotel"></div>';
          }
          mysqli_fetch_array($res);
          ?>
			</div>
		</div>
		<div class="gallery-right">
			<div class="gallery-right-title">
				<h3>Title</h3>
				<div class="gallery-right-text">
					<p>Lorem ipsum dolor sit, amet, consectetur adipisicing elit. Repudiandae laboriosam illum enim dignissimos nam molestiae explicabo, beatae. Temporibus provident ullam iusto quasi, sunt consectetur quam dolores autem voluptatem architecto officia. Lorem ipsum dolor sit amet, consectetur adipisicing, elit. Amet voluptatem dicta, saepe necessitatibus asperiores quisquam expedita dolor pariatur reprehenderit nam perferendis maxime, magnam unde, eum earum, aliquam totam iste eius. Lorem ipsum dolor sit amet consectetur adipisicing elit. Itaque veritatis quasi saepe explicabo deserunt libero, quisquam inventore tenetur ab consequatur officia doloremque aliquam perspiciatis unde, et ipsum animi voluptate natus!</p>
				</div>
			</div>
		</div>
	</section>
	<section>
		<div class="block-table">
			<div class="col-sm-6 col-md-6 col-lg-6 left">
				<?
				$select = 'SELECT * from comments, users where hotelid = '.$hid.' and userid = users.id order by login';
		    $res = mysqli_query($link, $select);
		    echo '<table class="table table-striped">';
		    while ($row = mysqli_fetch_array($res, MYSQLI_ASSOC)) {
		      echo '<tr>';
		      echo '<td>' . $row['comment'] . '</td>';
		      echo '<td>' . $row['login'] . '</td>';
		      echo '</tr>';
		    }
				mysqli_free_result($res);
				?>
			</div>
		</div>
	</section>
		<script type="text/javascript">
			$('.gallery').slick({
				arrows:true,
				speed: 900,
			});
		</script>
</body>
</html>
