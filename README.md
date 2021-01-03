# SymfonyOrderApi

git clone https://github.com/yemliha81/SymfonyOrderApi.git
cd SymfonyOrderApi

/*you can change the database credentials in the .env file. Default configuration is
DATABASE_URL=mysql://USER_NAME:USER_PASSWOR@127.0.0.1:3306/DB_NAME?serverVersion=5.7
*/

bin/console doctrine:schema:create

/*After DB tables creation you can run SQL commands in api_database.sql file to insert 3 customers and an admin user.
Also some orders will be inserted*/

symfony server:start
