var navigation = "<div class='container-fluid'>" +
        "<!-- Brand and toggle get grouped for better mobile display -->" +
        "<div class='navbar-header'>" +
        "<button type='button' class='navbar-toggle collapsed' data-toggle='collapse' data-target='#bs-example-navbar-collapse-1'>" +
        "<span class='sr-only'>Toggle navigation</span>" +
        "<span class='icon-bar'></span>" +
        "<span class='icon-bar'></span>" +
        "<span class='icon-bar'></span>" +
        "</button>" +
        "<a class='navbar-brand' href='./'><img src='img/LOGO.png' class='img-responsive center-block' alt=''></a>" +
        "</div>" +
        "<!-- Collect the nav links, forms, and other content for toggling -->" +
        "<div class='collapse navbar-collapse' id='bs-example-navbar-collapse-1'>" +
        "<ul class='nav navbar-nav'>" +
        "<li class='dropdown'>" +
        "<a href='carPool.html'>找共乘<span class='caret'></span></a>" +
        "<ul class='dropdown-menu' role='menu'>" +
        "<li>我是司機</li>" +
        "<li><a href='post.html'>刊登服務行程</a></li>" +
        "<li><a href='search.html'>共乘接單</a></li>" +
        "<li>我是乘客</li>" +
        "<li><a href='post1.html'>刊登需求行程</a></li>" +
        "<li><a href='search1.html'>共乘委託</a></li>" +
        "</ul>" +
        "</li>" +
        "<li class='dropdown'>" +
        "<a href='delivery.html'>找外送<span class='caret'></span></a>" +
        "<ul class='dropdown-menu' role='menu'>" +
        "<li><a href='post2.html'>刊登覓食行程</a></li>" +
        "<li><a href='search2.html'>委託順路外送</a></li>" +
        "</ul>" +
        "</li>" +
        "<li class='dropdown'>" +
        "<a href='groupBuy.html'>找團購<span class='caret'></span></a>" +
        "<ul class='dropdown-menu' role='menu'>" +
        "<li><a href='post3.html'>開團</a></li>" +
        "<li><a href='search3.html'>跟團</a></li>" +
        "</ul>" +
        "</li>" +
        "<li class='dropdown'>" +
        "<a href='myEvent.html'>MY活動<span class='caret'></span></a>" +
        "<ul class='dropdown-menu' role='menu'>" +
        "<li><a href='event.html'>享受共乘服務</a></li>" +
        "<li><a href='event1.html'>執行共乘任務</a></li>" +
        "<li><a href='event2.html'>享受外送服務</a></li>" +
        "<li><a href='event3.html'>執行外送任務</a></li>" +
        "<li><a href='event4.html'>團主管理</a></li>" +
        "<li><a href='event5.html'>跟團紀錄</a></li>" +
        "</ul>" +
        "</li>" +
        "</ul>" +
        "<ul class='nav navbar-nav navbar-right' >" +
        "<li id='log_area'><a href='Login.php' data-toggle='modal' data-target='.bs-example-modal-sm'>登入</a></li>" +
        "<li id='acc_area'><a href='userdata.html'><div id='set_acc'></div></a></li>" +
        "<li id='logout_area'><a href='#' id='logout'>登出</a></li>" +
        "</ul>" +
        "</div>" +
        "</div>";
$('#navigation').append(navigation);
$(document).ready(function () {
    checklogin();
});

function checklogin() {
    function myCallback() {
        if (xhr.readyState < 4) {
            return; // not ready yet
        }
        if (xhr.status !== 200) {
            alert('Error!'); // the HTTP status code is not OK
            return;
        }
        var person = JSON.parse(xhr.responseText);

        if (person.islogin) {
            document.getElementById("set_acc").innerHTML = person.account;
            document.getElementById("acc_area").style.display = "";
            document.getElementById("log_area").style.display = "none";
            document.getElementById("logout_area").style.display = "";
            if (document.getElementById("notloginmain") !== null) {
                document.getElementById("notloginmain").style.display = "none";
                document.getElementById("loginmain").style.display = "";
            }
        } else {
            document.getElementById("acc_area").style.display = "none";
            document.getElementById("logout_area").style.display = "none";
            document.getElementById("log_area").style.display = "";
            if (document.getElementById("notloginmain") !== null) {
                document.getElementById("notloginmain").style.display = "";
                document.getElementById("loginmain").style.display = "none";
            }
        }

    }

    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = myCallback;

    xhr.open('GET', 'IsLogin.php', true);
    xhr.send('');
}

$('#logout').click(function logout() {
    function myCallback() {
        if (xhr.readyState < 4) {
            return; // not ready yet
        }
        if (xhr.status !== 200) {
            alert('Error!'); // the HTTP status code is not OK
            return;
        }
        checklogin();
    }
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = myCallback;
    xhr.open('GET', 'Logout.php', true);
    xhr.send('');
});

