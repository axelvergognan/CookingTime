var i = 0;
var original = document.getElementById('ingredient0');
function duplicate() {
    var clone = original.cloneNode(true);
    clone.id = "ingredient" + ++i;
    original.parentNode.appendChild(clone);
    $("#ingredient").load(window.location.href + " #ingredient");
}
