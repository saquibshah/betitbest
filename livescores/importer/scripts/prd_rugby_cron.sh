#!/bin/sh
/usr/bin/lynx -dump https://www.betitbest.com/dev/stefan/prd_rugby_livescore2db.php 2>&1 
sleep 2
c=1
while [ $c -le 56 ]
do
/usr/bin/lynx -dump https://www.betitbest.com/dev/stefan/prd_rugby_livescore2db_delta.php 2>&1
(( c++ ))
sleep 1
done
