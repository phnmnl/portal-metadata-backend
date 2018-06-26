<?php

use Base\User as BaseUser;
use Propel\Runtime\Propel;

/**
 * User Model
 */
class User extends BaseUser
{
    /**
     * User constructor.
     * @param array|null $data
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function __construct(array $data = null)
    {
        parent::__construct();
        if (isset($data)) {
            $this->setId($data['id']);
            $this->setFirstAccess($data['firstAccess']);
            $this->setLastAccess(isset($data['lastAccess']) ? $data['lastAccess'] : $data['firstAccess']);
        }
    }

    /**
     * @param $data
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function updateFromData($data)
    {
        if (isset($data)) {
            if (isset($data["hasAcceptedTermsConditions"]))
                $this->setHasAcceptedTermsConditions($data["hasAcceptedTermsConditions"]);
            if (isset($data["hasGalaxyAccount"]))
                $this->setHasGalaxyAccount($data["hasGalaxyAccount"]);
            if (isset($data["lastAccess"]))
                $this->setLastAccess($data["lastAccess"]);
        }
    }

    /**
     * @param mixed $v
     * @return BaseUser|User
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function setLastAccess($v)
    {
        $this->debug("Last access before update: "
            . ($this->getLastAccess() ? $this->getLastAccess()->getTimestamp() : "UNDEFINED"));
        if (isset($v)) {
            if (!$this->getLastAccess())
                $this->setNumberOfAccesses(1);
            else {
                $this->debug("Checking: " . $v . " -- "
                    . gettype($v) . " " . gettype($this->getLastAccess()->getTimestamp()));
                if ($v < $this->getLastAccess()->getTimestamp())
                    throw new InvalidArgumentException(
                        "Last access '$v' is less then the current " . $this->getLastAccess());
                $this->debug("Checking: " . $v . " -- " . $this->getLastAccess()->getTimestamp());
                if ($v > $this->getLastAccess()->getTimestamp()) {
                    $this->setNumberOfAccesses($this->getNumberOfAccesses() + 1);
                }
            }
        }
        return parent::setLastAccess($v);
    }

    /**
     * Print a debug message through the the default Propel logger
     *
     * @param $msg
     */
    private function debug($msg)
    {
        $this->log($msg, Propel::LOG_DEBUG);
    }
}
