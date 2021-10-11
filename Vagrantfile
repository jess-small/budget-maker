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

  # Have to use dummy as the box for AWS
  config.vm.box = "dummy"

  config.vm.provider :aws do |aws, override|

    #Sets the aws region
    aws.region = "us-east-1"

    override.nfs.functional = false
    override.vm.allowed_synced_folder_types = :rsync

  
    #Name of key pair created for project
    aws.keypair_name = "cosc349-lab9-2021"

    #Location where keypair is stored
    override.ssh.private_key_path = "~/.ssh/cosc349-lab9-2021.pem"

    #Instance type of EC2 to create
    aws.instance_type = "t2.micro"

    #Security group that EC2 instances use
    aws.security_groups = ["sg-05c5b5de371d701a3"]

    #Availability zone of EC2 instances
    aws.availability_zone = "us-east-1a"
 
    #Subnet ID for EC2 instances
    aws.subnet_id = "subnet-11124a77"

    #AMI used for EC2 instances
    aws.ami = "ami-09e67e426f25ce0d7"

    override.ssh.username = "ubuntu"
  end

  #This command creates the web server virtual machine. This hosts the users front end.
  config.vm.define "webserver" do |webserver|
   webserver.vm.hostname = "webserver"
 
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


  #This command creates the web server virtual machine. This hosts the administrators front end.
  config.vm.define "administrative" do |administrative|
   administrative.vm.hostname = "administrative"
 


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


