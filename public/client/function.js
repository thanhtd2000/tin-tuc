var userSettings = document.querySelector(".user-settings");
var darkBtn = document.getElementById("dark-button");
function UserSettingToggle() {
    userSettings.classList.toggle("user-setting-showup-toggle");
}
var notibtn = document.querySelector(".notibtn");

function darkModeON() {
    darkBtn.classList .toggle("dark-mode-on");
    document.body.classList.toggle("dark-theme");
};



