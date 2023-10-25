<?php
include_once("koneksi.php");

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>absensi</title>
    <link rel="stylesheet" href="style.css">
  </head>
  <style>
  @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap');

* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  font-family: 'Roboto', sans-serif;
}

.flex {
  display: flex;
  align-items: center;
}

.container {
  padding: 0 15px;
  min-height: 100vh;
  justify-content: center;
  background: #f0f2f5;
}

.login-page {
  justify-content: space-between;
  max-width: 1000px;
  width: 100%;
}

.login-page .text {
  margin-bottom: 90px;
}

.login-page h1 {
  color: #0d65d9;
  font-size: 4rem;
  margin-bottom: 10px;
}

.login-page p {
  font-size: 1.75rem;
  white-space: nowrap;
}

form {
  display: flex;
  flex-direction: column;
  background: #fff;
  border-radius: 8px;
  padding: 20px;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1),
    0 8px 16px rgba(0, 0, 0, 0.1);
  max-width: 400px;
  width: 100%;
}

form input {
  height: 55px;
  width: 100%;
  border: 1px solid #ccc;
  border-radius: 6px;
  margin-bottom: 15px;
  font-size: 1rem;
  padding: 0 14px;
}

form input:focus {
  outline: none;
  border-color: #1877f2;
}

::placeholder {
  color: #777;
  font-size: 1.063rem;
}

.link {
  display: flex;
  flex-direction: column;
  text-align: center;
  gap: 15px;
}

.link .login {
  border: none;
  outline: none;
  cursor: pointer;
  background: #1877f2;
  padding: 15px 0;
  border-radius: 6px;
  color: #fff;
  font-size: 1.25rem;
  font-weight: 600;
  transition: 0.2s ease;
}

.link .login:hover {
  background: #0d65d9;
}

form a {
  text-decoration: none;
}

.link .forgot {
  color: #1877f2;
  font-size: 0.875rem;
}

.link .forgot:hover {
  text-decoration: underline;
}

hr {
  border: none;
  height: 1px;
  background-color: #ccc;
  margin-bottom: 20px;
  margin-top: 20px;
}

.button {
  margin-top: 25px;
  text-align: center;
  margin-bottom: 20px;
}

.button a {
  padding: 15px 20px;
  background: #42b72a;
  border-radius: 6px;
  color: #fff;
  font-size: 1.063rem;
  font-weight: 600;
  transition: 0.2s ease;
}

@media (max-width: 900px) {
  .login-page {
    flex-direction: column;
    text-align: center;
  }

  .login-page .text {
    margin-bottom: 30px;
  }
}

@media (max-width: 460px) {
  .login-page h1 {
    font-size: 3.5rem;
  }

  .login-page p {
    font-size: 1.3rem;
  }

  form {
    padding: 15px;
  }
}
  </style>
  <body>
    <div class="container flex">
      <div class="login-page flex">
        <div class="text">
          <h1>Abeasy</h1>
          <p>Absensi mudah dan cepat,</p>
          <p>ayo absen jangan sampai lupa!</p>
        </div>
        <form action="" method="post">
          <input type="text" placeholder="username" name="username">
          <input type="password" placeholder="Password" name="password">
          <div class="link">
            <button type="submit" class="login" name="login">Login</button>
          </div>
        </form>
      </div>
    </div>
  </body>
</html>
<?php 
          if (isset($_POST['login'])) {
            $username = $_POST['username'];
            $password = $_POST['password'];
            $query = "SELECT * FROM users WHERE username = ? AND password = ?";
            $stmt = mysqli_prepare($mysqli, $query);
            mysqli_stmt_bind_param($stmt, "ss", $username, $password);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt); 
            $cekRes = mysqli_num_rows($result);  
            var_dump($cekRes);     
            if ($cekRes === 1) {
                header("Location: index.php");
                exit();
            }
             else {
                echo "Login gagal. Periksa kembali username dan password Anda.";
            }
        }
?>