#!/bin/sh
/usr/bin/lynx -dump https://www.betitbest.com/dev/stefan/prd_football_livescore2db.php 2>&1
sleep 2

/opt/php-5.4/bin/php -c /opt/users/www/php/php.ini /opt/users/www/betitbest-news/livescores/importer/scripts/prd_football_livescore2db_future.php 2>&1
sleep 1
#/opt/php-5.4/bin/php -c /opt/users/www/php/php.ini /opt/users/www/betitbest-news/livescores/importer/scripts/prd_football_livescore2db_hider.php 2>&1
#sleep 1
c=1
while [ $c -le 56 ]
do
/usr/bin/lynx -dump https://www.betitbest.com/dev/stefan/prd_football_livescore2db_delta.php 2>&1
(( c++ ))
sleep 1
done


