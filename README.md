# Budget Maker
The Budget Maker application is a simple user interface for creating budgets. The application runs on 2 AWS EC2 virtual machine instances and uses a MySQL database which is hosted on AWS as an RDS. Vagrant is used to create the virtual machines and provision the servers.

## To use the application now:

### Admin Server
Head to http://ec2-100-27-33-102.compute-1.amazonaws.com

### Web Server
Head to http://ec2-44-193-10-91.compute-1.amazonaws.com


## Video demo of how to use application
https://user-images.githubusercontent.com/84217552/136725019-56e563c2-2143-4b0a-b4cc-09f8b7be3c48.mp4

# To run virtual machines from own AWS account

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
https://www.virtualbox.org/wiki/Downloads <br>

To install Vagrant
Head to: <br>
https://www.vagrantup.com/downloads

## Install AWS Vagrant extension
In a terminal window run these commands:

### OSX/Linux Instructions
vagrant plugin install --plugin-version 1.5.11 nokogiri <br>
vagrant plugin install --plugin-version 1.0.1 fog-ovirt <br>
vagrant plugin install --plugin-version 0.2.0 dry-inflector<br>
vagrant plugin install vagrant-aws

### Windows Instructions

In a command line window run these commands:
vagrant plugin install --plugin-version 1.0.1 fog-ovirt <br>
vagrant plugin install vagrant-aws

## Add a Vagrant dummy box
In a the folder where you want the project to be contained type this into a terminal window:
vagrant box add dummy https://github.com/mitchellh/vagrant-aws/raw/master/dummy.box


## Post Installation Instructions 
Once the software is installed, you can git clone this repository to your computer files. You can either do this from the command line 'git clone https://github.com/jess-small/349-assignment1.git' or in your favourite IDE using the URL https://github.com/jess-small/349-assignment1.git.

### Create an AWS account
For the virtual machines to be created, an AWS account is needed. Head to https://aws.amazon.com/account/sign-up.
You will then need to create a key pair and download it into the same location which is specified in the Vagrantfile on your own computer. Instructions on creating a key pair can be found here: https://docs.aws.amazon.com/AWSEC2/latest/UserGuide/ec2-key-pairs.html. Change the name of the keypair in the Vagrantfile to whatever you saved yours as.

Your credentials for your AWS are needed to start the virtual machines. Instructions on where to find these can be found here https://docs.aws.amazon.com/general/latest/gr/aws-sec-cred-types.html.
From here, cd into the .aws file from the root directory of the project. Then open up the credentials file in a text editor and copy and paste the credentials of your account. After this, the environment variables need to be set in the terminal. 

export AWS_ACCESS_KEY_ID= "YOUR VARIABLES" <br>
export AWS_SECRET_ACCESS_KEY= "YOUR VARIABLES" <br>
export AWS_SESSION_TOKEN= "YOUR VARIABLES" <br>


From there, open a terminal window, change into the directory where the repository was cloned, and run the commands "vagrant up --provider=aws". Once this command is complete, go to your AWS account console and then to the EC2 section. You should see the instances have been created.

### Database
These virtual machines will be connected to the existing RDS database. To create a new one for it to connect to head to https://www.amazonaws.cn/en/getting-started/tutorials/create-mysql-db/ for instructions on how to do so. Once created, download MySQL Workbench on your computer to create the database tables and to connect to the RDS. To connect to the new database on the servers, change the PHP database connection details to match your own.


## Clean up
Once you have finished with the application, you can run "vagrant halt" to stop the virtual machines, or "vagrant destroy" to destroy them. Note that halting/destroying the EC2s and then restarting will cause the servers to have new URLs.






