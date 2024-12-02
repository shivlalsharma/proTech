let flag = 0;
let hidden = document.getElementById('eye-close');
let password = document.getElementById('password');
let alert = document.querySelectorAll('.error');
const uppercase = new RegExp("(?=.*?[A-Z])");
const lowercase = new RegExp("(?=.*?[a-z])");
const digit = new RegExp("(?=.*?[0-9])");
const specialChar = new RegExp("(?=.*?[#?!@$%^&*-])");
const eightChar = new RegExp(".{8,}");
const email = new RegExp("^([a-zA-Z0-9._%-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,})$");
const white = new RegExp("\\s");

function toggle(){
    if(password.type === "password"){
        password.type = "text";
        hidden.classList.remove('fa-eye-close');
        hidden.classList.add('fa-eye');
    }
    else{
        password.type = "password";
        hidden.classList.remove('fa-eye');
        hidden.classList.add('fa-eye-close');
    }
}

function check1(data){
    if(data.length > 0){
        if(white.test(data) == 1){
            alert[0].innerText="Do not enter white space";
            flag = 0;
        }  
        else if(uppercase.test(data) == 0){
            alert[0].innerText="Enter atleast 1 uppercase letter";
            flag = 0;
        }   
        else if(lowercase.test(data) == 0){
            alert[0].innerText="Enter atleast 1 lowercase letter";
            flag = 0;
        }   
        else if(digit.test(data) == 0){
            alert[0].innerText="Enter atleast 1 digit";
            flag = 0;
        }   
        else if(specialChar.test(data) == 0){
            alert[0].innerText="Enter atleast 1 special character";
            flag = 0;
        }   
        else if(eightChar.test(data) == 0){
            alert[0].innerText="Enter atleast 8 character";
            flag = 0;
        }   
        else{
            alert[0].innerText="";
            flag = 1;
        }
    }
    else{
        alert[0].innerText="";
        flag = 0;
    }
}

function check2(data){
    if(data.length > 0){
        if(data != password.value){
            alert[1].innerText = "Incorrect confirm password";
            flag = 0;
        }
        else{
            alert[1].innerText = "";
            flag = 1;
        }
    }
    else{
        alert[1].innerText = "";
        flag = 0;
    }
}

function validate(){
    if(flag === 1){
        return true;
    }
    else{
        return false;
    }
}