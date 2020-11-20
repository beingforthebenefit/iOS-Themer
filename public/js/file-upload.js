function updateText(icontext, icon) {
    document.getElementById(icontext).innerHTML = "\"" + document.getElementById(icon).files[0].name + "\" selected.";
}

function updateText2(icontext, icon) {
    console.log(document.getElementById(icon));
    document.getElementById(icontext).innerHTML = document.getElementById(icon).files.length + ' file(s) selected.';
}