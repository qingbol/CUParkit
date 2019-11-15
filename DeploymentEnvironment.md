* Deployment Environment:

** 1. Test platform:
a. Virtual machine:
https://www.virtualbox.org/
b. Linux image:
https://www.virtualbox.org/wiki/Linux_Downloads
(e.g. Ubuntu 14.04 i386)
c. LAMP (Linux-Apache-MySQL-PHP):
https://help.ubuntu.com/community/ApacheMySQLPHP

** 2. Production platform:
a. Web page document root. You can access this directory at any one of lab machines.
/web/home/{YOUR_CU_ACCOUNT}/public_html/4620/project [6620 students should replace 462 by 662 in the path]
b. MySQL database. You can create a production MySQL database on our department server by using following link:
https://buffet.cs.clemson.edu
c. Web portal URL:
http://people.cs.clemson.edu/~{YOUR_CU_ACCOUNT}/4620/project
[6620 students should replace 4620 by 6620 in the URL]

d. Deployment steps:
i. Access any of the CS Linux lab machines.
ii. Create the following folder if it does not exist:
/web/home/{YOUR_CU_ACCOUNT}/public_html/4620/project. The directory /web/home/username already exists with a 2.0 GB quota for students.
iii. This directory and any subdirectories must have permissions 711 or 755. 711 is
recommended for security reasons (755 allows a user to get directory listing if an
index.html file does not exist.)
iv. Static files need 644 permissions.
v. PHP scripts need 600 permissions.
vi. CGI scripts need 700 permissions.