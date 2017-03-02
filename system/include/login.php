<div class="container">
<form method="post" class="form-signin">
        <h2 class="form-signin-heading"><?php
if (isset($loginerror))
{
echo $loginerror;
} else { echo 'Please Login';}
?></h2>
 <div class='form-group'>
       <label for="inputEmail" class="sr-only">Username</label>
        <input type="text" name="username" id="inputEmail" class="form-control" placeholder="Username" required autofocus>
</div>
<div class='form-group'>
        <label for="inputPassword" class="sr-only">Password</label>
        <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Password" required>
</div>
        <div class="checkbox">
          <label>
            <input type="checkbox" value="remember-me"> Remember me
          </label>
        </div>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Login</button>
      </form>

    </div>

