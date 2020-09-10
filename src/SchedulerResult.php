<?php

namespace Scheduler;

class SchedulerResult
{
    private $_id = '';
    private $_when = '';
    private $_now = '';
    private $_user = '';

    public function __construct($id = '', $when = '', $now = '', $user = '')
    {
        $this->setId($id);
        $this->setWhen($when);
        $this->setNow($now);
        $this->setUser($user);
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->_id;
    }

    /**
     * @param string $id
     */
    public function setId($id)
    {
        $this->_id = $id;
    }

    /**
     * @return string
     */
    public function getWhen()
    {
        return $this->_when;
    }

    /**
     * @param string $when
     */
    public function setWhen($when)
    {
        $this->_when = $when;
    }

    /**
     * @return string
     */
    public function getNow()
    {
        return $this->_now;
    }

    /**
     * @param string $now
     */
    public function setNow($now)
    {
        $this->_now = $now;
    }

    /**
     * @return string
     */
    public function getUser()
    {
        return $this->_user;
    }

    /**
     * @param string $user
     */
    public function setUser($user)
    {
        $this->_user = $user;
    }
}