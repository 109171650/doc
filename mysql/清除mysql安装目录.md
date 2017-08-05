在systemd系统里移除service
#dnf remove mysql-community-server
#rm /etc/my.cnf
#rm -rf /var/lib/mysql
#rm -rf /usr/share/mysql
#rm -rf /usr/lib/mysql
查询mysql服务
#systemctl list-unit-files | grep mysql
#systemctl disable mysqld.service
#systemctl disable mysql.service
#rm -rf /var/run/mysql/
#rm /etc/mecabrc
#rm /usr/lib/systemd/system/mysqld.service
#rm /etc/systemd/system/mysqld.service
#rm /etc/systemd/system/mysql.service
这样就完全干掉MySQL了，然后重新安装基本就没问题了。之前的问题，就是系统里MySQL/MariaDB混了
清除掉MySQL，之后无论是安装MySQL还是MariaDB应该都没问题了(我只装了MariaDB，没问题。MySQL没测试，应该也是可以的。另外，Fedora 23里的MariaDB还是10.0系列，要安装最新的10.1，要换MariaDB官方的repo
官方的repo只写了F20/F21，自己替换一下版本号就可以了)
