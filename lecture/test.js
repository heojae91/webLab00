window.onload = function() {
	document.getElementById("ok").observer("click", function() {
		var sn = $("contect")["sir_name"];
		$("p1").innerHTML = $F(sn);
		
		$F // Form.InputElement.getValue
		if ($F("gn").length > 7) {
			$("gn").clear();
		}
		event.element().stopObserving(); // element에들어가야함 
	});
};   

// <form id="newForm".....
// <input name="company" type = "adss"
// 
// document.getElementById("newForm").getValue(document.querySelector(#newForm>input@name="company"))
// $("newForm").getValue(document.querySelector(#newForm>input@name="company"))
// $F("newForm")["company"]
