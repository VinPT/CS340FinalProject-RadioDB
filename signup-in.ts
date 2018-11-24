var cover: HTMLElement = document.getElementById('cover');
var signBox: HTMLElement = document.getElementById('signBox');
var loginForm: HTMLElement = document.getElementById('login');
var signinForm: HTMLElement = document.getElementById('signin');
var checked: boolean = false;

interface SignUpFormElements extends HTMLFormElement {
  djName: HTMLInputElement;
  legalName:HTMLInputElement;
  email:HTMLInputElement;
  password: HTMLInputElement;
  password2: HTMLInputElement;
  city: HTMLInputElement;
  recoveryQ: HTMLInputElement;
  recoveryA: HTMLInputElement;
}
interface SigninFormElements extends HTMLFormElement {
  email:HTMLInputElement;
  password: HTMLInputElement;
}

function toggleOverlay(){
  cover = document.getElementById('cover');
  signBox = document.getElementById('signBox');
  loginForm = document.getElementById('login');
  signinForm = document.getElementById('signup');

	cover.style.opacity = ".5";
  if(true != checked){
    if("1" == getCookie("User")){  // get if this person is a user 
      loginForm.style.display = "block";
      signinForm.style.display = "none";
    }
    else{
      loginForm.style.display = "none";
      signinForm.style.display = "block";
    }
    checked = true;
  }


//i dont understand this code yet wish i had commented it
	if(cover.style.display == "block"){
	  cover.style.display = "none";
		signBox.style.display = "none";
	} else {
		cover.style.display = "block";
		signBox.style.display = "block";
	}
}
function formSwitch(){
  if("block" == loginForm.style.display){
    loginForm.style.display = "none";
    signinForm.style.display = "block";
	} else {
    loginForm.style.display = "block";
    signinForm.style.display = "none";
	}
}

//gets the cookies
function getCookie(cname: string) {
     let name: string = cname + "=";
     var ca: Array<string> = document.cookie.split(';');
     for(let i: number = 0; i<ca.length; i++) {
         let c: string = ca[i];
        
         while (c.charAt(0)==' ') 
          c = c.substring(1);
        
          if (c.indexOf(name) == 0) return c.substring(name.length,c.length);
     }
     return "";
 }
//// listeners to decide if we do that sort of thing //// 
// function loaded() {
//  document.forms[1].addEventListener("submit", function(event){
//    if(!validateSigninForm()){
// //       event.preventDefault();    //stop form from submitting
//    }
//});
//
//  document.forms[1].addEventListener("submit", function(event){
//    if(!validateSigninForm()){
//        event.preventDefault();    //stop form from submitting
//    }
//});
//}

function validateSignupForm()
{
  let signupForm: SignUpFormElements = (document.forms[0] as SignUpFormElements);//form 0 is the sign up form

  if(null == signupForm.djName.value || "" == signupForm.djName.value)
  {
    alert( "You must input a DJ Name to continue." );
    signupForm.djName.focus() ;
    return false;
  }
  if(null == signupForm.legalName.value || "" == signupForm.legalName.value)
  {
    alert( "You must provide a Legal name to continue." );
    signupForm.legalName.focus() ;
    return false;
  }
  if(null == signupForm.password.value || "" == signupForm.password.value)
  {
    alert( "You must provide a pasword to continue." );
    signupForm.password.focus() ;
    return false;
  }

  if(null == signupForm.password2.value || "" == signupForm.password2.value)
  {
      alert( "You must retype the password to continue." );
      signupForm.password2.focus() ;
      return false;
  }
  
  // check if password one is equal to password two
  if(signupForm.password2.value != signupForm.password.value)
  {
      alert( "The passwords do not match try again." );
      signupForm.password2.focus() ;
      return false;
  }

  if( null == signupForm.city.value || "" == signupForm.city.value )
  {
    alert( "Please provide a City!" );
    signupForm.city.focus() ;
    return false;
  }

  if( null == signupForm.recoveryQ.value || "" == signupForm.recoveryQ.value ) // should be modifyed to a dropdown
  {
    alert( "Please provide a Recovery Question!" );
    signupForm.recoveryQ.focus() ;
    return false;
  }

  if( null == signupForm.recoveryA.value || "" == signupForm.recoveryA.value )
  {
    alert( "Please provide a Recovery Answer!" );
    signupForm.recoveryA.focus() ;
    return false;
  }
  
  //password strength enforcer
  else{
    /*
    var c = document.signupForm.password.value.charAt(0);
    var a = document.signupForm.password.value.slice(-1);
    var b = document.signupForm.password.value.slice(-2);

    if (c != c.toUpperCase()) {
      alert( "Please provide a password that starts in a uppercase letter!"+c );
      document.signupForm.password.focus() ;
      return false;
    }
    if ( isNaN(b) || isNaN(a)) { //if not a number return false
      alert( "Please provide a password that ends in two numbers!"+a+b );
      document.signupForm.password.focus() ;
      return false;
    }*/
  }

  return( true );
}

function validateSigninForm()
  {
    let signinForm: SigninFormElements = (document.forms[1] as SigninFormElements); // one is login form because it is second

    if(null == signinForm.djname.value || "" == signinForm.djname.value)
    {
        alert( "You must input a username to continue." );
        signinForm.djname.focus() ;
        return false;
    }

    if( null == signinForm.password.value || "" == signinForm.password.value )
    {
        alert( "Please provide a password!" );
        signinForm.password.focus() ;
        return false;
    }

    return( true );
  } 
  
	  

