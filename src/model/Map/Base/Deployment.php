<?php

namespace Base;

use \DeploymentQuery as ChildDeploymentQuery;
use \User as ChildUser;
use \UserQuery as ChildUserQuery;
use \DateTime;
use \Exception;
use \PDO;
use Map\DeploymentTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveRecord\ActiveRecordInterface;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\BadMethodCallException;
use Propel\Runtime\Exception\LogicException;
use Propel\Runtime\Exception\PropelException;
use Propel\Runtime\Map\TableMap;
use Propel\Runtime\Parser\AbstractParser;
use Propel\Runtime\Util\PropelDateTime;

/**
 * Base class that represents a row from the 'deployment' table.
 *
 *
 *
 * @package    propel.generator..Base
 */
abstract class Deployment implements ActiveRecordInterface
{
    /**
     * TableMap class name
     */
    const TABLE_MAP = '\\Map\\DeploymentTableMap';


    /**
     * attribute to determine if this object has previously been saved.
     * @var boolean
     */
    protected $new = true;

    /**
     * attribute to determine whether this object has been deleted.
     * @var boolean
     */
    protected $deleted = false;

    /**
     * The columns that have been modified in current object.
     * Tracking modified columns allows us to only update modified columns.
     * @var array
     */
    protected $modifiedColumns = array();

    /**
     * The (virtual) columns that are added at runtime
     * The formatters can add supplementary columns based on a resultset
     * @var array
     */
    protected $virtualColumns = array();

    /**
     * The value for the id field.
     *
     * @var        int
     */
    protected $id;

    /**
     * The value for the user field.
     *
     * @var        string
     */
    protected $user;

    /**
     * The value for the name field.
     *
     * @var        string
     */
    protected $name;

    /**
     * The value for the reference field.
     *
     * @var        string
     */
    protected $reference;

    /**
     * The value for the provider field.
     *
     * @var        string
     */
    protected $provider;

    /**
     * The value for the created field.
     *
     * @var        DateTime
     */
    protected $created;

    /**
     * The value for the deployed field.
     *
     * @var        DateTime
     */
    protected $deployed;

    /**
     * The value for the destroyed field.
     *
     * @var        DateTime
     */
    protected $destroyed;

    /**
     * The value for the failed field.
     *
     * @var        DateTime
     */
    protected $failed;

    /**
     * The value for the configuration field.
     *
     * @var        string
     */
    protected $configuration;

    /**
     * @var        ChildUser
     */
    protected $aDeploymentUser;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     *
     * @var boolean
     */
    protected $alreadyInSave = false;

    /**
     * Initializes internal state of Base\Deployment object.
     */
    public function __construct()
    {
    }

    /**
     * Returns whether the object has been modified.
     *
     * @return boolean True if the object has been modified.
     */
    public function isModified()
    {
        return !!$this->modifiedColumns;
    }

    /**
     * Has specified column been modified?
     *
     * @param  string  $col column fully qualified name (TableMap::TYPE_COLNAME), e.g. Book::AUTHOR_ID
     * @return boolean True if $col has been modified.
     */
    public function isColumnModified($col)
    {
        return $this->modifiedColumns && isset($this->modifiedColumns[$col]);
    }

    /**
     * Get the columns that have been modified in this object.
     * @return array A unique list of the modified column names for this object.
     */
    public function getModifiedColumns()
    {
        return $this->modifiedColumns ? array_keys($this->modifiedColumns) : [];
    }

    /**
     * Returns whether the object has ever been saved.  This will
     * be false, if the object was retrieved from storage or was created
     * and then saved.
     *
     * @return boolean true, if the object has never been persisted.
     */
    public function isNew()
    {
        return $this->new;
    }

    /**
     * Setter for the isNew attribute.  This method will be called
     * by Propel-generated children and objects.
     *
     * @param boolean $b the state of the object.
     */
    public function setNew($b)
    {
        $this->new = (boolean) $b;
    }

    /**
     * Whether this object has been deleted.
     * @return boolean The deleted state of this object.
     */
    public function isDeleted()
    {
        return $this->deleted;
    }

    /**
     * Specify whether this object has been deleted.
     * @param  boolean $b The deleted state of this object.
     * @return void
     */
    public function setDeleted($b)
    {
        $this->deleted = (boolean) $b;
    }

    /**
     * Sets the modified state for the object to be false.
     * @param  string $col If supplied, only the specified column is reset.
     * @return void
     */
    public function resetModified($col = null)
    {
        if (null !== $col) {
            if (isset($this->modifiedColumns[$col])) {
                unset($this->modifiedColumns[$col]);
            }
        } else {
            $this->modifiedColumns = array();
        }
    }

    /**
     * Compares this with another <code>Deployment</code> instance.  If
     * <code>obj</code> is an instance of <code>Deployment</code>, delegates to
     * <code>equals(Deployment)</code>.  Otherwise, returns <code>false</code>.
     *
     * @param  mixed   $obj The object to compare to.
     * @return boolean Whether equal to the object specified.
     */
    public function equals($obj)
    {
        if (!$obj instanceof static) {
            return false;
        }

        if ($this === $obj) {
            return true;
        }

        if (null === $this->getPrimaryKey() || null === $obj->getPrimaryKey()) {
            return false;
        }

        return $this->getPrimaryKey() === $obj->getPrimaryKey();
    }

    /**
     * Get the associative array of the virtual columns in this object
     *
     * @return array
     */
    public function getVirtualColumns()
    {
        return $this->virtualColumns;
    }

