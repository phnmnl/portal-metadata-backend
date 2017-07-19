<?php

namespace Map;

use \Associatedmediaobjects;
use \AssociatedmediaobjectsQuery;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\InstancePoolTrait;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\DataFetcher\DataFetcherInterface;
use Propel\Runtime\Exception\PropelException;
use Propel\Runtime\Map\RelationMap;
use Propel\Runtime\Map\TableMap;
use Propel\Runtime\Map\TableMapTrait;


/**
 * This class defines the structure of the 'AssociatedMediaObjects' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 */
class AssociatedmediaobjectsTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = '.Map.AssociatedmediaobjectsTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'sierraleonedb';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'AssociatedMediaObjects';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\Associatedmediaobjects';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'Associatedmediaobjects';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 6;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 6;

    /**
     * the column name for the AMOid field
     */
    const COL_AMOID = 'AssociatedMediaObjects.AMOid';

    /**
     * the column name for the AssociatedMediaFileName field
     */
    const COL_ASSOCIATEDMEDIAFILENAME = 'AssociatedMediaObjects.AssociatedMediaFileName';

    /**
     * the column name for the AssociatedMediaTitle field
     */
    const COL_ASSOCIATEDMEDIATITLE = 'AssociatedMediaObjects.AssociatedMediaTitle';

    /**
     * the column name for the AssociatedMediaDescription field
     */
    const COL_ASSOCIATEDMEDIADESCRIPTION = 'AssociatedMediaObjects.AssociatedMediaDescription';

    /**
     * the column name for the AssociatedMediaType field
     */
    const COL_ASSOCIATEDMEDIATYPE = 'AssociatedMediaObjects.AssociatedMediaType';

    /**
     * the column name for the FK_COid field
     */
    const COL_FK_COID = 'AssociatedMediaObjects.FK_COid';

    /**
     * The default string format for model objects of the related table
     */
    const DEFAULT_STRING_FORMAT = 'YAML';

    /**
     * holds an array of fieldnames
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldNames[self::TYPE_PHPNAME][0] = 'Id'
     */
    protected static $fieldNames = array (
        self::TYPE_PHPNAME       => array('Amoid', 'Associatedmediafilename', 'Associatedmediatitle', 'Associatedmediadescription', 'Associatedmediatype', 'FkCoid', ),
        self::TYPE_CAMELNAME     => array('amoid', 'associatedmediafilename', 'associatedmediatitle', 'associatedmediadescription', 'associatedmediatype', 'fkCoid', ),
        self::TYPE_COLNAME       => array(AssociatedmediaobjectsTableMap::COL_AMOID, AssociatedmediaobjectsTableMap::COL_ASSOCIATEDMEDIAFILENAME, AssociatedmediaobjectsTableMap::COL_ASSOCIATEDMEDIATITLE, AssociatedmediaobjectsTableMap::COL_ASSOCIATEDMEDIADESCRIPTION, AssociatedmediaobjectsTableMap::COL_ASSOCIATEDMEDIATYPE, AssociatedmediaobjectsTableMap::COL_FK_COID, ),
        self::TYPE_FIELDNAME     => array('AMOid', 'AssociatedMediaFileName', 'AssociatedMediaTitle', 'AssociatedMediaDescription', 'AssociatedMediaType', 'FK_COid', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('Amoid' => 0, 'Associatedmediafilename' => 1, 'Associatedmediatitle' => 2, 'Associatedmediadescription' => 3, 'Associatedmediatype' => 4, 'FkCoid' => 5, ),
        self::TYPE_CAMELNAME     => array('amoid' => 0, 'associatedmediafilename' => 1, 'associatedmediatitle' => 2, 'associatedmediadescription' => 3, 'associatedmediatype' => 4, 'fkCoid' => 5, ),
        self::TYPE_COLNAME       => array(AssociatedmediaobjectsTableMap::COL_AMOID => 0, AssociatedmediaobjectsTableMap::COL_ASSOCIATEDMEDIAFILENAME => 1, AssociatedmediaobjectsTableMap::COL_ASSOCIATEDMEDIATITLE => 2, AssociatedmediaobjectsTableMap::COL_ASSOCIATEDMEDIADESCRIPTION => 3, AssociatedmediaobjectsTableMap::COL_ASSOCIATEDMEDIATYPE => 4, AssociatedmediaobjectsTableMap::COL_FK_COID => 5, ),
        self::TYPE_FIELDNAME     => array('AMOid' => 0, 'AssociatedMediaFileName' => 1, 'AssociatedMediaTitle' => 2, 'AssociatedMediaDescription' => 3, 'AssociatedMediaType' => 4, 'FK_COid' => 5, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, )
    );

    /**
     * Initialize the table attributes and columns
     * Relations are not initialized by this method since they are lazy loaded
     *
     * @return void
     * @throws PropelException
     */
    public function initialize()
    {
        // attributes
        $this->setName('AssociatedMediaObjects');
        $this->setPhpName('Associatedmediaobjects');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\Associatedmediaobjects');
        $this->setPackage('');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('AMOid', 'Amoid', 'SMALLINT', true, 8, null);
        $this->addColumn('AssociatedMediaFileName', 'Associatedmediafilename', 'VARCHAR', true, 255, null);
        $this->addColumn('AssociatedMediaTitle', 'Associatedmediatitle', 'VARCHAR', true, 255, null);
        $this->addColumn('AssociatedMediaDescription', 'Associatedmediadescription', 'VARCHAR', true, 255, null);
        $this->addColumn('AssociatedMediaType', 'Associatedmediatype', 'VARCHAR', true, 255, null);
        $this->addForeignKey('FK_COid', 'FkCoid', 'SMALLINT', 'CulturalObjects', 'COid', true, 8, null);
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('Culturalobjects', '\\Culturalobjects', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':FK_COid',
    1 => ':COid',
  ),
), null, null, null, false);
    } // buildRelations()

    /**
     * Retrieves a string version of the primary key from the DB resultset row that can be used to uniquely identify a row in this table.
     *
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, a serialize()d version of the primary key will be returned.
     *
     * @param array  $row       resultset row.
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM
     *
     * @return string The primary key hash of the row
     */
    public static function getPrimaryKeyHashFromRow($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        // If the PK cannot be derived from the row, return NULL.
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Amoid', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Amoid', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Amoid', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Amoid', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Amoid', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Amoid', TableMap::TYPE_PHPNAME, $indexType)];
    }

    /**
     * Retrieves the primary key from the DB resultset row
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, an array of the primary key columns will be returned.
     *
     * @param array  $row       resultset row.
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM
     *
     * @return mixed The primary key of the row
     */
    public static function getPrimaryKeyFromRow($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        return (int) $row[
            $indexType == TableMap::TYPE_NUM
                ? 0 + $offset
                : self::translateFieldName('Amoid', TableMap::TYPE_PHPNAME, $indexType)
        ];
    }

    /**
     * The class that the tableMap will make instances of.
     *
     * If $withPrefix is true, the returned path
     * uses a dot-path notation which is translated into a path
     * relative to a location on the PHP include_path.
     * (e.g. path.to.MyClass -> 'path/to/MyClass.php')
     *
     * @param boolean $withPrefix Whether or not to return the path with the class name
     * @return string path.to.ClassName
     */
    public static function getOMClass($withPrefix = true)
    {
        return $withPrefix ? AssociatedmediaobjectsTableMap::CLASS_DEFAULT : AssociatedmediaobjectsTableMap::OM_CLASS;
    }

    /**
     * Populates an object of the default type or an object that inherit from the default.
     *
     * @param array  $row       row returned by DataFetcher->fetch().
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType The index type of $row. Mostly DataFetcher->getIndexType().
                                 One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     * @return array           (Associatedmediaobjects object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = AssociatedmediaobjectsTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = AssociatedmediaobjectsTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + AssociatedmediaobjectsTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = AssociatedmediaobjectsTableMap::OM_CLASS;
            /** @var Associatedmediaobjects $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            AssociatedmediaobjectsTableMap::addInstanceToPool($obj, $key);
        }

        return array($obj, $col);
    }

    /**
     * The returned array will contain objects of the default type or
     * objects that inherit from the default.
     *
     * @param DataFetcherInterface $dataFetcher
     * @return array
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function populateObjects(DataFetcherInterface $dataFetcher)
    {
        $results = array();

        // set the class once to avoid overhead in the loop
        $cls = static::getOMClass(false);
        // populate the object(s)
        while ($row = $dataFetcher->fetch()) {
            $key = AssociatedmediaobjectsTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = AssociatedmediaobjectsTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var Associatedmediaobjects $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                AssociatedmediaobjectsTableMap::addInstanceToPool($obj, $key);
            } // if key exists
        }

        return $results;
    }
    /**
     * Add all the columns needed to create a new object.
     *
     * Note: any columns that were marked with lazyLoad="true" in the
     * XML schema will not be added to the select list and only loaded
     * on demand.
     *
     * @param Criteria $criteria object containing the columns to add.
     * @param string   $alias    optional table alias
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function addSelectColumns(Criteria $criteria, $alias = null)
    {
        if (null === $alias) {
            $criteria->addSelectColumn(AssociatedmediaobjectsTableMap::COL_AMOID);
            $criteria->addSelectColumn(AssociatedmediaobjectsTableMap::COL_ASSOCIATEDMEDIAFILENAME);
            $criteria->addSelectColumn(AssociatedmediaobjectsTableMap::COL_ASSOCIATEDMEDIATITLE);
            $criteria->addSelectColumn(AssociatedmediaobjectsTableMap::COL_ASSOCIATEDMEDIADESCRIPTION);
            $criteria->addSelectColumn(AssociatedmediaobjectsTableMap::COL_ASSOCIATEDMEDIATYPE);
            $criteria->addSelectColumn(AssociatedmediaobjectsTableMap::COL_FK_COID);
        } else {
            $criteria->addSelectColumn($alias . '.AMOid');
            $criteria->addSelectColumn($alias . '.AssociatedMediaFileName');
            $criteria->addSelectColumn($alias . '.AssociatedMediaTitle');
            $criteria->addSelectColumn($alias . '.AssociatedMediaDescription');
            $criteria->addSelectColumn($alias . '.AssociatedMediaType');
            $criteria->addSelectColumn($alias . '.FK_COid');
        }
    }

    /**
     * Returns the TableMap related to this object.
     * This method is not needed for general use but a specific application could have a need.
     * @return TableMap
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function getTableMap()
    {
        return Propel::getServiceContainer()->getDatabaseMap(AssociatedmediaobjectsTableMap::DATABASE_NAME)->getTable(AssociatedmediaobjectsTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(AssociatedmediaobjectsTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(AssociatedmediaobjectsTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new AssociatedmediaobjectsTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a Associatedmediaobjects or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or Associatedmediaobjects object or primary key or array of primary keys
     *              which is used to create the DELETE statement
     * @param  ConnectionInterface $con the connection to use
     * @return int             The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *                         if supported by native driver or if emulated using Propel.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
     public static function doDelete($values, ConnectionInterface $con = null)
     {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(AssociatedmediaobjectsTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Associatedmediaobjects) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(AssociatedmediaobjectsTableMap::DATABASE_NAME);
            $criteria->add(AssociatedmediaobjectsTableMap::COL_AMOID, (array) $values, Criteria::IN);
        }

        $query = AssociatedmediaobjectsQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            AssociatedmediaobjectsTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                AssociatedmediaobjectsTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the AssociatedMediaObjects table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return AssociatedmediaobjectsQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a Associatedmediaobjects or Criteria object.
     *
     * @param mixed               $criteria Criteria or Associatedmediaobjects object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(AssociatedmediaobjectsTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from Associatedmediaobjects object
        }

        if ($criteria->containsKey(AssociatedmediaobjectsTableMap::COL_AMOID) && $criteria->keyContainsValue(AssociatedmediaobjectsTableMap::COL_AMOID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.AssociatedmediaobjectsTableMap::COL_AMOID.')');
        }


        // Set the correct dbName
        $query = AssociatedmediaobjectsQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // AssociatedmediaobjectsTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
AssociatedmediaobjectsTableMap::buildTableMap();
