<?php

namespace Base;

use \Mediaobjects as ChildMediaobjects;
use \MediaobjectsQuery as ChildMediaobjectsQuery;
use \Exception;
use \PDO;
use Map\MediaobjectsTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'MediaObjects' table.
 *
 *
 *
 * @method     ChildMediaobjectsQuery orderByMoid($order = Criteria::ASC) Order by the MOid column
 * @method     ChildMediaobjectsQuery orderByMediafilename($order = Criteria::ASC) Order by the MediaFileName column
 * @method     ChildMediaobjectsQuery orderByMediatitle($order = Criteria::ASC) Order by the MediaTitle column
 * @method     ChildMediaobjectsQuery orderByMediadescription($order = Criteria::ASC) Order by the MediaDescription column
 * @method     ChildMediaobjectsQuery orderByMediatype($order = Criteria::ASC) Order by the MediaType column
 * @method     ChildMediaobjectsQuery orderByFkCoid($order = Criteria::ASC) Order by the FK_COid column
 *
 * @method     ChildMediaobjectsQuery groupByMoid() Group by the MOid column
 * @method     ChildMediaobjectsQuery groupByMediafilename() Group by the MediaFileName column
 * @method     ChildMediaobjectsQuery groupByMediatitle() Group by the MediaTitle column
 * @method     ChildMediaobjectsQuery groupByMediadescription() Group by the MediaDescription column
 * @method     ChildMediaobjectsQuery groupByMediatype() Group by the MediaType column
 * @method     ChildMediaobjectsQuery groupByFkCoid() Group by the FK_COid column
 *
 * @method     ChildMediaobjectsQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildMediaobjectsQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildMediaobjectsQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildMediaobjectsQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildMediaobjectsQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildMediaobjectsQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildMediaobjectsQuery leftJoinCulturalobjects($relationAlias = null) Adds a LEFT JOIN clause to the query using the Culturalobjects relation
 * @method     ChildMediaobjectsQuery rightJoinCulturalobjects($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Culturalobjects relation
 * @method     ChildMediaobjectsQuery innerJoinCulturalobjects($relationAlias = null) Adds a INNER JOIN clause to the query using the Culturalobjects relation
 *
 * @method     ChildMediaobjectsQuery joinWithCulturalobjects($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Culturalobjects relation
 *
 * @method     ChildMediaobjectsQuery leftJoinWithCulturalobjects() Adds a LEFT JOIN clause and with to the query using the Culturalobjects relation
 * @method     ChildMediaobjectsQuery rightJoinWithCulturalobjects() Adds a RIGHT JOIN clause and with to the query using the Culturalobjects relation
 * @method     ChildMediaobjectsQuery innerJoinWithCulturalobjects() Adds a INNER JOIN clause and with to the query using the Culturalobjects relation
 *
 * @method     \CulturalobjectsQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildMediaobjects findOne(ConnectionInterface $con = null) Return the first ChildMediaobjects matching the query
 * @method     ChildMediaobjects findOneOrCreate(ConnectionInterface $con = null) Return the first ChildMediaobjects matching the query, or a new ChildMediaobjects object populated from the query conditions when no match is found
 *
 * @method     ChildMediaobjects findOneByMoid(int $MOid) Return the first ChildMediaobjects filtered by the MOid column
 * @method     ChildMediaobjects findOneByMediafilename(string $MediaFileName) Return the first ChildMediaobjects filtered by the MediaFileName column
 * @method     ChildMediaobjects findOneByMediatitle(string $MediaTitle) Return the first ChildMediaobjects filtered by the MediaTitle column
 * @method     ChildMediaobjects findOneByMediadescription(string $MediaDescription) Return the first ChildMediaobjects filtered by the MediaDescription column
 * @method     ChildMediaobjects findOneByMediatype(string $MediaType) Return the first ChildMediaobjects filtered by the MediaType column
 * @method     ChildMediaobjects findOneByFkCoid(int $FK_COid) Return the first ChildMediaobjects filtered by the FK_COid column *

 * @method     ChildMediaobjects requirePk($key, ConnectionInterface $con = null) Return the ChildMediaobjects by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildMediaobjects requireOne(ConnectionInterface $con = null) Return the first ChildMediaobjects matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildMediaobjects requireOneByMoid(int $MOid) Return the first ChildMediaobjects filtered by the MOid column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildMediaobjects requireOneByMediafilename(string $MediaFileName) Return the first ChildMediaobjects filtered by the MediaFileName column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildMediaobjects requireOneByMediatitle(string $MediaTitle) Return the first ChildMediaobjects filtered by the MediaTitle column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildMediaobjects requireOneByMediadescription(string $MediaDescription) Return the first ChildMediaobjects filtered by the MediaDescription column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildMediaobjects requireOneByMediatype(string $MediaType) Return the first ChildMediaobjects filtered by the MediaType column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildMediaobjects requireOneByFkCoid(int $FK_COid) Return the first ChildMediaobjects filtered by the FK_COid column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildMediaobjects[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildMediaobjects objects based on current ModelCriteria
 * @method     ChildMediaobjects[]|ObjectCollection findByMoid(int $MOid) Return ChildMediaobjects objects filtered by the MOid column
 * @method     ChildMediaobjects[]|ObjectCollection findByMediafilename(string $MediaFileName) Return ChildMediaobjects objects filtered by the MediaFileName column
 * @method     ChildMediaobjects[]|ObjectCollection findByMediatitle(string $MediaTitle) Return ChildMediaobjects objects filtered by the MediaTitle column
 * @method     ChildMediaobjects[]|ObjectCollection findByMediadescription(string $MediaDescription) Return ChildMediaobjects objects filtered by the MediaDescription column
 * @method     ChildMediaobjects[]|ObjectCollection findByMediatype(string $MediaType) Return ChildMediaobjects objects filtered by the MediaType column
 * @method     ChildMediaobjects[]|ObjectCollection findByFkCoid(int $FK_COid) Return ChildMediaobjects objects filtered by the FK_COid column
 * @method     ChildMediaobjects[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class MediaobjectsQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\MediaobjectsQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'sierraleonedb', $modelName = '\\Mediaobjects', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildMediaobjectsQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildMediaobjectsQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildMediaobjectsQuery) {
            return $criteria;
        }
        $query = new ChildMediaobjectsQuery();
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
     * @return ChildMediaobjects|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(MediaobjectsTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = MediaobjectsTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildMediaobjects A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT MOid, MediaFileName, MediaTitle, MediaDescription, MediaType, FK_COid FROM MediaObjects WHERE MOid = :p0';
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
            /** @var ChildMediaobjects $obj */
            $obj = new ChildMediaobjects();
            $obj->hydrate($row);
            MediaobjectsTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildMediaobjects|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildMediaobjectsQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(MediaobjectsTableMap::COL_MOID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildMediaobjectsQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(MediaobjectsTableMap::COL_MOID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the MOid column
     *
     * Example usage:
     * <code>
     * $query->filterByMoid(1234); // WHERE MOid = 1234
     * $query->filterByMoid(array(12, 34)); // WHERE MOid IN (12, 34)
     * $query->filterByMoid(array('min' => 12)); // WHERE MOid > 12
     * </code>
     *
     * @param     mixed $moid The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildMediaobjectsQuery The current query, for fluid interface
     */
    public function filterByMoid($moid = null, $comparison = null)
    {
        if (is_array($moid)) {
            $useMinMax = false;
            if (isset($moid['min'])) {
                $this->addUsingAlias(MediaobjectsTableMap::COL_MOID, $moid['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($moid['max'])) {
                $this->addUsingAlias(MediaobjectsTableMap::COL_MOID, $moid['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(MediaobjectsTableMap::COL_MOID, $moid, $comparison);
    }

    /**
     * Filter the query on the MediaFileName column
     *
     * Example usage:
     * <code>
     * $query->filterByMediafilename('fooValue');   // WHERE MediaFileName = 'fooValue'
     * $query->filterByMediafilename('%fooValue%', Criteria::LIKE); // WHERE MediaFileName LIKE '%fooValue%'
     * </code>
     *
     * @param     string $mediafilename The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildMediaobjectsQuery The current query, for fluid interface
     */
    public function filterByMediafilename($mediafilename = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($mediafilename)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(MediaobjectsTableMap::COL_MEDIAFILENAME, $mediafilename, $comparison);
    }

    /**
     * Filter the query on the MediaTitle column
     *
     * Example usage:
     * <code>
     * $query->filterByMediatitle('fooValue');   // WHERE MediaTitle = 'fooValue'
     * $query->filterByMediatitle('%fooValue%', Criteria::LIKE); // WHERE MediaTitle LIKE '%fooValue%'
     * </code>
     *
     * @param     string $mediatitle The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildMediaobjectsQuery The current query, for fluid interface
     */
    public function filterByMediatitle($mediatitle = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($mediatitle)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(MediaobjectsTableMap::COL_MEDIATITLE, $mediatitle, $comparison);
    }

    /**
     * Filter the query on the MediaDescription column
     *
     * Example usage:
     * <code>
     * $query->filterByMediadescription('fooValue');   // WHERE MediaDescription = 'fooValue'
     * $query->filterByMediadescription('%fooValue%', Criteria::LIKE); // WHERE MediaDescription LIKE '%fooValue%'
     * </code>
     *
     * @param     string $mediadescription The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildMediaobjectsQuery The current query, for fluid interface
     */
    public function filterByMediadescription($mediadescription = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($mediadescription)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(MediaobjectsTableMap::COL_MEDIADESCRIPTION, $mediadescription, $comparison);
    }

    /**
     * Filter the query on the MediaType column
     *
     * Example usage:
     * <code>
     * $query->filterByMediatype('fooValue');   // WHERE MediaType = 'fooValue'
     * $query->filterByMediatype('%fooValue%', Criteria::LIKE); // WHERE MediaType LIKE '%fooValue%'
     * </code>
     *
     * @param     string $mediatype The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildMediaobjectsQuery The current query, for fluid interface
     */
    public function filterByMediatype($mediatype = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($mediatype)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(MediaobjectsTableMap::COL_MEDIATYPE, $mediatype, $comparison);
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
     * @return $this|ChildMediaobjectsQuery The current query, for fluid interface
     */
    public function filterByFkCoid($fkCoid = null, $comparison = null)
    {
        if (is_array($fkCoid)) {
            $useMinMax = false;
            if (isset($fkCoid['min'])) {
                $this->addUsingAlias(MediaobjectsTableMap::COL_FK_COID, $fkCoid['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($fkCoid['max'])) {
                $this->addUsingAlias(MediaobjectsTableMap::COL_FK_COID, $fkCoid['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(MediaobjectsTableMap::COL_FK_COID, $fkCoid, $comparison);
    }

    /**
     * Filter the query by a related \Culturalobjects object
     *
     * @param \Culturalobjects|ObjectCollection $culturalobjects The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildMediaobjectsQuery The current query, for fluid interface
     */
    public function filterByCulturalobjects($culturalobjects, $comparison = null)
    {
        if ($culturalobjects instanceof \Culturalobjects) {
            return $this
                ->addUsingAlias(MediaobjectsTableMap::COL_FK_COID, $culturalobjects->getCoid(), $comparison);
        } elseif ($culturalobjects instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(MediaobjectsTableMap::COL_FK_COID, $culturalobjects->toKeyValue('PrimaryKey', 'Coid'), $comparison);
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
     * @return $this|ChildMediaobjectsQuery The current query, for fluid interface
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
     * @param   ChildMediaobjects $mediaobjects Object to remove from the list of results
     *
     * @return $this|ChildMediaobjectsQuery The current query, for fluid interface
     */
    public function prune($mediaobjects = null)
    {
        if ($mediaobjects) {
            $this->addUsingAlias(MediaobjectsTableMap::COL_MOID, $mediaobjects->getMoid(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the MediaObjects table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(MediaobjectsTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            MediaobjectsTableMap::clearInstancePool();
            MediaobjectsTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(MediaobjectsTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(MediaobjectsTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            MediaobjectsTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            MediaobjectsTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // MediaobjectsQuery
