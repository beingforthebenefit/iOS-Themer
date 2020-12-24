function editIcon(index, name) {
    var newName = prompt("Edit icon name", name);
    if (newName == '') {
        newName = ' ';
    }
    if (newName != null && newName != name) {
        window.location.replace("/?a=renameIcon&name=" + newName + "&index=" + index + "#phone");
    }
    console.log(newName);
}