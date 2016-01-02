#!bin/sh

# Deployment script for Api war 
# Usage : In case of fresh deployment , just run this script without any argument .
#         In case of reverting last deployment , pass "revert" as an argument to this script 

echo "Initiating ...\n"

# Variable Constants 
PRIVATE_KEY_PATH='/Users/afroz/Downloads/main-website.pem' 
SERVER_NAME='52.25.218.204'
WAR_LOCATION='/Users/afroz/Downloads/pantry_car.war'



if [[ $1 == 'revert' ]] 
then
	echo "Reverting ...\n"
	ssh -i $PRIVATE_KEY_PATH ubuntu@$SERVER_NAME 'cp /var/local/apache-tomcat-8.0.22/webapps/pantry_car_backup.war /var/local/apache-tomcat-8.0.22/webapps/pantry_car.war'
else 
	echo "Deploying .. \n"
	ssh -i $PRIVATE_KEY_PATH ubuntu@$SERVER_NAME 'cp /var/local/apache-tomcat-8.0.22/webapps/pantry_car.war /var/local/apache-tomcat-8.0.22/webapps/pantry_car_backup.war'
	scp -i $PRIVATE_KEY_PATH $WAR_LOCATION ubuntu@$SERVER_NAME:/var/local/apache-tomcat-8.0.22/webapps/
   
fi	

ssh -i $PRIVATE_KEY_PATH ubuntu@$SERVER_NAME 'sudo /var/local/apache-tomcat-8.0.22/bin/shutdown.sh;sudo /var/local/apache-tomcat-8.0.22/bin/startup.sh'	

echo "\nDone\n"