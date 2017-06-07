Hello,

I apologize that this assignment took a while for me to finish instead of the three to six hours. 
By Sunday night, however, I finished with prelimaries and started on the design of the assignment by Monday evening, and coding by Monday night.

I started with a basic SQLhandler object that uses the MySQLI driver. I've created an extra page for the user to fill in their
servername, username and password for their own server. Default is my own, which is the basic WAMP server ('localhost:3306', 'root', ''). I included this object in the files 
required for SQL and solely used this object for whenever SQL is needed. 

I also made an extra validation-insertion page. The error is given as an alert button. I'm not sure if that counts as "server-side validation".

A problem I encountered was mostly syntax, especially when it comes to double quotes/single quotes in $_POST[] and alert(). Another is my overuse of echo; it's effective but I'm unsure if its the best way. I did not make a .css file, but even without a .css file, I've tried to make it as clean as it can be. Finally, I couldn't figure out how to permanently configure SQLhandler, so I just passed the username, servername, and password of the server through all the files in $_POST[], which I figure is not a very secure way of doing it. 

I used many of the resources online for reference to complete this project, mostly W3Schools.com and StackOverflow.com.


Thank you, I hope you respond soon.

~~~~~~~~~~~~~~~~~~~~~


To start, please drag the "EVERMIGHT ASSIGNMENT I" folder to your www.directory, then go on the server and click on "Start.php".




