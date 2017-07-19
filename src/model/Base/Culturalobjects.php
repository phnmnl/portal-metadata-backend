<?php

namespace Base;

use \Associatedmediaobjects as ChildAssociatedmediaobjects;
use \AssociatedmediaobjectsQuery as ChildAssociatedmediaobjectsQuery;
use \Culturalobjects as ChildCulturalobjects;
use \CulturalobjectsQuery as ChildCulturalobjectsQuery;
use \Exhibition as ChildExhibition;
use \ExhibitionQuery as ChildExhibitionQuery;
use \Institutions as ChildInstitutions;
use \InstitutionsQuery as ChildInstitutionsQuery;
use \Mediaobjects as ChildMediaobjects;
use \MediaobjectsQuery as ChildMediaobjectsQuery;
use \Exception;
use \PDO;
use Map\AssociatedmediaobjectsTableMap;
use Map\CulturalobjectsTableMap;
use Map\MediaobjectsTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveRecord\ActiveRecordInterface;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\BadMethodCallException;
use Propel\Runtime\Exception\LogicException;
use Propel\Runtime\Exception\PropelException;
use Propel\Runtime\Map\TableMap;
use Propel\Runtime\Parser\AbstractParser;

/**
 * Base class that represents a row from the 'CulturalObjects' table.
 *
 *
 *
 * @package    propel.generator..Base
 */
abstract class Culturalobjects implements ActiveRecordInterface
{
    /**
     * TableMap class name
     */
    const TABLE_MAP = '\\Map\\CulturalobjectsTableMap';


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
     * The value for the coid field.
     *
     * @var        int
     */
    protected $coid;

    /**
     * The value for the accessionnumber field.
     *
     * @var        string
     */
    protected $accessionnumber;

    /**
     * The value for the objecttype field.
     *
     * @var        string
     */
    protected $objecttype;

    /**
     * The value for the object field.
     *
     * @var        string
     */
    protected $object;

    /**
     * The value for the description field.
     *
     * @var        string
     */
    protected $description;

    /**
     * The value for the materials field.
     *
     * @var        string
     */
    protected $materials;

    /**
     * The value for the culturalgroup field.
     *
     * @var        string
     */
    protected $culturalgroup;

    /**
     * The value for the dimensions field.
     *
     * @var        string
     */
    protected $dimensions;

    /**
     * The value for the productiondate field.
     *
     * @var        string
     */
    protected $productiondate;

    /**
     * The value for the associatedplaces field.
     *
     * @var        string
     */
    protected $associatedplaces;

    /**
     * The value for the associatedpeople field.
     *
     * @var        string
     */
    protected $associatedpeople;

    /**
     * The value for the fk_iid field.
     *
     * @var        string
     */
    protected $fk_iid;

    /**
     * The value for the fk_exid field.
     *
     * @var        int
     */
    protected $fk_exid;

    /**
     * @var        ChildExhibition
     */
    protected $aExhibition;

    /**
     * @var        ChildInstitutions
     */
    protected $aInstitutions;

    /**
     * @var        ObjectCollection|ChildAssociatedmediaobjects[] Collection to store aggregation of ChildAssociatedmediaobjects objects.
     */
    protected $collAssociatedmediaobjectss;
    protected $collAssociatedmediaobjectssPartial;

    /**
     * @var        ObjectCollection|ChildMediaobjects[] Collection to store aggregation of ChildMediaobjects objects.
     */
    protected $collMediaobjectss;
    protected $collMediaobjectssPartial;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     *
     * @var boolean
     */
    protected $alreadyInSave = false;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildAssociatedmediaobjects[]
     */
    protected $associatedmediaobjectssScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildMediaobjects[]
     */
    protected $mediaobjectssScheduledForDeletion = null;

    /**
     * Initializes internal state of Base\Culturalobjects object.
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
     * Compares this with another <code>Culturalobjects</code> instance.  If
     * <code>obj</code> is an instance of <code>Culturalobjects</code>, delegates to
     * <code>equals(Culturalobjects)</code>.  Otherwise, returns <code>false</code>.
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
     * @return $this|Culturalobjects The current object, for fluid interface
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
     * Get the [coid] column value.
     *
     * @return int
     */
    public function getCoid()
    {
        return $this->coid;
    }

    /**
     * Get the [accessionnumber] column value.
     *
     * @return string
     */
    public function getAccessionnumber()
    {
        return $this->accessionnumber;
    }

    /**
     * Get the [objecttype] column value.
     *
     * @return string
     */
    public function getObjecttype()
    {
        return $this->objecttype;
    }

    /**
     * Get the [object] column value.
     *
     * @return string
     */
    public function getObject()
    {
        return $this->object;
    }

    /**
     * Get the [description] column value.
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Get the [materials] column value.
     *
     * @return string
     */
    public function getMaterials()
    {
        return $this->materials;
    }

    /**
     * Get the [culturalgroup] column value.
     *
     * @return string
     */
    public function getCulturalgroup()
    {
        return $this->culturalgroup;
    }

    /**
     * Get the [dimensions] column value.
     *
     * @return string
     */
    public function getDimensions()
    {
        return $this->dimensions;
    }

    /**
     * Get the [productiondate] column value.
     *
     * @return string
     */
    public function getProductiondate()
    {
        return $this->productiondate;
    }

    /**
     * Get the [associatedplaces] column value.
     *
     * @return string
     */
    public function getAssociatedplaces()
    {
        return $this->associatedplaces;
    }

    /**
     * Get the [associatedpeople] column value.
     *
     * @return string
     */
    public function getAssociatedpeople()
    {
        return $this->associatedpeople;
    }

    /**
     * Get the [fk_iid] column value.
     *
     * @return string
     */
    public function getFkIid()
    {
        return $this->fk_iid;
    }

