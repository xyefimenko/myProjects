// Example starter JavaScript for disabling form submissions if there are invalid fields
    (function() {
    'use strict';
    window.addEventListener('load', function() {
    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    var forms = document.getElementsByClassName('needs-validation');
    // Loop over them and prevent submission
    var validation = Array.prototype.filter.call(forms, function(form) {
    form.addEventListener('submit', function(event) {
    if (form.checkValidity() === false || totalCheck() == false) {
    event.preventDefault();
    event.stopPropagation();
    document.getElementById('Error').style.display = 'flex';
}
    form.classList.add('was-validated');
}, false);
});
}, false);
})();
/*
isNameEmpty() === false || isCityEmpty() === false || isLastNameEmpty() === false
|| ageTest() === false || checkEmeil() === false)
*/

function totalCheck(){
    isNameEmpty();
    isLastNameEmpty();
    isCityEmpty();
    ageTest();
    checkEmeil();
}

    function ineVisible(){
    var selectValue = document.getElementById("validationCustom04").value;
    if(selectValue === "INE"){
        document.getElementById('ineButton').style.display = 'block';
    }
  //  console.log(selectValue);
}

function vision(){
    document.getElementById('invisible').style.display = 'block';
}
function invision(){
    document.getElementById('invisible').style.display = 'none';
}

function bandSelect(){
    var selectValue = document.getElementById("validationCustom06").value;
    if(selectValue === "metallica"){
        document.getElementById('invisibleMetallica').style.display = 'block';
    } else if(selectValue === "bfmv"){
        document.getElementById('invisibleBullet').style.display = 'block';
    } else if(selectValue === "slipknot"){
        document.getElementById('invisibleSlipknot').style.display = 'block';
    }
}

function bulletAlbum(){
    var sel = document.getElementById("bulletAlbums").value;
    if(sel === "poison"){
        document.getElementById('invisiblePoison').style.display = 'block';
    } else if(sel === "gravity"){
        document.getElementById('invisibleGravity').style.display = 'block';
    } else if(sel === "scream"){
        document.getElementById('invisibleScreamAimFire').style.display = 'block';
    }
}

function isNameEmpty(){
    var name = document.getElementById('validationCustom01').value
    if(name.includes(" ")){
        alert("Zadajte spravnu/neprazdnu hodnotu")
        return false;
    }
    return true;
}

function isLastNameEmpty(){
    var name = document.getElementById('validationCustom02').value
    if(name.includes(" ")){
        alert("Zadajte spravnu/neprazdnu hodnotu")
        return false
    }
    return true;
}

function isCityEmpty(){
    var name = document.getElementById('validationCustom03').value
    if(name.includes(" ")){
        alert("Zadajte spravnu/neprazdnu hodnotu")
        return false
    }
    return true;
}

function ageTest(){
    const vek = document.forms['myForm']['vek'].value;
    var userAge = new Date() - new Date(document.forms['myForm']['datumNarodnenia'].value);
    userAge = userAge / 1000 / (60 * 60 * 24);
    userAge = Math.floor(userAge / 365.25)
    // console.log(userAge)
    // console.log(vek)
    if(userAge != vek){
        alert("Zadajte spravny vek")
        return false;
    }
    return true;
}

function checkEmeil(){
    var pattern="^[a-z0-9._%+-]{3,}@[a-z]{3,}([.]{1}[a-z]{2,}|[.]{1}[a-z]{2,}[.]{1}[a-z]{2,})$"
    if (/[a-z0-9._%+-]{3,}@[a-z]{3,}([.]{1}[a-z]{2,}|[.]{1}[a-z]{2,}[.]{1}[a-z]{2,})$/.test(document.getElementById("exampleInputEmail1").value))
    {
        alert("emeil is ok")
        return true
    } else {
        alert("Nespravny emeil")
        return false
    }
}

