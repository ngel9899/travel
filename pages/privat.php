<h3>Private form</h3>
<div class="row">
  <div class="col-sm-6 col-md-6 col-lg-6 left">
    <?
    $link = connect();
    $selectruser = 'SELECT * from users where roleid = 2';
    $res = mysqli_query($link , $selectruser);
    echo '<form action="index.php?page=5" method="post" enctype="multipart/form-data" class="input-group">';
    echo '<select name="userid">';
    while ($row = mysqli_fetch_array($res, MYSQLI_ASSOC)) {
        echo '<option value="'.$row['id'].'">' . $row['login'] .'</option>';
    }
    mysqli_free_result($res);
    echo '<input type="submit" name="addadmin" value="add" class="btn btn-sm btn-info">';
    echo '</form>';

    echo '<form action="index.php?page=5" method="post" class="input-group">';
    echo '<select name="deluserid">';
    $selectruser = 'SELECT * from users where roleid = 1';
    $res = mysqli_query($link, $selectruser);
    while ($row = mysqli_fetch_array($res, MYSQLI_ASSOC)) {
        echo '<option value="'.$row['id'].'">' . $row['login'] .'</option>';
    }
    mysqli_free_result($res);
    echo '<input type="submit" name="deladmin" value="deladmin" class="btn btn-sm btn-info">';
    echo '</form>';

    if (isset($_POST['addadmin'])) {
        $userid = $_POST['userid'];
        $insert = 'UPDATE users set roleid=1 where id = ' . $userid;
        mysqli_query($link , $insert);
        echo "<script>";
        echo "window.location=document.URL;";
        echo "</script>";
    }
    if (isset($_POST['deladmin'])) {
        $userid = $_POST['deluserid'];
        $insertdel = 'UPDATE users set roleid = 2 where id = ' . $userid;
        mysqli_query($link , $insertdel );
        echo "<script>";
        echo "window.location=document.URL;";
        echo "</script>";
    }


    $select = 'SELECT * from users where roleid = 1 order by login';
    $res = mysqli_query($link, $select);
    echo '<table class="table table-striped">';
    while ($row = mysqli_fetch_array($res, MYSQLI_ASSOC)) {
      echo '<tr>';
      echo '<td>' . $row['id'] . '</td>';
      echo '<td>' . $row['login'] . '</td>';
      echo '<td>' . $row['email'] . '</td>';
      echo '</tr>';
    }
    echo '</table>';





    ?>
  </div>
</div>
