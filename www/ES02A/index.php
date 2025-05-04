<!-- http://204.216.213.176/inf3php/ES02A/ -->
<!DOCTYPE html>
<html>
<head>
  <title>Pagina di login</title>
</head>
<body>
  <h3>Accesso a pagina riservata</h3>
  
  <form action="login.php" method="post">
    
    <label for="username" ><b>Username</b></label>
    <input type="text" name="nomeutente" placeholder="Inserisci il nome utente" /><br />

    <label for="password"><b>Password</b></label>
    <input type="password" name="password" placeholder="Inserisci la password" /><br />
    
    <input name="submit" type="submit" value="Invia" />
  
  </form>

</body>
</html>

