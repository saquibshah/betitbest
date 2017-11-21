#!/bin/bash

LOCKFILE="/home/javauser/xmlimporter/xmlimporter.pid"

SOURCE="/opt/users/www/betradar/xmls/sportradar/stats_copied/stats"
LSSOURCE="/opt/users/www/betradar/xmls/sportradar/ls_copied/ls"
TARGET="/home/javauser/xmlimporter/import"
XMLIMP="/home/javauser/xmlimporter/xmlimporter.jar"
LOGLOC="/home/javauser/xmlimporter/logs/$(date "+%Y-%m-%d_%H-%M").log"

touch $LOCKFILE
read lastPid < $LOCKFILE

if [ -n "$lastPid" -a -d "/proc/$lastPid" ]; then
	exit 0
fi

echo $$ > $LOCKFILE

rm /home/javauser/xmlimporter/xmlimporter.log && ln -s $LOGLOC /home/javauser/xmlimporter/xmlimporter.log
echo "" > $LOGLOC
find $SOURCE -iname '*.xml' -exec mv -v {} $TARGET \; >> $LOGLOC 2>&1
cp -v $LSSOURCE/{livescore_betitbest.xml,livescore_betitbest_future.xml} $TARGET/ >> $LOGLOC 2>&1
java -jar $XMLIMP >> $LOGLOC 2>&1
exit 0
