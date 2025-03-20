<?php
// file     :   presentation/includes/login.php
// author   :   sven.croon

// variables:
// -----------------------------------------------------------------------------
// $_COOKIE['PizzaPotente'] =   email address (username) of latest succesfull registration or login

?>

    <label for='email'>email</label>
    <input type='email' name='email' value='<?php echo isset($_COOKIE['PizzaPotente'])? $_COOKIE['PizzaPotente'] : "" ?>' placeholder='email address' required/>
    <label for='password'>password</label>
    <input type='password' name='password' placeholder='password' required/>
    <input type='submit' name='submit' id='submit' value='submit'/>
</form>
