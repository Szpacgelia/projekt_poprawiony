<?php
// Rozpoczynamy sesję
session_start();

// Kończymy sesję
session_destroy();

// Przekierowanie do index.php
header('Location: index.php');
exit;