/*
var k = 0;

var original3 = document.getElementById('etape0');
function duplicate3() {
    var clone3 = original3.cloneNode(true);
    clone3.id = "ingredient" + ++k;
    original3.parentNode.appendChild(clone3);
   // $("#etape").load(window.location.href + "#etape");
}
*/

var i, j, k = 0;
var original = document.getElementById('ingredient0');
var original2 = document.getElementById('ustensile0');
var original3 = document.getElementById('etape0');

function duplicateIng() {
    var clone = original.cloneNode(true);
    clone.id = "ingredient" + ++i;
    original.parentNode.appendChild(clone);
    // $("#etape").load(window.location.href + "#etape");
}

function duplicateUst() {
    var clone2 = original2.cloneNode(true);
    clone2.id = "ustensile" + ++j;
    original2.parentNode.appendChild(clone2);
    // $("#etape").load(window.location.href + "#etape");
}

function duplicateEta() {
    var clone3 = original3.cloneNode(true);
    clone3.id = "etape" + ++k;
    original3.parentNode.appendChild(clone3);
    // $("#etape").load(window.location.href + "#etape");
}

function removeElement(id) {
    var elem = document.getElementById(id);
    id.parentNode.remove();
}