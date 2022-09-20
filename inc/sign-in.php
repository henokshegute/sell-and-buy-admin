<?php if (!defined("APP_NAME")) exit(); ?>
<div class="split - left">
    <div class="welcome">
    <h1>Welcome <h1>
    <h3>Login to access your panel<h3>
    </div>
        </div>

<div class="split - right">
    <div class="form-container "  id="sign-in-form-container">
        <form method="post" id="signInForm" >
        <label for="username" style="margin-bottom: 20px; ;">Email address or username</label>
            <div class= "mb-3 form-group">
        <input type="text" name="username" id="username" class="form-control" placeholder="Email" required />
        </div>
        <div class="mb-3 form-group">
        <input type="password" name="password" id="password" class="form-control" placeholder="Password" required />          
        </div>
    <div class="text-center">
        <button type="submit" class="btn btn-primary6 btn-md " style="background-color:#ef6721; margin: 20px; padding: 10px 50px">Sign In</button>
    </div>
    <input type="hidden" name="_token" class="token-field" value="<?php echo isset($_SESSION["token"]) ? $_SESSION["token"] : ""; ?>" />
        </form>
    </div>
</div>