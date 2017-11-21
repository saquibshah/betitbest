#!/bin/sh
/usr/bin/lynx -dump https://www.betitbest.com/dev/stefan/prd_football_livescore2db_new.php 2>&1
sleep 2
c=1
while [ $c -le 56 ]
do
/usr/bin/lynx -dump https://www.betitbest.com/dev/stefan/prd_football_livescore2db_delta_new.php 2>&1
(( c++ ))
sleep 1
done


