"use strict";
var stack = [];

window.onload = function () {
    var displayVal = "0";
    for (var i in $$('button')) {
        $$('button')[i].onclick = function () {
            var value = $(this).innerHTML;
            if (value == "AC") {
                displayVal = value;
                stack = [];
                displayVal = 0;
            } else if (value == ".") {
                if (displayVal.indexOf(".") == -1) {
                    displayVal += value;
                }
            } else if (value == "(" || value == ")") {
                if (parseInt(stack[length-1]) != NaN) {
                    stack.push(value);
                }
                if (value == ")") {
                    stack.push(displayVal);
                    stack.push(value);
                }
            } else if (value >= 0 && value < 10) {
                if (displayVal == 0) {
                    displayVal = value;
                } else {
                    displayVal = "" + displayVal + value;
                }
            } else {
                if (value == "=") {
                    stack = infixToPostfix(stack);
                    displayVal = postfixCalculate(stack);
                } else {
                    stack.push(displayVal)
                    displayVal = 0;
                    $('expression').innerHTML = value;
                    stack.push(value);
                }
            }
            $('expression').innerHTML = stack;
            $('result').innerHTML = displayVal;
        };
    }
};

function isValidExpression(s) {
    var countOpen = 0;
    var countClose = 0;
    for (var i = 0; i < stack.length; i++) {
        if (stack[i] == "(") {
            countOpen++;
        } else if (stack[i] = ")") {
            countClose++;
        }
    }
    return countOpen == countClose;
}

function infixToPostfix(s) {
    var priority = {
        "+":0,
        "-":0,
        "*":1,
        "/":1
    };
    var tmpStack = [];
    var result = [];
    for(var i =0; i<stack.length ; i++) {
        if(/^[0-9]+$/.test(s[i])){
            result.push(s[i]);
        } else {
            if(tmpStack.length === 0){
                tmpStack.push(s[i]);
            } else {
                if(s[i] === ")"){
                    while (true) {
                        if(tmpStack.last() === "("){
                            tmpStack.pop();
                            break;
                        } else {
                            result.push(tmpStack.pop());
                        }
                    }
                    continue;
                }
                if(s[i] ==="(" || tmpStack.last() === "("){
                    tmpStack.push(s[i]);
                } else {
                    while(priority[tmpStack.last()] >= priority[s[i]]){
                        result.push(tmpStack.pop());
                    }
                    tmpStack.push(s[i]);
                }
            }
        }
    }
    for(var i = tmpStack.length; i > 0; i--){
        result.push(tmpStack.pop());
    }
    return result;
}

function postfixCalculate(s) {
    var tmpStack = [];

    for (var i = 0; i < s.length; i++) {
        if (!isNaN(s[i])) { // 숫자일 경우        
            tmpStack.push(s[i]);
        } else {
            var first = tmpStack.pop();
            var second = tmpStack.pop();            
            if (s[i] == "+") {
                tmpStack.push(first + second);
            } else if (s[i] == "-") {
                tmpStack.push(second - first);
            } else if (s[i] == "*") {
                tmpStack.push(first * second);
            } else if (s[i] == "/") {
                tmpStack.push(second / first);
            }
        }
    }
    return tmpStack[0];
}
