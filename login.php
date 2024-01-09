<html>
<head>
    <script src = "login.js"></script>
    <link rel = "stylesheet" href = "login.css">
    <title>Login</title>
</head>
<body>
<div class="container">
    <img src="contact.png" alt="Login" align="center">
    <form action="/login" method="post">
      <label>EMAIL:</label>
      <input type="email" name="email" placeholder="Email" required>
      <label>PASSWORD:</label>
      <input type="password" name="password" id = "password" placeholder="Password" required>
      <a href="/forgot-password">Forgot password?</a><br><br>
      <input type="submit" class = "button" value = "Login" onclick="return check()">
    </form>
    <p>Don't have an account? <a href="/register.html">Register</a></p>
  </div>
</body>
</html>