/*

function fun1() {
    var agreeVal;
    var chbox;
    chbox=document.getElementById('invalidCheck');
    if (chbox.checked) {
        agreeVal = 1;
      //  alert('Выбран');
        document.forms['myForm']['agree'].value = 1;
    }
    else {
        agreeVal = 0;
      //  alert ('Не выбран');
    }
    if (agreeVal === 1){
       // console.log("Gotovo")
    } else {
      //  console.log("aaaaaaaaaaa")
     //   console.log(agreeVal)
    }
}

function chekEmpty(){
    const firstname = document.forms['myForm']['name'].value;
    if(firstname.length <= 2 || firstname.value === " "){

    }
}

function asd(){
    const firstname = document.forms['myForm']['name'].value;
    //console.log(name)

    const city = document.forms['myForm']['city'].value;
   // console.log(city)
    const agree = document.forms['myForm']['agree'].value;

  //  console.log(agree)
   // setTimeout(alert("4 seconds"),4000);
}


const form = document.getElementById("form")
const firstname = document.getElementById("validationCustom01")
const lastName = document.getElementById("validationCustom02")
const city = document.getElementById("validationCustom03a")
const state = document.getElementById("validationCustom04")
const ine = document.getElementById("validationCustom05")

/!*
form.addEventListener('submit', (e) => {
    e.preventDefault();


})
*!/


function setErrorFor(input, message){
    const formControl = input.childElementCount
    const small = formControl.querySelector('small')

}
function submitmy(){
    const firstName = document.forms['myForm']['name'].value;
    const lastName = document.forms['myForm']['lastName'].value;
    const city = document.forms['myForm']['city'].value;
    const state = document.getElementById("validationCustom04").value;
    const ine = document.forms['myForm']['ine'].value;
    if(firstName.includes(" ")){
        alert("Zadajte spravne meno")
        return false;
    }
    if(lastName.includes(" ")){
        alert("Zadajte spravne priezvsko")
        return false;
    }
    if(city.includes(" ")){
        alert("Zadajte spravne mesto")
        return false;
    }
    if (/[a-z0-9._%+-]{3,}@[a-z]{3,}([.]{1}[a-z]{2,}|[.]{1}[a-z]{2,}[.]{1}[a-z]{2,})$/.test(document.getElementById("exampleInputEmail1").value))
    {
        alert("emeil is ok")
    } else {
        alert("Nespravny emeil")
        return (false)
    }
    var chbox1=document.getElementById('defaultCheck1');
    var chbox2=document.getElementById('defaultCheck2');
    var chbox3=document.getElementById('defaultCheck3');
    var chbox4=document.getElementById('defaultCheck4');
    var chbox5=document.getElementById('defaultCheck5');
    if (chbox1.checked) {
        chbox1 = "Metallica"
       // alert('Выбран');
    }

    if (chbox2.checked) {
        chbox2 = "AC/DC"
      //  alert('Выбран');
    }

    if (chbox3.checked) {
        chbox3 = "Slayer"
       // alert('Выбран');
    }

    if (chbox4.checked) {
        chbox4 = "Papa Roach"
       // alert('Выбран');
    }

    if (chbox5.checked) {
        chbox5 = "Bullet For My Valentine"
       // alert('Выбран');
    }
    else {
       // alert ('Не выбран');
    }
    /!*console.log(firstName);
    console.log(lastName)
    console.log(city);
    console.log(state)
    console.log(ine)
    console.log(chbox1)
    console.log(chbox2)
    console.log(chbox3)
    console.log(chbox4)
    console.log(chbox5)*!/

    ageTest();
   // ineVisible()
    setTimeout(alert("4 seconds"),4000);
}

*/
//update this with your js_form selector
/*
var form_id_js = 'form';

var data_js = {
    "access_token": "{your access token}" // sent after you sign up
};

function js_onSuccess() {
    // remove this to avoid redirect
    window.location = window.location.pathname + "?message=Email+Successfully+Sent%21&isError=0";
}

function js_onError(error) {
    // remove this to avoid redirect
    window.location = window.location.pathname + "?message=Email+could+not+be+sent.&isError=1";
}

var sendButton = document.getElementById("sendButton");

function js_send() {
    sendButton.value='Sending…';
    sendButton.disabled=true;
    var request = new XMLHttpRequest();
    request.onreadystatechange = function() {
        if (request.readyState == 4 && request.status == 200) {
            js_onSuccess();
        } else
        if(request.readyState == 4) {
            js_onError(request.response);
        }
    };

    var subject = document.querySelector("#" + form_id_js + " [name='name']").value;
    var message = document.querySelector("#" + form_id_js + " [name='text']").value;
    data_js['name'] = subject;
    data_js['text'] = message;
    var params = toParams(data_js);

    request.open("POST", "denis27652@gmail.com", true);
    request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    request.send(params);

    return false;
}

sendButton.onclick = js_send();

function toParams(data_js) {
    var form_data = [];
    for ( var key in data_js ) {
        form_data.push(encodeURIComponent(key) + "=" + encodeURIComponent(data_js[key]));
    }

    return form_data.join("&");
}

var js_form = document.getElementById(form_id_js);
js_form.addEventListener("submit", function (e) {
    e.preventDefault();
});
*/
