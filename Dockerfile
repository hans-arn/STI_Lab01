FROM nginx
RUN apt-get update && apt-get -y install sqlite php-sqlite3 
COPY site/databases /usr/share/nginx/html
RUN chown www-data:www-data /usr/share/nginx/html/database.sqlite
RUN chmod 770 /usr/share/nginx/html/database.sqlite
