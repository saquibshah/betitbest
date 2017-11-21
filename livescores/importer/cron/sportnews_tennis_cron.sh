#!/bin/sh
/opt/php-5.4/bin/php -c /opt/users//www/php/php.ini /opt/users/www/betitbest/livescores/importer/scripts/sportnews_tennis_livescore2db.php 2>&1
sleep 1
/opt/php-5.4/bin/php -c /opt/users/www/php/php.ini /opt/users/www/betitbest/livescores/importer/scripts/sportnews_tennis_livescore2db_future.php 2>&1
sleep 1
c=1
while [ $c -le 54 ]
do
/opt/php-5.4/bin/php -c /opt/users//www/php/php.ini /opt/users/www/betitbest/livescores/importer/scripts/sportnews_tennis_livescore2db_delta.php 2>&1
c=`expr $c + 1`
sleep 1
done