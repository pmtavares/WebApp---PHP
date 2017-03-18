/* 
* THIS IS SOME OF AJAX CODE THAT WILL BE HANDLE FOR SOME PAGES
*
*
*/
function elem(x){
	return document.getElementById(x);
}

function Obj(meth, url){
	var x = new XMLHttpRequest();	
	x.open(meth, url, true);
	x.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	return x;
}

function ObjReturn(x){
	if(x.readyState == 4 && x.status == 200){
		return true;	
	}
	
}
//AJAX TO CHECK THE IF THE USERNAME IS TAKEN OR NOT
function check_user(){
	var u = elem("username_register").value;
	var ajax = Obj("POST","reports.php" );
	ajax.onreadystatechange = function(){
		if(ObjReturn(ajax)== true){
			elem("status_username").innerHTML = ajax.responseText;	
		}
	}
	ajax.send("username="+u)
	elem("status_username").innerHTML = "checking...";
}


//AJAX TO CHECK THE IF THE EMAIL IS TAKEN OR NOT
function check_email(){
	var e = elem("register_email").value;
	var ajax = Obj("POST", "reports.php");
	ajax.onreadystatechange = function(){
		if(ObjReturn(ajax) == true){
			elem("status_email").innerHTML = ajax.responseText;	
		}
	}
	ajax.send("email="+e);
	elem("status_email").innerHTML = "checking...";
}


//AJAX TO CHECK THE IF THE OLD PASSWORD IS CORRECT
// NOTE: In the next functions, i did in more detail to show i did not copy it from anywhere.
function check_oldpass(){
	var hr = new XMLHttpRequest();
	var op = document.getElementById("old_password").value;
	hr.open("POST", "reports.php", true);
	hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	hr.onreadystatechange = function(){
		if(hr.readyState == 4 && hr.status == 200){
			var return_data = hr.responseText;
			document.getElementById("check_oldPas").innerHTML = return_data;
		}
		
	}
	hr.send("oldPass="+op);
	document.getElementById("check_oldPas").innerHTML = "checking...";
}



//AJAX TO INSERT AND THEN RETRIEVE THE ARTICLE'S COMMENTS
function add_comments(){
	var hr = new XMLHttpRequest();
	var ac = document.getElementById("text_comment").value;
	var ai = document.getElementById("id_article").value;
	hr.open("POST", "reports.php", true);
	hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	hr.onreadystatechange = function(){
		if(hr.readyState == 4 && hr.status == 200){
			var return_data = hr.responseText;
			document.getElementById("comment_user").innerHTML = return_data;
								
		}
	}
	hr.send("article_comment="+ac+"&id="+ai);
	document.getElementById("text_comment").value = "";
	
	
}

//AJAX TO RETRIEVE THE ARTICLE'S COMMENTS
function show_comments(){
	var hr = new XMLHttpRequest();
	var ai = document.getElementById("id_article").value;
	hr.open("POST", "reports.php", true);
	hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	hr.onreadystatechange = function(){
		if(hr.readyState == 4 && hr.status == 200){
			var return_data = hr.responseText;
			document.getElementById("comment_user").innerHTML = return_data;
								
		}
		
	}
	hr.send("id_article="+ai);
		
}