TASK MANAGEMENT APP 

To make the application work

Run the following command in sequence 

php artisan migrate --path=database/migrations/2023_09_13_102916_create_projects_table.php

php artisan migrate --path=database/migrations/2023_09_13_102904_create_tasks_table.php

php artisan db:seed

php artisan serve

Thats it enjoy the new Task management app