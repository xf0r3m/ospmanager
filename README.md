# OSPmanager

__OSPmanager__ - Aplikacja stworzona w technologiach webowych, ma za zadanie usprawnić prowadzenie dokumentacji w jednostkach Ochotniczej Straży Pożarnej.

__Wymagania:__

* LAMP Stack (Linux Apache MySQL PHP >= 7.0)
* Biblioteki PHP: php-zip, php-xml, php-gd
* Google Maps Api

__Instalacja (czynności należy wykonywać jako root):__

1. git clone https://github.com/xf0r3m/ospmanager.git
2. Zmieniamy domyślne hasła bazy danych w plikach ospmanager-master/install.sql oraz ospmanager-master/db_conf.php
3. cp ospmanager/* /var/www/html
4. chown -R www-data:www-data /var/www/html
5. chmod -R 775 /var/www/html
6. mysql < /var/www/html/install.sql.

__Logowanie (przez WWW):__

* Nazwa użytkownika: admin
* Hasło: admin1

Po pierwszy zalogowaniu należy nie zwłocznie zmienić hasło.

