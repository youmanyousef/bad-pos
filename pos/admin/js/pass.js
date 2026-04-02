function check(str, me) {
	type = document.getElementById(str).type;
	if (type == "text") {
		document.getElementById(str).type = "password";
		document.getElementById(me).innerHTML = "&#128065;";
	} else {
		document.getElementById(str).type = "text"
		document.getElementById(me).innerHTML = "&#10680;";
	}
}