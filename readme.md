settaggi:

nel php.ini

vanno modificati i parametri:

upload_max_filesize

post_max_size

e abilitata l'estensione : extension=php_fileinfo.dll


----settaggio database:

aggiunte le 5 tabelle: php artisan migrate

aggiunge i seeds specificati: php artisan db:seed

----database:
se vuoi aggiornare il database:
php artisan make:migration update_illustrations_table

poi aggiungi il codice e poi infine:
php artisan migrate
quest'ultimo codice dovrebbe segnare come eseguito solo l'ultimo file inserito.
----


----run on LAN:
php artisan serve --host 192.168.1.112

