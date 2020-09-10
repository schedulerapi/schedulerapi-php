<?php

namespace Scheduler\Tests;

use PHPUnit\Framework\TestCase;
use Scheduler\Scheduler;

class ScheduleTest extends TestCase
{
    public function testScheduleInFuture()
    {
        $key = trim(file_get_contents(dirname(__FILE__).'/env.key.txt'));
        $s = new Scheduler(['key'=>$key]);
        $soon = new \DateTime('now', new \DateTimeZone('UTC'));
        $soon->modify('+5 min');
        $results = $s->scheduleWebhook(
            $soon,
            'https://f9a73a6e047eaec7532e26511219ac36.m.pipedream.net',
            'GET',
            '');
        $this->assertNotEmpty($results->getId());
    }

}