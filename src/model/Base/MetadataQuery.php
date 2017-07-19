<?php

namespace Base;

use \Metadata as ChildMetadata;
use \MetadataQuery as ChildMetadataQuery;
use \Exception;
use \PDO;
use Map\MetadataTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'metadata' table.
 *
 *
 *
 * @method     ChildMetadataQuery orderByIdmetadata($order = Criteria::ASC) Order by the idmetadata column
 * @method     ChildMetadataQuery orderByIsaccepttermcondition($order = Criteria::ASC) Order by the isAcceptTermCondition column
 * @method     ChildMetadataQuery orderByIsregistergalaxy($order = Criteria::ASC) Order by the isRegisterGalaxy column
 *
 * @method     ChildMetadataQuery groupByIdmetadata() Group by the idmetadata column
 * @method     ChildMetadataQuery groupByIsaccepttermcondition() Group by the isAcceptTermCondition column
 * @method     ChildMetadataQuery groupByIsregistergalaxy() Group by the isRegisterGalaxy column
 *
 * @method     ChildMetadataQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildMetadataQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildMetadataQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildMetadataQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildMetadataQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildMetadataQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildMetadata findOne(ConnectionInterface $con = null) Return the first ChildMetadata matching the query
 * @method     ChildMetadata findOneOrCreate(ConnectionInterface $con = null) Return the first ChildMetadata matching the query, or a new ChildMetadata object populated from the query conditions when no match is found
 *
 * @method     ChildMetadata findOneByIdmetadata(string $idmetadata) Return the first ChildMetadata filtered by the idmetadata column
 * @method     ChildMetadata findOneByIsaccepttermcondition(int $isAcceptTermCondition) Return the first ChildMetadata filtered by the isAcceptTermCondition column
 * @method     ChildMetadata findOneByIsregistergalaxy(int $isRegisterGalaxy) Return the first ChildMetadata filtered by the isRegisterGalaxy column *

 * @method     ChildMetadata requirePk($key, ConnectionInterface $con = null) Return the ChildMetadata by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildMetadata requireOne(ConnectionInterface $con = null) Return the first ChildMetadata matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildMetadata requireOneByIdmetadata(string $idmetadata) Return the first ChildMetadata filtered by the idmetadata column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildMetadata requireOneByIsaccepttermcondition(int $isAcceptTermCondition) Return the first ChildMetadata filtered by the isAcceptTermCondition column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildMetadata requireOneByIsregistergalaxy(int $isRegisterGalaxy) Return the first ChildMetadata filtered by the isRegisterGalaxy column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildMetadata[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildMetadata objects based on current ModelCriteria
 * @method     ChildMetadata[]|ObjectCollection findByIdmetadata(string $idmetadata) Return ChildMetadata objects filtered by the idmetadata column
 * @method     ChildMetadata[]|ObjectCollection findByIsaccepttermcondition(int $isAcceptTermCondition) Return ChildMetadata objects filtered by the isAcceptTermCondition column
 * @method     ChildMetadata[]|ObjectCollection findByIsregistergalaxy(int $isRegisterGalaxy) Return ChildMetadata objects filtered by the isRegisterGalaxy column
 * @method     ChildMetadata[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class MetadataQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\MetadataQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'phenomenal', $modelName = '\\Metadata', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildMetadataQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildMetadataQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildMetadataQuery) {
            return $criteria;
        }
        $query = new ChildMetadataQuery();
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
     * @return ChildMetadata|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(MetadataTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = MetadataTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildMetadata A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT idmetadata, isAcceptTermCondition, isRegisterGalaxy FROM metadata WHERE idmetadata = :p0';
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
            /** @var ChildMetadata $obj */
            $obj = new ChildMetadata();
            $obj->hydrate($row);
            MetadataTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildMetadata|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildMetadataQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(MetadataTableMap::COL_IDMETADATA, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildMetadataQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(MetadataTableMap::COL_IDMETADATA, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the idmetadata column
     *
     * Example usage:
     * <code>
     * $query->filterByIdmetadata('fooValue');   // WHERE idmetadata = 'fooValue'
     * $query->filterByIdmetadata('%fooValue%', Criteria::LIKE); // WHERE idmetadata LIKE '%fooValue%'
     * </code>
     *
     * @param     string $idmetadata The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildMetadataQuery The current query, for fluid interface
     */
    public function filterByIdmetadata($idmetadata = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($idmetadata)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(MetadataTableMap::COL_IDMETADATA, $idmetadata, $comparison);
    }

    /**
     * Filter the query on the isAcceptTermCondition column
     *
     * Example usage:
     * <code>
     * $query->filterByIsaccepttermcondition(1234); // WHERE isAcceptTermCondition = 1234
     * $query->filterByIsaccepttermcondition(array(12, 34)); // WHERE isAcceptTermCondition IN (12, 34)
     * $query->filterByIsaccepttermcondition(array('min' => 12)); // WHERE isAcceptTermCondition > 12
     * </code>
     *
     * @param     mixed $isaccepttermcondition The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildMetadataQuery The current query, for fluid interface
     */
    public function filterByIsaccepttermcondition($isaccepttermcondition = null, $comparison = null)
    {
        if (is_array($isaccepttermcondition)) {
            $useMinMax = false;
            if (isset($isaccepttermcondition['min'])) {
                $this->addUsingAlias(MetadataTableMap::COL_ISACCEPTTERMCONDITION, $isaccepttermcondition['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($isaccepttermcondition['max'])) {
                $this->addUsingAlias(MetadataTableMap::COL_ISACCEPTTERMCONDITION, $isaccepttermcondition['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(MetadataTableMap::COL_ISACCEPTTERMCONDITION, $isaccepttermcondition, $comparison);
    }

    /**
     * Filter the query on the isRegisterGalaxy column
     *
     * Example usage:
     * <code>
     * $query->filterByIsregistergalaxy(1234); // WHERE isRegisterGalaxy = 1234
     * $query->filterByIsregistergalaxy(array(12, 34)); // WHERE isRegisterGalaxy IN (12, 34)
     * $query->filterByIsregistergalaxy(array('min' => 12)); // WHERE isRegisterGalaxy > 12
     * </code>
     *
     * @param     mixed $isregistergalaxy The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildMetadataQuery The current query, for fluid interface
     */
    public function filterByIsregistergalaxy($isregistergalaxy = null, $comparison = null)
    {
        if (is_array($isregistergalaxy)) {
            $useMinMax = false;
            if (isset($isregistergalaxy['min'])) {
                $this->addUsingAlias(MetadataTableMap::COL_ISREGISTERGALAXY, $isregistergalaxy['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($isregistergalaxy['max'])) {
                $this->addUsingAlias(MetadataTableMap::COL_ISREGISTERGALAXY, $isregistergalaxy['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(MetadataTableMap::COL_ISREGISTERGALAXY, $isregistergalaxy, $comparison);
    }

    /**
     * Exclude object from result
     *
     * @param   ChildMetadata $metadata Object to remove from the list of results
     *
     * @return $this|ChildMetadataQuery The current query, for fluid interface
     */
    public function prune($metadata = null)
    {
        if ($metadata) {
            $this->addUsingAlias(MetadataTableMap::COL_IDMETADATA, $metadata->getIdmetadata(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the metadata table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(MetadataTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            MetadataTableMap::clearInstancePool();
            MetadataTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(MetadataTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(MetadataTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            MetadataTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            MetadataTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // MetadataQuery
