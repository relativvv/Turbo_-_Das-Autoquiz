FROM nginx:latest
RUN apt-get update
RUN apt-get install software-properties-common apt-transport-https lsb-release ca-certificates wget -y
COPY config/nginx.conf /etc/nginx/conf.d/backend.conf

# Install PHP
RUN wget -O /etc/apt/trusted.gpg.d/php.gpg https://packages.sury.org/php/apt.gpg
RUN sh -c 'echo "deb https://packages.sury.org/php/ $(lsb_release -sc) main" > /etc/apt/sources.list.d/php.list'
RUN apt-get update
RUN apt-get install php8.1 php8.1-cli php8.1-cgi php8.1-fpm php8.1-gd php8.1-mysql php8.1-imap php8.1-curl php8.1-intl php8.1-pspell php8.1-sqlite3 php8.1-tidy php8.1-xsl php8.1-zip php8.1-mbstring php8.1-soap php8.1-opcache php8.1-common php8.1-readline php8.1-xml -y
RUN echo "listen = 0.0.0.0:9000" >> /etc/php/8.1/fpm/pool.d/www.conf

# Install Composer
RUN curl -sS https://getcomposer.org/installer -o composer-setup.php
RUN php -r "if (hash_file('SHA384', 'composer-setup.php') === '$(curl -sS https://composer.github.io/installer.sig)') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
RUN chmod 766 composer-setup.php
RUN rm /etc/nginx/conf.d/default.conf
RUN php composer-setup.php --install-dir=/usr/local/bin --filename=composer
RUN rm composer-setup.php

# Install Symfony CLI
RUN echo 'deb [trusted=yes] https://repo.symfony.com/apt/ /' | tee /etc/apt/sources.list.d/symfony-cli.list
RUN apt-get update
RUN apt-get install symfony-cli -y

