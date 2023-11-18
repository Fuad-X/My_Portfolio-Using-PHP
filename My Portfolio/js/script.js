function setCookie(cookieName, cookieValue, cookieExpireDay) {
    const date = new Date();
    date.setTime(date.getTime() + (cookieExpireDay * 24 * 60 * 60 * 1000));
    let cookieExpireTimeInMicroSeconds = "expires="+date.toUTCString();
    document.cookie = cookieName + "=" + cookieValue + ";" + cookieExpireTimeInMicroSeconds + ";path=/";
}

function getCookie(cookieName) {
    let modifiedCookieName = cookieName + "=";
    let allCookies = document.cookie.split(';');
    for(let i = 0; i < allCookies.length; i++) {
      let cookieName = allCookies[i];
      while (cookieName.charAt(0) == ' ') {
        cookieName = cookieName.substring(1);
      }
      if (cookieName.indexOf(modifiedCookieName) == 0) {
        return cookieName.substring(modifiedCookieName.length, cookieName.length);
      }
    }
    return "";
}

let userPreference = [null, null, null];

function checkIfCookiesSaved() {
    let cookieValue = getCookie("theme");
    if (cookieValue === "") {
        userPreference[0] = 0;
        setCookie("theme", 0, 30);
    }
    else{
        userPreference[0] = cookieValue;
    }

    cookieValue = getCookie("position");
    if (cookieValue === "") {
        userPreference[1] = 0;
        setCookie("position", 0, 30);
    }
    else{
        userPreference[1] = cookieValue;
    }

    cookieValue = getCookie("content");
    if (cookieValue === "") {
        userPreference[2] = 0;
        setCookie("content", 0, 30);
    }
    else{
        userPreference[2] = cookieValue;
    }
    loadContent();
    loadPosition();
    loadTheme();
}

let preferences = {
    theme   : {
        Light:[
            "#FBFFDC",
            "black",
            "black",
            "white",
            "#b6b6bb",
        ],
        Dark:[
            "#0F0E0E",
            "white",
            "white",
            "black",
            "#323232",
        ]
    },
    position: ["Top"  , "Left"],
    content : {
        Text: [
            "Home",
            "Blogs",
            "About",
            "Contact",
            "Preference",
            ["Light", "Dark"],
            ["Top", "Left"],
            "Text", 
            ["Sign Up", "Sign In", "Sign Out"],
            "20%",
        ],
        Icon: [
            '<i class="fa-solid fa-house"></i>',
            '<i class="fa-solid fa-book"></i>',
            '<i class="fa-solid fa-address-card"></i>',
            '<i class="fa-solid fa-envelope"></i>',
            '<i class="fa-solid fa-droplet"></i>',
            ['<i class="fa-solid fa-sun"></i>', '<i class="fa-solid fa-moon"></i>'],
            ['<i class="fa-solid fa-up-long"></i>', '<i class="fa-solid fa-left-long"></i>'],
            '<i class="fa-solid fa-icons"></i>',
            ['<i class="fa-solid fa-user-pen"></i>', '<i class="fa-solid fa-right-to-bracket"></i>', '<i class="fa-solid fa-right-from-bracket"></i>'],
            "40px",
        ],
    },
};

let allPreferences = [["Light", "Dark"],["Top", "Left"],["Text","Icon"]];

function contentToggle(){
    if(userPreference[2] === null){
        userPreference[2] = 0;
    }
    else if(userPreference[2] === 0){
        userPreference[2] = 1;
        setCookie("content", 1, 30);
    }
    else{
        userPreference[2] = 0;
        setCookie("content", 0, 30);
    }

    loadContent();
}

function loadContent(){
    var content = allPreferences[2][userPreference[2]];

    const navItemHolder = document.getElementById('nav-item-holder');
    const navLinks = navItemHolder.querySelectorAll('.nav-link');

    const topCollapsedNav = document.getElementById('top-collapsed-nav');
    const topNavLinks = topCollapsedNav.querySelectorAll('.nav-link');

    const leftCollapsedNav = document.getElementById('left-collapsed-nav');
    const leftNavLinks = leftCollapsedNav.querySelectorAll('.nav-link');
    
    leftNavLinks[0].innerHTML = topNavLinks[0].innerHTML = navLinks[0].innerHTML = preferences['content'][content][0];
    leftNavLinks[1].innerHTML = topNavLinks[1].innerHTML = navLinks[1].innerHTML = preferences['content'][content][1];
    leftNavLinks[2].innerHTML = topNavLinks[2].innerHTML = navLinks[2].innerHTML = preferences['content'][content][2];
    leftNavLinks[3].innerHTML = topNavLinks[3].innerHTML = navLinks[3].innerHTML = preferences['content'][content][3];
                                                           navLinks[4].innerHTML = preferences['content'][content][4];
    leftNavLinks[4].innerHTML = topNavLinks[4].innerHTML = navLinks[5].innerHTML = preferences['content'][content][5][userPreference[0]];
    leftNavLinks[5].innerHTML = topNavLinks[5].innerHTML = navLinks[6].innerHTML = preferences['content'][content][6][userPreference[1]];
    leftNavLinks[6].innerHTML = topNavLinks[6].innerHTML = navLinks[7].innerHTML = preferences['content'][content][7];

    if(document.getElementById('login-out').value === 'signin'){
        leftNavLinks[7].innerHTML = topNavLinks[7].innerHTML = navLinks[8].innerHTML = preferences['content'][content][8][1];
    }
    else if(document.getElementById('login-out').value === 'signout'){
        leftNavLinks[7].innerHTML = topNavLinks[7].innerHTML = navLinks[8].innerHTML = preferences['content'][content][8][2];
    }

    if(document.getElementById("left-collapsed-nav").style.width !== "0px"){
        document.getElementById("left-collapsed-nav").style.width = preferences['content'][content][9];
        document.getElementById("main-page").style.marginLeft = preferences['content'][content][9];
    }
}

