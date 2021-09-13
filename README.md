# Budget Maker
The Budget Maker application is a simple user interface for creating budgets. The project runs on 3 virtual machines and uses Vagrant to provision them and to install any necessary dependencies. 

## Installation Instructions
Vagrant and Virtual Box must be first installed to use this application. 

### OSX Installation
Both can be installed using Homebrew on MacOS with these commands or head to https://www.virtualbox.org/wiki/Downloads & https://www.vagrantup.com/downloads <br> <br>
$ brew cask install virtualbox <br>
$ brew cask install vagrant

### Linux Installation
To install VirtualBox: <br>
sudo apt install virtualbox

To install Vagrant: <br>
Head to:
https://linuxize.com/post/how-to-install-vagrant-on-ubuntu-18-04/


### Microsoft Installation
To install VirtualBox
Head to: <br>
https://www.virtualbox.org/wiki/Downloads

To install Vagrant
Head to: <br>
https://www.vagrantup.com/downloads


## Post Installation Instructions 
Once the software is installed, you can git clone this repository to your computer files. You can either do this from the command line or in your favourite IDE.
### From the command line
git clone https://github.com/jess-small/349-assignment1.git



From there, you open your command line, change into the directory where the repository was cloned, and run the commands "vagrant up". One this command is complete, you can visit the user site through the url link "http://127.0.0.1:8080/", and the admin site through "http://127.0.0.1:8081/".

Once you have finished with the application, you can run "vagrant destory" in the command line. This will destroy the virtual machines, and htop them running.

## Test data
Due to the hashing algorithm we use to store users passwords, test data is not available. 


# Demo Video
https://user-images.githubusercontent.com/84217552/133026504-ff5c2663-2db1-49e2-bc97-4dfc6d8a269d.mp4


