# Unit Testing

Unit tests currently cover only the data relationships.

Run unit tests via `$ php artisan test --testsuite=Unit`

## Phase I - Tables and Relationships

In this phase we identify all primary data types from the Drupal application that will need schema (migration) definitions created. At a minimum we will create tables for these data along with any pivot tables, as well as the model code to define inter-model relationships and the table columns to support the relationships.

## Phase II - Gather details

In this phase we return to the Drupal application to add any data columns, as well as SQL code to migrate Drupal data to the new application. Drupal tends to create lots of unnecessary tables, so this will likely require migrating data from multiple tables into a single Laravel table.
