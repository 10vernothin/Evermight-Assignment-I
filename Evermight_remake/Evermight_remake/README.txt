This is my remake, using MVC structure.


This solution has three parts, the main controller "routes.php", which directs pages to "controllers" which will in turn use appropriate files from "models" 
and display pages in "views". I have three controllers, one handling the page, one handling the posts (tables) and a final one handling the server. The server controller is used for updating the 
"server_config" file. 

I have also added three extraneous files: 
 -- redir.php, which contains functions that redirect to a page with all $_POST values intact.
 -- server_config.txt, which contains server info to be . This is not hidden though it probably should be, because there's no need to go in the file itself to edit it.
 -- validation.php in models, whereas the other models are object-oriented. 


This project took three days. This project in addition of restructuring, was trying to generalize the files so that it could be used for tables other than
"tbl_automobiles". It went so far until the validation and insertion, where the validation is specific to the case itself. 


I spent the most of the first day studying MVC protocols, routing protocols from online resources. By the second day I had a prototype MVC structure of
index.php->route.php->controllers->views.

I spent most of the second day trying to make the starting interface: storing server-data and resolved to edit a physical file called "server_config" which the "server" object
would refer to whenever it is creating an instance. The server handler would update that file whenever a valid entry is inputted, so the server object can call it whenever
it wants.

The third day was used to create the Table object, which fetches a virtual table from SQL server then returns a Table 
instance that stores the values of that table. I mostly used code I already have for my original for this part, but I generalized a lot of things and
split my code into controller and view.

Finally the last few hours were used to clean up code snippets, debugging and make everything look cleaner in general.

The general "view" part should looks pretty much that same as the original, except with a little more exception handling. 


