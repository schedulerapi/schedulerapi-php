# PHP SDK for the SchedulerAPI Service

A fast way to add the [www.schedulerapi.com](https://www.schedulerapi.com) service into your PHP projects.

## Installation

The recommended way to install the SchedulerAPI SDK is through Composer.

```bash
composer require schedulerapi/schedulerapi-php
```

## Usage

```php
    $key = '890asfe08qt43hqtwr980agdsf9y8dfsay234hnb4308'; // API key from the service - https://www.schedulerapi.com/
    $s = new Scheduler(['key'=>$key]);
    $soon = new \DateTime('now', new \DateTimeZone('UTC'));
    $soon->modify('+5 min');
    $results = $s->scheduleWebhook(
        $soon,
        'https://mydomain.com?mykey=somevalue',
        'GET',
        ''
    );
```

## Tests

Tests executed via PHPUnit.  You will need to use composer to install the dev 

```shell script
./vendor/bin/phpunit
```
