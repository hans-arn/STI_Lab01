FROM nginx
RUN apt-get update && apt-get -y install sqlite php-sqlite3 
COPY site/databases /usr/share/nginx/html
RUN chown www-data:www-data -R /usr/share/nginx/html/
RUN chmod 777 -R /usr/share/nginx/html/
