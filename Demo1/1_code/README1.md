
## AgriCom Training
Web based site that allows for users to be able to mimic the trading of commodities
in a simulated environment using close to real-time prices.

### Technology
- PHP 7
- MySQL

### Testing
- See README2 in ../2_unit_testing or README3 in ../3_integration_testing

### Project dependencies
A large majority of our source code is HTML, CSS, Javascript, and PHP. 
This makes it easily accessible to users who have access to a web browser on a computer.

To run the code you need to have PHP installed and configured on your local machine and
be connected to the internet for MySQL and API functionalities.

### To Clone & Deploy Application Locally
- git clone https://github.com/davsgladden/CSCI441_VB_Group_Project.git
- run 'cd Demo1/1_code'
- run 'php -S localhost:8000'
- Using a web browser, navigate to localhost:8000 or localhost:8000/index.php

All code, including the tests, is inside the Main/1_code directory.

Inside the key folders are:
- 1_code
  -  Contains core pages and navigations
- 1_code/controller/
  - Contains the core system functions
- 1_code/entity
  - Contains entity items that mirror the MySQL schemas
  - Getter & Setter functions
  - fetch, insert, update functions where needed

All DB and API config files are in Main/1_code.

All testing files are named ending in *Test.php,

