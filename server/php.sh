#!/bin/bash

#svn checkout https://github.com/docker-library/php/trunk/7.0/apache
#cd apache
#docker build -t php .

docker stop php
docker rm php
docker run -d -p 8080:80 --name php --link mysql -v ~amrabed/metrolab/server/web:/var/www/html php
