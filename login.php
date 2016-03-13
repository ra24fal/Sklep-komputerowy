<meta charset="utf-8">
<?php
session_start();

if ( $_POST['login']=='') {
    $_SESSION['bladLogin'] = true;
    if ($_POST['password']==''){
         $_SESSION['bladHaslo'] = true;
    }
   header("Location: index.php");
   
}else{
        $_SESSION['bladLogin'] = false;
        
        $login = $_POST['login'];
        $pass = $_POST['password'];
       
        $login = htmlentities($login, ENT_QUOTES, "utf-8");
        $pass = htmlentities($pass, ENT_QUOTES, "utf-8");
      // $password = htmlspecialchars($password, ENT_QUOTES, "utf-8");
       
        include('db_connect.php');
        
        if ($mysqli = new mysqli($localhost, $user, $password, $db)){
           // echo 'Połączony';
           
           if ($query = $mysqli->query(sprintf("SELECT * FROM uzytkownicy WHERE login='%s' AND haslo='%s'",
           mysqli_real_escape_string($mysqli, $login),
           mysqli_real_escape_string($mysqli, $pass) ))){
               
               if ($query->num_rows > 0){
                   // zalogowales sie
                   $_SESSION['zalogowany'] = true;
                   $row = $query->fetch_assoc();
                   
                   $_SESSION['imie'] = $row['imie'];
                   $_SESSION['nazwisko'] = $row['nazwisko']; 
                   header('Location: index.php');
               }else{
                   // nie ma takiego usera nie zalogowales sie
                   header('Location: index.php');
               }
               
           }else{
               echo 'Błędne zapytanie';
             
               
               
           }
            
          
           //header('Location: index.php');
            
        }else
        {
            echo 'Niepołączony';
        }
}

/*
<?php
                session_start();
                if ($_SESSION['zalogowany'] == true){
                    echo "<p style='color: red; font-size: 40px;'> Zalogowany</p>";
                }else{
                    echo "<form action='login.php' method='POST'>";
                    echo "<label>Login: </label>  <input name='login' type='text' /> <br> ";
                    echo "<label>Hasło: </label>  <input name='password' type='text' /> <br> ";
                    echo "<input type='submit' name='submit' /> ";
                    echo "</form>";
                }
            ?>
*/            

/*


index zalogowany panel


<?php
                session_start();
                if ($_SESSION['zalogowany'] == true){
                    echo "<p style='color: black; font-size: 20px;'> Zalogowany</p>";
                    echo "Witaj " . $_SESSION['imie'] .  $_SESSION['nazwisko'];
                    echo "<div id='wyloguj'> <a class='btn btn-primary  href='logout.php'> Wyloguj się</a> </div> " ;
                    
                    
                
                }else{
                    echo "<form action='login.php' method='POST'>";
                    echo "<label>Login: </label>  <input name='login' type='text' />" ;
                    if ($_SESSION['bladLogin']==true){
                        echo "<span style='color: red;'> Nie podałeś loginu </span>";
                    }
                    echo "<br>";
                    echo "<label>Hasło: </label>  <input name='password' type='password' /> <br> ";
                    echo "<button class='btn btn-default' type='submit' name='submit'>Zaloguj się </button> ";
                    echo "</form>";
                }
            ?>
            
 /*