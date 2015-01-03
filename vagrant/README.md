# Vagrant

## Dependencies

You will need the following dependencies installed:
* [Vagrant Host Manager](https://github.com/smdahlen/vagrant-hostmanager)
* [ansible](http://www.ansible.com/home)
* NFS

## Description

This configuration includes following software:

* Debian 7
* Apache
* PHP FPM
* PHP 5.5
* HHVM
* Composer
* MariaDB
* node.js with Grunt and Bower

## MariaDB

* user : dev
* password : ij86EEg9

# Usage

First you need to create vagrant VM

```
$ cd vagrant
$ vagrant up
```

Then go to wedding.dev/

# Logs and cache

```
$ tail -f /dev/shm/wedding/app/logs/prod.log
$ tail -f /dev/shm/wedding/app/logs/dev.log
```
