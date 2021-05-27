#!/bin/sh
# (not so) cleanly starts apache and mysql

# stop apache if already active
sudo /etc/init.d/apache2 stop

# restart them
sudo /opt/lampp/xampp startapache
sudo /opt/lampp/xampp startmysql
