# Hack examples
 and Typechecker(for Ubuntu 14.04 and above)
'''
  sudo apt-get install software-properties-common
  sudo apt-key adv --recv-keys --keyserver hkp://keyserver.ubuntu.com:80 0x5a16e7281be7a449
  sudo add-apt-repository "deb http://dl.hhvm.com/ubuntu $(lsb_release -sc) main"
  sudo apt-get update
  sudo apt-get install hhvm
This project is just for me to try out a few simple examples using Facebook's version of PHP called Hack.

To run the programs, follow the instructions below:-

1. Install HHVM
'''

2. Install and setup MySQL (plenty of resources show how to do this)

3. Setup Typechecker - go to the directory where you will store your Hack code and type
'''
  touch .hhconfig
'''

4. Run hh_client to see if the PHP (Hack) file contains any errors

5. If they don't, then run the following in the same directory (you can choose any unused port number for the 'p' field)
'''
  hhvm -m server -p 8080
'''

6. Go to your browser and type the following (for the weather example)
'''
  localhost:8080/getweather.php
'''

If you did everything correctly, you should see the correct output!
