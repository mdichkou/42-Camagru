<?php
echo ' <div class="topnav row">
<div class="logo col-sm-4">
    <img src="img/instagram.svg" >
    <h4 >Camagru</h4>
</div>
<div class="login col-sm-4 col-sm-offset-6">
        <form  action="includes/logout.inc.php" method="post" class="icons">
                <a href="home.php" ><img src="img/gallery.svg"alt=""></a>
                <a href="camera.php" ><img src="img/camera.svg"alt=""></a>
                <a  href="profile.php" ><img src="img/user.svg" alt=""></a>
                <button type="submit" name="btnlogout" class="btn">Logout</button>
        </form>
</div>
</div>';
?>