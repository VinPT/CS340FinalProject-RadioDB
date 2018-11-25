
  <noscript>
       Errors may occur if javascript is not enabled.
  </noscript>
  <header>
  <?php  $activeNav = basename($_SERVER['PHP_SELF']);
    if($activeNav == 'login.php'||$activeNav == 'logout.php'){

        }
    else if ( !$_SESSION["loggedin"]) {
      echo '<button id = "loginButton" class = "linkStyle" onmousedown="toggleOverlay()">Login/Signup</button>';
    }
    else{
      echo '<label id = uname> ' . $_SESSION["firstname"] . ' ' . $_SESSION["lastname"].' </label>';
      echo '<a id = "loginButton" class = "linkStyle" href="logout.php" >Logout</a>';
      echo session_status();

    } ?>
  </header>

  <?php  
  if (!isset($_SESSION['loggedin'])) $_SESSION['loggedin'] = 0;
  ?>
  <div class="background">
  <nav>
  
    <ul>
	<li><a <?php if($activeNav == 'index.php') { echo 'class="active"';} else { echo '';} ?> href="index.php">Home</a></li>
	
	<?php if (true == (isset($_SESSION['loggedin']) && true == $_SESSION['loggedin'])) { 
      echo '<li><a '; if($activeNav == 'createevent.php') { echo 'class="active"';} else { echo '';} echo 'href="createevent.php">Create Event</a></li>';
      echo '<li><a '; if($activeNav == 'eeinfo.php') { echo 'class="active"';} else { echo '';} echo 'href="eeinfo.php"> Edit Events</a></li>';
	  //echo '<li><a '; if($activeNav == 'euinfo.php') { echo 'class="active"';} else { echo '';} echo 'href="euinfo.php"> Edit Userinfo</a></li>';
	}else{} ?>  
	  
      <li><a <?php if($activeNav == 'about.php') { echo 'class="active"';} else { echo '';} ?> href="about.php">About</a></li>
      <li><a <?php if($activeNav == 'help.php') { echo 'class="active"';} else { echo '';} ?> href="help.php"> Help</a></li>
    </ul>

    

  

  </nav>
  <?php //if (true != (isset($_SESSION['loggedin']) && true != $_SESSION['loggedin'])) { ?>
    <div id="cover"></div>
    <div id="signBox">

      <button id ="close" class="linkStyle" onmousedown="toggleOverlay()">&times;</button>

      <div id="signup">
        <h2>Signup</h2>
        <h4>Already a member <button class = "linkStyle" onmousedown="formSwitch()">Login</button></h4>
        <h4>All fealds are required.</h4>

        <form id="signupForm" action="templates/signup.php" method="post" onsubmit="return(validateSignupForm());">
          <ul>
            <li><label>DJName: </label><input type="text" name="djName"></li>
            <li><label>Legal Name: </label><input type="text" name="legalName"></li>
            <li><label>Password: </label><input type="password" name="password"></li>
            <li><label>Reenter Password: </label><input type="password" name="password2"></li>
            <li><label>City of Residence: </label><input type="text" name="city"></li>
			      <li><label>Select recovery question: </label><input type="text" name="recoveryQ"></li>
            <li><label>Recovery Answer: </label><input type="text" name="recoveryA"></li>
          </ul>
          <input type="submit" name="formSubmit" value="Signup"/>
        </form>
      </div>

      <div id="login" >
        <h2>Login</h2>
        <h4>Not a member yet <button class = "linkStyle" onmousedown="formSwitch()">Signup</button></h4>
        <h4>Forget your password recover it <a href="recover.php" >here</a></h4>

        <form id="signinForm" action="templates/login.php" method="post" onsubmit="return(validateSigninForm());">
          <ul>
            <li><label>DJName: </label><input type="text" name="djname"></li>
            <li><label>Password: </label><input type="password" name="password"></li>
          </ul>
          <input type="submit" name="formSubmit" value="Signin"/>
        </form>
      </div>

    </div>

  <?php// else{ ?>

  <?php //} ?>