    /**
     * Checks the existence of a virtual column in this object
     *
     * @param  string  $name The virtual column name
     * @return boolean
     */
    public function hasVirtualColumn($name)
    {
        return array_key_exists($name, $this->virtualColumns);
    }

    /**
     * Get the value of a virtual column in this object
     *
     * @param  string $name The virtual column name
     * @return mixed
     *
     * @throws PropelException
     */
    public function getVirtualColumn($name)
    {
        if (!$this->hasVirtualColumn($name)) {
            throw new PropelException(sprintf('Cannot get value of inexistent virtual column %s.', $name));
        }

        return $this->virtualColumns[$name];
    }

    /**
     * Set the value of a virtual column in this object
     *
     * @param string $name  The virtual column name
     * @param mixed  $value The value to give to the virtual column
     *
     * @return $this|Deployment The current object, for fluid interface
     */
    public function setVirtualColumn($name, $value)
    {
        $this->virtualColumns[$name] = $value;

        return $this;
    }

    /**
     * Logs a message using Propel::log().
     *
     * @param  string  $msg
     * @param  int     $priority One of the Propel::LOG_* logging levels
     * @return boolean
     */
    protected function log($msg, $priority = Propel::LOG_INFO)
    {
        return Propel::log(get_class($this) . ': ' . $msg, $priority);
    }

    /**
     * Export the current object properties to a string, using a given parser format
     * <code>
     * $book = BookQuery::create()->findPk(9012);
     * echo $book->exportTo('JSON');
     *  => {"Id":9012,"Title":"Don Juan","ISBN":"0140422161","Price":12.99,"PublisherId":1234,"AuthorId":5678}');
     * </code>
     *
     * @param  mixed   $parser                 A AbstractParser instance, or a format name ('XML', 'YAML', 'JSON', 'CSV')
     * @param  boolean $includeLazyLoadColumns (optional) Whether to include lazy load(ed) columns. Defaults to TRUE.
     * @return string  The exported data
     */
    public function exportTo($parser, $includeLazyLoadColumns = true)
    {
        if (!$parser instanceof AbstractParser) {
            $parser = AbstractParser::getParser($parser);
        }

        return $parser->fromArray($this->toArray(TableMap::TYPE_PHPNAME, $includeLazyLoadColumns, array(), true));
    }

    /**
     * Clean up internal collections prior to serializing
     * Avoids recursive loops that turn into segmentation faults when serializing
     */
    public function __sleep()
    {
        $this->clearAllReferences();

        $cls = new \ReflectionClass($this);
        $propertyNames = [];
        $serializableProperties = array_diff($cls->getProperties(), $cls->getProperties(\ReflectionProperty::IS_STATIC));

        foreach($serializableProperties as $property) {
            $propertyNames[] = $property->getName();
        }

        return $propertyNames;
    }

    /**
     * Get the [id] column value.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get the [user] column value.
     *
     * @return string
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Get the [name] column value.
     *
     * @return string
     */
    public function getname()
    {
        return $this->name;
    }

    /**
     * Get the [reference] column value.
     *
     * @return string
     */
    public function getReference()
    {
        return $this->reference;
    }

    /**
     * Get the [provider] column value.
     *
     * @return string
     */
    public function getProvider()
    {
        return $this->provider;
    }

    /**
     * Get the [optionally formatted] temporal [created] column value.
     *
     *
     * @param      string $format The date/time format string (either date()-style or strftime()-style).
     *                            If format is NULL, then the raw DateTime object will be returned.
     *
     * @return string|DateTime Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00 00:00:00
     *
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getCreated($format = NULL)
    {
        if ($format === null) {
            return $this->created;
        } else {
            return $this->created instanceof \DateTimeInterface ? $this->created->format($format) : null;
        }
    }

    /**
     * Get the [optionally formatted] temporal [deployed] column value.
     *
     *
     * @param      string $format The date/time format string (either date()-style or strftime()-style).
     *                            If format is NULL, then the raw DateTime object will be returned.
     *
     * @return string|DateTime Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00 00:00:00
     *
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getDeployed($format = NULL)
    {
        if ($format === null) {
            return $this->deployed;
        } else {
            return $this->deployed instanceof \DateTimeInterface ? $this->deployed->format($format) : null;
        }
    }

    /**
     * Get the [optionally formatted] temporal [destroyed] column value.
     *
     *
     * @param      string $format The date/time format string (either date()-style or strftime()-style).
     *                            If format is NULL, then the raw DateTime object will be returned.
     *
     * @return string|DateTime Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00 00:00:00
     *
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getDestroyed($format = NULL)
    {
        if ($format === null) {
            return $this->destroyed;
        } else {
            return $this->destroyed instanceof \DateTimeInterface ? $this->destroyed->format($format) : null;
        }
    }

    /**
     * Get the [optionally formatted] temporal [failed] column value.
     *
     *
     * @param      string $format The date/time format string (either date()-style or strftime()-style).
     *                            If format is NULL, then the raw DateTime object will be returned.
     *
     * @return string|DateTime Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00 00:00:00
     *
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getFailed($format = NULL)
    {
        if ($format === null) {
            return $this->failed;
        } else {
            return $this->failed instanceof \DateTimeInterface ? $this->failed->format($format) : null;
        }
    }

    /**
     * Get the [configuration] column value.
     *
     * @return string
     */
    public function getConfiguration()
    {
        return $this->configuration;
    }

