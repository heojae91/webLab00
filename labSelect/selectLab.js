"use strict";

document.observe("dom:loaded", function() {
	/* Make necessary elements Dragabble / Droppables (Hint: use $$ function to get all images).
	 * All Droppables should call 'labSelect' function on 'onDrop' event. (Hint: set revert option appropriately!)
	 * 필요한 모든 element들을 Dragabble 혹은 Droppables로 만드시오 (힌트 $$ 함수를 사용하여 모든 image들을 찾으시오).
	 * 모든 Droppables는 'onDrop' 이벤트 발생시 'labSelect' function을 부르도록 작성 하시오. (힌트: revert옵션을 적절히 지정하시오!)
	 */
	 var images = $$("#labs>img");
	 for (var i = 0; i < images.length; i++)
	 {
	 	new Draggable(images[i], {revert: true});
	 }
	 Droppables.add("selectpad", {onDrop: labSelect});

	 var selectedImages = $$("#selectpad>img");
	 for (var i = 0; i < selectedImages.length; i++)
	 {
	 	new Draggable(selectedImages(images[i], {revert: true}));
	 }
	 Droppables.add("labs", {onDrop:labSelect});
});

function labSelect(drag, drop, event) {
	/* Complete this event-handler function 
	 * 이 event-handler function을 작성하시오.
	 */
	var inputFlag = 1;
	var selected = $$("#selection>li");
	if (drop.id != drag.id)
	{
		if (drop.id == "selectpad")
		{
			if (selected.length < 3)
			{
				for (var i = 0; i < selected.length; i++)
				{
					if (drag.getAttribute("alt") == selected[i].getAttribute("alt"))
					{
						inputFlag = 0;
						break;
					}
				}
				if (inputFlag == 1)
				{
					$("labs").removeChild(drag);
					$("selectpad").appendChild(drag);
					var li = document.createElement("li");
					li.innerHTML = drag.getAttribute("alt");
					$("selection").appendChild(li);
					li.pulsate({
						duration: 1.0,
						delay: 0.5
					});
				}
			}
		}
		else if (drop.id != "selectpad")
		{
			if (drag.parentNode.id == "selectpad")
			{
				$("selectpad").removeChild(drag);
				$("labs").appendChild(drag);
				var li;
				for (var i = 0; i < selected.length; i++)
				{
					if (drag.getAttribute("alt") == selected[i].innerHTML)
					{
						li = selected[i];
					}
				}
				
				$("selection").removeChild(li);
			}
		}
	}
}