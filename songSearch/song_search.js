document.observe("dom:loaded", function() {
    $("b_xml").observe("click", function(){
    	new Ajax.Request("songs_xml.php", {
    		method: "get",
    		parameters: {top: $F("top")},
    		onSuccess: showSongs_XML,
    		onFailure: ajaxFailed
    	})
    });
    $("b_json").observe("click", function(){
        new Ajax.Request("songs_json.php", {
        	method: "get",
        	parameters: {top: $F("top")},
        	onSuccess: showSongs_JSON,
        	onFailure: ajaxFailed
        })
    });
});

function showSongs_XML(ajax) {
	var songs = ajax.responseXML.getElementsByTagName("song");
	while ($("songs").firstChild) {
		$("songs").removeChild($("songs").firstChild);
	}

	for (var i = 0; i < songs.length; i++) {
		var li = document.createElement("li");
		var title = songs[i].getElementsByTagName("title")[0].firstChild.nodeValue;
		var artist = songs[i].getElementsByTagName("artist")[0].firstChild.nodeValue;
		var genre = songs[i].getElementsByTagName("genre")[0].firstChild.nodeValue;
		var time = songs[i].getElementsByTagName("time")[0].firstChild.nodeValue;

		li.innerHTML = title + " - " + artist + " [" + genre + "] (" + time + ")";
		$("songs").appendChild(li);
	}
}

function showSongs_JSON(ajax) {
    var songs = JSON.parse(ajax.responseText).songs;
	while ($("songs").firstChild) {
		$("songs").removeChild($("songs").firstChild);
	}
	for (var i = 0; i < songs.length; i++) {
		var li = document.createElement("li");
		var title = songs[i].title;
		var artist = songs[i].artist;
		var genre = songs[i].genre;
		var time = songs[i].time;

		li.innerHTML = title + " - " + artist + " [" + genre + "] (" + time + ")";
		$("songs").appendChild(li);
	}

}

function ajaxFailed(ajax, exception) {
	var errorMessage = "Error making Ajax request:\n\n";
	if (exception) {
		errorMessage += "Exception: " + exception.message;
	} else {
		errorMessage += "Server status:\n" + ajax.status + " " + ajax.statusText + 
		                "\n\nServer response text:\n" + ajax.responseText;
	}
	alert(errorMessage);
}
