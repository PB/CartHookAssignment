# Summary

### The main idea
I decided to use CQS pattern, mostly because code gets more readable and more trustworthy. 
The read & write operations are separate from each other. This business logic should reduce number of errors and improve scalability of the application.
It should be possible to move operations like `showComannd`, `storeComannd` (reed & write) to separate services (microservices).

 ### Database design
 The database has 3 tables with foreign keys. There is one unique index on user emails. There is also one text index on post title (because an option to search posts by titles).
 However, if these searches would be 'heavy' I would probably use ElasticSearch. 
 For storing user address and company data I used JSONB field. In Postgres you can search in JSON.
 Beside that it is a quite normal DB. 
 
 ### Other info
 There are few service providers that can be switched. For example: 
 - `JsonPlaceHolderRepository` can be replaced by `UserRepository` - this will cause the database to be used
 - `UserRepository` can be replaced by `CacheUserRepository` - this will cause searching user data first in redis
 
 Other use cases:
 - we have problem with DB, we can switch to `JsonPlaceHolderRepository` and application will work as a proxy
 - lots of traffic, switch to cached (redis)
 
 By using interfaces it is quite simple to write a new repository, for example, that use ElasticSearch.
 
 During caching users application store user's data also in the cache. 
 By id and by email because we will be querying users a lot by email (not used, but it is there).
 
 There are few simple test, that can be run:
 
 `docker-compose exec app php artisan test`
 
 In normal application there should be a more tests. Feature and units tests. Those are the minimum to check if application works.
 
 Application use standards packages for code validation: PhpCS, PhpCsFixer and PhpStan:
 ```
docker-compose exec app php artisan fixer:fix
docker-compose exec app ./vendor/bin/phpcs
docker-compose exec app ./vendor/bin/phpstan analyse
```
