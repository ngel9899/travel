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
    <link rel="stylesheet" type="text/css" href="../css/myStyle.css
    ">
    <script type="text/javascript" src="https://code.jquery.com/jquery-1.11.0.min.js"></script>
	  <script type="text/javascript" src="https://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
</head>
<body>
  <?
  include_once "functions.php";
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
      mysqli_free_result($res);
  }
  ?>
	<header class="header">
		<div class="header-menu">
			<div class="logo">
				<a href=""><img src="../images/hotel-logo.jpg"></a>
			</div>
			<nav class="header-nav">
			  <ul class="header-nav-ul">
					<li><a href="">Home</a></li>
					<li><a href="">About</a></li>
					<li><a href="">Rooms</a></li>
					<li class="drop-menu-active"><a href="">Pages</a>
              <ul class="drop-menu">
                  <li><a href="">About Us</a></li>
                  <li><a href="">Rooms</a></li>
                  <li><a href="">Services</a></li>
              </ul>
          </li>
          <li><a href="">News</a></li>
          <li><a href="">Contact</a></li>
          <?echo '<li>'.$hname.'</li>';?>
      	</ul>
			</nav>
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
		<script type="text/javascript">
			$('.gallery').slick({
				arrows:true,
				speed: 900,
			});
		</script>
	</section>
</body>
</html>
