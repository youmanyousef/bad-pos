i cant figure out why some files dont have perms with the www-data user (or the docker user?) to use the `file_put_contents` function 
- docker exec -it posapp bash 
- chown -R www-data:www-data 