    /**
     * Get the [fk_exid] column value.
     *
     * @return int
     */
    public function getFkExid()
    {
        return $this->fk_exid;
    }

    /**
     * Set the value of [coid] column.
     *
     * @param int $v new value
     * @return $this|\Culturalobjects The current object (for fluent API support)
     */
    public function setCoid($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->coid !== $v) {
            $this->coid = $v;
            $this->modifiedColumns[CulturalobjectsTableMap::COL_COID] = true;
        }

        return $this;
    } // setCoid()

    /**
     * Set the value of [accessionnumber] column.
     *
     * @param string $v new value
     * @return $this|\Culturalobjects The current object (for fluent API support)
     */
    public function setAccessionnumber($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->accessionnumber !== $v) {
            $this->accessionnumber = $v;
            $this->modifiedColumns[CulturalobjectsTableMap::COL_ACCESSIONNUMBER] = true;
        }

        return $this;
    } // setAccessionnumber()

    /**
     * Set the value of [objecttype] column.
     *
     * @param string $v new value
     * @return $this|\Culturalobjects The current object (for fluent API support)
     */
    public function setObjecttype($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->objecttype !== $v) {
            $this->objecttype = $v;
            $this->modifiedColumns[CulturalobjectsTableMap::COL_OBJECTTYPE] = true;
        }

        return $this;
    } // setObjecttype()

    /**
     * Set the value of [object] column.
     *
     * @param string $v new value
     * @return $this|\Culturalobjects The current object (for fluent API support)
     */
    public function setObject($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->object !== $v) {
            $this->object = $v;
            $this->modifiedColumns[CulturalobjectsTableMap::COL_OBJECT] = true;
        }

        return $this;
    } // setObject()

    /**
     * Set the value of [description] column.
     *
     * @param string $v new value
     * @return $this|\Culturalobjects The current object (for fluent API support)
     */
    public function setDescription($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->description !== $v) {
            $this->description = $v;
            $this->modifiedColumns[CulturalobjectsTableMap::COL_DESCRIPTION] = true;
        }

        return $this;
    } // setDescription()

    /**
     * Set the value of [materials] column.
     *
     * @param string $v new value
     * @return $this|\Culturalobjects The current object (for fluent API support)
     */
    public function setMaterials($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->materials !== $v) {
            $this->materials = $v;
            $this->modifiedColumns[CulturalobjectsTableMap::COL_MATERIALS] = true;
        }

        return $this;
    } // setMaterials()

    /**
     * Set the value of [culturalgroup] column.
     *
     * @param string $v new value
     * @return $this|\Culturalobjects The current object (for fluent API support)
     */
    public function setCulturalgroup($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->culturalgroup !== $v) {
            $this->culturalgroup = $v;
            $this->modifiedColumns[CulturalobjectsTableMap::COL_CULTURALGROUP] = true;
        }

        return $this;
    } // setCulturalgroup()

    /**
     * Set the value of [dimensions] column.
     *
     * @param string $v new value
     * @return $this|\Culturalobjects The current object (for fluent API support)
     */
    public function setDimensions($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->dimensions !== $v) {
            $this->dimensions = $v;
            $this->modifiedColumns[CulturalobjectsTableMap::COL_DIMENSIONS] = true;
        }

        return $this;
    } // setDimensions()

    /**
     * Set the value of [productiondate] column.
     *
     * @param string $v new value
     * @return $this|\Culturalobjects The current object (for fluent API support)
     */
    public function setProductiondate($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->productiondate !== $v) {
            $this->productiondate = $v;
            $this->modifiedColumns[CulturalobjectsTableMap::COL_PRODUCTIONDATE] = true;
        }

        return $this;
    } // setProductiondate()

    /**
     * Set the value of [associatedplaces] column.
     *
     * @param string $v new value
     * @return $this|\Culturalobjects The current object (for fluent API support)
     */
    public function setAssociatedplaces($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->associatedplaces !== $v) {
            $this->associatedplaces = $v;
            $this->modifiedColumns[CulturalobjectsTableMap::COL_ASSOCIATEDPLACES] = true;
        }

        return $this;
    } // setAssociatedplaces()

    /**
     * Set the value of [associatedpeople] column.
     *
     * @param string $v new value
     * @return $this|\Culturalobjects The current object (for fluent API support)
     */
    public function setAssociatedpeople($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->associatedpeople !== $v) {
            $this->associatedpeople = $v;
            $this->modifiedColumns[CulturalobjectsTableMap::COL_ASSOCIATEDPEOPLE] = true;
        }

        return $this;
    } // setAssociatedpeople()

    /**
     * Set the value of [fk_iid] column.
     *
     * @param string $v new value
     * @return $this|\Culturalobjects The current object (for fluent API support)
     */
    public function setFkIid($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->fk_iid !== $v) {
            $this->fk_iid = $v;
            $this->modifiedColumns[CulturalobjectsTableMap::COL_FK_IID] = true;
        }

        if ($this->aInstitutions !== null && $this->aInstitutions->getInstitutionname() !== $v) {
            $this->aInstitutions = null;
        }

        return $this;
    } // setFkIid()

    /**
     * Set the value of [fk_exid] column.
     *
     * @param int $v new value
     * @return $this|\Culturalobjects The current object (for fluent API support)
     */
    public function setFkExid($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->fk_exid !== $v) {
            $this->fk_exid = $v;
            $this->modifiedColumns[CulturalobjectsTableMap::COL_FK_EXID] = true;
        }

        if ($this->aExhibition !== null && $this->aExhibition->getExid() !== $v) {
            $this->aExhibition = null;
        }

        return $this;
    } // setFkExid()

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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : CulturalobjectsTableMap::translateFieldName('Coid', TableMap::TYPE_PHPNAME, $indexType)];
            $this->coid = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : CulturalobjectsTableMap::translateFieldName('Accessionnumber', TableMap::TYPE_PHPNAME, $indexType)];
            $this->accessionnumber = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : CulturalobjectsTableMap::translateFieldName('Objecttype', TableMap::TYPE_PHPNAME, $indexType)];
            $this->objecttype = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : CulturalobjectsTableMap::translateFieldName('Object', TableMap::TYPE_PHPNAME, $indexType)];
            $this->object = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : CulturalobjectsTableMap::translateFieldName('Description', TableMap::TYPE_PHPNAME, $indexType)];
            $this->description = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : CulturalobjectsTableMap::translateFieldName('Materials', TableMap::TYPE_PHPNAME, $indexType)];
            $this->materials = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : CulturalobjectsTableMap::translateFieldName('Culturalgroup', TableMap::TYPE_PHPNAME, $indexType)];
            $this->culturalgroup = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 7 + $startcol : CulturalobjectsTableMap::translateFieldName('Dimensions', TableMap::TYPE_PHPNAME, $indexType)];
            $this->dimensions = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 8 + $startcol : CulturalobjectsTableMap::translateFieldName('Productiondate', TableMap::TYPE_PHPNAME, $indexType)];
            $this->productiondate = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 9 + $startcol : CulturalobjectsTableMap::translateFieldName('Associatedplaces', TableMap::TYPE_PHPNAME, $indexType)];
            $this->associatedplaces = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 10 + $startcol : CulturalobjectsTableMap::translateFieldName('Associatedpeople', TableMap::TYPE_PHPNAME, $indexType)];
            $this->associatedpeople = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 11 + $startcol : CulturalobjectsTableMap::translateFieldName('FkIid', TableMap::TYPE_PHPNAME, $indexType)];
            $this->fk_iid = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 12 + $startcol : CulturalobjectsTableMap::translateFieldName('FkExid', TableMap::TYPE_PHPNAME, $indexType)];
            $this->fk_exid = (null !== $col) ? (int) $col : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 13; // 13 = CulturalobjectsTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\Culturalobjects'), 0, $e);
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
        if ($this->aInstitutions !== null && $this->fk_iid !== $this->aInstitutions->getInstitutionname()) {
            $this->aInstitutions = null;
        }
        if ($this->aExhibition !== null && $this->fk_exid !== $this->aExhibition->getExid()) {
            $this->aExhibition = null;
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
            $con = Propel::getServiceContainer()->getReadConnection(CulturalobjectsTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildCulturalobjectsQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aExhibition = null;
            $this->aInstitutions = null;
            $this->collAssociatedmediaobjectss = null;

            $this->collMediaobjectss = null;

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param      ConnectionInterface $con
     * @return void
     * @throws PropelException
     * @see Culturalobjects::setDeleted()
     * @see Culturalobjects::isDeleted()
     */
    public function delete(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(CulturalobjectsTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildCulturalobjectsQuery::create()
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
            $con = Propel::getServiceContainer()->getWriteConnection(CulturalobjectsTableMap::DATABASE_NAME);
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
                CulturalobjectsTableMap::addInstanceToPool($this);
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

            if ($this->aExhibition !== null) {
                if ($this->aExhibition->isModified() || $this->aExhibition->isNew()) {
                    $affectedRows += $this->aExhibition->save($con);
                }
                $this->setExhibition($this->aExhibition);
            }

            if ($this->aInstitutions !== null) {
                if ($this->aInstitutions->isModified() || $this->aInstitutions->isNew()) {
                    $affectedRows += $this->aInstitutions->save($con);
                }
                $this->setInstitutions($this->aInstitutions);
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

            if ($this->associatedmediaobjectssScheduledForDeletion !== null) {
                if (!$this->associatedmediaobjectssScheduledForDeletion->isEmpty()) {
                    \AssociatedmediaobjectsQuery::create()
                        ->filterByPrimaryKeys($this->associatedmediaobjectssScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->associatedmediaobjectssScheduledForDeletion = null;
                }
            }

            if ($this->collAssociatedmediaobjectss !== null) {
                foreach ($this->collAssociatedmediaobjectss as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->mediaobjectssScheduledForDeletion !== null) {
                if (!$this->mediaobjectssScheduledForDeletion->isEmpty()) {
                    \MediaobjectsQuery::create()
                        ->filterByPrimaryKeys($this->mediaobjectssScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->mediaobjectssScheduledForDeletion = null;
                }
            }

            if ($this->collMediaobjectss !== null) {
                foreach ($this->collMediaobjectss as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
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

        $this->modifiedColumns[CulturalobjectsTableMap::COL_COID] = true;
        if (null !== $this->coid) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . CulturalobjectsTableMap::COL_COID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(CulturalobjectsTableMap::COL_COID)) {
            $modifiedColumns[':p' . $index++]  = 'COid';
        }
        if ($this->isColumnModified(CulturalobjectsTableMap::COL_ACCESSIONNUMBER)) {
            $modifiedColumns[':p' . $index++]  = 'AccessionNumber';
        }
        if ($this->isColumnModified(CulturalobjectsTableMap::COL_OBJECTTYPE)) {
            $modifiedColumns[':p' . $index++]  = 'ObjectType';
        }
        if ($this->isColumnModified(CulturalobjectsTableMap::COL_OBJECT)) {
            $modifiedColumns[':p' . $index++]  = 'Object';
        }
        if ($this->isColumnModified(CulturalobjectsTableMap::COL_DESCRIPTION)) {
            $modifiedColumns[':p' . $index++]  = 'Description';
        }
        if ($this->isColumnModified(CulturalobjectsTableMap::COL_MATERIALS)) {
            $modifiedColumns[':p' . $index++]  = 'Materials';
        }
        if ($this->isColumnModified(CulturalobjectsTableMap::COL_CULTURALGROUP)) {
            $modifiedColumns[':p' . $index++]  = 'CulturalGroup';
        }
        if ($this->isColumnModified(CulturalobjectsTableMap::COL_DIMENSIONS)) {
            $modifiedColumns[':p' . $index++]  = 'Dimensions';
        }
        if ($this->isColumnModified(CulturalobjectsTableMap::COL_PRODUCTIONDATE)) {
            $modifiedColumns[':p' . $index++]  = 'ProductionDate';
        }
        if ($this->isColumnModified(CulturalobjectsTableMap::COL_ASSOCIATEDPLACES)) {
            $modifiedColumns[':p' . $index++]  = 'AssociatedPlaces';
        }
        if ($this->isColumnModified(CulturalobjectsTableMap::COL_ASSOCIATEDPEOPLE)) {
            $modifiedColumns[':p' . $index++]  = 'AssociatedPeople';
        }
        if ($this->isColumnModified(CulturalobjectsTableMap::COL_FK_IID)) {
            $modifiedColumns[':p' . $index++]  = 'FK_Iid';
        }
        if ($this->isColumnModified(CulturalobjectsTableMap::COL_FK_EXID)) {
            $modifiedColumns[':p' . $index++]  = 'FK_EXid';
        }

        $sql = sprintf(
            'INSERT INTO CulturalObjects (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case 'COid':
                        $stmt->bindValue($identifier, $this->coid, PDO::PARAM_INT);
                        break;
                    case 'AccessionNumber':
                        $stmt->bindValue($identifier, $this->accessionnumber, PDO::PARAM_STR);
                        break;
                    case 'ObjectType':
                        $stmt->bindValue($identifier, $this->objecttype, PDO::PARAM_STR);
                        break;
                    case 'Object':
                        $stmt->bindValue($identifier, $this->object, PDO::PARAM_STR);
                        break;
                    case 'Description':
                        $stmt->bindValue($identifier, $this->description, PDO::PARAM_STR);
                        break;
                    case 'Materials':
                        $stmt->bindValue($identifier, $this->materials, PDO::PARAM_STR);
                        break;
                    case 'CulturalGroup':
                        $stmt->bindValue($identifier, $this->culturalgroup, PDO::PARAM_STR);
                        break;
                    case 'Dimensions':
                        $stmt->bindValue($identifier, $this->dimensions, PDO::PARAM_STR);
                        break;
                    case 'ProductionDate':
                        $stmt->bindValue($identifier, $this->productiondate, PDO::PARAM_STR);
                        break;
                    case 'AssociatedPlaces':
                        $stmt->bindValue($identifier, $this->associatedplaces, PDO::PARAM_STR);
                        break;
                    case 'AssociatedPeople':
                        $stmt->bindValue($identifier, $this->associatedpeople, PDO::PARAM_STR);
                        break;
                    case 'FK_Iid':
                        $stmt->bindValue($identifier, $this->fk_iid, PDO::PARAM_STR);
                        break;
                    case 'FK_EXid':
                        $stmt->bindValue($identifier, $this->fk_exid, PDO::PARAM_INT);
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
        $this->setCoid($pk);

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
        $pos = CulturalobjectsTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
                return $this->getCoid();
                break;
            case 1:
                return $this->getAccessionnumber();
                break;
            case 2:
                return $this->getObjecttype();
                break;
            case 3:
                return $this->getObject();
                break;
            case 4:
                return $this->getDescription();
                break;
            case 5:
                return $this->getMaterials();
                break;
            case 6:
                return $this->getCulturalgroup();
                break;
            case 7:
                return $this->getDimensions();
                break;
            case 8:
                return $this->getProductiondate();
                break;
            case 9:
                return $this->getAssociatedplaces();
                break;
            case 10:
                return $this->getAssociatedpeople();
                break;
            case 11:
                return $this->getFkIid();
                break;
            case 12:
                return $this->getFkExid();
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

        if (isset($alreadyDumpedObjects['Culturalobjects'][$this->hashCode()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['Culturalobjects'][$this->hashCode()] = true;
        $keys = CulturalobjectsTableMap::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getCoid(),
            $keys[1] => $this->getAccessionnumber(),
            $keys[2] => $this->getObjecttype(),
            $keys[3] => $this->getObject(),
            $keys[4] => $this->getDescription(),
            $keys[5] => $this->getMaterials(),
            $keys[6] => $this->getCulturalgroup(),
            $keys[7] => $this->getDimensions(),
            $keys[8] => $this->getProductiondate(),
            $keys[9] => $this->getAssociatedplaces(),
            $keys[10] => $this->getAssociatedpeople(),
            $keys[11] => $this->getFkIid(),
            $keys[12] => $this->getFkExid(),
        );
        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->aExhibition) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'exhibition';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'Exhibition';
                        break;
                    default:
                        $key = 'Exhibition';
                }

                $result[$key] = $this->aExhibition->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aInstitutions) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'institutions';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'Institutions';
                        break;
                    default:
                        $key = 'Institutions';
                }

                $result[$key] = $this->aInstitutions->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->collAssociatedmediaobjectss) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'associatedmediaobjectss';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'AssociatedMediaObjectss';
                        break;
                    default:
                        $key = 'Associatedmediaobjectss';
                }

                $result[$key] = $this->collAssociatedmediaobjectss->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collMediaobjectss) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'mediaobjectss';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'MediaObjectss';
                        break;
                    default:
                        $key = 'Mediaobjectss';
                }

                $result[$key] = $this->collMediaobjectss->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
     * @return $this|\Culturalobjects
     */
    public function setByName($name, $value, $type = TableMap::TYPE_PHPNAME)
    {
        $pos = CulturalobjectsTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

        return $this->setByPosition($pos, $value);
    }

    /**
     * Sets a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param  int $pos position in xml schema
     * @param  mixed $value field value
     * @return $this|\Culturalobjects
     */
    public function setByPosition($pos, $value)
    {
        switch ($pos) {
            case 0:
                $this->setCoid($value);
                break;
            case 1:
                $this->setAccessionnumber($value);
                break;
            case 2:
                $this->setObjecttype($value);
                break;
            case 3:
                $this->setObject($value);
                break;
            case 4:
                $this->setDescription($value);
                break;
            case 5:
                $this->setMaterials($value);
                break;
            case 6:
                $this->setCulturalgroup($value);
                break;
            case 7:
                $this->setDimensions($value);
                break;
            case 8:
                $this->setProductiondate($value);
                break;
            case 9:
                $this->setAssociatedplaces($value);
                break;
            case 10:
                $this->setAssociatedpeople($value);
                break;
            case 11:
                $this->setFkIid($value);
                break;
            case 12:
                $this->setFkExid($value);
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
        $keys = CulturalobjectsTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setCoid($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setAccessionnumber($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setObjecttype($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setObject($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setDescription($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setMaterials($arr[$keys[5]]);
        }
        if (array_key_exists($keys[6], $arr)) {
            $this->setCulturalgroup($arr[$keys[6]]);
        }
        if (array_key_exists($keys[7], $arr)) {
            $this->setDimensions($arr[$keys[7]]);
        }
        if (array_key_exists($keys[8], $arr)) {
            $this->setProductiondate($arr[$keys[8]]);
        }
        if (array_key_exists($keys[9], $arr)) {
            $this->setAssociatedplaces($arr[$keys[9]]);
        }
        if (array_key_exists($keys[10], $arr)) {
            $this->setAssociatedpeople($arr[$keys[10]]);
        }
        if (array_key_exists($keys[11], $arr)) {
            $this->setFkIid($arr[$keys[11]]);
        }
        if (array_key_exists($keys[12], $arr)) {
            $this->setFkExid($arr[$keys[12]]);
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
     * @return $this|\Culturalobjects The current object, for fluid interface
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
        $criteria = new Criteria(CulturalobjectsTableMap::DATABASE_NAME);

        if ($this->isColumnModified(CulturalobjectsTableMap::COL_COID)) {
            $criteria->add(CulturalobjectsTableMap::COL_COID, $this->coid);
        }
        if ($this->isColumnModified(CulturalobjectsTableMap::COL_ACCESSIONNUMBER)) {
            $criteria->add(CulturalobjectsTableMap::COL_ACCESSIONNUMBER, $this->accessionnumber);
        }
        if ($this->isColumnModified(CulturalobjectsTableMap::COL_OBJECTTYPE)) {
            $criteria->add(CulturalobjectsTableMap::COL_OBJECTTYPE, $this->objecttype);
        }
        if ($this->isColumnModified(CulturalobjectsTableMap::COL_OBJECT)) {
            $criteria->add(CulturalobjectsTableMap::COL_OBJECT, $this->object);
        }
        if ($this->isColumnModified(CulturalobjectsTableMap::COL_DESCRIPTION)) {
            $criteria->add(CulturalobjectsTableMap::COL_DESCRIPTION, $this->description);
        }
        if ($this->isColumnModified(CulturalobjectsTableMap::COL_MATERIALS)) {
            $criteria->add(CulturalobjectsTableMap::COL_MATERIALS, $this->materials);
        }
        if ($this->isColumnModified(CulturalobjectsTableMap::COL_CULTURALGROUP)) {
            $criteria->add(CulturalobjectsTableMap::COL_CULTURALGROUP, $this->culturalgroup);
        }
        if ($this->isColumnModified(CulturalobjectsTableMap::COL_DIMENSIONS)) {
            $criteria->add(CulturalobjectsTableMap::COL_DIMENSIONS, $this->dimensions);
        }
        if ($this->isColumnModified(CulturalobjectsTableMap::COL_PRODUCTIONDATE)) {
            $criteria->add(CulturalobjectsTableMap::COL_PRODUCTIONDATE, $this->productiondate);
        }
        if ($this->isColumnModified(CulturalobjectsTableMap::COL_ASSOCIATEDPLACES)) {
            $criteria->add(CulturalobjectsTableMap::COL_ASSOCIATEDPLACES, $this->associatedplaces);
        }
        if ($this->isColumnModified(CulturalobjectsTableMap::COL_ASSOCIATEDPEOPLE)) {
            $criteria->add(CulturalobjectsTableMap::COL_ASSOCIATEDPEOPLE, $this->associatedpeople);
        }
        if ($this->isColumnModified(CulturalobjectsTableMap::COL_FK_IID)) {
            $criteria->add(CulturalobjectsTableMap::COL_FK_IID, $this->fk_iid);
        }
        if ($this->isColumnModified(CulturalobjectsTableMap::COL_FK_EXID)) {
            $criteria->add(CulturalobjectsTableMap::COL_FK_EXID, $this->fk_exid);
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
        $criteria = ChildCulturalobjectsQuery::create();
        $criteria->add(CulturalobjectsTableMap::COL_COID, $this->coid);

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
        $validPk = null !== $this->getCoid();

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
        return $this->getCoid();
    }

    /**
     * Generic method to set the primary key (coid column).
     *
     * @param       int $key Primary key.
     * @return void
     */
    public function setPrimaryKey($key)
    {
        $this->setCoid($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     * @return boolean
     */
    public function isPrimaryKeyNull()
    {
        return null === $this->getCoid();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param      object $copyObj An object of \Culturalobjects (or compatible) type.
     * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param      boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setAccessionnumber($this->getAccessionnumber());
        $copyObj->setObjecttype($this->getObjecttype());
        $copyObj->setObject($this->getObject());
        $copyObj->setDescription($this->getDescription());
        $copyObj->setMaterials($this->getMaterials());
        $copyObj->setCulturalgroup($this->getCulturalgroup());
        $copyObj->setDimensions($this->getDimensions());
        $copyObj->setProductiondate($this->getProductiondate());
        $copyObj->setAssociatedplaces($this->getAssociatedplaces());
        $copyObj->setAssociatedpeople($this->getAssociatedpeople());
        $copyObj->setFkIid($this->getFkIid());
        $copyObj->setFkExid($this->getFkExid());

        if ($deepCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);

            foreach ($this->getAssociatedmediaobjectss() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addAssociatedmediaobjects($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getMediaobjectss() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addMediaobjects($relObj->copy($deepCopy));
                }
            }

        } // if ($deepCopy)

        if ($makeNew) {
            $copyObj->setNew(true);
            $copyObj->setCoid(NULL); // this is a auto-increment column, so set to default value
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
     * @return \Culturalobjects Clone of current object.
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
     * Declares an association between this object and a ChildExhibition object.
     *
     * @param  ChildExhibition $v
     * @return $this|\Culturalobjects The current object (for fluent API support)
     * @throws PropelException
     */
    public function setExhibition(ChildExhibition $v = null)
    {
        if ($v === null) {
            $this->setFkExid(NULL);
        } else {
            $this->setFkExid($v->getExid());
        }

        $this->aExhibition = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildExhibition object, it will not be re-added.
        if ($v !== null) {
            $v->addCulturalobjects($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildExhibition object
     *
     * @param  ConnectionInterface $con Optional Connection object.
     * @return ChildExhibition The associated ChildExhibition object.
     * @throws PropelException
     */
    public function getExhibition(ConnectionInterface $con = null)
    {
        if ($this->aExhibition === null && ($this->fk_exid !== null)) {
            $this->aExhibition = ChildExhibitionQuery::create()->findPk($this->fk_exid, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aExhibition->addCulturalobjectss($this);
             */
        }

        return $this->aExhibition;
    }

    /**
     * Declares an association between this object and a ChildInstitutions object.
     *
     * @param  ChildInstitutions $v
     * @return $this|\Culturalobjects The current object (for fluent API support)
     * @throws PropelException
     */
    public function setInstitutions(ChildInstitutions $v = null)
    {
        if ($v === null) {
            $this->setFkIid(NULL);
        } else {
            $this->setFkIid($v->getInstitutionname());
        }

        $this->aInstitutions = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildInstitutions object, it will not be re-added.
        if ($v !== null) {
            $v->addCulturalobjects($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildInstitutions object
     *
     * @param  ConnectionInterface $con Optional Connection object.
     * @return ChildInstitutions The associated ChildInstitutions object.
     * @throws PropelException
     */
    public function getInstitutions(ConnectionInterface $con = null)
    {
        if ($this->aInstitutions === null && (($this->fk_iid !== "" && $this->fk_iid !== null))) {
            $this->aInstitutions = ChildInstitutionsQuery::create()->findPk($this->fk_iid, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aInstitutions->addCulturalobjectss($this);
             */
        }

        return $this->aInstitutions;
    }


    /**
     * Initializes a collection based on the name of a relation.
     * Avoids crafting an 'init[$relationName]s' method name
     * that wouldn't work when StandardEnglishPluralizer is used.
     *
     * @param      string $relationName The name of the relation to initialize
     * @return void
     */
    public function initRelation($relationName)
    {
        if ('Associatedmediaobjects' == $relationName) {
            return $this->initAssociatedmediaobjectss();
        }
        if ('Mediaobjects' == $relationName) {
            return $this->initMediaobjectss();
        }
    }

    /**
     * Clears out the collAssociatedmediaobjectss collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addAssociatedmediaobjectss()
     */
    public function clearAssociatedmediaobjectss()
    {
        $this->collAssociatedmediaobjectss = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collAssociatedmediaobjectss collection loaded partially.
     */
    public function resetPartialAssociatedmediaobjectss($v = true)
    {
        $this->collAssociatedmediaobjectssPartial = $v;
    }

    /**
     * Initializes the collAssociatedmediaobjectss collection.
     *
     * By default this just sets the collAssociatedmediaobjectss collection to an empty array (like clearcollAssociatedmediaobjectss());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initAssociatedmediaobjectss($overrideExisting = true)
    {
        if (null !== $this->collAssociatedmediaobjectss && !$overrideExisting) {
            return;
        }

        $collectionClassName = AssociatedmediaobjectsTableMap::getTableMap()->getCollectionClassName();

        $this->collAssociatedmediaobjectss = new $collectionClassName;
        $this->collAssociatedmediaobjectss->setModel('\Associatedmediaobjects');
    }

    /**
     * Gets an array of ChildAssociatedmediaobjects objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildCulturalobjects is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildAssociatedmediaobjects[] List of ChildAssociatedmediaobjects objects
     * @throws PropelException
     */
    public function getAssociatedmediaobjectss(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collAssociatedmediaobjectssPartial && !$this->isNew();
        if (null === $this->collAssociatedmediaobjectss || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collAssociatedmediaobjectss) {
                // return empty collection
                $this->initAssociatedmediaobjectss();
            } else {
                $collAssociatedmediaobjectss = ChildAssociatedmediaobjectsQuery::create(null, $criteria)
                    ->filterByCulturalobjects($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collAssociatedmediaobjectssPartial && count($collAssociatedmediaobjectss)) {
                        $this->initAssociatedmediaobjectss(false);

                        foreach ($collAssociatedmediaobjectss as $obj) {
                            if (false == $this->collAssociatedmediaobjectss->contains($obj)) {
                                $this->collAssociatedmediaobjectss->append($obj);
                            }
                        }

                        $this->collAssociatedmediaobjectssPartial = true;
                    }

                    return $collAssociatedmediaobjectss;
                }

                if ($partial && $this->collAssociatedmediaobjectss) {
                    foreach ($this->collAssociatedmediaobjectss as $obj) {
                        if ($obj->isNew()) {
                            $collAssociatedmediaobjectss[] = $obj;
                        }
                    }
                }

                $this->collAssociatedmediaobjectss = $collAssociatedmediaobjectss;
                $this->collAssociatedmediaobjectssPartial = false;
            }
        }

        return $this->collAssociatedmediaobjectss;
    }

    /**
     * Sets a collection of ChildAssociatedmediaobjects objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $associatedmediaobjectss A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildCulturalobjects The current object (for fluent API support)
     */
    public function setAssociatedmediaobjectss(Collection $associatedmediaobjectss, ConnectionInterface $con = null)
    {
        /** @var ChildAssociatedmediaobjects[] $associatedmediaobjectssToDelete */
        $associatedmediaobjectssToDelete = $this->getAssociatedmediaobjectss(new Criteria(), $con)->diff($associatedmediaobjectss);


        $this->associatedmediaobjectssScheduledForDeletion = $associatedmediaobjectssToDelete;

        foreach ($associatedmediaobjectssToDelete as $associatedmediaobjectsRemoved) {
            $associatedmediaobjectsRemoved->setCulturalobjects(null);
        }

        $this->collAssociatedmediaobjectss = null;
        foreach ($associatedmediaobjectss as $associatedmediaobjects) {
            $this->addAssociatedmediaobjects($associatedmediaobjects);
        }

        $this->collAssociatedmediaobjectss = $associatedmediaobjectss;
        $this->collAssociatedmediaobjectssPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Associatedmediaobjects objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related Associatedmediaobjects objects.
     * @throws PropelException
     */
    public function countAssociatedmediaobjectss(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collAssociatedmediaobjectssPartial && !$this->isNew();
        if (null === $this->collAssociatedmediaobjectss || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collAssociatedmediaobjectss) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getAssociatedmediaobjectss());
            }

            $query = ChildAssociatedmediaobjectsQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByCulturalobjects($this)
                ->count($con);
        }

        return count($this->collAssociatedmediaobjectss);
    }

    /**
     * Method called to associate a ChildAssociatedmediaobjects object to this object
     * through the ChildAssociatedmediaobjects foreign key attribute.
     *
     * @param  ChildAssociatedmediaobjects $l ChildAssociatedmediaobjects
     * @return $this|\Culturalobjects The current object (for fluent API support)
     */
    public function addAssociatedmediaobjects(ChildAssociatedmediaobjects $l)
    {
        if ($this->collAssociatedmediaobjectss === null) {
            $this->initAssociatedmediaobjectss();
            $this->collAssociatedmediaobjectssPartial = true;
        }

        if (!$this->collAssociatedmediaobjectss->contains($l)) {
            $this->doAddAssociatedmediaobjects($l);

            if ($this->associatedmediaobjectssScheduledForDeletion and $this->associatedmediaobjectssScheduledForDeletion->contains($l)) {
                $this->associatedmediaobjectssScheduledForDeletion->remove($this->associatedmediaobjectssScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildAssociatedmediaobjects $associatedmediaobjects The ChildAssociatedmediaobjects object to add.
     */
    protected function doAddAssociatedmediaobjects(ChildAssociatedmediaobjects $associatedmediaobjects)
    {
        $this->collAssociatedmediaobjectss[]= $associatedmediaobjects;
        $associatedmediaobjects->setCulturalobjects($this);
    }

    /**
     * @param  ChildAssociatedmediaobjects $associatedmediaobjects The ChildAssociatedmediaobjects object to remove.
     * @return $this|ChildCulturalobjects The current object (for fluent API support)
     */
    public function removeAssociatedmediaobjects(ChildAssociatedmediaobjects $associatedmediaobjects)
    {
        if ($this->getAssociatedmediaobjectss()->contains($associatedmediaobjects)) {
            $pos = $this->collAssociatedmediaobjectss->search($associatedmediaobjects);
            $this->collAssociatedmediaobjectss->remove($pos);
            if (null === $this->associatedmediaobjectssScheduledForDeletion) {
                $this->associatedmediaobjectssScheduledForDeletion = clone $this->collAssociatedmediaobjectss;
                $this->associatedmediaobjectssScheduledForDeletion->clear();
            }
            $this->associatedmediaobjectssScheduledForDeletion[]= clone $associatedmediaobjects;
            $associatedmediaobjects->setCulturalobjects(null);
        }

        return $this;
    }

    /**
     * Clears out the collMediaobjectss collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addMediaobjectss()
     */
    public function clearMediaobjectss()
    {
        $this->collMediaobjectss = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collMediaobjectss collection loaded partially.
     */
    public function resetPartialMediaobjectss($v = true)
    {
        $this->collMediaobjectssPartial = $v;
    }

    /**
     * Initializes the collMediaobjectss collection.
     *
     * By default this just sets the collMediaobjectss collection to an empty array (like clearcollMediaobjectss());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initMediaobjectss($overrideExisting = true)
    {
        if (null !== $this->collMediaobjectss && !$overrideExisting) {
            return;
        }

        $collectionClassName = MediaobjectsTableMap::getTableMap()->getCollectionClassName();

        $this->collMediaobjectss = new $collectionClassName;
        $this->collMediaobjectss->setModel('\Mediaobjects');
    }

    /**
     * Gets an array of ChildMediaobjects objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildCulturalobjects is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildMediaobjects[] List of ChildMediaobjects objects
     * @throws PropelException
     */
    public function getMediaobjectss(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collMediaobjectssPartial && !$this->isNew();
        if (null === $this->collMediaobjectss || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collMediaobjectss) {
                // return empty collection
                $this->initMediaobjectss();
            } else {
                $collMediaobjectss = ChildMediaobjectsQuery::create(null, $criteria)
                    ->filterByCulturalobjects($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collMediaobjectssPartial && count($collMediaobjectss)) {
                        $this->initMediaobjectss(false);

                        foreach ($collMediaobjectss as $obj) {
                            if (false == $this->collMediaobjectss->contains($obj)) {
                                $this->collMediaobjectss->append($obj);
                            }
                        }

                        $this->collMediaobjectssPartial = true;
                    }

                    return $collMediaobjectss;
                }

                if ($partial && $this->collMediaobjectss) {
                    foreach ($this->collMediaobjectss as $obj) {
                        if ($obj->isNew()) {
                            $collMediaobjectss[] = $obj;
                        }
                    }
                }

                $this->collMediaobjectss = $collMediaobjectss;
                $this->collMediaobjectssPartial = false;
            }
        }

        return $this->collMediaobjectss;
    }

    /**
     * Sets a collection of ChildMediaobjects objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $mediaobjectss A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildCulturalobjects The current object (for fluent API support)
     */
    public function setMediaobjectss(Collection $mediaobjectss, ConnectionInterface $con = null)
    {
        /** @var ChildMediaobjects[] $mediaobjectssToDelete */
        $mediaobjectssToDelete = $this->getMediaobjectss(new Criteria(), $con)->diff($mediaobjectss);


        $this->mediaobjectssScheduledForDeletion = $mediaobjectssToDelete;

        foreach ($mediaobjectssToDelete as $mediaobjectsRemoved) {
            $mediaobjectsRemoved->setCulturalobjects(null);
        }

        $this->collMediaobjectss = null;
        foreach ($mediaobjectss as $mediaobjects) {
            $this->addMediaobjects($mediaobjects);
        }

        $this->collMediaobjectss = $mediaobjectss;
        $this->collMediaobjectssPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Mediaobjects objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related Mediaobjects objects.
     * @throws PropelException
     */
    public function countMediaobjectss(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collMediaobjectssPartial && !$this->isNew();
        if (null === $this->collMediaobjectss || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collMediaobjectss) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getMediaobjectss());
            }

            $query = ChildMediaobjectsQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByCulturalobjects($this)
                ->count($con);
        }

        return count($this->collMediaobjectss);
    }

    /**
     * Method called to associate a ChildMediaobjects object to this object
     * through the ChildMediaobjects foreign key attribute.
     *
     * @param  ChildMediaobjects $l ChildMediaobjects
     * @return $this|\Culturalobjects The current object (for fluent API support)
     */
    public function addMediaobjects(ChildMediaobjects $l)
    {
        if ($this->collMediaobjectss === null) {
            $this->initMediaobjectss();
            $this->collMediaobjectssPartial = true;
        }

        if (!$this->collMediaobjectss->contains($l)) {
            $this->doAddMediaobjects($l);

            if ($this->mediaobjectssScheduledForDeletion and $this->mediaobjectssScheduledForDeletion->contains($l)) {
                $this->mediaobjectssScheduledForDeletion->remove($this->mediaobjectssScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildMediaobjects $mediaobjects The ChildMediaobjects object to add.
     */
    protected function doAddMediaobjects(ChildMediaobjects $mediaobjects)
    {
        $this->collMediaobjectss[]= $mediaobjects;
        $mediaobjects->setCulturalobjects($this);
    }

    /**
     * @param  ChildMediaobjects $mediaobjects The ChildMediaobjects object to remove.
     * @return $this|ChildCulturalobjects The current object (for fluent API support)
     */
    public function removeMediaobjects(ChildMediaobjects $mediaobjects)
    {
        if ($this->getMediaobjectss()->contains($mediaobjects)) {
            $pos = $this->collMediaobjectss->search($mediaobjects);
            $this->collMediaobjectss->remove($pos);
            if (null === $this->mediaobjectssScheduledForDeletion) {
                $this->mediaobjectssScheduledForDeletion = clone $this->collMediaobjectss;
                $this->mediaobjectssScheduledForDeletion->clear();
            }
            $this->mediaobjectssScheduledForDeletion[]= clone $mediaobjects;
            $mediaobjects->setCulturalobjects(null);
        }

        return $this;
    }

    /**
     * Clears the current object, sets all attributes to their default values and removes
     * outgoing references as well as back-references (from other objects to this one. Results probably in a database
     * change of those foreign objects when you call `save` there).
     */
    public function clear()
    {
        if (null !== $this->aExhibition) {
            $this->aExhibition->removeCulturalobjects($this);
        }
        if (null !== $this->aInstitutions) {
            $this->aInstitutions->removeCulturalobjects($this);
        }
        $this->coid = null;
        $this->accessionnumber = null;
        $this->objecttype = null;
        $this->object = null;
        $this->description = null;
        $this->materials = null;
        $this->culturalgroup = null;
        $this->dimensions = null;
        $this->productiondate = null;
        $this->associatedplaces = null;
        $this->associatedpeople = null;
        $this->fk_iid = null;
        $this->fk_exid = null;
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
            if ($this->collAssociatedmediaobjectss) {
                foreach ($this->collAssociatedmediaobjectss as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collMediaobjectss) {
                foreach ($this->collMediaobjectss as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        $this->collAssociatedmediaobjectss = null;
        $this->collMediaobjectss = null;
        $this->aExhibition = null;
        $this->aInstitutions = null;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(CulturalobjectsTableMap::DEFAULT_STRING_FORMAT);
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
