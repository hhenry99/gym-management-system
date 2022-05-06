# gym-management-system

Hello my name is Henry and for this project I built a Gym Management System. The purpose of this system is to help the admins or (gym employees/manager) to be able to keep track of sales and the memebers within the system.  Tools that were used: HTML, CSS, JQUERY/AJAX, PHP, XAMPP.

Currently there are 3 users within this system, which consists of the headadmin, admin, and trainer. The admin and headadmin are fairly similiar and they are able to manage(CRUD) all sorts of things within the system, including the plans, equipments, and members. However the headadmin is able to add and manage other admins to the system. The trainer is able to manage classes that were assign to them and add members to their class. 

That being said, here are the steps to get the system to work: 
1) Download XAMPP and start Apache Server and MYSQL. (or hosting of your choice)
2) Download source code (make sure to place them in HTDOCS folder)
3) Run database script. Found under database / GGGscriptsUpdated.sql
4) Go on browser and type the address in: localhost/gym-management-system/admin/login.php 
5) A login screen will appear and change the role selection to headadmin
6) Enter in admin as the username and password (This is the first user that was added to the system)
7) All done! Test and play around with the system!

Folders: 
1) admin // All the admin related stuff will go here
    1) config // Creating constants and database connection
    2) crud // All of the pages regarding adding, updating, and deleting data
    3) css // CSS folder
    4) images // Folder stores images that are being upload
    5) partials // folder to store pages that are being reuse over and over again

2) database // database script and model is stored here

3) Trainer // Stuff related to trainer goes here

# comments 
I am not an expert - This is my first project using the tools above, there may be some flaws within the code. 

Only one user can be logged in per browser. This is because we are using sessions to check if the user is logged in. Once the user logged off, all sessions are being destroyed. So if you have multiple systems open using chrome, and one logs off, all the other systems would logged off as well. To prevent this, I implemented some code that only one user can be logged in. However you are able to open up two different browsers (Explorer and chrome, etc) and it will work!

No security has been added to the server such as SQL injection and hashing. I will eventually implement.

If I were to do this project over again, I will use bootstrap and go object orientated approach.

A video I made on the project https://www.youtube.com/watch?v=dx4YF-XaX7E&list=PLQuNlpzB7VQ1qG92FC_SVo2h9ngvmYwyG&index=2
