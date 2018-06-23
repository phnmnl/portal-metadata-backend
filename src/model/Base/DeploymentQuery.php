<?php

namespace Base;

use \Deployment as ChildDeployment;
use \DeploymentQuery as ChildDeploymentQuery;
use \Exception;
use \PDO;
use Map\DeploymentTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'deployment' table.
 *
 *
 *
 * @method     ChildDeploymentQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildDeploymentQuery orderByUser($order = Criteria::ASC) Order by the user column
 * @method     ChildDeploymentQuery orderByname($order = Criteria::ASC) Order by the name column
 * @method     ChildDeploymentQuery orderByReference($order = Criteria::ASC) Order by the reference column
 * @method     ChildDeploymentQuery orderByProvider($order = Criteria::ASC) Order by the provider column
 * @method     ChildDeploymentQuery orderByCreated($order = Criteria::ASC) Order by the created column
 * @method     ChildDeploymentQuery orderByDeployed($order = Criteria::ASC) Order by the deployed column
 * @method     ChildDeploymentQuery orderByDestroyed($order = Criteria::ASC) Order by the destroyed column
 * @method     ChildDeploymentQuery orderByFailed($order = Criteria::ASC) Order by the failed column
 * @method     ChildDeploymentQuery orderByConfiguration($order = Criteria::ASC) Order by the configuration column
 *
 * @method     ChildDeploymentQuery groupById() Group by the id column
 * @method     ChildDeploymentQuery groupByUser() Group by the user column
 * @method     ChildDeploymentQuery groupByname() Group by the name column
 * @method     ChildDeploymentQuery groupByReference() Group by the reference column
 * @method     ChildDeploymentQuery groupByProvider() Group by the provider column
 * @method     ChildDeploymentQuery groupByCreated() Group by the created column
 * @method     ChildDeploymentQuery groupByDeployed() Group by the deployed column
 * @method     ChildDeploymentQuery groupByDestroyed() Group by the destroyed column
 * @method     ChildDeploymentQuery groupByFailed() Group by the failed column
 * @method     ChildDeploymentQuery groupByConfiguration() Group by the configuration column
 *
 * @method     ChildDeploymentQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildDeploymentQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildDeploymentQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildDeploymentQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildDeploymentQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildDeploymentQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildDeploymentQuery leftJoinDeploymentUser($relationAlias = null) Adds a LEFT JOIN clause to the query using the DeploymentUser relation
 * @method     ChildDeploymentQuery rightJoinDeploymentUser($relationAlias = null) Adds a RIGHT JOIN clause to the query using the DeploymentUser relation
 * @method     ChildDeploymentQuery innerJoinDeploymentUser($relationAlias = null) Adds a INNER JOIN clause to the query using the DeploymentUser relation
 *
 * @method     ChildDeploymentQuery joinWithDeploymentUser($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the DeploymentUser relation
 *
 * @method     ChildDeploymentQuery leftJoinWithDeploymentUser() Adds a LEFT JOIN clause and with to the query using the DeploymentUser relation
 * @method     ChildDeploymentQuery rightJoinWithDeploymentUser() Adds a RIGHT JOIN clause and with to the query using the DeploymentUser relation
 * @method     ChildDeploymentQuery innerJoinWithDeploymentUser() Adds a INNER JOIN clause and with to the query using the DeploymentUser relation
 *
 * @method     \UserQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildDeployment findOne(ConnectionInterface $con = null) Return the first ChildDeployment matching the query
 * @method     ChildDeployment findOneOrCreate(ConnectionInterface $con = null) Return the first ChildDeployment matching the query, or a new ChildDeployment object populated from the query conditions when no match is found
 *
 * @method     ChildDeployment findOneById(int $id) Return the first ChildDeployment filtered by the id column
 * @method     ChildDeployment findOneByUser(string $user) Return the first ChildDeployment filtered by the user column
 * @method     ChildDeployment findOneByname(string $name) Return the first ChildDeployment filtered by the name column
 * @method     ChildDeployment findOneByReference(string $reference) Return the first ChildDeployment filtered by the reference column
 * @method     ChildDeployment findOneByProvider(string $provider) Return the first ChildDeployment filtered by the provider column
 * @method     ChildDeployment findOneByCreated(string $created) Return the first ChildDeployment filtered by the created column
 * @method     ChildDeployment findOneByDeployed(string $deployed) Return the first ChildDeployment filtered by the deployed column
 * @method     ChildDeployment findOneByDestroyed(string $destroyed) Return the first ChildDeployment filtered by the destroyed column
 * @method     ChildDeployment findOneByFailed(string $failed) Return the first ChildDeployment filtered by the failed column
 * @method     ChildDeployment findOneByConfiguration(string $configuration) Return the first ChildDeployment filtered by the configuration column *

 * @method     ChildDeployment requirePk($key, ConnectionInterface $con = null) Return the ChildDeployment by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDeployment requireOne(ConnectionInterface $con = null) Return the first ChildDeployment matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildDeployment requireOneById(int $id) Return the first ChildDeployment filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDeployment requireOneByUser(string $user) Return the first ChildDeployment filtered by the user column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDeployment requireOneByname(string $name) Return the first ChildDeployment filtered by the name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDeployment requireOneByReference(string $reference) Return the first ChildDeployment filtered by the reference column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDeployment requireOneByProvider(string $provider) Return the first ChildDeployment filtered by the provider column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDeployment requireOneByCreated(string $created) Return the first ChildDeployment filtered by the created column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDeployment requireOneByDeployed(string $deployed) Return the first ChildDeployment filtered by the deployed column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDeployment requireOneByDestroyed(string $destroyed) Return the first ChildDeployment filtered by the destroyed column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDeployment requireOneByFailed(string $failed) Return the first ChildDeployment filtered by the failed column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDeployment requireOneByConfiguration(string $configuration) Return the first ChildDeployment filtered by the configuration column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildDeployment[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildDeployment objects based on current ModelCriteria
 * @method     ChildDeployment[]|ObjectCollection findById(int $id) Return ChildDeployment objects filtered by the id column
 * @method     ChildDeployment[]|ObjectCollection findByUser(string $user) Return ChildDeployment objects filtered by the user column
 * @method     ChildDeployment[]|ObjectCollection findByname(string $name) Return ChildDeployment objects filtered by the name column
 * @method     ChildDeployment[]|ObjectCollection findByReference(string $reference) Return ChildDeployment objects filtered by the reference column
 * @method     ChildDeployment[]|ObjectCollection findByProvider(string $provider) Return ChildDeployment objects filtered by the provider column
 * @method     ChildDeployment[]|ObjectCollection findByCreated(string $created) Return ChildDeployment objects filtered by the created column
 * @method     ChildDeployment[]|ObjectCollection findByDeployed(string $deployed) Return ChildDeployment objects filtered by the deployed column
 * @method     ChildDeployment[]|ObjectCollection findByDestroyed(string $destroyed) Return ChildDeployment objects filtered by the destroyed column
 * @method     ChildDeployment[]|ObjectCollection findByFailed(string $failed) Return ChildDeployment objects filtered by the failed column
 * @method     ChildDeployment[]|ObjectCollection findByConfiguration(string $configuration) Return ChildDeployment objects filtered by the configuration column
 * @method     ChildDeployment[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class DeploymentQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\DeploymentQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'phenomenal', $modelName = '\\Deployment', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildDeploymentQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildDeploymentQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildDeploymentQuery) {
            return $criteria;
        }
        $query = new ChildDeploymentQuery();
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
     * @return ChildDeployment|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(DeploymentTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = DeploymentTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildDeployment A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, user, name, reference, provider, created, deployed, destroyed, failed, configuration FROM deployment WHERE id = :p0';
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
            /** @var ChildDeployment $obj */
            $obj = new ChildDeployment();
            $obj->hydrate($row);
            DeploymentTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildDeployment|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildDeploymentQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(DeploymentTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildDeploymentQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(DeploymentTableMap::COL_ID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the id column
     *
     * Example usage:
     * <code>
     * $query->filterById(1234); // WHERE id = 1234
     * $query->filterById(array(12, 34)); // WHERE id IN (12, 34)
     * $query->filterById(array('min' => 12)); // WHERE id > 12
     * </code>
     *
     * @param     mixed $id The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildDeploymentQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(DeploymentTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(DeploymentTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(DeploymentTableMap::COL_ID, $id, $comparison);
    }

    /**
     * Filter the query on the user column
     *
     * Example usage:
     * <code>
     * $query->filterByUser('fooValue');   // WHERE user = 'fooValue'
     * $query->filterByUser('%fooValue%', Criteria::LIKE); // WHERE user LIKE '%fooValue%'
     * </code>
     *
     * @param     string $user The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildDeploymentQuery The current query, for fluid interface
     */
    public function filterByUser($user = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($user)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(DeploymentTableMap::COL_USER, $user, $comparison);
    }

    /**
     * Filter the query on the name column
     *
     * Example usage:
     * <code>
     * $query->filterByname('fooValue');   // WHERE name = 'fooValue'
     * $query->filterByname('%fooValue%', Criteria::LIKE); // WHERE name LIKE '%fooValue%'
     * </code>
     *
     * @param     string $name The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildDeploymentQuery The current query, for fluid interface
     */
    public function filterByname($name = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($name)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(DeploymentTableMap::COL_NAME, $name, $comparison);
    }

    /**
     * Filter the query on the reference column
     *
     * Example usage:
     * <code>
     * $query->filterByReference('fooValue');   // WHERE reference = 'fooValue'
     * $query->filterByReference('%fooValue%', Criteria::LIKE); // WHERE reference LIKE '%fooValue%'
     * </code>
     *
     * @param     string $reference The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildDeploymentQuery The current query, for fluid interface
     */
    public function filterByReference($reference = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($reference)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(DeploymentTableMap::COL_REFERENCE, $reference, $comparison);
    }

    /**
     * Filter the query on the provider column
     *
     * Example usage:
     * <code>
     * $query->filterByProvider('fooValue');   // WHERE provider = 'fooValue'
     * $query->filterByProvider('%fooValue%', Criteria::LIKE); // WHERE provider LIKE '%fooValue%'
     * </code>
     *
     * @param     string $provider The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildDeploymentQuery The current query, for fluid interface
     */
    public function filterByProvider($provider = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($provider)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(DeploymentTableMap::COL_PROVIDER, $provider, $comparison);
    }

    /**
     * Filter the query on the created column
     *
     * Example usage:
     * <code>
     * $query->filterByCreated('2011-03-14'); // WHERE created = '2011-03-14'
     * $query->filterByCreated('now'); // WHERE created = '2011-03-14'
     * $query->filterByCreated(array('max' => 'yesterday')); // WHERE created > '2011-03-13'
     * </code>
     *
     * @param     mixed $created The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildDeploymentQuery The current query, for fluid interface
     */
    public function filterByCreated($created = null, $comparison = null)
    {
        if (is_array($created)) {
            $useMinMax = false;
            if (isset($created['min'])) {
                $this->addUsingAlias(DeploymentTableMap::COL_CREATED, $created['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($created['max'])) {
                $this->addUsingAlias(DeploymentTableMap::COL_CREATED, $created['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(DeploymentTableMap::COL_CREATED, $created, $comparison);
    }

    /**
     * Filter the query on the deployed column
     *
     * Example usage:
     * <code>
     * $query->filterByDeployed('2011-03-14'); // WHERE deployed = '2011-03-14'
     * $query->filterByDeployed('now'); // WHERE deployed = '2011-03-14'
     * $query->filterByDeployed(array('max' => 'yesterday')); // WHERE deployed > '2011-03-13'
     * </code>
     *
     * @param     mixed $deployed The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildDeploymentQuery The current query, for fluid interface
     */
    public function filterByDeployed($deployed = null, $comparison = null)
    {
        if (is_array($deployed)) {
            $useMinMax = false;
            if (isset($deployed['min'])) {
                $this->addUsingAlias(DeploymentTableMap::COL_DEPLOYED, $deployed['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($deployed['max'])) {
                $this->addUsingAlias(DeploymentTableMap::COL_DEPLOYED, $deployed['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(DeploymentTableMap::COL_DEPLOYED, $deployed, $comparison);
    }

    /**
     * Filter the query on the destroyed column
     *
     * Example usage:
     * <code>
     * $query->filterByDestroyed('2011-03-14'); // WHERE destroyed = '2011-03-14'
     * $query->filterByDestroyed('now'); // WHERE destroyed = '2011-03-14'
     * $query->filterByDestroyed(array('max' => 'yesterday')); // WHERE destroyed > '2011-03-13'
     * </code>
     *
     * @param     mixed $destroyed The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildDeploymentQuery The current query, for fluid interface
     */
    public function filterByDestroyed($destroyed = null, $comparison = null)
    {
        if (is_array($destroyed)) {
            $useMinMax = false;
            if (isset($destroyed['min'])) {
                $this->addUsingAlias(DeploymentTableMap::COL_DESTROYED, $destroyed['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($destroyed['max'])) {
                $this->addUsingAlias(DeploymentTableMap::COL_DESTROYED, $destroyed['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(DeploymentTableMap::COL_DESTROYED, $destroyed, $comparison);
    }

    /**
     * Filter the query on the failed column
     *
     * Example usage:
     * <code>
     * $query->filterByFailed('2011-03-14'); // WHERE failed = '2011-03-14'
     * $query->filterByFailed('now'); // WHERE failed = '2011-03-14'
     * $query->filterByFailed(array('max' => 'yesterday')); // WHERE failed > '2011-03-13'
     * </code>
     *
     * @param     mixed $failed The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildDeploymentQuery The current query, for fluid interface
     */
    public function filterByFailed($failed = null, $comparison = null)
    {
        if (is_array($failed)) {
            $useMinMax = false;
            if (isset($failed['min'])) {
                $this->addUsingAlias(DeploymentTableMap::COL_FAILED, $failed['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($failed['max'])) {
                $this->addUsingAlias(DeploymentTableMap::COL_FAILED, $failed['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(DeploymentTableMap::COL_FAILED, $failed, $comparison);
    }

    /**
     * Filter the query on the configuration column
     *
     * Example usage:
     * <code>
     * $query->filterByConfiguration('fooValue');   // WHERE configuration = 'fooValue'
     * $query->filterByConfiguration('%fooValue%', Criteria::LIKE); // WHERE configuration LIKE '%fooValue%'
     * </code>
     *
     * @param     string $configuration The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildDeploymentQuery The current query, for fluid interface
     */
    public function filterByConfiguration($configuration = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($configuration)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(DeploymentTableMap::COL_CONFIGURATION, $configuration, $comparison);
    }

    /**
     * Filter the query by a related \User object
     *
     * @param \User|ObjectCollection $user The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildDeploymentQuery The current query, for fluid interface
     */
    public function filterByDeploymentUser($user, $comparison = null)
    {
        if ($user instanceof \User) {
            return $this
                ->addUsingAlias(DeploymentTableMap::COL_USER, $user->getId(), $comparison);
        } elseif ($user instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(DeploymentTableMap::COL_USER, $user->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByDeploymentUser() only accepts arguments of type \User or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the DeploymentUser relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildDeploymentQuery The current query, for fluid interface
     */
    public function joinDeploymentUser($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('DeploymentUser');

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
            $this->addJoinObject($join, 'DeploymentUser');
        }

        return $this;
    }

    /**
     * Use the DeploymentUser relation User object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \UserQuery A secondary query class using the current class as primary query
     */
    public function useDeploymentUserQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinDeploymentUser($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'DeploymentUser', '\UserQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildDeployment $deployment Object to remove from the list of results
     *
     * @return $this|ChildDeploymentQuery The current query, for fluid interface
     */
    public function prune($deployment = null)
    {
        if ($deployment) {
            $this->addUsingAlias(DeploymentTableMap::COL_ID, $deployment->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the deployment table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(DeploymentTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            DeploymentTableMap::clearInstancePool();
            DeploymentTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(DeploymentTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(DeploymentTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            DeploymentTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            DeploymentTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // DeploymentQuery
