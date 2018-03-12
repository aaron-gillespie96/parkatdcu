//Synopsis//

The objective of this website was to provide a user with information about the different parking faculties within Dublin City University. 
There are different sections to the website which are targeted to different users. The sections are laid out as follows. 

Web Service 
This section of the website allows you to access real time information about the capacity of each of the car parks across DCU's three campuses. 
Simply input a carpark name into the text box and select which type of space you want and you will be given live information.

Closest Car Park 
This section of the website allows you to input the building you would like to park closest to. 
Once you click enter you will be given the closest carpark to that building.

Campus Space Information 
This section of the website allows you to get information on the carpark spaces across DCU's three campuses. Simply input a campus and you will be given the total number of regular spaces and disabled spaces for that campus.

Historical Information 
This section allows you to input a Carpark and Week (1-52) and you will be returned a list of the occupancy times for that week at each hour of the day for the previous year. 

The website is built on html and css using php to query a database which conatins two tables. One conaining histotical information for the previous year the other conating general information.

//Motivation//

The motivation behind the creation of the project was to make it easier for staff , students and guests of the university to navagiate the carparks across DCU's three campuses.

//Installation//

1.Sign up for an account with microsft azure , free account available for studnets.
2.Create a new web applation + mysql.
3.Enter a name for the application and a url in my case it was parkatdcu.azurewebsites.net (custom domains avaiable at a cost).Select the pricing structure you would like.
4.Click deploy.
5.Once deployed open the project and naviagte to the extensions tab.
6.Click add new extenstions and select phpMyAdmin.
7.Click install.
8.Click browse and you will be brought to the phpMyAdmin sign in page.
9.Go back to azure and select deployment credintals under your project and set a password.
10.Now copy your username from the project description should look like username/projectname.
11.Use this combined with your new password to log in to phpMyAdmin.
12.You can now import your csv files into tables within the database.
13.Do this by using the import function within phpMyAdmin and select the files you want to import.
14.To upload your files to the server you have to do the following
15. Download an FTP client such as filezilla.
16.Enter the ftp address provided in your project desdcription into the server box.
17. Enter the username provided in the description into the username box.
18. Enter your created password into the password box.
19. Click connect.
20. On the right hand side of the screen your local directories will be displayed on the left hand side the server directorys will be displayed.
21.On the right hand side click on the site folder and then wwwroot.
22. Simply drag the files you want to upload into this directory and you are done.