<?php

namespace Scheduler;

use Exception;

class Scheduler
{
    private $_key = '';

    public function __construct($config)
    {
        $this->applyConfig($config);
    }

    private function applyConfig($config)
    {
        if (isset($config['key'])) {
            $this->_key = $config['key'];
        }
    }

    private function schedule($data) {
        $payload = json_encode($data);

        $ch = curl_init('https://api.schedulerapi.com/schedule');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLINFO_HEADER_OUT, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);

        curl_setopt($ch, CURLOPT_HTTPHEADER, [
                'Content-Type: application/json',
                'Content-Length: ' . strlen($payload),
                'x-api-key: ' . $this->_key
            ]
        );

        $result = json_decode(curl_exec($ch));

        curl_close($ch);

        return new SchedulerResult(
            $result->id,
            $result->when,
            $result->now,
            $result->user
        );
    }

    /**
     * @param $when \DateTime when to fire the event
     * @param $url string URL to call when the webhook event fires
     * @param $method string either GET or POST (verb) of the webhook event
     * @param $body string body to send with the request - typically used for POST events
     * @param array $config
     * @return SchedulerResult
     * @throws Exception
     */
    public function scheduleWebhook($when, $url, $method, $body, $config = [])
    {
        if (count($config) > 0) {
            $this->applyConfig($config);
        }
        $data = [
            'when' => $when->format('Y-m-d H:i:s'),
            'protocol' => 'webhook',
            'payload'=>[
                'url' => $url,
                'method' => $method,
                'body' => $body,
            ]
        ];

        return $this->schedule($data);

    }

    /**
     * @param $when \DateTime when to fire the event
     * @param $url string URL to call when the webhook event fires
     * @param $body string body to send with the request - typically used for POST events
     * @param array $config
     * @return SchedulerResult
     * @throws Exception
     */
    public function scheduleSqs($when, $url, $body, $config = [])
    {
        if (count($config) > 0) {
            $this->applyConfig($config);
        }
        $data = [
            'when' => $when->format('Y-m-d H:i:s'),
            'protocol' => 'sqs',
            'payload'=>[
                'url' => $url,
                'body' => $body,
            ]
        ];

        return $this->schedule($data);
    }

}

