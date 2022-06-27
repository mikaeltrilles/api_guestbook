# api_guestbook

[![wakatime](https://wakatime.com/badge/github/mikaeltrilles/api_guestbook.svg)](https://wakatime.com/badge/github/mikaeltrilles/api_guestbook)

## Ce projet est un projet de cours de formation Diginamic DWWM 2022.

Il est la suite du projet [guestbook](

- Initialisation du projet

```BASH
symfony new api_guestbook
```

- Installation doctrine

```BASH
cd api_guestbook
symfony composer req orm
```

- Reprennons la base de données du projet guestbook avec la même configuration a rajouter dans le .env

```PHP
DATABASE_URL="mysql://guestbook:guestbook@127.0.0.1:3306/guestbook?serverVersion=5.7.34"
```

- Installation du maker de Symfony

```BASH
symfony composer require symfony/maker-bundle --dev
```

- Création des entités : Comment

```BASH
❯ scme Comment

 created: src/Entity/Comment.php
 created: src/Repository/CommentRepository.php

 Entity generated! Now let's add some fields!
 You can always add more fields later manually or by re-running this command.

 New property name (press <return> to stop adding fields):
 > author

 Field type (enter ? to see all types) [string]:
 >

 Field length [255]:
 >

 Can this field be null in the database (nullable) (yes/no) [no]:
 >

 updated: src/Entity/Comment.php

 Add another property? Enter the property name (or press <return> to stop adding fields):
 > text

 Field type (enter ? to see all types) [string]:
 > text

 Can this field be null in the database (nullable) (yes/no) [no]:
 >

 updated: src/Entity/Comment.php

 Add another property? Enter the property name (or press <return> to stop adding fields):
 > email

 Field type (enter ? to see all types) [string]:
 >

 Field length [255]:
 >

 Can this field be null in the database (nullable) (yes/no) [no]:
 >

 updated: src/Entity/Comment.php

 Add another property? Enter the property name (or press <return> to stop adding fields):
 > createdAt

 Field type (enter ? to see all types) [datetime_immutable]:
 >

 Can this field be null in the database (nullable) (yes/no) [no]:
 >

 updated: src/Entity/Comment.php

 Add another property? Enter the property name (or press <return> to stop adding fields):
 > note

 Field type (enter ? to see all types) [string]:
 > smallint

 Can this field be null in the database (nullable) (yes/no) [no]:
 > yes

 updated: src/Entity/Comment.php

 Add another property? Enter the property name (or press <return> to stop adding fields):
 >



  Success!
```

- Création des entités : Comment

```BASH
❯ scme Conference

 created: src/Entity/Conference.php
 created: src/Repository/ConferenceRepository.php

 Entity generated! Now let's add some fields!
 You can always add more fields later manually or by re-running this command.

 New property name (press <return> to stop adding fields):
 > city

 Field type (enter ? to see all types) [string]:
 >

 Field length [255]:
 >

 Can this field be null in the database (nullable) (yes/no) [no]:
 >

 updated: src/Entity/Conference.php

 Add another property? Enter the property name (or press <return> to stop adding fields):
 > year

 Field type (enter ? to see all types) [string]:
 >

 Field length [255]:
 > 4

 Can this field be null in the database (nullable) (yes/no) [no]:
 >

 updated: src/Entity/Conference.php

 Add another property? Enter the property name (or press <return> to stop adding fields):
 > isInternational

 Field type (enter ? to see all types) [boolean]:
 >

 Can this field be null in the database (nullable) (yes/no) [no]:
 >

 updated: src/Entity/Conference.php

 Add another property? Enter the property name (or press <return> to stop adding fields):
 > comments

 Field type (enter ? to see all types) [string]:
 > OneToMany

 What class should this entity be related to?:
 > Comment

 A new property will also be added to the Comment class so that you can access and set the related Conference object from it.

 New field name inside Comment [conference]:
 >

 Is the Comment.conference property allowed to be null (nullable)? (yes/no) [yes]:
 > no

 Do you want to activate orphanRemoval on your relationship?
 A Comment is "orphaned" when it is removed from its related Conference.
 e.g. $conference->removeComment($comment)

 NOTE: If a Comment may *change* from one Conference to another, answer "no".

 Do you want to automatically delete orphaned App\Entity\Comment objects (orphanRemoval)? (yes/no) [no]:
 > yes

 updated: src/Entity/Conference.php
 updated: src/Entity/Comment.php

 Add another property? Enter the property name (or press <return> to stop adding fields):
 >



  Success!
```
