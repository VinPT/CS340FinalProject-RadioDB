
  <noscript>
       Errors may occur if javascript is not enabled.
  </noscript>


  <header>
  <?php  
    // save current link as active 
    $activeNav = basename($_SERVER['PHP_SELF']);
    
    // set Logged in as false if we dont have a loggedin variable.
    if (!isset($_SESSION['loggedin'])) $_SESSION['loggedin'] = 0;
    //echo ($_SESSION['loggedin']);
    // dont do anything if we are on login or logout page
    if($activeNav == 'login.php'||$activeNav == 'logout.php'){}

    // if not logged in display the login button
    else if ( !$_SESSION["loggedin"]) {
      echo '<button id = "loginButton" class = "linkStyle" onmousedown="toggleOverlay()">Login/Signup</button>';
    }

    // else we are logged in display DJ name and add the logout button
    else{
      echo '<label id = uname> ' . $_SESSION["djName"] .' </label>';
      echo '<a id = "loginButton" class = "linkStyle" href="logout.php" >Logout</a>';
      echo session_status();

    } ?>
  </header>

  <?php  
  
  ?>
  <div class="background">
  <nav>
  
    <ul>
    <!-- display home page to every one-->
    <li><a <?php if($activeNav == 'index.php') { echo 'class="active"';} else { echo '';} ?> href="index.php">Home</a></li>
  
  
  <!-- display User only pages-->
	<?php if (true == (isset($_SESSION['loggedin']) && true == $_SESSION['loggedin'])) { 
      echo '<li><a '; if($activeNav == 'createshow.php') { echo 'class="active"';} else { echo '';} echo 'href="createevent.php">Update Show</a></li>';
      echo '<li><a '; if($activeNav == 'esinfo.php') { echo 'class="active"';} else { echo '';} echo 'href="eeinfo.php"> Edit Show Info</a></li>';
      echo '<li><a '; 
      if($activeNav == 'stationDashboard.php') { 
        echo 'class="active"';
      } else { 
        echo '';
      } 
      echo ('href="stationDashboard.php">');
      echo(($DBCObject-> isStationMaster($_SESSION["djName"])) ? 'Station Dashboard' : 'CreateStation' );
      echo('</a></li>');
  }else{} ?>  
  
	  <!-- display other pages designed for mass consumption-->
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

        <form id="signupForm" action="signup.php" method="post" onsubmit="return(validateSignupForm());">
          <ul>
            <li><label>DJName: </label><input type="text" name="djName" required ></li>
            <li><label>Legal Name: </label><input type="text" name="legalName" required ></li>
            <li><label>Password: </label><input type="password" name="password" required ></li>
            <li><label>Reenter Password: </label><input type="password" name="password2" required ></li>
            <li><label>City of Residence: </label><input type="text" name="city" required ></li>
			      <li><label>Select recovery question: </label><input type="text" name="recoveryQ" required ></li>
            <li><label>Recovery Answer: </label><input type="text" name="recoveryA" required ></li>
          </ul>
          <input type="submit" name="formSubmit" value="Signup"/>
        </form>
      </div>

      <div id="login" >
        <h2>Login</h2>
        <h4>Not a member yet <button class = "linkStyle" onmousedown="formSwitch()">Signup</button></h4>
        <!--<h4>Forget your password recover it <a href="recover.php" >here</a></h4>-->

        <form id="signinForm" action="login.php" method="post" onsubmit="return(validateSigninForm());">
          <ul>
            <li><label>DJName: </label><input type="text" name="djname" required ></li>
            <li><label>Password: </label><input type="password" name="password" required ></li>
          </ul>
          <input type="submit" name="formSubmit" value="Signin"/>
        </form>
      </div>

    </div>

  <?php// else{ ?>

  <?php //} ?>

