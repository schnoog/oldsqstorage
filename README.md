![Logo sqStorage](https://www.picflash.org/img/2018/12/31/hwxkb96wq17sfvu.png "Logo sqStorage")

A easy to use and super quick way to organize your inventory, storage and storage areas.

### Note
At the moment sqStorage is available in German and in English.

### Installation
In order for sqStorage to work, the database structure (file) **tlv_empty.sql** has to be imported, for example using *phpmyadmin*.
The directories **smartyfiles/** and **languages/locale/** need to be writeable for the webserver.
**chown -R www-data smartyfiles/** and **chown -R www-data languages/locale/** should do it in most cases.

### Configuration
By default, the database name used is *tlv* and the main user *tlvUser* with the password *tlvUser* - this can be configured in **support/dba.php** changing the ***DB::dbName***,  ***DB::$user*** and ***DB::$password*** variables.

### Translation
Create your own translation from the **languages/sqstorage.pot** file and save it in the corresponding language/locale/ subdirectory.

Add the new language to the existing array in
support/language_tools.php
`$langsAvailable = array('en_GB','de_DE','youLanguage');`
`$langsLabels = array(
    'en_GB' => 'English',
    'de_DE' => 'Deutsch',
    'yourLanguage => 'SpecialNameOfYourLanguage'
);`

***The language locale must be present on the webserver to be served***