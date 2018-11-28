<?php
if(isset($_SESSION['user_id']) && $_GET['logout'] == 1){
setcookie("rememberme","",time()-3660);
session_destroy();
}
?>