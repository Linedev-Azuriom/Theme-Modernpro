var nav_active = false;
document.getElementById("mobile-btn").addEventListener('click', function (e) {
    e.preventDefault();

    if (nav_active) {
        nav_active = false;
        document.getElementById('nav-btn-icon').innerHTML = '<i class="bi bi-list"></i>'
        document.getElementById('mobile-nav').style.transform = 'translateX(-100vw)'
    } else {
        nav_active = true;
        document.getElementById('nav-btn-icon').innerHTML = '<i class="bi bi-x-lg"></i>'
        document.getElementById('mobile-nav').style.transform = 'translateX(0px)'
    }
});

document.getElementById("go-to-bottom").addEventListener('click', function () {
    window.scrollTo(0, document.querySelector("#go-to-bottom-div").scrollHeight + 350)

});
