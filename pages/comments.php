<h2>Commets</h2>
<hr>
<?php
$link = connect();
echo '<form action="index.php?page=2" method="post" class="input-group">';
echo '<select name="hotel">';
$select = 'select countries.country, cities.city, hotels.hotel, hotels.id, users.id
            from countries, cities, hotels, users where countries.id = hotels.countryid and cities.id = hotels.cityid order by countries.country';
$res = mysqli_query($link, $select);
$linkUserToCountry = [];
while ($row = mysqli_fetch_array($res, MYSQLI_NUM)) {
    echo '<option value="'.$row[3].'">';
    echo $row[0] . ' / ' . $row[1] . ' / ' .$row[2];
    echo '</option>';
    $linkUserToCountry[$row[3]] = $row[4];
}
echo '<input type="text" name="comment" placeholder="Comment" >';
echo '<input type="submit" name="addcomment" value="Add" class="btn btn-sm btn-info">';
echo '</select>';
echo '</form>';

mysqli_free_result($res);
if (isset($_REQUEST['addcomment'])) {
  $hotelid = $_POST['hotel'];
  $usersid = $linkUserToCountry[$hotelid];
  $comment = $_POST['comment'];
  $insercomment = 'INSERT comments(comment, userid, hotelid) VALUES ("'.$comment.'",' . $usersid . "," . $hotelid .')';
  mysqli_query($link , $insercomment );
  echo "<script>";
  echo "window.location=document.URL;";
  echo "</script>";
}
