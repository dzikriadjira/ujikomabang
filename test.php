<?php
echo "Apache berfungsi!";
echo "<br>PHP version: " . phpversion();
echo "<br>Current directory: " . __DIR__;
echo "<br>mod_rewrite status: " . (function_exists('apache_get_modules') ? (in_array('mod_rewrite', apache_get_modules()) ? 'Aktif' : 'Tidak Aktif') : 'Tidak bisa cek');
?>
