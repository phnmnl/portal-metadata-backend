<?php

namespace Base;

use \Culturalobjects as ChildCulturalobjects;
use \CulturalobjectsQuery as ChildCulturalobjectsQuery;
use \Exception;
use \PDO;
use Map\CulturalobjectsTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'CulturalObjects' table.
 *
 *
 *
 * @method     ChildCulturalobjectsQuery orderByCoid($order = Criteria::ASC) Order by the COid column
 * @method     ChildCulturalobjectsQuery orderByAccessionnumber($order = Criteria::ASC) Order by the AccessionNumber column
 * @method     ChildCulturalobjectsQuery orderByObjecttype($order = Criteria::ASC) Order by the ObjectType column
 * @method     ChildCulturalobjectsQuery orderByObject($order = Criteria::ASC) Order by the Object column
 * @method     ChildCulturalobjectsQuery orderByDescription($order = Criteria::ASC) Order by the Description column
 * @method     ChildCulturalobjectsQuery orderByMaterials($order = Criteria::ASC) Order by the Materials column
 * @method     ChildCulturalobjectsQuery orderByCulturalgroup($order = Criteria::ASC) Order by the CulturalGroup column
 * @method     ChildCulturalobjectsQuery orderByDimensions($order = Criteria::ASC) Order by the Dimensions column
 * @method     ChildCulturalobjectsQuery orderByProductiondate($order = Criteria::ASC) Order by the ProductionDate column
 * @method     ChildCulturalobjectsQuery orderByAssociatedplaces($order = Criteria::ASC) Order by the AssociatedPlaces column
 * @method     ChildCulturalobjectsQuery orderByAssociatedpeople($order = Criteria::ASC) Order by the AssociatedPeople column
 * @method     ChildCulturalobjectsQuery orderByFkIid($order = Criteria::ASC) Order by the FK_Iid column
 * @method     ChildCulturalobjectsQuery orderByFkExid($order = Criteria::ASC) Order by the FK_EXid column
 *
 * @method     ChildCulturalobjectsQuery groupByCoid() Group by the COid column
 * @method     ChildCulturalobjectsQuery groupByAccessionnumber() Group by the AccessionNumber column
 * @method     ChildCulturalobjectsQuery groupByObjecttype() Group by the ObjectType column
 * @method     ChildCulturalobjectsQuery groupByObject() Group by the Object column
 * @method     ChildCulturalobjectsQuery groupByDescription() Group by the Description column
 * @method     ChildCulturalobjectsQuery groupByMaterials() Group by the Materials column
 * @method     ChildCulturalobjectsQuery groupByCulturalgroup() Group by the CulturalGroup column
 * @method     ChildCulturalobjectsQuery groupByDimensions() Group by the Dimensions column
 * @method     ChildCulturalobjectsQuery groupByProductiondate() Group by the ProductionDate column
 * @method     ChildCulturalobjectsQuery groupByAssociatedplaces() Group by the AssociatedPlaces column
 * @method     ChildCulturalobjectsQuery groupByAssociatedpeople() Group by the AssociatedPeople column
 * @method     ChildCulturalobjectsQuery groupByFkIid() Group by the FK_Iid column
 * @method     ChildCulturalobjectsQuery groupByFkExid() Group by the FK_EXid column
 *
 * @method     ChildCulturalobjectsQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildCulturalobjectsQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildCulturalobjectsQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildCulturalobjectsQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildCulturalobjectsQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildCulturalobjectsQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildCulturalobjectsQuery leftJoinExhibition($relationAlias = null) Adds a LEFT JOIN clause to the query using the Exhibition relation
 * @method     ChildCulturalobjectsQuery rightJoinExhibition($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Exhibition relation
 * @method     ChildCulturalobjectsQuery innerJoinExhibition($relationAlias = null) Adds a INNER JOIN clause to the query using the Exhibition relation
 *
 * @method     ChildCulturalobjectsQuery joinWithExhibition($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Exhibition relation
 *
 * @method     ChildCulturalobjectsQuery leftJoinWithExhibition() Adds a LEFT JOIN clause and with to the query using the Exhibition relation
 * @method     ChildCulturalobjectsQuery rightJoinWithExhibition() Adds a RIGHT JOIN clause and with to the query using the Exhibition relation
 * @method     ChildCulturalobjectsQuery innerJoinWithExhibition() Adds a INNER JOIN clause and with to the query using the Exhibition relation
 *
 * @method     ChildCulturalobjectsQuery leftJoinInstitutions($relationAlias = null) Adds a LEFT JOIN clause to the query using the Institutions relation
 * @method     ChildCulturalobjectsQuery rightJoinInstitutions($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Institutions relation
 * @method     ChildCulturalobjectsQuery innerJoinInstitutions($relationAlias = null) Adds a INNER JOIN clause to the query using the Institutions relation
 *
 * @method     ChildCulturalobjectsQuery joinWithInstitutions($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Institutions relation
 *
 * @method     ChildCulturalobjectsQuery leftJoinWithInstitutions() Adds a LEFT JOIN clause and with to the query using the Institutions relation
 * @method     ChildCulturalobjectsQuery rightJoinWithInstitutions() Adds a RIGHT JOIN clause and with to the query using the Institutions relation
 * @method     ChildCulturalobjectsQuery innerJoinWithInstitutions() Adds a INNER JOIN clause and with to the query using the Institutions relation
 *
 * @method     ChildCulturalobjectsQuery leftJoinAssociatedmediaobjects($relationAlias = null) Adds a LEFT JOIN clause to the query using the Associatedmediaobjects relation
 * @method     ChildCulturalobjectsQuery rightJoinAssociatedmediaobjects($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Associatedmediaobjects relation
 * @method     ChildCulturalobjectsQuery innerJoinAssociatedmediaobjects($relationAlias = null) Adds a INNER JOIN clause to the query using the Associatedmediaobjects relation
 *
 * @method     ChildCulturalobjectsQuery joinWithAssociatedmediaobjects($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Associatedmediaobjects relation
 *
 * @method     ChildCulturalobjectsQuery leftJoinWithAssociatedmediaobjects() Adds a LEFT JOIN clause and with to the query using the Associatedmediaobjects relation
 * @method     ChildCulturalobjectsQuery rightJoinWithAssociatedmediaobjects() Adds a RIGHT JOIN clause and with to the query using the Associatedmediaobjects relation
 * @method     ChildCulturalobjectsQuery innerJoinWithAssociatedmediaobjects() Adds a INNER JOIN clause and with to the query using the Associatedmediaobjects relation
 *
 * @method     ChildCulturalobjectsQuery leftJoinMediaobjects($relationAlias = null) Adds a LEFT JOIN clause to the query using the Mediaobjects relation
 * @method     ChildCulturalobjectsQuery rightJoinMediaobjects($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Mediaobjects relation
 * @method     ChildCulturalobjectsQuery innerJoinMediaobjects($relationAlias = null) Adds a INNER JOIN clause to the query using the Mediaobjects relation
 *
 * @method     ChildCulturalobjectsQuery joinWithMediaobjects($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Mediaobjects relation
 *
 * @method     ChildCulturalobjectsQuery leftJoinWithMediaobjects() Adds a LEFT JOIN clause and with to the query using the Mediaobjects relation
 * @method     ChildCulturalobjectsQuery rightJoinWithMediaobjects() Adds a RIGHT JOIN clause and with to the query using the Mediaobjects relation
 * @method     ChildCulturalobjectsQuery innerJoinWithMediaobjects() Adds a INNER JOIN clause and with to the query using the Mediaobjects relation
 *
 * @method     \ExhibitionQuery|\InstitutionsQuery|\AssociatedmediaobjectsQuery|\MediaobjectsQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildCulturalobjects findOne(ConnectionInterface $con = null) Return the first ChildCulturalobjects matching the query
 * @method     ChildCulturalobjects findOneOrCreate(ConnectionInterface $con = null) Return the first ChildCulturalobjects matching the query, or a new ChildCulturalobjects object populated from the query conditions when no match is found
 *
 * @method     ChildCulturalobjects findOneByCoid(int $COid) Return the first ChildCulturalobjects filtered by the COid column
 * @method     ChildCulturalobjects findOneByAccessionnumber(string $AccessionNumber) Return the first ChildCulturalobjects filtered by the AccessionNumber column
 * @method     ChildCulturalobjects findOneByObjecttype(string $ObjectType) Return the first ChildCulturalobjects filtered by the ObjectType column
 * @method     ChildCulturalobjects findOneByObject(string $Object) Return the first ChildCulturalobjects filtered by the Object column
 * @method     ChildCulturalobjects findOneByDescription(string $Description) Return the first ChildCulturalobjects filtered by the Description column
 * @method     ChildCulturalobjects findOneByMaterials(string $Materials) Return the first ChildCulturalobjects filtered by the Materials column
 * @method     ChildCulturalobjects findOneByCulturalgroup(string $CulturalGroup) Return the first ChildCulturalobjects filtered by the CulturalGroup column
 * @method     ChildCulturalobjects findOneByDimensions(string $Dimensions) Return the first ChildCulturalobjects filtered by the Dimensions column
 * @method     ChildCulturalobjects findOneByProductiondate(string $ProductionDate) Return the first ChildCulturalobjects filtered by the ProductionDate column
 * @method     ChildCulturalobjects findOneByAssociatedplaces(string $AssociatedPlaces) Return the first ChildCulturalobjects filtered by the AssociatedPlaces column
 * @method     ChildCulturalobjects findOneByAssociatedpeople(string $AssociatedPeople) Return the first ChildCulturalobjects filtered by the AssociatedPeople column
 * @method     ChildCulturalobjects findOneByFkIid(string $FK_Iid) Return the first ChildCulturalobjects filtered by the FK_Iid column
 * @method     ChildCulturalobjects findOneByFkExid(int $FK_EXid) Return the first ChildCulturalobjects filtered by the FK_EXid column *

 * @method     ChildCulturalobjects requirePk($key, ConnectionInterface $con = null) Return the ChildCulturalobjects by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCulturalobjects requireOne(ConnectionInterface $con = null) Return the first ChildCulturalobjects matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildCulturalobjects requireOneByCoid(int $COid) Return the first ChildCulturalobjects filtered by the COid column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCulturalobjects requireOneByAccessionnumber(string $AccessionNumber) Return the first ChildCulturalobjects filtered by the AccessionNumber column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCulturalobjects requireOneByObjecttype(string $ObjectType) Return the first ChildCulturalobjects filtered by the ObjectType column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCulturalobjects requireOneByObject(string $Object) Return the first ChildCulturalobjects filtered by the Object column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCulturalobjects requireOneByDescription(string $Description) Return the first ChildCulturalobjects filtered by the Description column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCulturalobjects requireOneByMaterials(string $Materials) Return the first ChildCulturalobjects filtered by the Materials column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCulturalobjects requireOneByCulturalgroup(string $CulturalGroup) Return the first ChildCulturalobjects filtered by the CulturalGroup column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCulturalobjects requireOneByDimensions(string $Dimensions) Return the first ChildCulturalobjects filtered by the Dimensions column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCulturalobjects requireOneByProductiondate(string $ProductionDate) Return the first ChildCulturalobjects filtered by the ProductionDate column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCulturalobjects requireOneByAssociatedplaces(string $AssociatedPlaces) Return the first ChildCulturalobjects filtered by the AssociatedPlaces column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCulturalobjects requireOneByAssociatedpeople(string $AssociatedPeople) Return the first ChildCulturalobjects filtered by the AssociatedPeople column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCulturalobjects requireOneByFkIid(string $FK_Iid) Return the first ChildCulturalobjects filtered by the FK_Iid column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCulturalobjects requireOneByFkExid(int $FK_EXid) Return the first ChildCulturalobjects filtered by the FK_EXid column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildCulturalobjects[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildCulturalobjects objects based on current ModelCriteria
 * @method     ChildCulturalobjects[]|ObjectCollection findByCoid(int $COid) Return ChildCulturalobjects objects filtered by the COid column
 * @method     ChildCulturalobjects[]|ObjectCollection findByAccessionnumber(string $AccessionNumber) Return ChildCulturalobjects objects filtered by the AccessionNumber column
 * @method     ChildCulturalobjects[]|ObjectCollection findByObjecttype(string $ObjectType) Return ChildCulturalobjects objects filtered by the ObjectType column
 * @method     ChildCulturalobjects[]|ObjectCollection findByObject(string $Object) Return ChildCulturalobjects objects filtered by the Object column
 * @method     ChildCulturalobjects[]|ObjectCollection findByDescription(string $Description) Return ChildCulturalobjects objects filtered by the Description column
 * @method     ChildCulturalobjects[]|ObjectCollection findByMaterials(string $Materials) Return ChildCulturalobjects objects filtered by the Materials column
 * @method     ChildCulturalobjects[]|ObjectCollection findByCulturalgroup(string $CulturalGroup) Return ChildCulturalobjects objects filtered by the CulturalGroup column
 * @method     ChildCulturalobjects[]|ObjectCollection findByDimensions(string $Dimensions) Return ChildCulturalobjects objects filtered by the Dimensions column
 * @method     ChildCulturalobjects[]|ObjectCollection findByProductiondate(string $ProductionDate) Return ChildCulturalobjects objects filtered by the ProductionDate column
 * @method     ChildCulturalobjects[]|ObjectCollection findByAssociatedplaces(string $AssociatedPlaces) Return ChildCulturalobjects objects filtered by the AssociatedPlaces column
 * @method     ChildCulturalobjects[]|ObjectCollection findByAssociatedpeople(string $AssociatedPeople) Return ChildCulturalobjects objects filtered by the AssociatedPeople column
 * @method     ChildCulturalobjects[]|ObjectCollection findByFkIid(string $FK_Iid) Return ChildCulturalobjects objects filtered by the FK_Iid column
 * @method     ChildCulturalobjects[]|ObjectCollection findByFkExid(int $FK_EXid) Return ChildCulturalobjects objects filtered by the FK_EXid column
 * @method     ChildCulturalobjects[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class CulturalobjectsQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\CulturalobjectsQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'sierraleonedb', $modelName = '\\Culturalobjects', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildCulturalobjectsQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildCulturalobjectsQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildCulturalobjectsQuery) {
            return $criteria;
        }
        $query = new ChildCulturalobjectsQuery();
        if (null !== $modelAlias) {
            $query->setModelAlias($modelAlias);
        }
        if ($criteria instanceof Criteria) {
            $query->mergeWith($criteria);
        }

        return $query;
    }

    /**
     * Find object by primary key.
     * Propel uses the instance pool to skip the database if the object exists.
     * Go fast if the query is untouched.
     *
     * <code>
     * $obj  = $c->findPk(12, $con);
     * </code>
     *
     * @param mixed $key Primary key to use for the query
     * @param ConnectionInterface $con an optional connection object
     *
     * @return ChildCulturalobjects|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(CulturalobjectsTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = CulturalobjectsTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
            // the object is already in the instance pool
            return $obj;
        }

        return $this->findPkSimple($key, $con);
    }

    /**
     * Find object by primary key using raw SQL to go fast.
     * Bypass doSelect() and the object formatter by using generated code.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     ConnectionInterface $con A connection object
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildCulturalobjects A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT COid, AccessionNumber, ObjectType, Object, Description, Materials, CulturalGroup, Dimensions, ProductionDate, AssociatedPlaces, AssociatedPeople, FK_Iid, FK_EXid FROM CulturalObjects WHERE COid = :p0';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key, PDO::PARAM_INT);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), 0, $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(\PDO::FETCH_NUM)) {
            /** @var ChildCulturalobjects $obj */
            $obj = new ChildCulturalobjects();
            $obj->hydrate($row);
            CulturalobjectsTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
        }
        $stmt->closeCursor();

        return $obj;
    }

    /**
     * Find object by primary key.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     ConnectionInterface $con A connection object
     *
     * @return ChildCulturalobjects|array|mixed the result, formatted by the current formatter
     */
    protected function findPkComplex($key, ConnectionInterface $con)
    {
        // As the query uses a PK condition, no limit(1) is necessary.
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $dataFetcher = $criteria
            ->filterByPrimaryKey($key)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->formatOne($dataFetcher);
    }

    /**
     * Find objects by primary key
     * <code>
     * $objs = $c->findPks(array(12, 56, 832), $con);
     * </code>
     * @param     array $keys Primary keys to use for the query
     * @param     ConnectionInterface $con an optional connection object
     *
     * @return ObjectCollection|array|mixed the list of results, formatted by the current formatter
     */
    public function findPks($keys, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getReadConnection($this->getDbName());
        }
        $this->basePreSelect($con);
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $dataFetcher = $criteria
            ->filterByPrimaryKeys($keys)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->format($dataFetcher);
    }

    /**
     * Filter the query by primary key
     *
     * @param     mixed $key Primary key to use for the query
     *
     * @return $this|ChildCulturalobjectsQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(CulturalobjectsTableMap::COL_COID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildCulturalobjectsQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(CulturalobjectsTableMap::COL_COID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the COid column
     *
     * Example usage:
     * <code>
     * $query->filterByCoid(1234); // WHERE COid = 1234
     * $query->filterByCoid(array(12, 34)); // WHERE COid IN (12, 34)
     * $query->filterByCoid(array('min' => 12)); // WHERE COid > 12
     * </code>
     *
     * @param     mixed $coid The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCulturalobjectsQuery The current query, for fluid interface
     */
    public function filterByCoid($coid = null, $comparison = null)
    {
        if (is_array($coid)) {
            $useMinMax = false;
            if (isset($coid['min'])) {
                $this->addUsingAlias(CulturalobjectsTableMap::COL_COID, $coid['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($coid['max'])) {
                $this->addUsingAlias(CulturalobjectsTableMap::COL_COID, $coid['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CulturalobjectsTableMap::COL_COID, $coid, $comparison);
    }

    /**
     * Filter the query on the AccessionNumber column
     *
     * Example usage:
     * <code>
     * $query->filterByAccessionnumber('fooValue');   // WHERE AccessionNumber = 'fooValue'
     * $query->filterByAccessionnumber('%fooValue%', Criteria::LIKE); // WHERE AccessionNumber LIKE '%fooValue%'
     * </code>
     *
     * @param     string $accessionnumber The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCulturalobjectsQuery The current query, for fluid interface
     */
    public function filterByAccessionnumber($accessionnumber = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($accessionnumber)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CulturalobjectsTableMap::COL_ACCESSIONNUMBER, $accessionnumber, $comparison);
    }

    /**
     * Filter the query on the ObjectType column
     *
     * Example usage:
     * <code>
     * $query->filterByObjecttype('fooValue');   // WHERE ObjectType = 'fooValue'
     * $query->filterByObjecttype('%fooValue%', Criteria::LIKE); // WHERE ObjectType LIKE '%fooValue%'
     * </code>
     *
     * @param     string $objecttype The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCulturalobjectsQuery The current query, for fluid interface
     */
    public function filterByObjecttype($objecttype = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($objecttype)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CulturalobjectsTableMap::COL_OBJECTTYPE, $objecttype, $comparison);
    }

    /**
     * Filter the query on the Object column
     *
     * Example usage:
     * <code>
     * $query->filterByObject('fooValue');   // WHERE Object = 'fooValue'
     * $query->filterByObject('%fooValue%', Criteria::LIKE); // WHERE Object LIKE '%fooValue%'
     * </code>
     *
     * @param     string $object The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCulturalobjectsQuery The current query, for fluid interface
     */
    public function filterByObject($object = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($object)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CulturalobjectsTableMap::COL_OBJECT, $object, $comparison);
    }

    /**
     * Filter the query on the Description column
     *
     * Example usage:
     * <code>
     * $query->filterByDescription('fooValue');   // WHERE Description = 'fooValue'
     * $query->filterByDescription('%fooValue%', Criteria::LIKE); // WHERE Description LIKE '%fooValue%'
     * </code>
     *
     * @param     string $description The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCulturalobjectsQuery The current query, for fluid interface
     */
    public function filterByDescription($description = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($description)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CulturalobjectsTableMap::COL_DESCRIPTION, $description, $comparison);
    }

    /**
     * Filter the query on the Materials column
     *
     * Example usage:
     * <code>
     * $query->filterByMaterials('fooValue');   // WHERE Materials = 'fooValue'
     * $query->filterByMaterials('%fooValue%', Criteria::LIKE); // WHERE Materials LIKE '%fooValue%'
     * </code>
     *
     * @param     string $materials The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCulturalobjectsQuery The current query, for fluid interface
     */
    public function filterByMaterials($materials = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($materials)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CulturalobjectsTableMap::COL_MATERIALS, $materials, $comparison);
    }

    /**
     * Filter the query on the CulturalGroup column
     *
     * Example usage:
     * <code>
     * $query->filterByCulturalgroup('fooValue');   // WHERE CulturalGroup = 'fooValue'
     * $query->filterByCulturalgroup('%fooValue%', Criteria::LIKE); // WHERE CulturalGroup LIKE '%fooValue%'
     * </code>
     *
     * @param     string $culturalgroup The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCulturalobjectsQuery The current query, for fluid interface
     */
    public function filterByCulturalgroup($culturalgroup = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($culturalgroup)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CulturalobjectsTableMap::COL_CULTURALGROUP, $culturalgroup, $comparison);
    }

    /**
     * Filter the query on the Dimensions column
     *
     * Example usage:
     * <code>
     * $query->filterByDimensions('fooValue');   // WHERE Dimensions = 'fooValue'
     * $query->filterByDimensions('%fooValue%', Criteria::LIKE); // WHERE Dimensions LIKE '%fooValue%'
     * </code>
     *
     * @param     string $dimensions The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCulturalobjectsQuery The current query, for fluid interface
     */
    public function filterByDimensions($dimensions = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($dimensions)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CulturalobjectsTableMap::COL_DIMENSIONS, $dimensions, $comparison);
    }

    /**
     * Filter the query on the ProductionDate column
     *
     * Example usage:
     * <code>
     * $query->filterByProductiondate('fooValue');   // WHERE ProductionDate = 'fooValue'
     * $query->filterByProductiondate('%fooValue%', Criteria::LIKE); // WHERE ProductionDate LIKE '%fooValue%'
     * </code>
     *
     * @param     string $productiondate The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCulturalobjectsQuery The current query, for fluid interface
     */
    public function filterByProductiondate($productiondate = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($productiondate)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CulturalobjectsTableMap::COL_PRODUCTIONDATE, $productiondate, $comparison);
    }

    /**
     * Filter the query on the AssociatedPlaces column
     *
     * Example usage:
     * <code>
     * $query->filterByAssociatedplaces('fooValue');   // WHERE AssociatedPlaces = 'fooValue'
     * $query->filterByAssociatedplaces('%fooValue%', Criteria::LIKE); // WHERE AssociatedPlaces LIKE '%fooValue%'
     * </code>
     *
     * @param     string $associatedplaces The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCulturalobjectsQuery The current query, for fluid interface
     */
    public function filterByAssociatedplaces($associatedplaces = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($associatedplaces)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CulturalobjectsTableMap::COL_ASSOCIATEDPLACES, $associatedplaces, $comparison);
    }

    /**
     * Filter the query on the AssociatedPeople column
     *
     * Example usage:
     * <code>
     * $query->filterByAssociatedpeople('fooValue');   // WHERE AssociatedPeople = 'fooValue'
     * $query->filterByAssociatedpeople('%fooValue%', Criteria::LIKE); // WHERE AssociatedPeople LIKE '%fooValue%'
     * </code>
     *
     * @param     string $associatedpeople The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCulturalobjectsQuery The current query, for fluid interface
     */
    public function filterByAssociatedpeople($associatedpeople = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($associatedpeople)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CulturalobjectsTableMap::COL_ASSOCIATEDPEOPLE, $associatedpeople, $comparison);
    }

    /**
     * Filter the query on the FK_Iid column
     *
     * Example usage:
     * <code>
     * $query->filterByFkIid('fooValue');   // WHERE FK_Iid = 'fooValue'
     * $query->filterByFkIid('%fooValue%', Criteria::LIKE); // WHERE FK_Iid LIKE '%fooValue%'
     * </code>
     *
     * @param     string $fkIid The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCulturalobjectsQuery The current query, for fluid interface
     */
    public function filterByFkIid($fkIid = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($fkIid)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CulturalobjectsTableMap::COL_FK_IID, $fkIid, $comparison);
    }

    /**
     * Filter the query on the FK_EXid column
     *
     * Example usage:
     * <code>
     * $query->filterByFkExid(1234); // WHERE FK_EXid = 1234
     * $query->filterByFkExid(array(12, 34)); // WHERE FK_EXid IN (12, 34)
     * $query->filterByFkExid(array('min' => 12)); // WHERE FK_EXid > 12
     * </code>
     *
     * @see       filterByExhibition()
     *
     * @param     mixed $fkExid The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCulturalobjectsQuery The current query, for fluid interface
     */
    public function filterByFkExid($fkExid = null, $comparison = null)
    {
        if (is_array($fkExid)) {
            $useMinMax = false;
            if (isset($fkExid['min'])) {
                $this->addUsingAlias(CulturalobjectsTableMap::COL_FK_EXID, $fkExid['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($fkExid['max'])) {
                $this->addUsingAlias(CulturalobjectsTableMap::COL_FK_EXID, $fkExid['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CulturalobjectsTableMap::COL_FK_EXID, $fkExid, $comparison);
    }

    /**
     * Filter the query by a related \Exhibition object
     *
     * @param \Exhibition|ObjectCollection $exhibition The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildCulturalobjectsQuery The current query, for fluid interface
     */
    public function filterByExhibition($exhibition, $comparison = null)
    {
        if ($exhibition instanceof \Exhibition) {
            return $this
                ->addUsingAlias(CulturalobjectsTableMap::COL_FK_EXID, $exhibition->getExid(), $comparison);
        } elseif ($exhibition instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(CulturalobjectsTableMap::COL_FK_EXID, $exhibition->toKeyValue('PrimaryKey', 'Exid'), $comparison);
        } else {
            throw new PropelException('filterByExhibition() only accepts arguments of type \Exhibition or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Exhibition relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildCulturalobjectsQuery The current query, for fluid interface
     */
    public function joinExhibition($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Exhibition');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'Exhibition');
        }

        return $this;
    }

    /**
     * Use the Exhibition relation Exhibition object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \ExhibitionQuery A secondary query class using the current class as primary query
     */
    public function useExhibitionQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinExhibition($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Exhibition', '\ExhibitionQuery');
    }

    /**
     * Filter the query by a related \Institutions object
     *
     * @param \Institutions|ObjectCollection $institutions The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildCulturalobjectsQuery The current query, for fluid interface
     */
    public function filterByInstitutions($institutions, $comparison = null)
    {
        if ($institutions instanceof \Institutions) {
            return $this
                ->addUsingAlias(CulturalobjectsTableMap::COL_FK_IID, $institutions->getInstitutionname(), $comparison);
        } elseif ($institutions instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(CulturalobjectsTableMap::COL_FK_IID, $institutions->toKeyValue('PrimaryKey', 'Institutionname'), $comparison);
        } else {
            throw new PropelException('filterByInstitutions() only accepts arguments of type \Institutions or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Institutions relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildCulturalobjectsQuery The current query, for fluid interface
     */
    public function joinInstitutions($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Institutions');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'Institutions');
        }

        return $this;
    }

    /**
     * Use the Institutions relation Institutions object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \InstitutionsQuery A secondary query class using the current class as primary query
     */
    public function useInstitutionsQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinInstitutions($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Institutions', '\InstitutionsQuery');
    }

    /**
     * Filter the query by a related \Associatedmediaobjects object
     *
     * @param \Associatedmediaobjects|ObjectCollection $associatedmediaobjects the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildCulturalobjectsQuery The current query, for fluid interface
     */
    public function filterByAssociatedmediaobjects($associatedmediaobjects, $comparison = null)
    {
        if ($associatedmediaobjects instanceof \Associatedmediaobjects) {
            return $this
                ->addUsingAlias(CulturalobjectsTableMap::COL_COID, $associatedmediaobjects->getFkCoid(), $comparison);
        } elseif ($associatedmediaobjects instanceof ObjectCollection) {
            return $this
                ->useAssociatedmediaobjectsQuery()
                ->filterByPrimaryKeys($associatedmediaobjects->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByAssociatedmediaobjects() only accepts arguments of type \Associatedmediaobjects or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Associatedmediaobjects relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildCulturalobjectsQuery The current query, for fluid interface
     */
    public function joinAssociatedmediaobjects($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Associatedmediaobjects');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'Associatedmediaobjects');
        }

        return $this;
    }

    /**
     * Use the Associatedmediaobjects relation Associatedmediaobjects object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \AssociatedmediaobjectsQuery A secondary query class using the current class as primary query
     */
    public function useAssociatedmediaobjectsQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinAssociatedmediaobjects($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Associatedmediaobjects', '\AssociatedmediaobjectsQuery');
    }

    /**
     * Filter the query by a related \Mediaobjects object
     *
     * @param \Mediaobjects|ObjectCollection $mediaobjects the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildCulturalobjectsQuery The current query, for fluid interface
     */
    public function filterByMediaobjects($mediaobjects, $comparison = null)
    {
        if ($mediaobjects instanceof \Mediaobjects) {
            return $this
                ->addUsingAlias(CulturalobjectsTableMap::COL_COID, $mediaobjects->getFkCoid(), $comparison);
        } elseif ($mediaobjects instanceof ObjectCollection) {
            return $this
                ->useMediaobjectsQuery()
                ->filterByPrimaryKeys($mediaobjects->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByMediaobjects() only accepts arguments of type \Mediaobjects or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Mediaobjects relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildCulturalobjectsQuery The current query, for fluid interface
     */
    public function joinMediaobjects($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Mediaobjects');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'Mediaobjects');
        }

        return $this;
    }

    /**
     * Use the Mediaobjects relation Mediaobjects object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \MediaobjectsQuery A secondary query class using the current class as primary query
     */
    public function useMediaobjectsQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinMediaobjects($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Mediaobjects', '\MediaobjectsQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildCulturalobjects $culturalobjects Object to remove from the list of results
     *
     * @return $this|ChildCulturalobjectsQuery The current query, for fluid interface
     */
    public function prune($culturalobjects = null)
    {
        if ($culturalobjects) {
            $this->addUsingAlias(CulturalobjectsTableMap::COL_COID, $culturalobjects->getCoid(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the CulturalObjects table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(CulturalobjectsTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            CulturalobjectsTableMap::clearInstancePool();
            CulturalobjectsTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

    /**
     * Performs a DELETE on the database based on the current ModelCriteria
     *
     * @param ConnectionInterface $con the connection to use
     * @return int             The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *                         if supported by native driver or if emulated using Propel.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public function delete(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(CulturalobjectsTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(CulturalobjectsTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            CulturalobjectsTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            CulturalobjectsTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // CulturalobjectsQuery
