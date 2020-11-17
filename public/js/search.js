async function fetchApps() {
    var term = document.getElementById('text').value;
    const response = await fetch('https://itunes.apple.com/search?entity=software&limit=5&term=' + term);
    const apps = await response.json();

    var list = document.getElementById('apps');
    list.disabled = false;
    removeAllChildNodes(list);
    apps['results'].forEach(app => {
        var option = document.createElement("OPTION");
        option.text = app['trackName'];
        option.value = app['bundleId'];
        list.appendChild(option);
    });
}

function removeAllChildNodes(parent) {
    while (parent.firstChild) {
        parent.removeChild(parent.firstChild);
    }
}

function insertSelection() {
    var apps = document.getElementById('apps');
    var selection = apps.children.item(apps.selectedIndex).text;
    var textField = document.getElementById('text');
    textField.value = selection;
}

function removeSearch() {
    document.getElementById('text').remove();
}