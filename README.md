Welcome To Your Laravel Test.

To Run The App Please Add Db credentials to your .env file

 
run ``composer install``

by that you installed dependencies required.

this is in laravel 9.

run those commands too

``php artisan migrate --seed``

to migrate tables into the db and seed it with dummy faker data. (added factories to seed db)

finally for the app to work run ``php artisan serve`` 


this app contains 4 main tables 

website table / post table / user table / subscribtion table

in addition to the job tables that contain the tasks that are in the queue waiting for workers to process it

you can check the table columns in the migrations files, and check relations in the models files.

you have an api to subscribe to a website.

after subscribing to this website you receive an email about that.

you also have an api endpoint for getting all the posts from the website that get cached for a day. 

you have an api for adding a post.

although it's not necessary i used repository pattern for adding the post. and added its service provider.

also used events and listeners to listen to the event of adding a post and dispatching the event.

after that made queues to send email to all subscribers to the post's website.




