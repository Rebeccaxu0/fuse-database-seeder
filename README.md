# FUSE authenticated website 4.x (Laravel)

## Roadmap

* Data relationships and migrations
* Business logic & tests
* Skin

## Data

### Testing

See `tests/Unit/README.md`

### Migrations

We currently do not write any tests against the data layer directly,
preferring instead to write robust migrations (schemas) which are implicitly
validated by writing factories and seeders. In anticipation of an actual
migration in the classical sense, when we copy the FUSE 3.x (Drupal 7) data to
the the new Laravel site, we are writing the SQL migration script alongside
our Laravel code in `database/migrations/drupal7_to_laravel_data_xfer.sql`. In
addition to the local database we run Laravel against (`fuse-laravel`), we also
have a copy of the Drupal 7 database (`fuse`). Therefore, it this phase we
recommend running the following often:

```
$ php artisan migrate:fresh && \
  mysql -u root -p < database/migrations/drupal7_to_laravel_data_xfer.sql
```

The above commands will clear the current database, recreate it via Laravel
migration code, and finally run the mysql script. Usually the migrations are
written in conjunction with factory and seeder files. Only after we are
confident our data relationships are working properly (`$ php artisan tinker`
is your friend), will we start to write the concommitant MYSQL code to move
legacy data to the new tables.
