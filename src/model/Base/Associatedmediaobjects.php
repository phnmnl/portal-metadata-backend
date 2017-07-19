<?php

namespace Base;

use \AssociatedmediaobjectsQuery as ChildAssociatedmediaobjectsQuery;
use \Culturalobjects as ChildCulturalobjects;
use \CulturalobjectsQuery as ChildCulturalobjectsQuery;
use \Exception;
use \PDO;
use Map\AssociatedmediaobjectsTableMap;
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

/**
 * Base class that represents a row from the 'AssociatedMediaObjects' table.
 *
 *
 *
 * @package    propel.generator..Base
 */
abstract class Associatedmediaobjects implements ActiveRecordInterface
{
    /**
     * TableMap class name
     */
    const TABLE_MAP = '\\Map\\AssociatedmediaobjectsTableMap';


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
     * The value for the amoid field.
     *
     * @var        int
     */
    protected $amoid;

    /**
     * The value for the associatedmediafilename field.
     *
     * @var        string
     */
    protected $associatedmediafilename;

    /**
     * The value for the associatedmediatitle field.
     *
     * @var        string
     */
    protected $associatedmediatitle;

    /**
     * The value for the associatedmediadescription field.
     *
     * @var        string
     */
    protected $associatedmediadescription;

    /**
     * The value for the associatedmediatype field.
     *
     * @var        string
     */
    protected $associatedmediatype;

    /**
     * The value for the fk_coid field.
     *
     * @var        int
     */
    protected $fk_coid;

    /**
     * @var        ChildCulturalobjects
     */
    protected $aCulturalobjects;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     *
     * @var boolean
     */
    protected $alreadyInSave = false;

    /**
     * Initializes internal state of Base\Associatedmediaobjects object.
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
     * Compares this with another <code>Associatedmediaobjects</code> instance.  If
     * <code>obj</code> is an instance of <code>Associatedmediaobjects</code>, delegates to
     * <code>equals(Associatedmediaobjects)</code>.  Otherwise, returns <code>false</code>.
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
     * @return $this|Associatedmediaobjects The current object, for fluid interface
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
     * Get the [amoid] column value.
     *
     * @return int
     */
    public function getAmoid()
    {
        return $this->amoid;
    }

    /**
     * Get the [associatedmediafilename] column value.
     *
     * @return string
     */
    public function getAssociatedmediafilename()
    {
        return $this->associatedmediafilename;
    }

    /**
     * Get the [associatedmediatitle] column value.
     *
     * @return string
     */
    public function getAssociatedmediatitle()
    {
        return $this->associatedmediatitle;
    }

    /**
     * Get the [associatedmediadescription] column value.
     *
     * @return string
     */
    public function getAssociatedmediadescription()
    {
        return $this->associatedmediadescription;
    }

    /**
     * Get the [associatedmediatype] column value.
     *
     * @return string
     */
    public function getAssociatedmediatype()
    {
        return $this->associatedmediatype;
    }

    /**
     * Get the [fk_coid] column value.
     *
     * @return int
     */
    public function getFkCoid()
    {
        return $this->fk_coid;
    }

    /**
     * Set the value of [amoid] column.
     *
     * @param int $v new value
     * @return $this|\Associatedmediaobjects The current object (for fluent API support)
     */
    public function setAmoid($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->amoid !== $v) {
            $this->amoid = $v;
            $this->modifiedColumns[AssociatedmediaobjectsTableMap::COL_AMOID] = true;
        }

