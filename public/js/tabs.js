function switchTab(tab) {
    if (tab == '') {
        return;
    }
    form = document.getElementById(tab);
    if (form.id == 'app-store') {
        document.getElementById('system-app').classList.add('hidden');
        document.getElementById('custom-app').classList.add('hidden');
        document.getElementById('batch').classList.add('hidden');
        document.getElementById('tab1').classList.add('active');
        document.getElementById('tab2').classList.remove('active');
        document.getElementById('tab3').classList.remove('active');
        document.getElementById('tab4').classList.remove('active');
    } else if (form.id == 'system-app') {
        document.getElementById('app-store').classList.add('hidden');
        document.getElementById('custom-app').classList.add('hidden');
        document.getElementById('batch').classList.add('hidden');
        document.getElementById('tab2').classList.add('active');
        document.getElementById('tab1').classList.remove('active');
        document.getElementById('tab3').classList.remove('active');
        document.getElementById('tab4').classList.remove('active');
    } else if (form.id == 'custom-app') {
        document.getElementById('app-store').classList.add('hidden');
        document.getElementById('system-app').classList.add('hidden');
        document.getElementById('batch').classList.add('hidden');
        document.getElementById('tab3').classList.add('active');
        document.getElementById('tab1').classList.remove('active');
        document.getElementById('tab2').classList.remove('active');
        document.getElementById('tab4').classList.remove('active');
    } else {
        document.getElementById('app-store').classList.add('hidden');
        document.getElementById('system-app').classList.add('hidden');
        document.getElementById('custom-app').classList.add('hidden');
        document.getElementById('tab4').classList.add('active');
        document.getElementById('tab1').classList.remove('active');
        document.getElementById('tab2').classList.remove('active');
        document.getElementById('tab3').classList.remove('active');
    }
    form.classList.remove('hidden');
}
