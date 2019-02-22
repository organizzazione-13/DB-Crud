<!doctype html>
<html lang="en">

<head>
  <title>Title</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="css/main.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO"
    crossorigin="anonymous">
</head>

<body>
  <form method="POST" autocomplete="off" action="main.php">
    <div class="container">
      <h1>Accedi</h1>
                                        <div id="errore"><?php
                            if(isset($_GET['err']))
                            echo "
                              <div class=\"alert alert-danger\" role=\"alert\">".
                              urldecode($_GET['err'])
                              ."</div>";
                            ?></div>
      <hr>

      <label for="username"><b>Username</b></label>
      <input type="text" placeholder="Inserire Username" name="username" required>

      <label for="password"><b>Password</b></label>
      <input type="password" placeholder="Inserire Password" name="password" required>

      <hr>
      <button type="submit" class="registerbtn"> Accedi</button>
    </div>
    <div class="container signup">
      <p>Non hai un account? <a href="../registrazione">Registrati</a>.</p>
    </div>
  </form>

  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
    crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
    crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy"
    crossorigin="anonymous"></script>
</body>

</html>