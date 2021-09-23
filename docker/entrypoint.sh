#!/bin/bash

if ! [ -z ${LOCAL_USER_ID} ]; then
  if ! [ -z  ${LOCAL_GROUP_ID} ]; then
    sed -i "s,33:33,${LOCAL_USER_ID}:${LOCAL_GROUP_ID},g" /etc/passwd
    sed -i "s,/var/www,/var/www/html,g" /etc/passwd
    sed -i "s,:33:,:${LOCAL_GROUP_ID}:,g" /etc/group
  fi
fi

if ! [ -z ${XDEBUG_ENABLE} ]; then
  if [ ${XDEBUG_ENABLE} == "true" ]; then
    cat /var/www/html/docker/php/xdebug > /etc/php/8.0/mods-available/xdebug.ini
  fi
fi

exec ${@}
