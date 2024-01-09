function check(){
    var uname = document.getElementById('username').value;
    var pass = document.getElementById('password').value;
    var cpass = document.getElementById('cpassword').value;
    var upperCaseLetters = /[A-Z]/g;
    var lowerCaseLetters = /[a-z]/g;
    var flags = [0,0,0];
    var sum = 0;

    for(let i of uname){
        if(!(isNaN(i))){
            console.log(i);
            alert("Username should not contain any numbers or spaces!!!");
            document.getElementById('username').value = "";
            document.getElementById('username').focus();
            return false;     
        }
    }
    for(let i of pass){
        if(!isNaN(i)){
            flags[0] = 1;
        }else if(i.match(lowerCaseLetters)){
            flags[1] = 1;
        }else if(i.match(upperCaseLetters)){
            flags[2] = 1;
        }else{
            continue;
        }
    }
    for(let i of flags){
        sum = sum+i;
    }

    if((uname.length < 6)||(uname.length > 32)){
        alert("Username should be between 6 to 32 letters!!!");
        document.getElementById('username').value = "";
        document.getElementById('username').focus();
        return false;
    }else if((pass.length < 8)||(pass.length > 32||(sum !== 3))){
        alert("Password should be between 8 to 32 letters and must contain atleast one capital letter, one small letter, one number!!!");
        document.getElementById('password').value = "";
        document.getElementById('password').focus();
        return false;
    }else if(cpass !== pass){
        alert("Confirm password and password do not match!!!");
        document.getElementById('cpassword').value = "";
        document.getElementById('cpassword').focus = "";
        return false;
    }else{
       return true;
    }
}