FROM nginx:latest

ADD docker/vhost.conf /etc/nginx/conf.d/default.conf

# COPY public /var/www/public
