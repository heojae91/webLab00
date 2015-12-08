"use strict";
var stack = [];
var exp = "";
var errorFlag = 0;

window.onload = function () {
    var displayVal = "0";
    for (var i in $$('button')) {
        $$('button')[i].onclick = function () {
            var value = $(this).innerHTML;
            try {
                if (errorFlag ==0 && (value >= 0 || value < 10)) {
                    console.log(errorFlag);
                    if (stack[stack.length - 1] == ")") {
                        stack.push("*");
                    }
                    if ("" + displayVal === "0") {
                        displayVal = value;
                    }
                    else {
                        displayVal = "" + displayVal + value;
                    }
                } else if (value == "AC") {
                    stack = [];
                    displayVal = 0;
                    errorFlag = 0;
                } else if (value == "." && errorFlag == 0) {
                    if (stack[0] === undefined || displayVal.indexOf(".") == -1) {
                        displayVal += value;
                    }
                } else if ((value == "(" || value == ")") && errorFlag == 0) {
                    if (stack == [] || displayVal == 0) {
                        if (stack[stack.length-1] == ")" && value == "(") {
                            stack.push("*");
                        } else if (stack[stack.length-1] == "(" && value == ")") {
                            stack.push(0);
                        }
                        stack.push(value);
                    } else if (value == "(") {
                        stack.push(displayVal);
                        stack.push("*");
                        stack.push(value);
                        displayVal = 0;
                    } else if (value == ")") {
                        stack.push(displayVal);
                        stack.push(value);
                    }
                    displayVal = 0;
                } else if (errorFlag == 0) {
                    if (value == "=") {
                        if (displayVal != 0) {
                            stack.push(displayVal);
                        } else if (stack[length-1] == "+" || stack[length-1] == "-" || stack[length-1] == "*" || stack[length-1] == "/") {
                            stack.push(0);
                        }
                        if (isValidExpression(stack)) {
                            stack = infixToPostfix(stack);
                            displayVal = postfixCalculate(stack);
                            stack = [];
                            if (displayVal == undefined || isNaN(displayVal)) {
                                alert("Wrong answer!");
                                errorFlag = 1;
                            }
                        } else {
                            errorFlag = 1;
                            console.log(errorFlag);
                            alert("Invalid Input!");
                        }
                    } else { // equal을 제외한 모든 경우
                        if (stack[0] === undefined && displayVal == 0) {
                            alert("You need to input at least 1 num");
                        } else if (stack[stack.length-1] == ")") {
                            stack.push(value);
                        } else if (stack[stack.length-1] == "(") {
                            stack.push(displayVal);
                            stack.push(value);
                        } else if (isNaN(stack[stack.length - 1]) && displayVal == 0) {
                            stack.pop();
                            stack.push(value);
                        } else {
                            stack.push(displayVal);
                            stack.push(value);
                        }
                        displayVal = 0;
                    }
                }
            }
            catch (err) {
                alert("error occurred!");
                errorFlag = 1;
            }
            $('expression').innerHTML = stack.join(" ");
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
        } else if (stack[i] == ")") {
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
        if(/^[0.0-9.9]+$/.test(s[i])){
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
    s.reverse();
    var tmpStack=[];
    var loop = s.length;
    for (var i = 0; i < loop; i++)
    {
        var tmp = s.pop();
        if (!isNaN(tmp)) { // 숫자
            tmpStack.push(tmp);
        } else {
            var first = tmpStack.pop();
            var second = tmpStack.pop();
            if (tmp == "+") {
                second *= 1;
                first *= 1;
                tmpStack.push(second + first);
            } else if (tmp == "-") {
                tmpStack.push(second - first);
            } else if (tmp == "*") {
                tmpStack.push(second * first);
            } else if (tmp == "/") {
                tmpStack.push(second / first);
            }
        }
    }
    return tmpStack[0];
}
