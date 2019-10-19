var todo;

function setCookie(cname, cvalue) {

var cooks;
	if (document.cookie != "")
		cooks = document.cookie + ";";
	document.cookie = cooks + cname + "=" + cvalue + ";";
  }
  
  function getCookie(cname) {
	var name = cname + "=";
	var ca = document.cookie.split(';');
	for(var i = 0; i < ca.length; i++) {
	  var c = ca[i];
	  while (c.charAt(0) == ' ') {
		c = c.substring(1);
	  }
	  if (c.indexOf(name) == 0) {
		return c.substring(name.length, c.length);
	  }
	}
	return ca;
  }
  
  function checkCookie() {
	var user;
	user = prompt("add your data: ", "");
	if (user != "" && user != null) {
		setCookie("username", user);
	}
	var data = getCookie("username");
	if (data != "") {
	//	var element = document.createElement(tagName[, options]);

	  alert("Welcome dATA " + data);
  }
  
  };

// in while create div each time for  new string */