function themeToggle(){
    if(userPreference[0] === null){
        userPreference[0] = 0;
    }
    else if(userPreference[0] === 0){
        userPreference[0] = 1;
        setCookie("theme", 1, 30);
    }
    else{
        userPreference[0] = 0;
        setCookie("theme", 0, 30);
    }
    loadTheme();
}

function loadTheme(){
    const root = document.documentElement;
    const themeBtns = document.querySelectorAll(".theme-toggle");
    
    var theme = allPreferences[0][userPreference[0]];

    root.style.setProperty("--main-bg-color", preferences['theme'][theme][0]);
    root.style.setProperty("--main-text-color", preferences['theme'][theme][1]);

    root.style.setProperty("--main-action-bg-color", preferences['theme'][theme][2]);
    root.style.setProperty("--main-action-text-color", preferences['theme'][theme][3]);

    root.style.setProperty("--second-main-bg-color", preferences['theme'][theme][4]);

    themeBtns.forEach(button =>{
        button.innerHTML = preferences['content'][allPreferences[2][userPreference[2]]][5][userPreference[0]];
    });
}

function positionToggle(){
    if(userPreference[1] === null){
        userPreference[1] = 0;
    }
    else if(userPreference[1] === 0){
        userPreference[1] = 1;
        setCookie("position", 1, 30);
    }
    else{
        userPreference[1] = 0;
        setCookie("position", 0, 30);
        mediaOnlyScreen();
    }
    
    loadPosition();
}

function loadPosition(){
    const positionBtns = document.querySelectorAll(".position-toggle");

    var position = allPreferences[1][userPreference[1]];

    if(position === preferences['position'][0]){
        document.getElementById("nav-brand").style.order = 1;
        document.getElementById("nav-brand").style.width = "auto";

        document.getElementById("nav-toggle").style.order = 2;
        document.getElementById("top-nav").classList.add("px-2");
        document.getElementById("nav-item-holder").style.display = "flex";
        document.getElementById("nav-toggle").style.display = "none";
        document.getElementById("left-collapsed-nav").style.width = "0px";
        document.getElementById("main-page").style.marginLeft = "0px";
        mediaOnlyScreen();
    }
    else{
        document.getElementById("nav-brand").style.order = 2;
        document.getElementById("nav-brand").style.width = "100%";

        document.getElementById("nav-toggle").style.order = 1;
        document.getElementById("top-nav").classList.remove("px-2");
        document.getElementById("nav-item-holder").style.display = "none";
        document.getElementById("nav-toggle").style.display = "block";
        document.getElementById("top-collapsed-nav").style.height = "0px"
    }

    positionBtns.forEach(button =>{
        button.innerHTML = preferences['content'][allPreferences[2][userPreference[2]]][6][userPreference[1]];
    });
}

function navToggle(){
    if(allPreferences[1][userPreference[1]] === "Top"){
        const topCollapsedNav = document.getElementById("top-collapsed-nav");
        if(topCollapsedNav.style.height === "0px"){
            topCollapsedNav.style.height = "100%";
        }
        else{
            topCollapsedNav.style.height = "0px";
        }
    }
    else if(allPreferences[1][userPreference[1]] === "Left"){
        const leftCollapsedNav = document.getElementById("left-collapsed-nav");
        if(leftCollapsedNav.style.width === "0px")
        {
            leftCollapsedNav.style.width = preferences['content'][allPreferences[2][userPreference[2]]][9];
            document.getElementById("main-page").style.marginLeft = preferences['content'][allPreferences[2][userPreference[2]]][9];
        }
        else{
            leftCollapsedNav.style.width = "0px";
            document.getElementById("main-page").style.marginLeft = "0px";
        }
    }
}

function mediaOnlyScreen(){
    if(allPreferences[1][userPreference[1]] === "Top"){
        if(window.innerWidth <= 640){
            document.getElementById("nav-item-holder").style.display = "none";
            document.getElementById("nav-toggle").style.display = "block";
        }
        else{
            document.getElementById("nav-item-holder").style.display = "flex";
            document.getElementById("nav-toggle").style.display = "none";
            document.getElementById("top-collapsed-nav").style.height = "0px";
        }
    }
}

function toggleModal(rModal){
    var modal = document.getElementById(rModal);
    
    if(modal.style.display === "block"){
        modal.style.display = "none";
    }
    else{
        modal.style.display = "block";
    }
}

function toastDismiss(){
    document.getElementById('toast').style.display = 'none';
}

function bodyOnLoad(){
    checkIfCookiesSaved();
    mediaOnlyScreen();
}

window.addEventListener('resize', mediaOnlyScreen);

window.onscroll = () =>{
    let navLinks = ['home', 'about', 'contact'];

    navLinks.forEach(navLink => {
        let top = window.scrollY+45;
        let home = document.getElementById(navLink);
        let homeOffset = home.offsetTop;
        let homeHeight = home.offsetHeight;
        let homeLinks = document.querySelectorAll('.'+navLink+'-link');
    
        if(top >= homeOffset && top < homeOffset + homeHeight){
            homeLinks.forEach(homeLink => {
                homeLink.classList.add('active');
            })
        }
        else{
            homeLinks.forEach(homeLink => {
                homeLink.classList.remove('active');
            })
        }
    })
}