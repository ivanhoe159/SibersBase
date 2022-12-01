<?php 
    foreach($ct as $key => $chars)      //users table
 	{
		if($chars['adminrights'] == 1)
			$admins = "True";
		else $admins = "False";
		$alt = $key + 1;
		if($alt > 5 * $page - 5 && $alt <= 5 * $page)
		{
			echo "<tr>";
			echo "<td>".$alt."</td>";
			echo "<td>".$chars['login']."</td>";
			//delete and additional info buttons with saved params for each user
			echo "<td><p><button type='submit' class='button tab-button green' onclick=\"toEdit(".$chars['id'].",'".$chars['login']."', '".$chars['password']."','".$admins."','".$chars['fullname']."','".$chars['gender']."','".$chars['datebirth']."')\">I</button></p></td>";
			echo "<td><p><button type='submit' class='button tab-button red' onclick=\"toDelete('".$chars['login']."')\">X</button></p></td>";
			echo "</tr>";
		}
  	}