#!/bin/bash 

docker run -ti -v "$PWD/site":/usr/share/nginx/ -d -p 8080:80 --name sti_lab01_daubresse_saucy --hostname sti arubinst/sti:project2018

docker exec -u root sti_lab01_daubresse_saucy service nginx start

docker exec -u root sti_lab01_daubresse_saucy service php5-fpm start
