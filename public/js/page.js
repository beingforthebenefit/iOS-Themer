function changePage(page) {
    var pages = ['home', 'how-to', 'installer', 'icon-packs']
        .filter(function(item) {
            return item != page;
        });

    for (var i = 0; i < pages.length; i++) {
        console.log(pages[i]);
        document.getElementById(pages[i]).classList.add('hidden');
        document.getElementById(pages[i] + '-link').classList.remove('active');
    }

    document.getElementById(page).classList.remove('hidden');
    document.getElementById(page + '-link').classList.add('active');
}