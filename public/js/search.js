async function fetchApps() {
    var country = document.getElementById('country').value
    var term = document.getElementById('text').value;
    const response = await fetch('https://itunes.apple.com/search?entity=software&country=' + country + '&limit=5&term=' + term);
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
    document.getElementById('label').value = apps['results'][0]['trackName'];
}

function removeAllChildNodes(parent) {
    while (parent.firstChild) {
        parent.removeChild(parent.firstChild);
    }
}

function insertSelection(list, label) {
    var apps = document.getElementById(list);
    var selection = apps.children.item(apps.selectedIndex).text;
    var labelField = document.getElementById(label);
    labelField.value = selection;
}

function removeSearch() {
    document.getElementById('text').remove();
}