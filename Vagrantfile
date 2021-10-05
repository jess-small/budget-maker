# -*- mode: ruby -*-
# vi: set ft=ruby :

class Hash
  def slice(*keep_keys)
    h = {}
    keep_keys.each { |key| h[key] = fetch(key) if has_key?(key) }
    h
  end unless Hash.method_defined?(:slice)
  def except(*less_keys)
    slice(*keys - less_keys)
  end unless Hash.method_defined?(:except)
end

# This command configures the three virtual machines we use for this application.
Vagrant.configure("2") do |config|

  # We use Ubuntu software, so we can specify our box with this command
  config.vm.box = "ubuntu/xenial64"

  config.vm.provider :aws do |aws, override|

    aws.region = "us-east-1"

    override.nfs.functional = false
    override.vm.allowed_synced_folder_types = :rsync

    aws.keypair_name = "AMIwwwdudgetmaker-kp"
    override.ssh.private_key_path = "~/.ssh/AMIwwwdudgetmaker-kp.pem"

    aws.instance_type = "t2.micro"

    aws.security_groups = ["sg-0496c3e0487402a45"]

    aws.availability_zone = "us-east-1a"
    aws.subnet_id = "subnet-11124a77"

    aws.ami = "ami-089b5711e63812c2a"

    override.ssh.username = "ubuntu"
  end

  #This command creates the web server virtual machine. This hosts the users front end.
  config.vm.define "webserver" do |webserver|
   webserver.vm.hostname = "webserver"
   #Port-forwarding settings
   webserver.vm.network "forwarded_port", guest: 80, host: 8080, host_ip: "127.0.0.1"
   #private IP address. This allows a channel for virtual machines to communicate with one another.
   webserver.vm.network "private_network", ip: "192.168.2.11"
   #Permissions for Owheo lab computers to access the application
   webserver.vm.synced_folder ".", "/vagrant", owner: "vagrant", group: "vagrant", mount_options: ["dmode=775,fmode=777"]


  # Enable provisioning of the webserver with a shell script.
   webserver.vm.provision "shell", inline: <<-SHELL
     apt-get update
     apt-get install -y apache2 php libapache2-mod-php php-mysql
     # Changes VM's webserver's configuration to use the www shared folder.
      cp /vagrant/test-website.conf /etc/apache2/sites-available/
      # Activate our website configuration
      a2ensite test-website
      # Disable the default website provided with Apache
      a2dissite 000-default
      # Reload the webserver configuration, to pick up our changes
      service apache2 reload

   SHELL
end

  #This command creates the database server virtual machine.
  config.vm.define "dbserver" do |dbserver|
    dbserver.vm.hostname = "dbserver"
    # Note that the IP address is different from that of the webserver
    # above: it is important that no two VMs attempt to use the same
    # IP address on the private_network.
    dbserver.vm.network "private_network", ip: "192.168.2.12"
    #Permissions for Owheo lab computers to access the application
    dbserver.vm.synced_folder ".", "/vagrant", owner: "vagrant", group: "vagrant", mount_options: ["dmode=775,fmode=777"]
    
    # Enable provisioning the database with a shell script. 
    dbserver.vm.provision "shell", inline: <<-SHELL
      # Update Ubuntu software packages.
      apt-get update
      
      # We create a shell variable MYSQL_PWD that contains the MySQL root password
      export MYSQL_PWD='insecure_mysqlroot_pw'

      # If you run the `apt-get install mysql-server` command
      # manually, it will prompt you to enter a MySQL root
      # password. The next two lines set up answers to the questions
      # the package installer would otherwise ask ahead of it asking,
      # so our automated provisioning script does not get stopped by
      # the software package management system attempting to ask the
      # user for configuration information.
      echo "mysql-server mysql-server/root_password password $MYSQL_PWD" | debconf-set-selections 
      echo "mysql-server mysql-server/root_password_again password $MYSQL_PWD" | debconf-set-selections

      # Install the MySQL database server.
      apt-get -y install mysql-server

      # Run some setup commands to get the database ready to use.
      # First create a database.
      echo "CREATE DATABASE fvision;" | mysql

      # Then create a database user "webuser" with the given password.
      echo "CREATE USER 'webuser'@'%' IDENTIFIED BY 'insecure_db_pw';" | mysql

      # Grant all permissions to the database user "webuser" regarding
      # the "fvision" database that we just created, above.
      echo "GRANT ALL PRIVILEGES ON fvision.* TO 'webuser'@'%'" | mysql
      
      # Set the MYSQL_PWD shell variable that the mysql command will
      # try to use as the database password ...
      export MYSQL_PWD='insecure_db_pw'

      # ... and run all of the SQL within the setup-database.sql file,
      # which is part of the repository containing this Vagrantfile, so you
      # can look at the file on your host. The mysql command specifies both
      # the user to connect as (webuser) and the database to use (fvision).
      cat /vagrant/dbserver/db.sql | mysql -u webuser fvision

      # By default, MySQL only listens for local network requests,
      # i.e., that originate from within the dbserver VM. We need to
      # change this so that the webserver VM can connect to the
      # database on the dbserver VM. Use of `sed` is pretty obscure,
      # but the net effect of the command is to find the line
      # containing "bind-address" within the given `mysqld.cnf`
      # configuration file and then to change "127.0.0.1" (meaning
      # local only) to "0.0.0.0" (meaning accept connections from any
      # network interface).
      sed -i'' -e '/bind-address/s/127.0.0.1/0.0.0.0/' /etc/mysql/mysql.conf.d/mysqld.cnf

      # We then restart the MySQL server to ensure that it picks up
      # our configuration changes.
      service mysql restart
    SHELL
  end

  #This command creates the web server virtual machine. This hosts the administrators front end.
  config.vm.define "administrative" do |administrative|
   administrative.vm.hostname = "administrative"
   #Port-forwarding settings. Note webserver and administrative machines have different host port numbers
   administrative.vm.network "forwarded_port", guest: 80, host: 8081, host_ip: "127.0.0.1"
   #private IP address.
   administrative.vm.network "private_network", ip: "192.168.2.13"
  #Permissions for Owheo lab computers to access the application
   administrative.vm.synced_folder ".", "/vagrant", owner: "vagrant", group: "vagrant", mount_options: ["dmode=775,fmode=777"]


  # Enable provisioning of the administratice server with a shell script.
   administrative.vm.provision "shell", inline: <<-SHELL
     apt-get update
     apt-get install -y apache2 php libapache2-mod-php php-mysql
     # Change VM's administrative's configuration to use shared folder.
      cp /vagrant/admin.conf /etc/apache2/sites-available/
      # Activate our website configuration
      a2ensite admin
      # Disable the default website provided with Apache
      a2dissite 000-default
      # Reload the administrative configuration, to pick up our changes
      service apache2 reload

   SHELL
end

end


