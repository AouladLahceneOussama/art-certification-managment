<p align="center">
  <img src="/public/images/logoPurple2.svg" width="100" height="100" />
</p>

# art-certification-managment
This application is made using Laravel 8.4 with jetstrem kit that come with livewire components and the laravel-admin package. the idea of this project is to manage the relation between the artist and the buyer, by managing their arts, demands, and verification of certifications, the application traits all the process from the demande until the generating of the certificate of the specific art.

# Requirements
- php >= 7.4
- Laravel = 8.4
 
# Instruction to install the application
```
git clone ...
cd art-certification-managment
composer install
npm install
php artisan migrate
```
> Don't forget to copy the env file and enter a valid database name before migration.
> After creating .env file please run this command to generate an application key 
```
php artisan key:generate
```
> The last thing to do is to insert the smtp mail trap to catch emails, and you need also to use the braintree gateway for the payment.
```
MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME= your username
MAIL_PASSWORD= your password
MAIL_ENCRYPTION=tls

BRAINTREE_ENV=sandbox
BRAINTREE_MERCHANT_ID=
BRAINTREE_PUBLIC_KEY=
BRAINTREE_PRIVATE_KEY=
```

# usage
```
php artisan serve
```
> Register to the application.

# Functionalities
- Create your profile.
- The user add the demands by inserting all the informations about the art.
- The user can verify the originality of its art by a generated code.
- All the payment are done using paypal or masterCard (directly for the persons in the same city).
- Generate the certificate after traiting the informations and the pictures of the art.
- The admin approve the account creation of the users.
