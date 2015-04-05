# README for scripts using the Twilio API

------------------------------------------------------------
HOW TO RUN THE SCRIPTS
------------------------------------------------------------

1. Download all files/folders (sendSMS.php, clientForm.html,
   and the twilio-php-master folder) into a new directory.

2. Open the PHP file. Enter the information I have provided
   to you in the globals section and save the file.

3. Copy the downloaded files and folder to a local
   or remote server (required for Options 1 and 2). 

4. Option 1. Open the HTML file in a browser and enter the 
   phone number I have given you, type a message in the 
   text box, and hit 'Send'. Your message will be sent to
   the phone number I have given you.

5. Option 2. Type the following in a browser:

		path/to/server/folder/sendSMS.php?testing=1&auth=X

   Set the last character of the address ('X') to 0 or 1 
   for test or live credentials (read the section 
   'PROGRAM ARCHITECTURE' below).

6. Option 3. Open the php file and set the testing and auth
   variables on lines 11 and 17 to 1 and (0 for test or 1 
   for live credentials), respectively. 

   Optional: Feel free to type in a different message than
   the one provided on line 66.

   Save and execute the sendSMS.php by using the following
   command in a command line terminal:

   php sendSMS.php


-----------------------------------------------------------
PROGRAM ARCHITECTURE
-----------------------------------------------------------

	The architecture of this web app is very simple. It 
consists of a Twilio PHP helper library (available at 
https://www.twilio.com/docs/php/install), an HTML file, and
a PHP file. The PHP file is the core of the we app. It 
contains sensitive information so it must be securely 
stored with appropriate permissions. It has 2 flags that 
modulate its behavior: testing and auth. The testing flag 
allows the user to adjust the 'interface', while the auth
flag specifies which API credentials to use.

	Setting testing to 1 allows the user to execute the PHP
file directly without the use of an external interface.
When set to 0, certain variables in the PHP file will be
set by external requests, like the HTML file interface. The
HTML interface allows a user to type in a phone number and
a message. The HTML file passes these values to the PHP
file, setting the variables toNumber and message on lines
40 and 41, respectively. The fromNumber is hard-coded on 
line 39. Additionally, the HTML file also hard-codes the 
use of live credentials. Simply switch the 1 to a 0 on line 
1 of the action variable.

	In testing mode, auth needs to be set to 0 or 1. Setting 
auth to 0 establishes the use of test credentials, which 
should not result in any possible charges from Twilio. The
API will respond in certain ways depending on the 'magic'
phone numbers used, but no real messages will be sent. On 
the other hand, if auth is set to 1, live credentials will 
be used, which might results in charges from Twilio and 
actual messages may be sent to the given phone number.
