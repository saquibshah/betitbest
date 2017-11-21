#!/bin/sh
/usr/bin/lynx -dump https://www.betitbest.com/dev/stefan/prd_soccer_livescore2db_future.php 2>&1
sleep 2
c=1
while [ $c -le 56 ]
do
/usr/bin/lynx -dump https://www.betitbest.com/dev/stefan/prd_soccer_livescore2db_hider.php 2>&1
(( c++ ))
sleep 1
done