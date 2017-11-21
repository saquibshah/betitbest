#!/bin/bash

OPTIND=1
#PHP=$(which php5)
PHP="/opt/php-5.4/bin/php -c /opt/users/www/php/php.ini"
PATH="$(dirname $(readlink -e $0))/fetch.php"

while getopts "uctps" opt; do
    case "$opt" in
        u)
            type="user"
            ;;

        c)
            type="channel"
            ;;

        t)
            type="topic"
            ;;

        p)
            type="playlist"
            ;;

        s)
            type="singlevideo"
            ;;
    esac

    $PHP $PATH -t $type
done
