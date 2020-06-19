# eventbooking

### How to Use this repo


##### Clone this repo

`git clone https://github.com/sharidas/eventbooking.git`


##### Fetch the packages

This is a snapshot of symfony 5.1, composer is used here to fetch the dependencies for the project.

Run the command: `composer install`


##### Run the server

Check if symfony client is installed in your machine. If not kindly install using command:

`wget https://get.symfony.com/cli/installer -O - | bash`

After executing the command do not forget to update the PATH variable of the shell. 

You may execute the command: `export PATH=$PATH:$HOME/.symfony/bin` or update the same in bashrc or zshrc.


##### Populate the database with the json file

Update var `DATABASE_URL` in `.env` file.

Create the DB using command: `php bin/console doctrine:database:create`. Once the DB is created you are ready to move to the next step.

There is a symfony command created which can be executed as:

`php bin/console app:import-bookingevent <absolute-path-of-file>` 


##### View the page

Run the symfony server: `symfony server:start`

Now open the browser and navigate to the URL mentioned in the console: `http://localhost:8000`

The page should look like the one shown below:

[!Screenshot](./screenshot/project.png)


##### Filter

The filter support for employee name, event name and data is provided. The total price also gets varied according to the filter applied.

##### Pagination

The pagination support is available in the backend.


##### Files created for this project

1.  `src/Entity/EventBooking.php`                - DB schema is available here with the get and set operations.
2.  `src/command/ImportBookingeventCommand.php`  - Write to DB happens using this command
3.  `src/EventBackend/EventBookingManager.php`   - The DB read happens here.
4.  `public/js/table.js`                         - The js file is available here to update the row.
5.  `tests/EventBookingManagerTest.php`          - The test file to test the version comparison
