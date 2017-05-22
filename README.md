# Hack-PHP examples

This project is just for me to try out a few simple examples using Facebook's version of PHP called Hack.

To run the programs, follow the instructions below:-

1. Install HHVM and Typechecker(for Ubuntu 14.04 and above)
```
  sudo apt-get install software-properties-common
  sudo apt-key adv --recv-keys --keyserver hkp://keyserver.ubuntu.com:80 0x5a16e7281be7a449
  sudo add-apt-repository "deb http://dl.hhvm.com/ubuntu $(lsb_release -sc) main"
  sudo apt-get update
  sudo apt-get install hhvm
```

2. Install and setup MySQL (plenty of resources show how to do this)

3. Setup Typechecker - go to the directory where you will store your Hack code and type
```
  touch .hhconfig
```

4. Run the following to see if the Hack (.php) file contains any errors
```
  hh_client
```

5. Create the configuration file using the format of sample_config.ini and name this file 'config.ini' (you'll need to create an account on openweathermap.org to obtain an API key for the weather program).

6. If they don't, then run the following in the same directory (you can choose any unused port number for the 'p' field)
```
  hhvm -m server -p 8080
```

7. Go to your browser and type the following (for the weather example)
```
  localhost:8080/getweather.php
```

If you did everything correctly, you should see the correct output!
