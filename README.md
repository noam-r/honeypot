# Simple Honeypot Project

This project was built to assist people being stalked online. 

It allows the person being stalked to create a unique link they can send to their stalker a unique link created by the system and when the stalker clicks on it their details will be recorded and viewed by the person who created the unique link.


## Installation

First, clone the repository
```bash
git clone https://github.com/noam-r/honeypot.git
``` 
Run composer ([Installation instructions in case you don't have it installed](https://getcomposer.org/doc/00-intro.md))
```bash
composer update
```
Prepare your environment file
```bash
mv .env.example .env
``` 
Edit the file with your favorite editor to configure the system.

Once you have the envronment set up, you should call:
```bash
http://[system_root]/validate
```

If the configuration is correct you should see "All is well" and start working.

In order to run maintenance (delete the old files) you should set up a cron in your crontab (or wherever you schedule your tasks):

```bash
* */12 * * * /path/to/system/root/cron/run.php >/dev/null 2>&1
```

That's it - you're ready to roll. 


 