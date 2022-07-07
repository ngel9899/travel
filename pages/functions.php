  <? function connect(
  $host = 'localhost',
  $user = 'root',
  $pass = '460368',
  $dbname = 'travels'
)
{
  $link = mysqli_connect($host, $user, $pass) or die ('connection error');
  mysqli_select_db($link, $dbname) or die('DB open error');
  mysqli_query($link, "set names 'utf8'" );
  return $link;
}

function register($login, $pass, $email)
{
    $login = trim(htmlspecialchars($login));
    $pass = trim(htmlspecialchars($pass));
    $email = trim(htmlspecialchars($email));
    if ($login == "" || $pass == "" || $email == "") {
        echo "<h3><span style='color: red;'>Fill all required fields!</span></h3>";
        return false;
    }

    if (strlen($login) < 3 || strlen($login) > 30 || strlen($pass) < 3 || strlen($pass) > 30) {
        echo "<h3><span style='color: red;'>Values length must be between 3 and 30</span></h3>";
        return false;
    }

    $queryInsertUser = 'insert into users (login, pass, email, roleid) values ("'.$login.'", "'.md5($pass).'", "'.$email.'", 2)';
    $link = connect();
    mysqli_query($link, $queryInsertUser);
    $error = mysqli_errno($link);
    if ($error) {
        if ($error == 1062) {
            echo "<h3><span style='color: red;'>This login is already taken!</span></h3>";
        } else {
            echo $login." ".$pass." ".$email ;
            echo "<h3><span style='color: red;'>Error code: {$error}!</span></h3>";
        }
        return false;
    }
    return true;
}

function login($login, $pass)
{
  $login = trim(htmlspecialchars($login));
  $pass = trim(htmlspecialchars($pass));
  if ($login == "" || $pass == "") {
      echo "<h3><span style='color: red;'>Fill all required fields!</span></h3>";
      return false;
  }
  if (strlen($login) < 3 || strlen($login) > 30 || strlen($pass) < 3 || strlen($pass) > 30) {
    echo "<h3><span style='color: red;'>Please enter a username and password of at least 3 characters and no more than 30</span></h3>";
    return false;
  }
    $link = connect();
    $log = mysqli_query($link, 'SELECT * from users where login="'.$login.'" and pass="'.md5($pass).'"');
    if ($row =  mysqli_fetch_array($log , MYSQLI_ASSOC)) {
      if ($login == $row['login'] && md5($pass) == $row['pass']) {
        $_SESSION['ruser'] = $login;
        if ($row['roleid'] == 1) {
            $_SESSION['radmin'] = $login;
        }
        return true;
    } else {
        echo "<h3><span style='color: red;'>No such User!</span></h3>";
        return false;
    }
}
}
