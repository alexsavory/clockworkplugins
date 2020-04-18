This is for the web portion. Navigate to your clockwork database, more than likley you will use phpMyadmin. 
You will need to add 3 new tables to your clockwork database for the plugin to work.

When in the clockwork database click the Import tab, upload all 3 sql files. If you cannot for some reason upload files, open them then copy the SQL function.
3 New tables will be created:

combinelogins
combineannoucements
combinereports

!!!You do not need a seperate database! This will use the clockwork database!!!

Upload the web files to a accessible webspace, probably in its own seperate directory or a subdomain. If you wish this not to be accessible outside of the game, you could:
- place the website files in a randomly named folder eg. www.mywebsite.com/kasjdkajs89IJO21lkma0S

Edit the file "include/configuration.php" with your MYSQL info.
Then set other settings to your liking.