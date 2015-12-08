var interval = 3000;
var numberOfBlocks = 9;
var numberOfTarget = 3;
var targetBlocks = [];
var selectedBlocks = [];
var timer;

document.observe('dom:loaded', function(){
	for (var i in $$('div#trigger>div')) {
		alert(i);
		$$('div#trigger>div')[i].onclick = function () {
			var trigger = $(this).id;
			if (trigger == "start") {
				stopToStart();
			} else if (trigger == "stop") {
				stopGame();
			}
		}
	}
});

function stopToStart(){
    stopGame();
    startToSetTarget();
}

function stopGame(){
	if (targetBlocks.length > 0) {
		for (var i = 0; i < numberOfTarget; i++) {
			if (targetBlocks[i].hasClassName("target")) {
				targetBlocks[i].removeClassName("target");
			}
		}
	}
	if (selectedBlocks.length>0) {
		for (var i =0; i < numberOfTarget; i++) {
			if (selectedBlocks[i].hasClassName("selected")) {
				selectedBlocks[i].removeClassName("selected");
			}
		}
	}
	$('state').innerHTML = "Stop";
	$('answer').innerHTML = "0 / 0";
	clearInterval(timer);
	targetBlocks = [];
	selectedBlocks = [];
}

function startToSetTarget(){
	$('state').innerHTML = "Ready!";
	clearInterval(timer);
	targetBlocks = [];
	selectedBlocks = [];
	var select = 0;
	var rand;
	var randArray = [];
	while(select < numberOfTarget) {
		rand = Math.floor((Math.random() * 9));
		if (randArray.indexOf(rand) != -1)
			continue;
		randArray.push(rand);
		targetBlocks.push($$('div#blocks>div')[rand]);
		select++;
	}
	timer = setTimeout(setTargetToShow, interval);
}

function setTargetToShow(){
	$('state').innerHTML = "Memorize!";
	for (var i = 0; i < targetBlocks.length; i++) {
		targetBlocks[i].addClassName("target");
	}
	timer = setTimeout(showToSelect, interval);
}

function showToSelect(){
	$('state').innerHTML = "Select!";
	for (var i=0; i < 3; i++) {
		targetBlocks[i].removeClassName("target");
	}
	for (var i in $$('div#blocks>div')) {
		$$('div#blocks>div')[i].onclick = function () {
			if (selectedBlocks.length == 3) {
				for (var i in $$('div#blocks>div')) {
					$$('div#blocks>div')[i].onclick = null;
				}
			} else {
				if ($(this).hasClassName("selected")) {
					alert("You selected this block twice!");
				} else {
					$(this).addClassName("selected");
					selectedBlocks.push($(this));
				}
			}
		}
	}
	timer = setTimeout(selectToResult, interval);
}

function selectToResult(){
	$('state').innerHTML = "Checking";	
	if (selectedBlocks.length > 0) {
		for (var i=0; i < 3; i++) {
			selectedBlocks[i].removeClassName("selected");
		}
	}
	for (var i in $$('div#blocks>div')) {
		$$('div#blocks>div')[i].onclick = null;
	}
	var counter = $('answer').innerHTML;
	var splittedCounter = counter.split(" / ");
	var answerCounter = 0;
	for (var i = 0; i < numberOfTarget; i++) {
		if (targetBlocks.indexOf(selectedBlocks[i]) != -1)
			answerCounter++;
	}
	splittedCounter[0] *= 1;
	splittedCounter[1] *= 1;

	splittedCounter[0] += answerCounter;
	splittedCounter[1] += numberOfTarget;

	$('answer').innerHTML = splittedCounter.join(" / ");
	timer = setTimeout(startToSetTarget, interval);
}