
# POWER GYM PLATFORM
Power Gym is an all-in-one administration platform that streamlines membership, scheduling, and billing for gym owners. It automates operations to save time and drive growth.



## Requirements
- Composer & PHP >= 8.2
- PHP Symfony framework
- PosgresSQL database
- 7-Zip library
## Environment Variables

To run project, you will need to modify the following environment variables to your .env file

`DATABASE_URL=`

`DATABASE_URL_TMP=`


## Installation

First clone repository
```bash
  git clone git@github.com:Mou3in02/powergym_server_app.git
```
Move into folder
```bash
  cd powergym_server_app
```
Install symfony dependencies
```bash
  composer install
```
Create main & tmp databases
```bash
  php bin/console d:d:c
  php bin/console d:d:c --connection=temp_db
```
Integrate database schema
```bash
  php bin/console app:create-database-schema
```
Execute migration files
```bash
  php bin/console d:m:m
```
Insert service user
```bash
  php bin/console app-dev:generate-user-service
```
Generate the first administrator account
```bash
  php bin/console app-dev:generate-user-admin -u your_username -p your_password
```
Run project
```bash
  symfony server:start
```

After import backups you need to execute this command to merge data to a database
```bash
  php bin/console app:extract-uploaded-files
  php bin/console app:import-sql-script
  php bin/console app:merge-sql-script
```
## Features
- Member Management
- Billing & Payments


## Tech Stack

**Client side:** Javascript, CSS, bootstrap, JQuery

**Server side:** PHP, Symfony, PostgreSQL


## Used By

This project is used by the following companies:

- Power GYM

![Logo](logo.png)


## Authors

- [@Mouine LAHBIB](https://www.github.com/Mou3in02)
- [@Yassine LAHBIB](https://www.github.com/yassinelhb1)

## 🚀 About Me
Senior PHP Symfony / React Native developer


## 🔗 Links
[![linkedin](https://img.shields.io/badge/linkedin-0A66C2?style=for-the-badge&logo=linkedin&logoColor=white)](https://www.linkedin.com/in/mouine-lahbib-211579172/)

