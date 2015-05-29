# Installing on Windows machines

##1. Create a virtual host:
	* Add in file 'httpd-vhosts.conf' something like that:
		```
		<VirtualHost *:80>
			ServerName tour-system
			ServerAlias www.tour-system

			DocumentRoot C:/apache/tour-system/web
			<Directory C:/apache/tour-system/web>
				AllowOverride FileInfo
				Require all granted
			</Directory>
		</VirtualHost>
		```
	* Edit your 'hosts' file(c:\Windows\System32\drivers\etc\). Add to the end of file:
		```
		127.0.0.1 tour-system
		127.0.0.1 www.tour-system
		```
##2. Start your 'Git Bash' app. Move to your folder with virtual hosts and type:
	```
	git clone https://github.com/KiresMA/tour-system.git
	```
##3. Open standard windows command line, move into 'tour-system' folder you've just created and type:
	```
	composer install
	```
##4. Restart your Apache server.
##5. Create database named 'toursystem'. Create mysql-user 'toursystem' with the same password.
##6. Execute `php yii migrate`
