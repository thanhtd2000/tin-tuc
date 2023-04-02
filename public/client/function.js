var userSettings = document.querySelector(".user-settings");
var darkBtn = document.getElementById("dark-button");
var LoadMoreBackground = document.querySelector(".btn-LoadMore");
function UserSettingToggle() {
    userSettings.classList.toggle("user-setting-showup-toggle");
}
// darkBtn.onclick = function(){
//     darkBtn.classList.toggle("dark-mode-on");
// }

function darkModeON() {
    darkBtn.classList.toggle("dark-mode-on");
    document.body.classList.toggle("dark-theme");
};

function LoadMoreToggle() {
    LoadMoreBackground.classList.toggle("loadMoreToggle");
};
////// add post user

//// comment
// Lắng nghe sự kiện click vào thẻ có class "reply_comment"
// $(document).ready(function () {
//     $(".reply_comment").click(function (event) {
//         event.preventDefault();
//         $(this).parents(".voting-icons").siblings(".reply_comment_form").show();
//     });

//     $(".reply_comment_complete").click(function () {
//         $(this).parents(".reply_comment_form").hide();
//     });
// });
