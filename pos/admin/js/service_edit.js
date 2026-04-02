//any js gurus out there :(((( holy shit
function show_add_service() {
	document.getElementById("ins").innerHTML = "";
}
var index = 0;
function remove_service(id) {
	var text_obj = document.getElementById(id);
	text_obj.remove();
}
function del_btn(id){
	const myId = id;
	const mySpace = 's'+id;
	var text_obj = document.getElementById(myId);
	var space_obj = document.getElementById(mySpace);
	text_obj.remove();
	space_obj.remove();
	var btn = document.getElementById(id);
	btn.remove();
	index = 0;
	
	return true;
}
function add_service() {
	while (document.getElementById(index))
		index++;
	const para = document.createElement("input");
	const element = document.getElementById("para");
	para.type = 'text';
	para.placeholder = 'add service';
	para.required = 'required';
	para.value = '';
	para.name = index;
	para.id = index;
	const del = document.createElement("button");
	const line = document.createElement("br");
	line.id = "s"+index;
	del.onclick = function(){
		const myId = para.id;
		const mySpace = line.id;
		var text_obj = document.getElementById(myId);
		var space_obj = document.getElementById(mySpace);
		text_obj.remove();
		space_obj.remove();
		index = 0;
		this.parentNode.removeChild(this);
		return false;
	};
	del.innerHTML = 'X';
	index++;
	
	element.appendChild(para);
	element.appendChild(del);
	element.appendChild(line);
}