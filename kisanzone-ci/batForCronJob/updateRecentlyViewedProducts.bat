@ECHO OFF
set "PATH=%PATH%;d:\xampp\htdocs\kisanzone-ci"
call d:
call cd xampp\htdocs\kisanzone-ci
:loop
call php index.php CCron
PAUSE