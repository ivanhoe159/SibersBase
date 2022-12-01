<!-- Authorization page -->

<html>
<title>Authorization</title>
<head>
<link rel="stylesheet" href="styles.css">
<h1><br>User database</h1>
<?php 
    include 'login-header.php'   //php [GET] and [POST] handler
?>
</head>
<body>
<br>
<form role="form" autocomplete="off" method="POST">
    <div class="block login">
    <p class="header">Username<p>
    <!-- pre-load readonly to prevent autocomplete -->
    <input type = "text" name="login" value="" autocomplete="off" class = "f1 h3" readonly onfocus="this.removeAttribute('readonly')">
    <p class="header">Password</p>
    <input type = "password" name="password" value="" autocomplete="off" class = "f1 h3" readonly onfocus="this.removeAttribute('readonly')">
    <br><br>
    <button class="button green">Login</button>
</form>
</div>
</body>
</html>