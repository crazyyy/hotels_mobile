#!/bin/bash

file="/tmp/s.txt"
need='1'
status=$(cat $file)
if [ "$need" = "$status" ]; then
      /etc/init.d/php5-fpm restart
      echo "restart php"
      echo '0'>$file
  else
      echo 'vse ok'
fi
