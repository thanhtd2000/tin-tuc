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
var add_post = document.getElementById('add_post');

var post_an_article = document.getElementById('post_an_article');
var cancel_post = document.getElementById('cancel_post');
add_post.addEventListener("click", function () {
    add_post.style.display = 'none';
    post_an_article.style.display = 'block';
})
cancel_post.addEventListener("click", function () {
    add_post.style.display = 'block';
    post_an_article.style.display = 'none';
})
//// comment
const myButton = document.querySelector('#myButton');

myButton.addEventListener('click', () => {
    console.log('Button clicked!');
});