    /**
     * Set the value of [id] column.
     *
     * @param int $v new value
     * @return $this|\Deployment The current object (for fluent API support)
     */
    public function setId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->id !== $v) {
            $this->id = $v;
            $this->modifiedColumns[DeploymentTableMap::COL_ID] = true;
        }

        return $this;
    } // setId()

    /**
     * Set the value of [user] column.
     *
     * @param string $v new value
     * @return $this|\Deployment The current object (for fluent API support)
     */
    public function setUser($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->user !== $v) {
            $this->user = $v;
            $this->modifiedColumns[DeploymentTableMap::COL_USER] = true;
        }

        if ($this->aDeploymentUser !== null && $this->aDeploymentUser->getId() !== $v) {
            $this->aDeploymentUser = null;
        }

        return $this;
    } // setUser()

    /**
     * Set the value of [name] column.
     *
     * @param string $v new value
     * @return $this|\Deployment The current object (for fluent API support)
     */
    public function setname($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->name !== $v) {
            $this->name = $v;
            $this->modifiedColumns[DeploymentTableMap::COL_NAME] = true;
        }

        return $this;
    } // setname()

    /**
     * Set the value of [reference] column.
     *
     * @param string $v new value
     * @return $this|\Deployment The current object (for fluent API support)
     */
    public function setReference($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->reference !== $v) {
            $this->reference = $v;
            $this->modifiedColumns[DeploymentTableMap::COL_REFERENCE] = true;
        }

        return $this;
    } // setReference()

    /**
     * Set the value of [provider] column.
     *
     * @param string $v new value
     * @return $this|\Deployment The current object (for fluent API support)
     */
    public function setProvider($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->provider !== $v) {
            $this->provider = $v;
            $this->modifiedColumns[DeploymentTableMap::COL_PROVIDER] = true;
        }

        return $this;
    } // setProvider()

    /**
     * Sets the value of [created] column to a normalized version of the date/time value specified.
     *
     * @param  mixed $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this|\Deployment The current object (for fluent API support)
     */
    public function setCreated($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->created !== null || $dt !== null) {
            if ($this->created === null || $dt === null || $dt->format("Y-m-d H:i:s.u") !== $this->created->format("Y-m-d H:i:s.u")) {
                $this->created = $dt === null ? null : clone $dt;
                $this->modifiedColumns[DeploymentTableMap::COL_CREATED] = true;
            }
        } // if either are not null

        return $this;
    } // setCreated()

    /**
     * Sets the value of [deployed] column to a normalized version of the date/time value specified.
     *
     * @param  mixed $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this|\Deployment The current object (for fluent API support)
     */
    public function setDeployed($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->deployed !== null || $dt !== null) {
            if ($this->deployed === null || $dt === null || $dt->format("Y-m-d H:i:s.u") !== $this->deployed->format("Y-m-d H:i:s.u")) {
                $this->deployed = $dt === null ? null : clone $dt;
                $this->modifiedColumns[DeploymentTableMap::COL_DEPLOYED] = true;
            }
        } // if either are not null

        return $this;
    } // setDeployed()

    /**
     * Sets the value of [destroyed] column to a normalized version of the date/time value specified.
     *
     * @param  mixed $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this|\Deployment The current object (for fluent API support)
     */
    public function setDestroyed($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->destroyed !== null || $dt !== null) {
            if ($this->destroyed === null || $dt === null || $dt->format("Y-m-d H:i:s.u") !== $this->destroyed->format("Y-m-d H:i:s.u")) {
                $this->destroyed = $dt === null ? null : clone $dt;
                $this->modifiedColumns[DeploymentTableMap::COL_DESTROYED] = true;
            }
        } // if either are not null

        return $this;
    } // setDestroyed()

    /**
     * Sets the value of [failed] column to a normalized version of the date/time value specified.
     *
     * @param  mixed $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this|\Deployment The current object (for fluent API support)
     */
    public function setFailed($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->failed !== null || $dt !== null) {
            if ($this->failed === null || $dt === null || $dt->format("Y-m-d H:i:s.u") !== $this->failed->format("Y-m-d H:i:s.u")) {
                $this->failed = $dt === null ? null : clone $dt;
                $this->modifiedColumns[DeploymentTableMap::COL_FAILED] = true;
            }
        } // if either are not null

        return $this;
    } // setFailed()

    /**
     * Set the value of [configuration] column.
     *
     * @param string $v new value
     * @return $this|\Deployment The current object (for fluent API support)
     */
    public function setConfiguration($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->configuration !== $v) {
            $this->configuration = $v;
            $this->modifiedColumns[DeploymentTableMap::COL_CONFIGURATION] = true;
        }

        return $this;
    } // setConfiguration()

    /**
     * Indicates whether the columns in this object are only set to default values.
     *
     * This method can be used in conjunction with isModified() to indicate whether an object is both
     * modified _and_ has some values set which are non-default.
     *
     * @return boolean Whether the columns in this object are only been set with default values.
     */
    public function hasOnlyDefaultValues()
    {
        // otherwise, everything was equal, so return TRUE
        return true;
    } // hasOnlyDefaultValues()

    /**
     * Hydrates (populates) the object variables with values from the database resultset.
     *
     * An offset (0-based "start column") is specified so that objects can be hydrated
     * with a subset of the columns in the resultset rows.  This is needed, for example,
     * for results of JOIN queries where the resultset row includes columns from two or
     * more tables.
     *
     * @param array   $row       The row returned by DataFetcher->fetch().
     * @param int     $startcol  0-based offset column which indicates which restultset column to start with.
     * @param boolean $rehydrate Whether this object is being re-hydrated from the database.
     * @param string  $indexType The index type of $row. Mostly DataFetcher->getIndexType().
                                  One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                            TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *
     * @return int             next starting column
     * @throws PropelException - Any caught Exception will be rewrapped as a PropelException.
     */
    public function hydrate($row, $startcol = 0, $rehydrate = false, $indexType = TableMap::TYPE_NUM)
    {
        try {

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : DeploymentTableMap::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)];
            $this->id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : DeploymentTableMap::translateFieldName('User', TableMap::TYPE_PHPNAME, $indexType)];
            $this->user = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : DeploymentTableMap::translateFieldName('name', TableMap::TYPE_PHPNAME, $indexType)];
            $this->name = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : DeploymentTableMap::translateFieldName('Reference', TableMap::TYPE_PHPNAME, $indexType)];
            $this->reference = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : DeploymentTableMap::translateFieldName('Provider', TableMap::TYPE_PHPNAME, $indexType)];
            $this->provider = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : DeploymentTableMap::translateFieldName('Created', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->created = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : DeploymentTableMap::translateFieldName('Deployed', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->deployed = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 7 + $startcol : DeploymentTableMap::translateFieldName('Destroyed', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->destroyed = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 8 + $startcol : DeploymentTableMap::translateFieldName('Failed', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->failed = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 9 + $startcol : DeploymentTableMap::translateFieldName('Configuration', TableMap::TYPE_PHPNAME, $indexType)];
            $this->configuration = (null !== $col) ? (string) $col : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 10; // 10 = DeploymentTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\Deployment'), 0, $e);
        }
    }

    /**
     * Checks and repairs the internal consistency of the object.
     *
     * This method is executed after an already-instantiated object is re-hydrated
     * from the database.  It exists to check any foreign keys to make sure that
     * the objects related to the current object are correct based on foreign key.
     *
     * You can override this method in the stub class, but you should always invoke
     * the base method from the overridden method (i.e. parent::ensureConsistency()),
     * in case your model changes.
     *
     * @throws PropelException
     */
    public function ensureConsistency()
    {
        if ($this->aDeploymentUser !== null && $this->user !== $this->aDeploymentUser->getId()) {
            $this->aDeploymentUser = null;
        }
    } // ensureConsistency

    /**
     * Reloads this object from datastore based on primary key and (optionally) resets all associated objects.
     *
     * This will only work if the object has been saved and has a valid primary key set.
     *
     * @param      boolean $deep (optional) Whether to also de-associated any related objects.
     * @param      ConnectionInterface $con (optional) The ConnectionInterface connection to use.
     * @return void
     * @throws PropelException - if this object is deleted, unsaved or doesn't have pk match in db
     */
    public function reload($deep = false, ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("Cannot reload a deleted object.");
        }

        if ($this->isNew()) {
            throw new PropelException("Cannot reload an unsaved object.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(DeploymentTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildDeploymentQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aDeploymentUser = null;
        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param      ConnectionInterface $con
     * @return void
     * @throws PropelException
     * @see Deployment::setDeleted()
     * @see Deployment::isDeleted()
     */
    public function delete(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(DeploymentTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildDeploymentQuery::create()
                ->filterByPrimaryKey($this->getPrimaryKey());
            $ret = $this->preDelete($con);
            if ($ret) {
                $deleteQuery->delete($con);
                $this->postDelete($con);
                $this->setDeleted(true);
            }
        });
    }

    /**
     * Persists this object to the database.
     *
     * If the object is new, it inserts it; otherwise an update is performed.
     * All modified related objects will also be persisted in the doSave()
     * method.  This method wraps all precipitate database operations in a
     * single transaction.
     *
     * @param      ConnectionInterface $con
     * @return int             The number of rows affected by this insert/update and any referring fk objects' save() operations.
     * @throws PropelException
     * @see doSave()
     */
    public function save(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("You cannot save an object that has been deleted.");
        }

        if ($this->alreadyInSave) {
            return 0;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(DeploymentTableMap::DATABASE_NAME);
        }

        return $con->transaction(function () use ($con) {
            $ret = $this->preSave($con);
            $isInsert = $this->isNew();
            if ($isInsert) {
                $ret = $ret && $this->preInsert($con);
            } else {
                $ret = $ret && $this->preUpdate($con);
            }
            if ($ret) {
                $affectedRows = $this->doSave($con);
                if ($isInsert) {
                    $this->postInsert($con);
                } else {
                    $this->postUpdate($con);
                }
                $this->postSave($con);
                DeploymentTableMap::addInstanceToPool($this);
            } else {
                $affectedRows = 0;
            }

            return $affectedRows;
        });
    }

    /**
     * Performs the work of inserting or updating the row in the database.
     *
     * If the object is new, it inserts it; otherwise an update is performed.
     * All related objects are also updated in this method.
     *
     * @param      ConnectionInterface $con
     * @return int             The number of rows affected by this insert/update and any referring fk objects' save() operations.
     * @throws PropelException
     * @see save()
     */
    protected function doSave(ConnectionInterface $con)
    {
        $affectedRows = 0; // initialize var to track total num of affected rows
        if (!$this->alreadyInSave) {
            $this->alreadyInSave = true;

            // We call the save method on the following object(s) if they
            // were passed to this object by their corresponding set
            // method.  This object relates to these object(s) by a
            // foreign key reference.

            if ($this->aDeploymentUser !== null) {
                if ($this->aDeploymentUser->isModified() || $this->aDeploymentUser->isNew()) {
                    $affectedRows += $this->aDeploymentUser->save($con);
                }
                $this->setDeploymentUser($this->aDeploymentUser);
            }

            if ($this->isNew() || $this->isModified()) {
                // persist changes
                if ($this->isNew()) {
                    $this->doInsert($con);
                    $affectedRows += 1;
                } else {
                    $affectedRows += $this->doUpdate($con);
                }
                $this->resetModified();
            }

            $this->alreadyInSave = false;

        }

        return $affectedRows;
    } // doSave()

    /**
     * Insert the row in the database.
     *
     * @param      ConnectionInterface $con
     *
     * @throws PropelException
     * @see doSave()
     */
    protected function doInsert(ConnectionInterface $con)
    {
        $modifiedColumns = array();
        $index = 0;

        $this->modifiedColumns[DeploymentTableMap::COL_ID] = true;
        if (null !== $this->id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . DeploymentTableMap::COL_ID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(DeploymentTableMap::COL_ID)) {
            $modifiedColumns[':p' . $index++]  = 'id';
        }
        if ($this->isColumnModified(DeploymentTableMap::COL_USER)) {
            $modifiedColumns[':p' . $index++]  = 'user';
        }
        if ($this->isColumnModified(DeploymentTableMap::COL_NAME)) {
            $modifiedColumns[':p' . $index++]  = 'name';
        }
        if ($this->isColumnModified(DeploymentTableMap::COL_REFERENCE)) {
            $modifiedColumns[':p' . $index++]  = 'reference';
        }
        if ($this->isColumnModified(DeploymentTableMap::COL_PROVIDER)) {
            $modifiedColumns[':p' . $index++]  = 'provider';
        }
        if ($this->isColumnModified(DeploymentTableMap::COL_CREATED)) {
            $modifiedColumns[':p' . $index++]  = 'created';
        }
        if ($this->isColumnModified(DeploymentTableMap::COL_DEPLOYED)) {
            $modifiedColumns[':p' . $index++]  = 'deployed';
        }
        if ($this->isColumnModified(DeploymentTableMap::COL_DESTROYED)) {
            $modifiedColumns[':p' . $index++]  = 'destroyed';
        }
        if ($this->isColumnModified(DeploymentTableMap::COL_FAILED)) {
            $modifiedColumns[':p' . $index++]  = 'failed';
        }
        if ($this->isColumnModified(DeploymentTableMap::COL_CONFIGURATION)) {
            $modifiedColumns[':p' . $index++]  = 'configuration';
        }

        $sql = sprintf(
            'INSERT INTO deployment (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case 'id':
                        $stmt->bindValue($identifier, $this->id, PDO::PARAM_INT);
                        break;
                    case 'user':
                        $stmt->bindValue($identifier, $this->user, PDO::PARAM_STR);
                        break;
                    case 'name':
                        $stmt->bindValue($identifier, $this->name, PDO::PARAM_STR);
                        break;
                    case 'reference':
                        $stmt->bindValue($identifier, $this->reference, PDO::PARAM_STR);
                        break;
                    case 'provider':
                        $stmt->bindValue($identifier, $this->provider, PDO::PARAM_STR);
                        break;
                    case 'created':
                        $stmt->bindValue($identifier, $this->created ? $this->created->format("Y-m-d H:i:s.u") : null, PDO::PARAM_STR);
                        break;
                    case 'deployed':
                        $stmt->bindValue($identifier, $this->deployed ? $this->deployed->format("Y-m-d H:i:s.u") : null, PDO::PARAM_STR);
                        break;
                    case 'destroyed':
                        $stmt->bindValue($identifier, $this->destroyed ? $this->destroyed->format("Y-m-d H:i:s.u") : null, PDO::PARAM_STR);
                        break;
                    case 'failed':
                        $stmt->bindValue($identifier, $this->failed ? $this->failed->format("Y-m-d H:i:s.u") : null, PDO::PARAM_STR);
                        break;
                    case 'configuration':
                        $stmt->bindValue($identifier, $this->configuration, PDO::PARAM_STR);
                        break;
                }
            }
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute INSERT statement [%s]', $sql), 0, $e);
        }

        try {
            $pk = $con->lastInsertId();
        } catch (Exception $e) {
            throw new PropelException('Unable to get autoincrement id.', 0, $e);
        }
        $this->setId($pk);

        $this->setNew(false);
    }

    /**
     * Update the row in the database.
     *
     * @param      ConnectionInterface $con
     *
     * @return Integer Number of updated rows
     * @see doSave()
     */
    protected function doUpdate(ConnectionInterface $con)
    {
        $selectCriteria = $this->buildPkeyCriteria();
        $valuesCriteria = $this->buildCriteria();

        return $selectCriteria->doUpdate($valuesCriteria, $con);
    }

    /**
     * Retrieves a field from the object by name passed in as a string.
     *
     * @param      string $name name
     * @param      string $type The type of fieldname the $name is of:
     *                     one of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                     TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *                     Defaults to TableMap::TYPE_PHPNAME.
     * @return mixed Value of field.
     */
    public function getByName($name, $type = TableMap::TYPE_PHPNAME)
    {
        $pos = DeploymentTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
        $field = $this->getByPosition($pos);

        return $field;
    }

    /**
     * Retrieves a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param      int $pos position in xml schema
     * @return mixed Value of field at $pos
     */
    public function getByPosition($pos)
    {
        switch ($pos) {
            case 0:
                return $this->getId();
                break;
            case 1:
                return $this->getUser();
                break;
            case 2:
                return $this->getname();
                break;
            case 3:
                return $this->getReference();
                break;
            case 4:
                return $this->getProvider();
                break;
            case 5:
                return $this->getCreated();
                break;
            case 6:
                return $this->getDeployed();
                break;
            case 7:
                return $this->getDestroyed();
                break;
            case 8:
                return $this->getFailed();
                break;
            case 9:
                return $this->getConfiguration();
                break;
            default:
                return null;
                break;
        } // switch()
    }

    /**
     * Exports the object as an array.
     *
     * You can specify the key type of the array by passing one of the class
     * type constants.
     *
     * @param     string  $keyType (optional) One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME,
     *                    TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *                    Defaults to TableMap::TYPE_PHPNAME.
     * @param     boolean $includeLazyLoadColumns (optional) Whether to include lazy loaded columns. Defaults to TRUE.
     * @param     array $alreadyDumpedObjects List of objects to skip to avoid recursion
     * @param     boolean $includeForeignObjects (optional) Whether to include hydrated related objects. Default to FALSE.
     *
     * @return array an associative array containing the field names (as keys) and field values
     */
    public function toArray($keyType = TableMap::TYPE_PHPNAME, $includeLazyLoadColumns = true, $alreadyDumpedObjects = array(), $includeForeignObjects = false)
    {

        if (isset($alreadyDumpedObjects['Deployment'][$this->hashCode()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['Deployment'][$this->hashCode()] = true;
        $keys = DeploymentTableMap::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getId(),
            $keys[1] => $this->getUser(),
            $keys[2] => $this->getname(),
            $keys[3] => $this->getReference(),
            $keys[4] => $this->getProvider(),
            $keys[5] => $this->getCreated(),
            $keys[6] => $this->getDeployed(),
            $keys[7] => $this->getDestroyed(),
            $keys[8] => $this->getFailed(),
            $keys[9] => $this->getConfiguration(),
        );
        if ($result[$keys[5]] instanceof \DateTime) {
            $result[$keys[5]] = $result[$keys[5]]->format('c');
        }

        if ($result[$keys[6]] instanceof \DateTime) {
            $result[$keys[6]] = $result[$keys[6]]->format('c');
        }

        if ($result[$keys[7]] instanceof \DateTime) {
            $result[$keys[7]] = $result[$keys[7]]->format('c');
        }

        if ($result[$keys[8]] instanceof \DateTime) {
            $result[$keys[8]] = $result[$keys[8]]->format('c');
        }

        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->aDeploymentUser) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'user';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'user';
                        break;
                    default:
                        $key = 'DeploymentUser';
                }

                $result[$key] = $this->aDeploymentUser->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
        }

        return $result;
    }

    /**
     * Sets a field from the object by name passed in as a string.
     *
     * @param  string $name
     * @param  mixed  $value field value
     * @param  string $type The type of fieldname the $name is of:
     *                one of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *                Defaults to TableMap::TYPE_PHPNAME.
     * @return $this|\Deployment
     */
    public function setByName($name, $value, $type = TableMap::TYPE_PHPNAME)
    {
        $pos = DeploymentTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

        return $this->setByPosition($pos, $value);
    }

    /**
     * Sets a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param  int $pos position in xml schema
     * @param  mixed $value field value
     * @return $this|\Deployment
     */
    public function setByPosition($pos, $value)
    {
        switch ($pos) {
            case 0:
                $this->setId($value);
                break;
            case 1:
                $this->setUser($value);
                break;
            case 2:
                $this->setname($value);
                break;
            case 3:
                $this->setReference($value);
                break;
            case 4:
                $this->setProvider($value);
                break;
            case 5:
                $this->setCreated($value);
                break;
            case 6:
                $this->setDeployed($value);
                break;
            case 7:
                $this->setDestroyed($value);
                break;
            case 8:
                $this->setFailed($value);
                break;
            case 9:
                $this->setConfiguration($value);
                break;
        } // switch()

        return $this;
    }

    /**
     * Populates the object using an array.
     *
     * This is particularly useful when populating an object from one of the
     * request arrays (e.g. $_POST).  This method goes through the column
     * names, checking to see whether a matching key exists in populated
     * array. If so the setByName() method is called for that column.
     *
     * You can specify the key type of the array by additionally passing one
     * of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME,
     * TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     * The default key type is the column's TableMap::TYPE_PHPNAME.
     *
     * @param      array  $arr     An array to populate the object from.
     * @param      string $keyType The type of keys the array uses.
     * @return void
     */
    public function fromArray($arr, $keyType = TableMap::TYPE_PHPNAME)
    {
        $keys = DeploymentTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setId($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setUser($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setname($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setReference($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setProvider($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setCreated($arr[$keys[5]]);
        }
        if (array_key_exists($keys[6], $arr)) {
            $this->setDeployed($arr[$keys[6]]);
        }
        if (array_key_exists($keys[7], $arr)) {
            $this->setDestroyed($arr[$keys[7]]);
        }
        if (array_key_exists($keys[8], $arr)) {
            $this->setFailed($arr[$keys[8]]);
        }
        if (array_key_exists($keys[9], $arr)) {
            $this->setConfiguration($arr[$keys[9]]);
        }
    }

     /**
     * Populate the current object from a string, using a given parser format
     * <code>
     * $book = new Book();
     * $book->importFrom('JSON', '{"Id":9012,"Title":"Don Juan","ISBN":"0140422161","Price":12.99,"PublisherId":1234,"AuthorId":5678}');
     * </code>
     *
     * You can specify the key type of the array by additionally passing one
     * of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME,
     * TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     * The default key type is the column's TableMap::TYPE_PHPNAME.
     *
     * @param mixed $parser A AbstractParser instance,
     *                       or a format name ('XML', 'YAML', 'JSON', 'CSV')
     * @param string $data The source data to import from
     * @param string $keyType The type of keys the array uses.
     *
     * @return $this|\Deployment The current object, for fluid interface
     */
    public function importFrom($parser, $data, $keyType = TableMap::TYPE_PHPNAME)
    {
        if (!$parser instanceof AbstractParser) {
            $parser = AbstractParser::getParser($parser);
        }

        $this->fromArray($parser->toArray($data), $keyType);

        return $this;
    }

    /**
     * Build a Criteria object containing the values of all modified columns in this object.
     *
     * @return Criteria The Criteria object containing all modified values.
     */
    public function buildCriteria()
    {
        $criteria = new Criteria(DeploymentTableMap::DATABASE_NAME);

        if ($this->isColumnModified(DeploymentTableMap::COL_ID)) {
            $criteria->add(DeploymentTableMap::COL_ID, $this->id);
        }
        if ($this->isColumnModified(DeploymentTableMap::COL_USER)) {
            $criteria->add(DeploymentTableMap::COL_USER, $this->user);
        }
        if ($this->isColumnModified(DeploymentTableMap::COL_NAME)) {
            $criteria->add(DeploymentTableMap::COL_NAME, $this->name);
        }
        if ($this->isColumnModified(DeploymentTableMap::COL_REFERENCE)) {
            $criteria->add(DeploymentTableMap::COL_REFERENCE, $this->reference);
        }
        if ($this->isColumnModified(DeploymentTableMap::COL_PROVIDER)) {
            $criteria->add(DeploymentTableMap::COL_PROVIDER, $this->provider);
        }
        if ($this->isColumnModified(DeploymentTableMap::COL_CREATED)) {
            $criteria->add(DeploymentTableMap::COL_CREATED, $this->created);
        }
        if ($this->isColumnModified(DeploymentTableMap::COL_DEPLOYED)) {
            $criteria->add(DeploymentTableMap::COL_DEPLOYED, $this->deployed);
        }
        if ($this->isColumnModified(DeploymentTableMap::COL_DESTROYED)) {
            $criteria->add(DeploymentTableMap::COL_DESTROYED, $this->destroyed);
        }
        if ($this->isColumnModified(DeploymentTableMap::COL_FAILED)) {
            $criteria->add(DeploymentTableMap::COL_FAILED, $this->failed);
        }
        if ($this->isColumnModified(DeploymentTableMap::COL_CONFIGURATION)) {
            $criteria->add(DeploymentTableMap::COL_CONFIGURATION, $this->configuration);
        }

        return $criteria;
    }

    /**
     * Builds a Criteria object containing the primary key for this object.
     *
     * Unlike buildCriteria() this method includes the primary key values regardless
     * of whether or not they have been modified.
     *
     * @throws LogicException if no primary key is defined
     *
     * @return Criteria The Criteria object containing value(s) for primary key(s).
     */
    public function buildPkeyCriteria()
    {
        $criteria = ChildDeploymentQuery::create();
        $criteria->add(DeploymentTableMap::COL_ID, $this->id);

        return $criteria;
    }

    /**
     * If the primary key is not null, return the hashcode of the
     * primary key. Otherwise, return the hash code of the object.
     *
     * @return int Hashcode
     */
    public function hashCode()
    {
        $validPk = null !== $this->getId();

        $validPrimaryKeyFKs = 0;
        $primaryKeyFKs = [];

        if ($validPk) {
            return crc32(json_encode($this->getPrimaryKey(), JSON_UNESCAPED_UNICODE));
        } elseif ($validPrimaryKeyFKs) {
            return crc32(json_encode($primaryKeyFKs, JSON_UNESCAPED_UNICODE));
        }

        return spl_object_hash($this);
    }

    /**
     * Returns the primary key for this object (row).
     * @return int
     */
    public function getPrimaryKey()
    {
        return $this->getId();
    }

    /**
     * Generic method to set the primary key (id column).
     *
     * @param       int $key Primary key.
     * @return void
     */
    public function setPrimaryKey($key)
    {
        $this->setId($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     * @return boolean
     */
    public function isPrimaryKeyNull()
    {
        return null === $this->getId();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param      object $copyObj An object of \Deployment (or compatible) type.
     * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param      boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setUser($this->getUser());
        $copyObj->setname($this->getname());
        $copyObj->setReference($this->getReference());
        $copyObj->setProvider($this->getProvider());
        $copyObj->setCreated($this->getCreated());
        $copyObj->setDeployed($this->getDeployed());
        $copyObj->setDestroyed($this->getDestroyed());
        $copyObj->setFailed($this->getFailed());
        $copyObj->setConfiguration($this->getConfiguration());
        if ($makeNew) {
            $copyObj->setNew(true);
            $copyObj->setId(NULL); // this is a auto-increment column, so set to default value
        }
    }

    /**
     * Makes a copy of this object that will be inserted as a new row in table when saved.
     * It creates a new object filling in the simple attributes, but skipping any primary
     * keys that are defined for the table.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param  boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @return \Deployment Clone of current object.
     * @throws PropelException
     */
    public function copy($deepCopy = false)
    {
        // we use get_class(), because this might be a subclass
        $clazz = get_class($this);
        $copyObj = new $clazz();
        $this->copyInto($copyObj, $deepCopy);

        return $copyObj;
    }

    /**
     * Declares an association between this object and a ChildUser object.
     *
     * @param  ChildUser $v
     * @return $this|\Deployment The current object (for fluent API support)
     * @throws PropelException
     */
    public function setDeploymentUser(ChildUser $v = null)
    {
        if ($v === null) {
            $this->setUser(NULL);
        } else {
            $this->setUser($v->getId());
        }

        $this->aDeploymentUser = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildUser object, it will not be re-added.
        if ($v !== null) {
            $v->addDeployment($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildUser object
     *
     * @param  ConnectionInterface $con Optional Connection object.
     * @return ChildUser The associated ChildUser object.
     * @throws PropelException
     */
    public function getDeploymentUser(ConnectionInterface $con = null)
    {
        if ($this->aDeploymentUser === null && (($this->user !== "" && $this->user !== null))) {
            $this->aDeploymentUser = ChildUserQuery::create()->findPk($this->user, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aDeploymentUser->addDeployments($this);
             */
        }

        return $this->aDeploymentUser;
    }

    /**
     * Clears the current object, sets all attributes to their default values and removes
     * outgoing references as well as back-references (from other objects to this one. Results probably in a database
     * change of those foreign objects when you call `save` there).
     */
    public function clear()
    {
        if (null !== $this->aDeploymentUser) {
            $this->aDeploymentUser->removeDeployment($this);
        }
        $this->id = null;
        $this->user = null;
        $this->name = null;
        $this->reference = null;
        $this->provider = null;
        $this->created = null;
        $this->deployed = null;
        $this->destroyed = null;
        $this->failed = null;
        $this->configuration = null;
        $this->alreadyInSave = false;
        $this->clearAllReferences();
        $this->resetModified();
        $this->setNew(true);
        $this->setDeleted(false);
    }

    /**
     * Resets all references and back-references to other model objects or collections of model objects.
     *
     * This method is used to reset all php object references (not the actual reference in the database).
     * Necessary for object serialisation.
     *
     * @param      boolean $deep Whether to also clear the references on all referrer objects.
     */
    public function clearAllReferences($deep = false)
    {
        if ($deep) {
        } // if ($deep)

        $this->aDeploymentUser = null;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(DeploymentTableMap::DEFAULT_STRING_FORMAT);
    }

    /**
     * Code to be run before persisting the object
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preSave(ConnectionInterface $con = null)
    {
        if (is_callable('parent::preSave')) {
            return parent::preSave($con);
        }
        return true;
    }

    /**
     * Code to be run after persisting the object
     * @param ConnectionInterface $con
     */
    public function postSave(ConnectionInterface $con = null)
    {
        if (is_callable('parent::postSave')) {
            parent::postSave($con);
        }
    }

    /**
     * Code to be run before inserting to database
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preInsert(ConnectionInterface $con = null)
    {
        if (is_callable('parent::preInsert')) {
            return parent::preInsert($con);
        }
        return true;
    }

    /**
     * Code to be run after inserting to database
     * @param ConnectionInterface $con
     */
    public function postInsert(ConnectionInterface $con = null)
    {
        if (is_callable('parent::postInsert')) {
            parent::postInsert($con);
        }
    }

    /**
     * Code to be run before updating the object in database
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preUpdate(ConnectionInterface $con = null)
    {
        if (is_callable('parent::preUpdate')) {
            return parent::preUpdate($con);
        }
        return true;
    }

    /**
     * Code to be run after updating the object in database
     * @param ConnectionInterface $con
     */
    public function postUpdate(ConnectionInterface $con = null)
    {
        if (is_callable('parent::postUpdate')) {
            parent::postUpdate($con);
        }
    }

    /**
     * Code to be run before deleting the object in database
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preDelete(ConnectionInterface $con = null)
    {
        if (is_callable('parent::preDelete')) {
            return parent::preDelete($con);
        }
        return true;
    }

    /**
     * Code to be run after deleting the object in database
     * @param ConnectionInterface $con
     */
    public function postDelete(ConnectionInterface $con = null)
    {
        if (is_callable('parent::postDelete')) {
            parent::postDelete($con);
        }
    }


    /**
     * Derived method to catches calls to undefined methods.
     *
     * Provides magic import/export method support (fromXML()/toXML(), fromYAML()/toYAML(), etc.).
     * Allows to define default __call() behavior if you overwrite __call()
     *
     * @param string $name
     * @param mixed  $params
     *
     * @return array|string
     */
    public function __call($name, $params)
    {
        if (0 === strpos($name, 'get')) {
            $virtualColumn = substr($name, 3);
            if ($this->hasVirtualColumn($virtualColumn)) {
                return $this->getVirtualColumn($virtualColumn);
            }

            $virtualColumn = lcfirst($virtualColumn);
            if ($this->hasVirtualColumn($virtualColumn)) {
                return $this->getVirtualColumn($virtualColumn);
            }
        }

        if (0 === strpos($name, 'from')) {
            $format = substr($name, 4);

            return $this->importFrom($format, reset($params));
        }

        if (0 === strpos($name, 'to')) {
            $format = substr($name, 2);
            $includeLazyLoadColumns = isset($params[0]) ? $params[0] : true;

            return $this->exportTo($format, $includeLazyLoadColumns);
        }

        throw new BadMethodCallException(sprintf('Call to undefined method: %s.', $name));
    }

}
