function editIcon(index, name) {
    var newName = prompt("Edit icon name", name);
    if (newName && newName != name) {
        window.location.replace("/?a=renameIcon&name=" + newName + "&index=" + index);
    }
}