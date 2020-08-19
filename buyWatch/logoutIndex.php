<?php include_once 'config/init.php'; ?>


<?php

unset($_SESSION);
session_destroy();
session_write_close();
header("location:index.php");
