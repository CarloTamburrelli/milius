settaggi:

nel php.ini

vanno modificati i parametri:

upload_max_filesize

post_max_size

e abilitata l'estensione : extension=php_fileinfo.dll


----settaggio database:

aggiunte le 5 tabelle: php artisan migrate

aggiunge i seeds specificati: php artisan db:seed


----run on LAN:
php artisan serve --host 192.168.1.112

