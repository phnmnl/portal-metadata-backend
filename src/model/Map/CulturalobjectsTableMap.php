<?php

namespace Map;

use \Culturalobjects;
use \CulturalobjectsQuery;
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
 * This class defines the structure of the 'CulturalObjects' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 */
class CulturalobjectsTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = '.Map.CulturalobjectsTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'sierraleonedb';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'CulturalObjects';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\Culturalobjects';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'Culturalobjects';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 13;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 13;

    /**
     * the column name for the COid field
     */
    const COL_COID = 'CulturalObjects.COid';

    /**
     * the column name for the AccessionNumber field
     */
    const COL_ACCESSIONNUMBER = 'CulturalObjects.AccessionNumber';

    /**
     * the column name for the ObjectType field
     */
    const COL_OBJECTTYPE = 'CulturalObjects.ObjectType';

    /**
     * the column name for the Object field
     */
    const COL_OBJECT = 'CulturalObjects.Object';

    /**
     * the column name for the Description field
     */
    const COL_DESCRIPTION = 'CulturalObjects.Description';

    /**
     * the column name for the Materials field
     */
    const COL_MATERIALS = 'CulturalObjects.Materials';

    /**
     * the column name for the CulturalGroup field
     */
    const COL_CULTURALGROUP = 'CulturalObjects.CulturalGroup';

    /**
     * the column name for the Dimensions field
     */
    const COL_DIMENSIONS = 'CulturalObjects.Dimensions';

    /**
     * the column name for the ProductionDate field
     */
    const COL_PRODUCTIONDATE = 'CulturalObjects.ProductionDate';

    /**
     * the column name for the AssociatedPlaces field
     */
    const COL_ASSOCIATEDPLACES = 'CulturalObjects.AssociatedPlaces';

    /**
     * the column name for the AssociatedPeople field
     */
    const COL_ASSOCIATEDPEOPLE = 'CulturalObjects.AssociatedPeople';

    /**
     * the column name for the FK_Iid field
     */
    const COL_FK_IID = 'CulturalObjects.FK_Iid';

    /**
     * the column name for the FK_EXid field
     */
    const COL_FK_EXID = 'CulturalObjects.FK_EXid';

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
        self::TYPE_PHPNAME       => array('Coid', 'Accessionnumber', 'Objecttype', 'Object', 'Description', 'Materials', 'Culturalgroup', 'Dimensions', 'Productiondate', 'Associatedplaces', 'Associatedpeople', 'FkIid', 'FkExid', ),
        self::TYPE_CAMELNAME     => array('coid', 'accessionnumber', 'objecttype', 'object', 'description', 'materials', 'culturalgroup', 'dimensions', 'productiondate', 'associatedplaces', 'associatedpeople', 'fkIid', 'fkExid', ),
        self::TYPE_COLNAME       => array(CulturalobjectsTableMap::COL_COID, CulturalobjectsTableMap::COL_ACCESSIONNUMBER, CulturalobjectsTableMap::COL_OBJECTTYPE, CulturalobjectsTableMap::COL_OBJECT, CulturalobjectsTableMap::COL_DESCRIPTION, CulturalobjectsTableMap::COL_MATERIALS, CulturalobjectsTableMap::COL_CULTURALGROUP, CulturalobjectsTableMap::COL_DIMENSIONS, CulturalobjectsTableMap::COL_PRODUCTIONDATE, CulturalobjectsTableMap::COL_ASSOCIATEDPLACES, CulturalobjectsTableMap::COL_ASSOCIATEDPEOPLE, CulturalobjectsTableMap::COL_FK_IID, CulturalobjectsTableMap::COL_FK_EXID, ),
        self::TYPE_FIELDNAME     => array('COid', 'AccessionNumber', 'ObjectType', 'Object', 'Description', 'Materials', 'CulturalGroup', 'Dimensions', 'ProductionDate', 'AssociatedPlaces', 'AssociatedPeople', 'FK_Iid', 'FK_EXid', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('Coid' => 0, 'Accessionnumber' => 1, 'Objecttype' => 2, 'Object' => 3, 'Description' => 4, 'Materials' => 5, 'Culturalgroup' => 6, 'Dimensions' => 7, 'Productiondate' => 8, 'Associatedplaces' => 9, 'Associatedpeople' => 10, 'FkIid' => 11, 'FkExid' => 12, ),
        self::TYPE_CAMELNAME     => array('coid' => 0, 'accessionnumber' => 1, 'objecttype' => 2, 'object' => 3, 'description' => 4, 'materials' => 5, 'culturalgroup' => 6, 'dimensions' => 7, 'productiondate' => 8, 'associatedplaces' => 9, 'associatedpeople' => 10, 'fkIid' => 11, 'fkExid' => 12, ),
        self::TYPE_COLNAME       => array(CulturalobjectsTableMap::COL_COID => 0, CulturalobjectsTableMap::COL_ACCESSIONNUMBER => 1, CulturalobjectsTableMap::COL_OBJECTTYPE => 2, CulturalobjectsTableMap::COL_OBJECT => 3, CulturalobjectsTableMap::COL_DESCRIPTION => 4, CulturalobjectsTableMap::COL_MATERIALS => 5, CulturalobjectsTableMap::COL_CULTURALGROUP => 6, CulturalobjectsTableMap::COL_DIMENSIONS => 7, CulturalobjectsTableMap::COL_PRODUCTIONDATE => 8, CulturalobjectsTableMap::COL_ASSOCIATEDPLACES => 9, CulturalobjectsTableMap::COL_ASSOCIATEDPEOPLE => 10, CulturalobjectsTableMap::COL_FK_IID => 11, CulturalobjectsTableMap::COL_FK_EXID => 12, ),
        self::TYPE_FIELDNAME     => array('COid' => 0, 'AccessionNumber' => 1, 'ObjectType' => 2, 'Object' => 3, 'Description' => 4, 'Materials' => 5, 'CulturalGroup' => 6, 'Dimensions' => 7, 'ProductionDate' => 8, 'AssociatedPlaces' => 9, 'AssociatedPeople' => 10, 'FK_Iid' => 11, 'FK_EXid' => 12, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, )
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
        $this->setName('CulturalObjects');
        $this->setPhpName('Culturalobjects');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\Culturalobjects');
        $this->setPackage('');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('COid', 'Coid', 'SMALLINT', true, 8, null);
        $this->addColumn('AccessionNumber', 'Accessionnumber', 'VARCHAR', true, 255, null);
        $this->addColumn('ObjectType', 'Objecttype', 'VARCHAR', true, 255, null);
        $this->addColumn('Object', 'Object', 'VARCHAR', true, 255, null);
        $this->addColumn('Description', 'Description', 'VARCHAR', true, 6000, null);
        $this->addColumn('Materials', 'Materials', 'VARCHAR', true, 255, null);
        $this->addColumn('CulturalGroup', 'Culturalgroup', 'VARCHAR', true, 255, null);
        $this->addColumn('Dimensions', 'Dimensions', 'VARCHAR', true, 255, null);
        $this->addColumn('ProductionDate', 'Productiondate', 'VARCHAR', true, 255, null);
        $this->addColumn('AssociatedPlaces', 'Associatedplaces', 'VARCHAR', true, 255, null);
        $this->addColumn('AssociatedPeople', 'Associatedpeople', 'VARCHAR', true, 255, null);
        $this->addForeignKey('FK_Iid', 'FkIid', 'VARCHAR', 'Institutions', 'InstitutionName', true, 100, null);
        $this->addForeignKey('FK_EXid', 'FkExid', 'SMALLINT', 'Exhibition', 'EXid', true, 5, null);
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('Exhibition', '\\Exhibition', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':FK_EXid',
    1 => ':EXid',
  ),
), null, null, null, false);
        $this->addRelation('Institutions', '\\Institutions', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':FK_Iid',
    1 => ':InstitutionName',
  ),
), null, null, null, false);
        $this->addRelation('Associatedmediaobjects', '\\Associatedmediaobjects', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':FK_COid',
    1 => ':COid',
  ),
), null, null, 'Associatedmediaobjectss', false);
        $this->addRelation('Mediaobjects', '\\Mediaobjects', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':FK_COid',
    1 => ':COid',
  ),
), null, null, 'Mediaobjectss', false);
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Coid', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Coid', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Coid', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Coid', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Coid', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Coid', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('Coid', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? CulturalobjectsTableMap::CLASS_DEFAULT : CulturalobjectsTableMap::OM_CLASS;
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
     * @return array           (Culturalobjects object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = CulturalobjectsTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = CulturalobjectsTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + CulturalobjectsTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = CulturalobjectsTableMap::OM_CLASS;
            /** @var Culturalobjects $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            CulturalobjectsTableMap::addInstanceToPool($obj, $key);
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
            $key = CulturalobjectsTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = CulturalobjectsTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var Culturalobjects $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                CulturalobjectsTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(CulturalobjectsTableMap::COL_COID);
            $criteria->addSelectColumn(CulturalobjectsTableMap::COL_ACCESSIONNUMBER);
            $criteria->addSelectColumn(CulturalobjectsTableMap::COL_OBJECTTYPE);
            $criteria->addSelectColumn(CulturalobjectsTableMap::COL_OBJECT);
            $criteria->addSelectColumn(CulturalobjectsTableMap::COL_DESCRIPTION);
            $criteria->addSelectColumn(CulturalobjectsTableMap::COL_MATERIALS);
            $criteria->addSelectColumn(CulturalobjectsTableMap::COL_CULTURALGROUP);
            $criteria->addSelectColumn(CulturalobjectsTableMap::COL_DIMENSIONS);
            $criteria->addSelectColumn(CulturalobjectsTableMap::COL_PRODUCTIONDATE);
            $criteria->addSelectColumn(CulturalobjectsTableMap::COL_ASSOCIATEDPLACES);
            $criteria->addSelectColumn(CulturalobjectsTableMap::COL_ASSOCIATEDPEOPLE);
            $criteria->addSelectColumn(CulturalobjectsTableMap::COL_FK_IID);
            $criteria->addSelectColumn(CulturalobjectsTableMap::COL_FK_EXID);
        } else {
            $criteria->addSelectColumn($alias . '.COid');
            $criteria->addSelectColumn($alias . '.AccessionNumber');
            $criteria->addSelectColumn($alias . '.ObjectType');
            $criteria->addSelectColumn($alias . '.Object');
            $criteria->addSelectColumn($alias . '.Description');
            $criteria->addSelectColumn($alias . '.Materials');
            $criteria->addSelectColumn($alias . '.CulturalGroup');
            $criteria->addSelectColumn($alias . '.Dimensions');
            $criteria->addSelectColumn($alias . '.ProductionDate');
            $criteria->addSelectColumn($alias . '.AssociatedPlaces');
            $criteria->addSelectColumn($alias . '.AssociatedPeople');
            $criteria->addSelectColumn($alias . '.FK_Iid');
            $criteria->addSelectColumn($alias . '.FK_EXid');
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
        return Propel::getServiceContainer()->getDatabaseMap(CulturalobjectsTableMap::DATABASE_NAME)->getTable(CulturalobjectsTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(CulturalobjectsTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(CulturalobjectsTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new CulturalobjectsTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a Culturalobjects or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or Culturalobjects object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(CulturalobjectsTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Culturalobjects) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(CulturalobjectsTableMap::DATABASE_NAME);
            $criteria->add(CulturalobjectsTableMap::COL_COID, (array) $values, Criteria::IN);
        }

        $query = CulturalobjectsQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            CulturalobjectsTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                CulturalobjectsTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the CulturalObjects table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return CulturalobjectsQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a Culturalobjects or Criteria object.
     *
     * @param mixed               $criteria Criteria or Culturalobjects object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(CulturalobjectsTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from Culturalobjects object
        }

        if ($criteria->containsKey(CulturalobjectsTableMap::COL_COID) && $criteria->keyContainsValue(CulturalobjectsTableMap::COL_COID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.CulturalobjectsTableMap::COL_COID.')');
        }


        // Set the correct dbName
        $query = CulturalobjectsQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // CulturalobjectsTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
CulturalobjectsTableMap::buildTableMap();
