docker stop mysql
docker rm mysql
docker run -d --name mysql -p 3306:3306 -v ~amrabed/metrolab/data/mysql:/var/lib/mysql -e MYSQL_ROOT_PASSWORD=P@ssw0rd mysql
