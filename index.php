<!-- Main page to work with a database interface -->

<?php     
include 'index-header.php'; //php [GET] and [POST] handler
?>
<html>
<title>Control panel</title>
<head>
<script src="https://code.jquery.com/jquery-3.5.0.js"></script>  
<script type="text/javascript" src="index.js"></script> <!-- js script to handle buttons and forms -->
<link rel="stylesheet" href="styles.css">
</head>
<body>
<br>
<h2>Welcome home, admin!</h2> 
 <!-- Date and error handling (changing a current login to the login that already exists) -->
<h2>Today is  <?php $time = date('F j, Y', time()); echo $time;?></h2> 
<?php if ($err == 1) echo "<h3 class='warn'>Login $log already exists!</h3>";?>
<div class="flexer maxx">
	<div class="first">
    	<p><button type="submit" class="button f2 green" onclick="openForm('t-settings')">New user</button></p>
	</div>
    <div class="first">
	   <p><button type="button" class="button f2 red" onclick="logOut()">Exit</button></p>
    </div>
</div>
<!-- First form - create a new user -->
<div class="block hidden" id='t-settings'>
    <form role="form" autocomplete="off" method="POST">
        <h1>New user</h1>
        <p class="header">Login & Password (5 to 20 characters)</p>
        <!-- Pre-load readonly to prevent autocomplete -->
        <input pattern=".{5,20}" class="f3" type="text" name="login" required readonly onfocus="this.removeAttribute('readonly')">
        <input pattern=".{5,20}" class="f3" type="password" name="password" required readonly onfocus="this.removeAttribute('readonly')">
        <p class="header">Fullname & Gender</p>
        <input type="text" maxlength="120" class="f3 gender" name="fullname" required>
		<select class="f3 gender" name="gender">
            <option value="Male">Male</option>
			<option value="Female">Female</option>
        </select>
		<p class="header">Birthdate & Admin rights</p>
        <input class="f1" type="date" name="datebirth" min="1910-01-01" max="2010-01-01" required>
		<h3><input type="checkbox" name="isadmin">Admin</h3>
		<div class="flexer maxx">
	    	<div class="first">
        		<p><input type="submit" class="button f2 green" value="Save"></p>
			</div>
    </form>
			<div class="second">
    			<p><button type="button" class="button f2" onclick="closeForm('t-settings')">Close</button></p>
			</div>
		</div>
</div>
<!-- Second form - edit an existing user -->
<div class="block hidden" id='editer'>
    <form role="form" autocomplete="off" method="POST">
        <p class="header">User id: <input type="number" max="1000000" name="eid" id="eid" readonly></p>
        <p class="header">Login & Password</p>
        <input pattern=".{5,20}" class="f3" type="text" name="elogin" id="elogin" required>
        <input pattern=".{5,20}" class="f3" type="password" name="epassword" id="epassword" required>
        <p class="header">Fullname & Gender</p>
        <input type="text" maxlength="120" class="f3 gender" name="efullname" id="efullname" required>
		<select class="f3 gender" name="egender" id="egender">
            <option value="Male">Male</option>
			<option value="Female">Female</option>
        </select>
		<p class="header">Birthdate & Admin rights</p>
        <input class="f1" type="date" name="edatebirth" id="edatebirth" min="1910-01-01" max="2010-01-01" required>
		<h3><input type="checkbox" name="eisadmin" id="eisadmin">Admin</h3>
		<div class="flexer maxx">
	    	<div class="first">
			<p><input type="submit" class="button f2 green" value="Edit"></p>
			</div>
    </form>
			<div class="second">
    			<p><button type="button" class="button f2" onclick="closeForm('editer')">Close</button></p>
			</div>
		</div>
</div>
<br>
<div class="block table">               
<table> 
<br>
<th>№</th>
<th>Login</th>
<th>Info</th>
<th>Delete</th>
<?php
	include 'index-table.php'; //php table handler
?>
</table>
</div>
<!-- Navigation buttons -->
<div class="flexer maxx">
    <div class="first">
        <p><button type="submit" class="button f2 nav-button" onclick="toPage(-2)"><<</button></p>
    </div>
    <div class="second">
        <p><button type="submit" class="button f2 nav-button" onclick="toPage(-1)"><</button></p>
    </div>
	<div class="third">
            <h2 class="nav-footer">Page <input id="cpage" min="1" max="100000" value="<?php echo "$page"?>" type = "number" class="page" readonly> of <input id="epage" min="1" max="100000" value="<?php echo "$pages"?>" type = "number" class="page" readonly></h2>
    </div>
    <div class="third">
            <p><button type="submit" class="button f2 nav-button" onclick="toPage(1)">></button></p>
    </div>
    <div class="fourth">
            <p><button type="submit" class="button f2 nav-button" onclick="toPage(2)">>></button></p>
    </div>
</div>
</body>
</html>