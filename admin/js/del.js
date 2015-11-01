function showMessage(msg, type) {
	var span = document.createElement("span");
	span.setAttribute("aria-hidden", "true");
	span.appendChild(document.createTextNode("x"));
	
	var button = document.createElement("button");
	button.setAttribute("type", "button");
	button.setAttribute("class", "close");
	button.setAttribute("data-dismiss", "alert");
	button.setAttribute("aria-label", "Close");
	button.appendChild(span);
	
	var message = document.createElement("div");
	message.setAttribute("class", "alert alert-" + type + " alert-dismissible fade in");
	message.setAttribute("role", "alert");		
	message.innerHTML = msg;
	message.appendChild(button);
	$(".col-md-12").prepend(message);
	
	setTimeout(function() {
		$(message).alert('close');
	}, 3000);
}

function del(id, btn) {
	if (!confirm("Вы дейстивтельно хотите удалить эту новость?")) return;
	var req = new XMLHttpRequest();
	req.onreadystatechange = function() {
		if (req.readyState != 4) return;
		var tr = btn.parentNode.parentNode;
		var title = tr.getElementsByTagName("td")[0].firstChild.nodeValue;
		var response = JSON.parse(req.responseText);
		if (response.result == "200 OK") {		
			tr.parentNode.removeChild(tr);
			showMessage("Новость <strong>" + title + "</strong> успешно удалена", "info");
		} else {
			showMessage("Ошибка. Новость <strong>" + title + "</strong> не удалена", "danger");
		}
	}
	req.open("GET","deleteNews.php?id=" + id + "", true);
	req.send(null);
}