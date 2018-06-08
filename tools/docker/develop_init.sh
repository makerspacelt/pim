#!/bin/bash

set -e
set -x

PROJECT_ROOT="$(dirname "$(dirname "$(cd "$(dirname "${BASH_SOURCE[0]}")" && pwd)")")"

echo "PROJECT ROOT: ${PROJECT_ROOT}"
cd "${PROJECT_ROOT}"


function setPerms {
	mkdir -p "$1"
	sudo setfacl -R  -m m:rwx -m u:33:rwX -m u:1000:rwX "$1"
	sudo setfacl -dR -m m:rwx -m u:33:rwX -m u:1000:rwX "$1"
}


echo -e '\n## Setting up CMS ... '

mkdir -p "${PROJECT_ROOT}/tmp"
cd "${PROJECT_ROOT}/tmp"
wget -O cms.zip "https://github.com/CouchCMS/CouchCMS/archive/v2.1.zip"
unzip -oq cms.zip

cd "${PROJECT_ROOT}/web"
mv couch{,_}
mv ../tmp/CouchCMS*/couch ./
cp -r couch_/* ./couch/
rm -r couch_
rm -r "${PROJECT_ROOT}/tmp"


echo -e '\n## Setting up database ... '
mysql -f -uproject -pproject -hmysql project < ${PROJECT_ROOT}/db/init.sql


echo -e '\n## Touching random files... oh uh ... '

wget -qO /dev/null --keep-session-cookies --save-cookies /tmp/c --load-cookies /tmp/c --post-data 'k_user_name=admin&k_user_pwd=admin&k_cookie_test=1&k_login=1' http://web/couch/login.php?redirect=%2F

wget -qO /dev/null --keep-session-cookies --save-cookies /tmp/c --load-cookies /tmp/c --post-data 'k_user_name=admin&k_user_pwd=admin&k_cookie_test=1&k_login=1' http://web/couch/login.php?redirect=%2F

for file in tags tool gallery
do
	wget -qO /dev/null --keep-session-cookies --save-cookies /tmp/c --load-cookies /tmp/c http://web/${file}.php
done
rm /tmp/c


#echo -e '\n## Setting up permissions ... '
#setPerms "${PROJECT_ROOT}/var"


