<?php

namespace Base;

use \Institutions as ChildInstitutions;
use \InstitutionsQuery as ChildInstitutionsQuery;
use \Exception;
use \PDO;
use Map\InstitutionsTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'Institutions' table.
 *
 *
 *
 * @method     ChildInstitutionsQuery orderByInstitutionname($order = Criteria::ASC) Order by the InstitutionName column
 * @method     ChildInstitutionsQuery orderByInstitutionurl($order = Criteria::ASC) Order by the InstitutionURL column
 *
 * @method     ChildInstitutionsQuery groupByInstitutionname() Group by the InstitutionName column
 * @method     ChildInstitutionsQuery groupByInstitutionurl() Group by the InstitutionURL column
 *
 * @method     ChildInstitutionsQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildInstitutionsQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildInstitutionsQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildInstitutionsQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildInstitutionsQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildInstitutionsQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildInstitutionsQuery leftJoinCulturalobjects($relationAlias = null) Adds a LEFT JOIN clause to the query using the Culturalobjects relation
 * @method     ChildInstitutionsQuery rightJoinCulturalobjects($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Culturalobjects relation
 * @method     ChildInstitutionsQuery innerJoinCulturalobjects($relationAlias = null) Adds a INNER JOIN clause to the query using the Culturalobjects relation
 *
 * @method     ChildInstitutionsQuery joinWithCulturalobjects($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Culturalobjects relation
 *
 * @method     ChildInstitutionsQuery leftJoinWithCulturalobjects() Adds a LEFT JOIN clause and with to the query using the Culturalobjects relation
 * @method     ChildInstitutionsQuery rightJoinWithCulturalobjects() Adds a RIGHT JOIN clause and with to the query using the Culturalobjects relation
 * @method     ChildInstitutionsQuery innerJoinWithCulturalobjects() Adds a INNER JOIN clause and with to the query using the Culturalobjects relation
 *
 * @method     \CulturalobjectsQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildInstitutions findOne(ConnectionInterface $con = null) Return the first ChildInstitutions matching the query
 * @method     ChildInstitutions findOneOrCreate(ConnectionInterface $con = null) Return the first ChildInstitutions matching the query, or a new ChildInstitutions object populated from the query conditions when no match is found
 *
 * @method     ChildInstitutions findOneByInstitutionname(string $InstitutionName) Return the first ChildInstitutions filtered by the InstitutionName column
 * @method     ChildInstitutions findOneByInstitutionurl(string $InstitutionURL) Return the first ChildInstitutions filtered by the InstitutionURL column *

 * @method     ChildInstitutions requirePk($key, ConnectionInterface $con = null) Return the ChildInstitutions by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildInstitutions requireOne(ConnectionInterface $con = null) Return the first ChildInstitutions matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildInstitutions requireOneByInstitutionname(string $InstitutionName) Return the first ChildInstitutions filtered by the InstitutionName column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildInstitutions requireOneByInstitutionurl(string $InstitutionURL) Return the first ChildInstitutions filtered by the InstitutionURL column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildInstitutions[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildInstitutions objects based on current ModelCriteria
 * @method     ChildInstitutions[]|ObjectCollection findByInstitutionname(string $InstitutionName) Return ChildInstitutions objects filtered by the InstitutionName column
 * @method     ChildInstitutions[]|ObjectCollection findByInstitutionurl(string $InstitutionURL) Return ChildInstitutions objects filtered by the InstitutionURL column
 * @method     ChildInstitutions[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class InstitutionsQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\InstitutionsQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'sierraleonedb', $modelName = '\\Institutions', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildInstitutionsQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildInstitutionsQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildInstitutionsQuery) {
            return $criteria;
        }
        $query = new ChildInstitutionsQuery();
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
     * @return ChildInstitutions|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(InstitutionsTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = InstitutionsTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildInstitutions A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT InstitutionName, InstitutionURL FROM Institutions WHERE InstitutionName = :p0';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key, PDO::PARAM_STR);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), 0, $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(\PDO::FETCH_NUM)) {
            /** @var ChildInstitutions $obj */
            $obj = new ChildInstitutions();
            $obj->hydrate($row);
            InstitutionsTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildInstitutions|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildInstitutionsQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(InstitutionsTableMap::COL_INSTITUTIONNAME, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildInstitutionsQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(InstitutionsTableMap::COL_INSTITUTIONNAME, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the InstitutionName column
     *
     * Example usage:
     * <code>
     * $query->filterByInstitutionname('fooValue');   // WHERE InstitutionName = 'fooValue'
     * $query->filterByInstitutionname('%fooValue%', Criteria::LIKE); // WHERE InstitutionName LIKE '%fooValue%'
     * </code>
     *
     * @param     string $institutionname The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildInstitutionsQuery The current query, for fluid interface
     */
    public function filterByInstitutionname($institutionname = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($institutionname)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(InstitutionsTableMap::COL_INSTITUTIONNAME, $institutionname, $comparison);
    }

    /**
     * Filter the query on the InstitutionURL column
     *
     * Example usage:
     * <code>
     * $query->filterByInstitutionurl('fooValue');   // WHERE InstitutionURL = 'fooValue'
     * $query->filterByInstitutionurl('%fooValue%', Criteria::LIKE); // WHERE InstitutionURL LIKE '%fooValue%'
     * </code>
     *
     * @param     string $institutionurl The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildInstitutionsQuery The current query, for fluid interface
     */
    public function filterByInstitutionurl($institutionurl = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($institutionurl)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(InstitutionsTableMap::COL_INSTITUTIONURL, $institutionurl, $comparison);
    }

    /**
     * Filter the query by a related \Culturalobjects object
     *
     * @param \Culturalobjects|ObjectCollection $culturalobjects the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildInstitutionsQuery The current query, for fluid interface
     */
    public function filterByCulturalobjects($culturalobjects, $comparison = null)
    {
        if ($culturalobjects instanceof \Culturalobjects) {
            return $this
                ->addUsingAlias(InstitutionsTableMap::COL_INSTITUTIONNAME, $culturalobjects->getFkIid(), $comparison);
        } elseif ($culturalobjects instanceof ObjectCollection) {
            return $this
                ->useCulturalobjectsQuery()
                ->filterByPrimaryKeys($culturalobjects->getPrimaryKeys())
                ->endUse();
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
     * @return $this|ChildInstitutionsQuery The current query, for fluid interface
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
     * @param   ChildInstitutions $institutions Object to remove from the list of results
     *
     * @return $this|ChildInstitutionsQuery The current query, for fluid interface
     */
    public function prune($institutions = null)
    {
        if ($institutions) {
            $this->addUsingAlias(InstitutionsTableMap::COL_INSTITUTIONNAME, $institutions->getInstitutionname(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the Institutions table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(InstitutionsTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            InstitutionsTableMap::clearInstancePool();
            InstitutionsTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(InstitutionsTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(InstitutionsTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            InstitutionsTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            InstitutionsTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // InstitutionsQuery
