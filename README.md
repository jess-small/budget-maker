# Budget Maker
The Budget Maker application is a simple user interface for creating budgets. It uses Vagrant to provision the virtual machines that are used for this application and to install any necessary dependencies.

## Installation Instructions
Vagrant and Virtual Box must be first installed to use this application. 

Both can be installed using Homebrew on MacOS with these commands

## Post Installation Instructions 
Once the software is installed, you can git clone this repository to your computer files. From there, you open your command line, change into the directory where the repository was cloned, and run the commands "vagrant up". One this command is complete, you can visit the user site through the url link "http://127.0.0.1:8080/", and the admin site through "http://127.0.0.1:8081/".

Once you have finished with the application, you can run "vagrant destory" in the command line. This will destroy the virtual machines, and htop them running.

## Test data
Due to the hashing algorithm we use to store users passwords, test data is not available. 


# Demo Video
https://user-images.githubusercontent.com/84217552/133026504-ff5c2663-2db1-49e2-bc97-4dfc6d8a269d.mp4