        return $this;
    } // setAmoid()

    /**
     * Set the value of [associatedmediafilename] column.
     *
     * @param string $v new value
     * @return $this|\Associatedmediaobjects The current object (for fluent API support)
     */
    public function setAssociatedmediafilename($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->associatedmediafilename !== $v) {
            $this->associatedmediafilename = $v;
            $this->modifiedColumns[AssociatedmediaobjectsTableMap::COL_ASSOCIATEDMEDIAFILENAME] = true;
        }

        return $this;
    } // setAssociatedmediafilename()

    /**
     * Set the value of [associatedmediatitle] column.
     *
     * @param string $v new value
     * @return $this|\Associatedmediaobjects The current object (for fluent API support)
     */
    public function setAssociatedmediatitle($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->associatedmediatitle !== $v) {
            $this->associatedmediatitle = $v;
            $this->modifiedColumns[AssociatedmediaobjectsTableMap::COL_ASSOCIATEDMEDIATITLE] = true;
        }

        return $this;
    } // setAssociatedmediatitle()

    /**
     * Set the value of [associatedmediadescription] column.
     *
     * @param string $v new value
     * @return $this|\Associatedmediaobjects The current object (for fluent API support)
     */
    public function setAssociatedmediadescription($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->associatedmediadescription !== $v) {
            $this->associatedmediadescription = $v;
            $this->modifiedColumns[AssociatedmediaobjectsTableMap::COL_ASSOCIATEDMEDIADESCRIPTION] = true;
        }

        return $this;
    } // setAssociatedmediadescription()

    /**
     * Set the value of [associatedmediatype] column.
     *
     * @param string $v new value
     * @return $this|\Associatedmediaobjects The current object (for fluent API support)
     */
    public function setAssociatedmediatype($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->associatedmediatype !== $v) {
            $this->associatedmediatype = $v;
            $this->modifiedColumns[AssociatedmediaobjectsTableMap::COL_ASSOCIATEDMEDIATYPE] = true;
        }

        return $this;
    } // setAssociatedmediatype()

    /**
     * Set the value of [fk_coid] column.
     *
     * @param int $v new value
     * @return $this|\Associatedmediaobjects The current object (for fluent API support)
     */
    public function setFkCoid($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->fk_coid !== $v) {
            $this->fk_coid = $v;
            $this->modifiedColumns[AssociatedmediaobjectsTableMap::COL_FK_COID] = true;
        }

        if ($this->aCulturalobjects !== null && $this->aCulturalobjects->getCoid() !== $v) {
            $this->aCulturalobjects = null;
        }

        return $this;
    } // setFkCoid()

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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : AssociatedmediaobjectsTableMap::translateFieldName('Amoid', TableMap::TYPE_PHPNAME, $indexType)];
            $this->amoid = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : AssociatedmediaobjectsTableMap::translateFieldName('Associatedmediafilename', TableMap::TYPE_PHPNAME, $indexType)];
            $this->associatedmediafilename = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : AssociatedmediaobjectsTableMap::translateFieldName('Associatedmediatitle', TableMap::TYPE_PHPNAME, $indexType)];
            $this->associatedmediatitle = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : AssociatedmediaobjectsTableMap::translateFieldName('Associatedmediadescription', TableMap::TYPE_PHPNAME, $indexType)];
            $this->associatedmediadescription = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : AssociatedmediaobjectsTableMap::translateFieldName('Associatedmediatype', TableMap::TYPE_PHPNAME, $indexType)];
            $this->associatedmediatype = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : AssociatedmediaobjectsTableMap::translateFieldName('FkCoid', TableMap::TYPE_PHPNAME, $indexType)];
            $this->fk_coid = (null !== $col) ? (int) $col : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 6; // 6 = AssociatedmediaobjectsTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\Associatedmediaobjects'), 0, $e);
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
        if ($this->aCulturalobjects !== null && $this->fk_coid !== $this->aCulturalobjects->getCoid()) {
            $this->aCulturalobjects = null;
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
            $con = Propel::getServiceContainer()->getReadConnection(AssociatedmediaobjectsTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildAssociatedmediaobjectsQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aCulturalobjects = null;
        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param      ConnectionInterface $con
     * @return void
     * @throws PropelException
     * @see Associatedmediaobjects::setDeleted()
     * @see Associatedmediaobjects::isDeleted()
     */
    public function delete(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(AssociatedmediaobjectsTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildAssociatedmediaobjectsQuery::create()
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
            $con = Propel::getServiceContainer()->getWriteConnection(AssociatedmediaobjectsTableMap::DATABASE_NAME);
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
                AssociatedmediaobjectsTableMap::addInstanceToPool($this);
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

            if ($this->aCulturalobjects !== null) {
                if ($this->aCulturalobjects->isModified() || $this->aCulturalobjects->isNew()) {
                    $affectedRows += $this->aCulturalobjects->save($con);
                }
                $this->setCulturalobjects($this->aCulturalobjects);
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

        $this->modifiedColumns[AssociatedmediaobjectsTableMap::COL_AMOID] = true;
        if (null !== $this->amoid) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . AssociatedmediaobjectsTableMap::COL_AMOID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(AssociatedmediaobjectsTableMap::COL_AMOID)) {
            $modifiedColumns[':p' . $index++]  = 'AMOid';
        }
        if ($this->isColumnModified(AssociatedmediaobjectsTableMap::COL_ASSOCIATEDMEDIAFILENAME)) {
            $modifiedColumns[':p' . $index++]  = 'AssociatedMediaFileName';
        }
        if ($this->isColumnModified(AssociatedmediaobjectsTableMap::COL_ASSOCIATEDMEDIATITLE)) {
            $modifiedColumns[':p' . $index++]  = 'AssociatedMediaTitle';
        }
        if ($this->isColumnModified(AssociatedmediaobjectsTableMap::COL_ASSOCIATEDMEDIADESCRIPTION)) {
            $modifiedColumns[':p' . $index++]  = 'AssociatedMediaDescription';
        }
        if ($this->isColumnModified(AssociatedmediaobjectsTableMap::COL_ASSOCIATEDMEDIATYPE)) {
            $modifiedColumns[':p' . $index++]  = 'AssociatedMediaType';
        }
        if ($this->isColumnModified(AssociatedmediaobjectsTableMap::COL_FK_COID)) {
            $modifiedColumns[':p' . $index++]  = 'FK_COid';
        }

        $sql = sprintf(
            'INSERT INTO AssociatedMediaObjects (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case 'AMOid':
                        $stmt->bindValue($identifier, $this->amoid, PDO::PARAM_INT);
                        break;
                    case 'AssociatedMediaFileName':
                        $stmt->bindValue($identifier, $this->associatedmediafilename, PDO::PARAM_STR);
                        break;
                    case 'AssociatedMediaTitle':
                        $stmt->bindValue($identifier, $this->associatedmediatitle, PDO::PARAM_STR);
                        break;
                    case 'AssociatedMediaDescription':
                        $stmt->bindValue($identifier, $this->associatedmediadescription, PDO::PARAM_STR);
                        break;
                    case 'AssociatedMediaType':
                        $stmt->bindValue($identifier, $this->associatedmediatype, PDO::PARAM_STR);
                        break;
                    case 'FK_COid':
                        $stmt->bindValue($identifier, $this->fk_coid, PDO::PARAM_INT);
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
        $this->setAmoid($pk);

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
        $pos = AssociatedmediaobjectsTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
                return $this->getAmoid();
                break;
            case 1:
                return $this->getAssociatedmediafilename();
                break;
            case 2:
                return $this->getAssociatedmediatitle();
                break;
            case 3:
                return $this->getAssociatedmediadescription();
                break;
            case 4:
                return $this->getAssociatedmediatype();
                break;
            case 5:
                return $this->getFkCoid();
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

        if (isset($alreadyDumpedObjects['Associatedmediaobjects'][$this->hashCode()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['Associatedmediaobjects'][$this->hashCode()] = true;
        $keys = AssociatedmediaobjectsTableMap::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getAmoid(),
            $keys[1] => $this->getAssociatedmediafilename(),
            $keys[2] => $this->getAssociatedmediatitle(),
            $keys[3] => $this->getAssociatedmediadescription(),
            $keys[4] => $this->getAssociatedmediatype(),
            $keys[5] => $this->getFkCoid(),
        );
        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->aCulturalobjects) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'culturalobjects';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'CulturalObjects';
                        break;
                    default:
                        $key = 'Culturalobjects';
                }

                $result[$key] = $this->aCulturalobjects->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
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
     * @return $this|\Associatedmediaobjects
     */
    public function setByName($name, $value, $type = TableMap::TYPE_PHPNAME)
    {
        $pos = AssociatedmediaobjectsTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

        return $this->setByPosition($pos, $value);
    }

    /**
     * Sets a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param  int $pos position in xml schema
     * @param  mixed $value field value
     * @return $this|\Associatedmediaobjects
     */
    public function setByPosition($pos, $value)
    {
        switch ($pos) {
            case 0:
                $this->setAmoid($value);
                break;
            case 1:
                $this->setAssociatedmediafilename($value);
                break;
            case 2:
                $this->setAssociatedmediatitle($value);
                break;
            case 3:
                $this->setAssociatedmediadescription($value);
                break;
            case 4:
                $this->setAssociatedmediatype($value);
                break;
            case 5:
                $this->setFkCoid($value);
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
        $keys = AssociatedmediaobjectsTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setAmoid($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setAssociatedmediafilename($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setAssociatedmediatitle($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setAssociatedmediadescription($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setAssociatedmediatype($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setFkCoid($arr[$keys[5]]);
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
     * @return $this|\Associatedmediaobjects The current object, for fluid interface
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
        $criteria = new Criteria(AssociatedmediaobjectsTableMap::DATABASE_NAME);

        if ($this->isColumnModified(AssociatedmediaobjectsTableMap::COL_AMOID)) {
            $criteria->add(AssociatedmediaobjectsTableMap::COL_AMOID, $this->amoid);
        }
        if ($this->isColumnModified(AssociatedmediaobjectsTableMap::COL_ASSOCIATEDMEDIAFILENAME)) {
            $criteria->add(AssociatedmediaobjectsTableMap::COL_ASSOCIATEDMEDIAFILENAME, $this->associatedmediafilename);
        }
        if ($this->isColumnModified(AssociatedmediaobjectsTableMap::COL_ASSOCIATEDMEDIATITLE)) {
            $criteria->add(AssociatedmediaobjectsTableMap::COL_ASSOCIATEDMEDIATITLE, $this->associatedmediatitle);
        }
        if ($this->isColumnModified(AssociatedmediaobjectsTableMap::COL_ASSOCIATEDMEDIADESCRIPTION)) {
            $criteria->add(AssociatedmediaobjectsTableMap::COL_ASSOCIATEDMEDIADESCRIPTION, $this->associatedmediadescription);
        }
        if ($this->isColumnModified(AssociatedmediaobjectsTableMap::COL_ASSOCIATEDMEDIATYPE)) {
            $criteria->add(AssociatedmediaobjectsTableMap::COL_ASSOCIATEDMEDIATYPE, $this->associatedmediatype);
        }
        if ($this->isColumnModified(AssociatedmediaobjectsTableMap::COL_FK_COID)) {
            $criteria->add(AssociatedmediaobjectsTableMap::COL_FK_COID, $this->fk_coid);
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
        $criteria = ChildAssociatedmediaobjectsQuery::create();
        $criteria->add(AssociatedmediaobjectsTableMap::COL_AMOID, $this->amoid);

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
        $validPk = null !== $this->getAmoid();

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
        return $this->getAmoid();
    }

    /**
     * Generic method to set the primary key (amoid column).
     *
     * @param       int $key Primary key.
     * @return void
     */
    public function setPrimaryKey($key)
    {
        $this->setAmoid($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     * @return boolean
     */
    public function isPrimaryKeyNull()
    {
        return null === $this->getAmoid();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param      object $copyObj An object of \Associatedmediaobjects (or compatible) type.
     * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param      boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setAssociatedmediafilename($this->getAssociatedmediafilename());
        $copyObj->setAssociatedmediatitle($this->getAssociatedmediatitle());
        $copyObj->setAssociatedmediadescription($this->getAssociatedmediadescription());
        $copyObj->setAssociatedmediatype($this->getAssociatedmediatype());
        $copyObj->setFkCoid($this->getFkCoid());
        if ($makeNew) {
            $copyObj->setNew(true);
            $copyObj->setAmoid(NULL); // this is a auto-increment column, so set to default value
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
     * @return \Associatedmediaobjects Clone of current object.
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
     * Declares an association between this object and a ChildCulturalobjects object.
     *
     * @param  ChildCulturalobjects $v
     * @return $this|\Associatedmediaobjects The current object (for fluent API support)
     * @throws PropelException
     */
    public function setCulturalobjects(ChildCulturalobjects $v = null)
    {
        if ($v === null) {
            $this->setFkCoid(NULL);
        } else {
            $this->setFkCoid($v->getCoid());
        }

        $this->aCulturalobjects = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildCulturalobjects object, it will not be re-added.
        if ($v !== null) {
            $v->addAssociatedmediaobjects($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildCulturalobjects object
     *
     * @param  ConnectionInterface $con Optional Connection object.
     * @return ChildCulturalobjects The associated ChildCulturalobjects object.
     * @throws PropelException
     */
    public function getCulturalobjects(ConnectionInterface $con = null)
    {
        if ($this->aCulturalobjects === null && ($this->fk_coid !== null)) {
            $this->aCulturalobjects = ChildCulturalobjectsQuery::create()->findPk($this->fk_coid, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aCulturalobjects->addAssociatedmediaobjectss($this);
             */
        }

        return $this->aCulturalobjects;
    }

    /**
     * Clears the current object, sets all attributes to their default values and removes
     * outgoing references as well as back-references (from other objects to this one. Results probably in a database
     * change of those foreign objects when you call `save` there).
     */
    public function clear()
    {
        if (null !== $this->aCulturalobjects) {
            $this->aCulturalobjects->removeAssociatedmediaobjects($this);
        }
        $this->amoid = null;
        $this->associatedmediafilename = null;
        $this->associatedmediatitle = null;
        $this->associatedmediadescription = null;
        $this->associatedmediatype = null;
        $this->fk_coid = null;
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

        $this->aCulturalobjects = null;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(AssociatedmediaobjectsTableMap::DEFAULT_STRING_FORMAT);
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
