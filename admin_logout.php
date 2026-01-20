<?php
// ૧. સેશન શરૂ કરો
session_start();

// ૨. બધા સેશન વેરિએબલ્સ ખાલી કરો
session_unset();

// ૩. સેશનનો નાશ કરો
session_destroy();

// ૪. એડમિનને પાછા લોગિન પેજ પર મોકલી દો
header("Location: admin_login.php");
exit();
?>