# FUSE authenticated website 4.x (Laravel)

## Infrastructure

In production and dev/stage environments, the project is meant to be run
serverless on AWS Lambda using the Bref framework. The minimum framework
infrastructure needs are captured in the `serverless.yml` file, which is
mostly the Lambda layers and the S3 bucket for assets. This file references
many resources managed in Terraform outside of Bref[^1] including the VPC
and database. However, the following are not captured in either:

* Certificate creation
* DNS entries

These need to be managed manually.

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

[^1]: It is not very convenient to create resources in Bref that will need to
be shared to other resources. We take the stance that Bref should only describe
Laravel-specific resources, viz the lambda layers, the Redis cache, and the S3
bucket for assets. The VPC, subnets, security groups, and other resources are
captured in Terraform and salient resource ids are passed to Bref via AWS
Parameter Store.
