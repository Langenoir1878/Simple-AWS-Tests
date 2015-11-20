#!/bin/bash
# Repo ref: https://github.com/jhajek/itmo-544-444-env/blob/master/install-webserver.sh

sudo apt-get update -y
sudo apt-get install -y apache2 git php5 php5-mysql php5-curl mysql-client curl



sudo git clone https://github.com/Langenoir1878/Simple-AWS-Tests.git

mv ./Application-setup/images /var/www/html/images
mv ./Simple-AWS-Tests/* /var/www/html




curl -sS https://getcomposer.org/installer | sudo php &> /tmp/getcomposer.txt

sudo php composer.phar require aws/aws-sdk-php &> /tmp/runcomposer.txt

sudo mv vendor /var/www/html &> /tmp/movevendor.txt

sudo php /var/www/html/setup.php &> /tmp/database-setup.txt



echo "Hi, install-webserver.sh has been called!" > /tmp/hello.txt

