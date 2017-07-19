<?php

namespace Base;

use \Associatedmediaobjects as ChildAssociatedmediaobjects;
use \AssociatedmediaobjectsQuery as ChildAssociatedmediaobjectsQuery;
use \Exception;
use \PDO;
use Map\AssociatedmediaobjectsTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'AssociatedMediaObjects' table.
 *
 *
 *
 * @method     ChildAssociatedmediaobjectsQuery orderByAmoid($order = Criteria::ASC) Order by the AMOid column
 * @method     ChildAssociatedmediaobjectsQuery orderByAssociatedmediafilename($order = Criteria::ASC) Order by the AssociatedMediaFileName column
 * @method     ChildAssociatedmediaobjectsQuery orderByAssociatedmediatitle($order = Criteria::ASC) Order by the AssociatedMediaTitle column
 * @method     ChildAssociatedmediaobjectsQuery orderByAssociatedmediadescription($order = Criteria::ASC) Order by the AssociatedMediaDescription column
 * @method     ChildAssociatedmediaobjectsQuery orderByAssociatedmediatype($order = Criteria::ASC) Order by the AssociatedMediaType column
 * @method     ChildAssociatedmediaobjectsQuery orderByFkCoid($order = Criteria::ASC) Order by the FK_COid column
 *
 * @method     ChildAssociatedmediaobjectsQuery groupByAmoid() Group by the AMOid column
 * @method     ChildAssociatedmediaobjectsQuery groupByAssociatedmediafilename() Group by the AssociatedMediaFileName column
 * @method     ChildAssociatedmediaobjectsQuery groupByAssociatedmediatitle() Group by the AssociatedMediaTitle column
 * @method     ChildAssociatedmediaobjectsQuery groupByAssociatedmediadescription() Group by the AssociatedMediaDescription column
 * @method     ChildAssociatedmediaobjectsQuery groupByAssociatedmediatype() Group by the AssociatedMediaType column
 * @method     ChildAssociatedmediaobjectsQuery groupByFkCoid() Group by the FK_COid column
 *
 * @method     ChildAssociatedmediaobjectsQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildAssociatedmediaobjectsQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildAssociatedmediaobjectsQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildAssociatedmediaobjectsQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildAssociatedmediaobjectsQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildAssociatedmediaobjectsQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildAssociatedmediaobjectsQuery leftJoinCulturalobjects($relationAlias = null) Adds a LEFT JOIN clause to the query using the Culturalobjects relation
 * @method     ChildAssociatedmediaobjectsQuery rightJoinCulturalobjects($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Culturalobjects relation
 * @method     ChildAssociatedmediaobjectsQuery innerJoinCulturalobjects($relationAlias = null) Adds a INNER JOIN clause to the query using the Culturalobjects relation
 *
 * @method     ChildAssociatedmediaobjectsQuery joinWithCulturalobjects($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Culturalobjects relation
 *
 * @method     ChildAssociatedmediaobjectsQuery leftJoinWithCulturalobjects() Adds a LEFT JOIN clause and with to the query using the Culturalobjects relation
 * @method     ChildAssociatedmediaobjectsQuery rightJoinWithCulturalobjects() Adds a RIGHT JOIN clause and with to the query using the Culturalobjects relation
 * @method     ChildAssociatedmediaobjectsQuery innerJoinWithCulturalobjects() Adds a INNER JOIN clause and with to the query using the Culturalobjects relation
 *
 * @method     \CulturalobjectsQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildAssociatedmediaobjects findOne(ConnectionInterface $con = null) Return the first ChildAssociatedmediaobjects matching the query
 * @method     ChildAssociatedmediaobjects findOneOrCreate(ConnectionInterface $con = null) Return the first ChildAssociatedmediaobjects matching the query, or a new ChildAssociatedmediaobjects object populated from the query conditions when no match is found
 *
 * @method     ChildAssociatedmediaobjects findOneByAmoid(int $AMOid) Return the first ChildAssociatedmediaobjects filtered by the AMOid column
 * @method     ChildAssociatedmediaobjects findOneByAssociatedmediafilename(string $AssociatedMediaFileName) Return the first ChildAssociatedmediaobjects filtered by the AssociatedMediaFileName column
 * @method     ChildAssociatedmediaobjects findOneByAssociatedmediatitle(string $AssociatedMediaTitle) Return the first ChildAssociatedmediaobjects filtered by the AssociatedMediaTitle column
 * @method     ChildAssociatedmediaobjects findOneByAssociatedmediadescription(string $AssociatedMediaDescription) Return the first ChildAssociatedmediaobjects filtered by the AssociatedMediaDescription column
 * @method     ChildAssociatedmediaobjects findOneByAssociatedmediatype(string $AssociatedMediaType) Return the first ChildAssociatedmediaobjects filtered by the AssociatedMediaType column
 * @method     ChildAssociatedmediaobjects findOneByFkCoid(int $FK_COid) Return the first ChildAssociatedmediaobjects filtered by the FK_COid column *

 * @method     ChildAssociatedmediaobjects requirePk($key, ConnectionInterface $con = null) Return the ChildAssociatedmediaobjects by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAssociatedmediaobjects requireOne(ConnectionInterface $con = null) Return the first ChildAssociatedmediaobjects matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildAssociatedmediaobjects requireOneByAmoid(int $AMOid) Return the first ChildAssociatedmediaobjects filtered by the AMOid column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAssociatedmediaobjects requireOneByAssociatedmediafilename(string $AssociatedMediaFileName) Return the first ChildAssociatedmediaobjects filtered by the AssociatedMediaFileName column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAssociatedmediaobjects requireOneByAssociatedmediatitle(string $AssociatedMediaTitle) Return the first ChildAssociatedmediaobjects filtered by the AssociatedMediaTitle column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAssociatedmediaobjects requireOneByAssociatedmediadescription(string $AssociatedMediaDescription) Return the first ChildAssociatedmediaobjects filtered by the AssociatedMediaDescription column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAssociatedmediaobjects requireOneByAssociatedmediatype(string $AssociatedMediaType) Return the first ChildAssociatedmediaobjects filtered by the AssociatedMediaType column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAssociatedmediaobjects requireOneByFkCoid(int $FK_COid) Return the first ChildAssociatedmediaobjects filtered by the FK_COid column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildAssociatedmediaobjects[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildAssociatedmediaobjects objects based on current ModelCriteria
 * @method     ChildAssociatedmediaobjects[]|ObjectCollection findByAmoid(int $AMOid) Return ChildAssociatedmediaobjects objects filtered by the AMOid column
 * @method     ChildAssociatedmediaobjects[]|ObjectCollection findByAssociatedmediafilename(string $AssociatedMediaFileName) Return ChildAssociatedmediaobjects objects filtered by the AssociatedMediaFileName column
 * @method     ChildAssociatedmediaobjects[]|ObjectCollection findByAssociatedmediatitle(string $AssociatedMediaTitle) Return ChildAssociatedmediaobjects objects filtered by the AssociatedMediaTitle column
 * @method     ChildAssociatedmediaobjects[]|ObjectCollection findByAssociatedmediadescription(string $AssociatedMediaDescription) Return ChildAssociatedmediaobjects objects filtered by the AssociatedMediaDescription column
 * @method     ChildAssociatedmediaobjects[]|ObjectCollection findByAssociatedmediatype(string $AssociatedMediaType) Return ChildAssociatedmediaobjects objects filtered by the AssociatedMediaType column
 * @method     ChildAssociatedmediaobjects[]|ObjectCollection findByFkCoid(int $FK_COid) Return ChildAssociatedmediaobjects objects filtered by the FK_COid column
 * @method     ChildAssociatedmediaobjects[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class AssociatedmediaobjectsQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\AssociatedmediaobjectsQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'sierraleonedb', $modelName = '\\Associatedmediaobjects', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildAssociatedmediaobjectsQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildAssociatedmediaobjectsQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildAssociatedmediaobjectsQuery) {
            return $criteria;
        }
        $query = new ChildAssociatedmediaobjectsQuery();
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
     * @return ChildAssociatedmediaobjects|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(AssociatedmediaobjectsTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = AssociatedmediaobjectsTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildAssociatedmediaobjects A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT AMOid, AssociatedMediaFileName, AssociatedMediaTitle, AssociatedMediaDescription, AssociatedMediaType, FK_COid FROM AssociatedMediaObjects WHERE AMOid = :p0';
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
            /** @var ChildAssociatedmediaobjects $obj */
            $obj = new ChildAssociatedmediaobjects();
            $obj->hydrate($row);
            AssociatedmediaobjectsTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildAssociatedmediaobjects|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildAssociatedmediaobjectsQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(AssociatedmediaobjectsTableMap::COL_AMOID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildAssociatedmediaobjectsQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(AssociatedmediaobjectsTableMap::COL_AMOID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the AMOid column
     *
     * Example usage:
     * <code>
     * $query->filterByAmoid(1234); // WHERE AMOid = 1234
     * $query->filterByAmoid(array(12, 34)); // WHERE AMOid IN (12, 34)
     * $query->filterByAmoid(array('min' => 12)); // WHERE AMOid > 12
     * </code>
     *
     * @param     mixed $amoid The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildAssociatedmediaobjectsQuery The current query, for fluid interface
     */
    public function filterByAmoid($amoid = null, $comparison = null)
    {
        if (is_array($amoid)) {
            $useMinMax = false;
            if (isset($amoid['min'])) {
                $this->addUsingAlias(AssociatedmediaobjectsTableMap::COL_AMOID, $amoid['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($amoid['max'])) {
                $this->addUsingAlias(AssociatedmediaobjectsTableMap::COL_AMOID, $amoid['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(AssociatedmediaobjectsTableMap::COL_AMOID, $amoid, $comparison);
    }

    /**
     * Filter the query on the AssociatedMediaFileName column
     *
     * Example usage:
     * <code>
     * $query->filterByAssociatedmediafilename('fooValue');   // WHERE AssociatedMediaFileName = 'fooValue'
     * $query->filterByAssociatedmediafilename('%fooValue%', Criteria::LIKE); // WHERE AssociatedMediaFileName LIKE '%fooValue%'
     * </code>
     *
     * @param     string $associatedmediafilename The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildAssociatedmediaobjectsQuery The current query, for fluid interface
     */
    public function filterByAssociatedmediafilename($associatedmediafilename = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($associatedmediafilename)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(AssociatedmediaobjectsTableMap::COL_ASSOCIATEDMEDIAFILENAME, $associatedmediafilename, $comparison);
    }

    /**
     * Filter the query on the AssociatedMediaTitle column
     *
     * Example usage:
     * <code>
     * $query->filterByAssociatedmediatitle('fooValue');   // WHERE AssociatedMediaTitle = 'fooValue'
     * $query->filterByAssociatedmediatitle('%fooValue%', Criteria::LIKE); // WHERE AssociatedMediaTitle LIKE '%fooValue%'
     * </code>
     *
     * @param     string $associatedmediatitle The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildAssociatedmediaobjectsQuery The current query, for fluid interface
     */
    public function filterByAssociatedmediatitle($associatedmediatitle = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($associatedmediatitle)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(AssociatedmediaobjectsTableMap::COL_ASSOCIATEDMEDIATITLE, $associatedmediatitle, $comparison);
    }

    /**
     * Filter the query on the AssociatedMediaDescription column
     *
     * Example usage:
     * <code>
     * $query->filterByAssociatedmediadescription('fooValue');   // WHERE AssociatedMediaDescription = 'fooValue'
     * $query->filterByAssociatedmediadescription('%fooValue%', Criteria::LIKE); // WHERE AssociatedMediaDescription LIKE '%fooValue%'
     * </code>
     *
     * @param     string $associatedmediadescription The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildAssociatedmediaobjectsQuery The current query, for fluid interface
     */
    public function filterByAssociatedmediadescription($associatedmediadescription = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($associatedmediadescription)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(AssociatedmediaobjectsTableMap::COL_ASSOCIATEDMEDIADESCRIPTION, $associatedmediadescription, $comparison);
    }

    /**
     * Filter the query on the AssociatedMediaType column
     *
     * Example usage:
     * <code>
     * $query->filterByAssociatedmediatype('fooValue');   // WHERE AssociatedMediaType = 'fooValue'
     * $query->filterByAssociatedmediatype('%fooValue%', Criteria::LIKE); // WHERE AssociatedMediaType LIKE '%fooValue%'
     * </code>
     *
     * @param     string $associatedmediatype The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildAssociatedmediaobjectsQuery The current query, for fluid interface
     */
    public function filterByAssociatedmediatype($associatedmediatype = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($associatedmediatype)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(AssociatedmediaobjectsTableMap::COL_ASSOCIATEDMEDIATYPE, $associatedmediatype, $comparison);
    }

    /**
     * Filter the query on the FK_COid column
     *
     * Example usage:
     * <code>
     * $query->filterByFkCoid(1234); // WHERE FK_COid = 1234
     * $query->filterByFkCoid(array(12, 34)); // WHERE FK_COid IN (12, 34)
     * $query->filterByFkCoid(array('min' => 12)); // WHERE FK_COid > 12
     * </code>
     *
     * @see       filterByCulturalobjects()
     *
     * @param     mixed $fkCoid The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildAssociatedmediaobjectsQuery The current query, for fluid interface
     */
    public function filterByFkCoid($fkCoid = null, $comparison = null)
    {
        if (is_array($fkCoid)) {
            $useMinMax = false;
            if (isset($fkCoid['min'])) {
                $this->addUsingAlias(AssociatedmediaobjectsTableMap::COL_FK_COID, $fkCoid['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($fkCoid['max'])) {
                $this->addUsingAlias(AssociatedmediaobjectsTableMap::COL_FK_COID, $fkCoid['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(AssociatedmediaobjectsTableMap::COL_FK_COID, $fkCoid, $comparison);
    }

    /**
     * Filter the query by a related \Culturalobjects object
     *
     * @param \Culturalobjects|ObjectCollection $culturalobjects The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildAssociatedmediaobjectsQuery The current query, for fluid interface
     */
    public function filterByCulturalobjects($culturalobjects, $comparison = null)
    {
        if ($culturalobjects instanceof \Culturalobjects) {
            return $this
                ->addUsingAlias(AssociatedmediaobjectsTableMap::COL_FK_COID, $culturalobjects->getCoid(), $comparison);
        } elseif ($culturalobjects instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(AssociatedmediaobjectsTableMap::COL_FK_COID, $culturalobjects->toKeyValue('PrimaryKey', 'Coid'), $comparison);
        } else {
            throw new PropelException('filterByCulturalobjects() only accepts arguments of type \Culturalobjects or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Culturalobjects relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildAssociatedmediaobjectsQuery The current query, for fluid interface
     */
    public function joinCulturalobjects($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Culturalobjects');

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
            $this->addJoinObject($join, 'Culturalobjects');
        }

        return $this;
    }

    /**
     * Use the Culturalobjects relation Culturalobjects object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \CulturalobjectsQuery A secondary query class using the current class as primary query
     */
    public function useCulturalobjectsQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinCulturalobjects($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Culturalobjects', '\CulturalobjectsQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildAssociatedmediaobjects $associatedmediaobjects Object to remove from the list of results
     *
     * @return $this|ChildAssociatedmediaobjectsQuery The current query, for fluid interface
     */
    public function prune($associatedmediaobjects = null)
    {
        if ($associatedmediaobjects) {
            $this->addUsingAlias(AssociatedmediaobjectsTableMap::COL_AMOID, $associatedmediaobjects->getAmoid(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the AssociatedMediaObjects table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(AssociatedmediaobjectsTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            AssociatedmediaobjectsTableMap::clearInstancePool();
            AssociatedmediaobjectsTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(AssociatedmediaobjectsTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(AssociatedmediaobjectsTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            AssociatedmediaobjectsTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            AssociatedmediaobjectsTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // AssociatedmediaobjectsQuery
