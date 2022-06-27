# api_guestbook
## Ce projet est un projet de cours de formation Diginamic DWWM 2022.

* Initialisation du projet
```BASH
symfony new api_guestbook
```
* Installation doctrine
```BASH
cd api_guestbook
symfony composer req orm
```
* Reprennons la base de données du projet guestbook avec la même configuration a rajouter dans le .env
```PHP
DATABASE_URL="mysql://guestbook:guestbook@127.0.0.1:3306/guestbook?serverVersion=5.7.34"
```
