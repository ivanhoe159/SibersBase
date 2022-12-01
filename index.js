    var url = "http://localhost/sybers/";
	
	//toPage() handler, current page counter
	function toPage(a) {
        var cpage = parseInt(document.getElementById("cpage").value, 10);
		var epage = parseInt(document.getElementById("epage").value, 10);
		if(cpage > epage)
		{
			cpage = epage;
		}
		if(a == -2)
		{
			cpage = 1;
		}
		else if(a == -1)
		{
			cpage = cpage - 1;
		}
		else if(a == 1)
		{
			if(cpage < epage)
			  cpage = cpage + 1;
		}
		else if(a == 2)
		{
			cpage = epage;
		}
		window.location.href = url + 'index.php?page=' + cpage;            //redirect with GET of a current page for a php script
    }
	function logOut() {                                                    //logout redirect

		window.location.href = url + 'index.php?exit=1';
	}
	function toDelete(c) {                                                 //deletion redirect
		var cpage = parseInt(document.getElementById("cpage").value, 10);
		window.location.href = url + 'index.php?page=' + cpage + '&delete=' + c;
	}
    function openForm(id) {                                                //open a "New user" form
        document.getElementById(id).style.display = "block";
    }
	function toEdit(id, login, password, admin, fullname, gender, datebirth) {  //open an "Edit" form with saved params
        document.getElementById('editer').style.display = "block";
		document.getElementById('eid').value = id;
		document.getElementById('elogin').value = login;
		document.getElementById('epassword').value = password;
		if(admin == "True")
			document.getElementById('eisadmin').checked = true;
		else document.getElementById('eisadmin').checked = false;
		document.getElementById('efullname').value = fullname;
		document.getElementById('egender').value = gender;
		document.getElementById('edatebirth').value = datebirth;
    }
    function closeForm(id) {                                               //close form
        document.getElementById(id).style.display = "none";
    }