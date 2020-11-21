function toggleEditMode() {
    apps = document.getElementsByClassName("app");
    for (const app of apps) {
        app.classList.toggle('wiggle');
    }
    buttons = document.getElementsByClassName("delete-button");
    for (const button of buttons) {
        button.classList.toggle('hidden');
    }
}
