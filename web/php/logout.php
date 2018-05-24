<?php
/**
 * Author: Tom Ryser
 * Date: 22.05.2018
 * Version : 1.0
 * Title : logout
 * Description : contains the functions needed to disconnect and delete session variables.
 */
session_start();
session_destroy();
session_abort();


header("location: ../view/index.php");
exit;
?>