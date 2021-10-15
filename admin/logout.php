<?php
// Admin logout
session_start();
session_unset();
session_destroy();
header("Location: ../admin.php");
