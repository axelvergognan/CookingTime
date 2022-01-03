var j = 0;
var original2 = document.getElementById('ustensile0');
function duplicate2() {
    var clone2 = original2.cloneNode(true);
    clone2.id = "ustensile" + ++j;
    original2.parentNode.appendChild(clone2);
    $("#ustensile").load(window.location.href + " #ustensile");
}

function removeElement(id) {
    var elem = document.getElementById(id);
    id.parentNode.remove();
}