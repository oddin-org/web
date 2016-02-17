<?php

namespace BossEdu\Model\Base;

use \Exception;
use \PDO;
use BossEdu\Model\Contribution as ChildContribution;
use BossEdu\Model\ContributionQuery as ChildContributionQuery;
use BossEdu\Model\Map\ContributionTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'contribution' table.
 *
 * 
 *
 * @method     ChildContributionQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildContributionQuery orderByStatus($order = Criteria::ASC) Order by the status column
 * @method     ChildContributionQuery orderByText($order = Criteria::ASC) Order by the text column
 * @method     ChildContributionQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method     ChildContributionQuery orderByAnonymous($order = Criteria::ASC) Order by the anonymous column
 * @method     ChildContributionQuery orderByDoubtId($order = Criteria::ASC) Order by the doubt_id column
 * @method     ChildContributionQuery orderByPersonId($order = Criteria::ASC) Order by the person_id column
 *
 * @method     ChildContributionQuery groupById() Group by the id column
 * @method     ChildContributionQuery groupByStatus() Group by the status column
 * @method     ChildContributionQuery groupByText() Group by the text column
 * @method     ChildContributionQuery groupByCreatedAt() Group by the created_at column
 * @method     ChildContributionQuery groupByAnonymous() Group by the anonymous column
 * @method     ChildContributionQuery groupByDoubtId() Group by the doubt_id column
 * @method     ChildContributionQuery groupByPersonId() Group by the person_id column
 *
 * @method     ChildContributionQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildContributionQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildContributionQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildContributionQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildContributionQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildContributionQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildContributionQuery leftJoinDoubt($relationAlias = null) Adds a LEFT JOIN clause to the query using the Doubt relation
 * @method     ChildContributionQuery rightJoinDoubt($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Doubt relation
 * @method     ChildContributionQuery innerJoinDoubt($relationAlias = null) Adds a INNER JOIN clause to the query using the Doubt relation
 *
 * @method     ChildContributionQuery joinWithDoubt($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Doubt relation
 *
 * @method     ChildContributionQuery leftJoinWithDoubt() Adds a LEFT JOIN clause and with to the query using the Doubt relation
 * @method     ChildContributionQuery rightJoinWithDoubt() Adds a RIGHT JOIN clause and with to the query using the Doubt relation
 * @method     ChildContributionQuery innerJoinWithDoubt() Adds a INNER JOIN clause and with to the query using the Doubt relation
 *
 * @method     ChildContributionQuery leftJoinPerson($relationAlias = null) Adds a LEFT JOIN clause to the query using the Person relation
 * @method     ChildContributionQuery rightJoinPerson($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Person relation
 * @method     ChildContributionQuery innerJoinPerson($relationAlias = null) Adds a INNER JOIN clause to the query using the Person relation
 *
 * @method     ChildContributionQuery joinWithPerson($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Person relation
 *
 * @method     ChildContributionQuery leftJoinWithPerson() Adds a LEFT JOIN clause and with to the query using the Person relation
 * @method     ChildContributionQuery rightJoinWithPerson() Adds a RIGHT JOIN clause and with to the query using the Person relation
 * @method     ChildContributionQuery innerJoinWithPerson() Adds a INNER JOIN clause and with to the query using the Person relation
 *
 * @method     ChildContributionQuery leftJoinMcMaterial($relationAlias = null) Adds a LEFT JOIN clause to the query using the McMaterial relation
 * @method     ChildContributionQuery rightJoinMcMaterial($relationAlias = null) Adds a RIGHT JOIN clause to the query using the McMaterial relation
 * @method     ChildContributionQuery innerJoinMcMaterial($relationAlias = null) Adds a INNER JOIN clause to the query using the McMaterial relation
 *
 * @method     ChildContributionQuery joinWithMcMaterial($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the McMaterial relation
 *
 * @method     ChildContributionQuery leftJoinWithMcMaterial() Adds a LEFT JOIN clause and with to the query using the McMaterial relation
 * @method     ChildContributionQuery rightJoinWithMcMaterial() Adds a RIGHT JOIN clause and with to the query using the McMaterial relation
 * @method     ChildContributionQuery innerJoinWithMcMaterial() Adds a INNER JOIN clause and with to the query using the McMaterial relation
 *
 * @method     \BossEdu\Model\DoubtQuery|\BossEdu\Model\PersonQuery|\BossEdu\Model\McMaterialQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildContribution findOne(ConnectionInterface $con = null) Return the first ChildContribution matching the query
 * @method     ChildContribution findOneOrCreate(ConnectionInterface $con = null) Return the first ChildContribution matching the query, or a new ChildContribution object populated from the query conditions when no match is found
 *
 * @method     ChildContribution findOneById(int $id) Return the first ChildContribution filtered by the id column
 * @method     ChildContribution findOneByStatus(int $status) Return the first ChildContribution filtered by the status column
 * @method     ChildContribution findOneByText(string $text) Return the first ChildContribution filtered by the text column
 * @method     ChildContribution findOneByCreatedAt(string $created_at) Return the first ChildContribution filtered by the created_at column
 * @method     ChildContribution findOneByAnonymous(boolean $anonymous) Return the first ChildContribution filtered by the anonymous column
 * @method     ChildContribution findOneByDoubtId(int $doubt_id) Return the first ChildContribution filtered by the doubt_id column
 * @method     ChildContribution findOneByPersonId(int $person_id) Return the first ChildContribution filtered by the person_id column *

 * @method     ChildContribution requirePk($key, ConnectionInterface $con = null) Return the ChildContribution by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildContribution requireOne(ConnectionInterface $con = null) Return the first ChildContribution matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildContribution requireOneById(int $id) Return the first ChildContribution filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildContribution requireOneByStatus(int $status) Return the first ChildContribution filtered by the status column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildContribution requireOneByText(string $text) Return the first ChildContribution filtered by the text column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildContribution requireOneByCreatedAt(string $created_at) Return the first ChildContribution filtered by the created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildContribution requireOneByAnonymous(boolean $anonymous) Return the first ChildContribution filtered by the anonymous column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildContribution requireOneByDoubtId(int $doubt_id) Return the first ChildContribution filtered by the doubt_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildContribution requireOneByPersonId(int $person_id) Return the first ChildContribution filtered by the person_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildContribution[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildContribution objects based on current ModelCriteria
 * @method     ChildContribution[]|ObjectCollection findById(int $id) Return ChildContribution objects filtered by the id column
 * @method     ChildContribution[]|ObjectCollection findByStatus(int $status) Return ChildContribution objects filtered by the status column
 * @method     ChildContribution[]|ObjectCollection findByText(string $text) Return ChildContribution objects filtered by the text column
 * @method     ChildContribution[]|ObjectCollection findByCreatedAt(string $created_at) Return ChildContribution objects filtered by the created_at column
 * @method     ChildContribution[]|ObjectCollection findByAnonymous(boolean $anonymous) Return ChildContribution objects filtered by the anonymous column
 * @method     ChildContribution[]|ObjectCollection findByDoubtId(int $doubt_id) Return ChildContribution objects filtered by the doubt_id column
 * @method     ChildContribution[]|ObjectCollection findByPersonId(int $person_id) Return ChildContribution objects filtered by the person_id column
 * @method     ChildContribution[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class ContributionQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \BossEdu\Model\Base\ContributionQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\BossEdu\\Model\\Contribution', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildContributionQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildContributionQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildContributionQuery) {
            return $criteria;
        }
        $query = new ChildContributionQuery();
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
     * @return ChildContribution|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = ContributionTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(ContributionTableMap::DATABASE_NAME);
        }
        $this->basePreSelect($con);
        if ($this->formatter || $this->modelAlias || $this->with || $this->select
         || $this->selectColumns || $this->asColumns || $this->selectModifiers
         || $this->map || $this->having || $this->joins) {
            return $this->findPkComplex($key, $con);
        } else {
            return $this->findPkSimple($key, $con);
        }
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
     * @return ChildContribution A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, status, text, created_at, anonymous, doubt_id, person_id FROM contribution WHERE id = :p0';
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
            /** @var ChildContribution $obj */
            $obj = new ChildContribution();
            $obj->hydrate($row);
            ContributionTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildContribution|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildContributionQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(ContributionTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildContributionQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(ContributionTableMap::COL_ID, $keys, Criteria::IN);
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
     * @return $this|ChildContributionQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(ContributionTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(ContributionTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ContributionTableMap::COL_ID, $id, $comparison);
    }

    /**
     * Filter the query on the status column
     *
     * Example usage:
     * <code>
     * $query->filterByStatus(1234); // WHERE status = 1234
     * $query->filterByStatus(array(12, 34)); // WHERE status IN (12, 34)
     * $query->filterByStatus(array('min' => 12)); // WHERE status > 12
     * </code>
     *
     * @param     mixed $status The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildContributionQuery The current query, for fluid interface
     */
    public function filterByStatus($status = null, $comparison = null)
    {
        if (is_array($status)) {
            $useMinMax = false;
            if (isset($status['min'])) {
                $this->addUsingAlias(ContributionTableMap::COL_STATUS, $status['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($status['max'])) {
                $this->addUsingAlias(ContributionTableMap::COL_STATUS, $status['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ContributionTableMap::COL_STATUS, $status, $comparison);
    }

    /**
     * Filter the query on the text column
     *
     * Example usage:
     * <code>
     * $query->filterByText('fooValue');   // WHERE text = 'fooValue'
     * $query->filterByText('%fooValue%'); // WHERE text LIKE '%fooValue%'
     * </code>
     *
     * @param     string $text The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildContributionQuery The current query, for fluid interface
     */
    public function filterByText($text = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($text)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $text)) {
                $text = str_replace('*', '%', $text);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ContributionTableMap::COL_TEXT, $text, $comparison);
    }

    /**
     * Filter the query on the created_at column
     *
     * Example usage:
     * <code>
     * $query->filterByCreatedAt('2011-03-14'); // WHERE created_at = '2011-03-14'
     * $query->filterByCreatedAt('now'); // WHERE created_at = '2011-03-14'
     * $query->filterByCreatedAt(array('max' => 'yesterday')); // WHERE created_at > '2011-03-13'
     * </code>
     *
     * @param     mixed $createdAt The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildContributionQuery The current query, for fluid interface
     */
    public function filterByCreatedAt($createdAt = null, $comparison = null)
    {
        if (is_array($createdAt)) {
            $useMinMax = false;
            if (isset($createdAt['min'])) {
                $this->addUsingAlias(ContributionTableMap::COL_CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(ContributionTableMap::COL_CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ContributionTableMap::COL_CREATED_AT, $createdAt, $comparison);
    }

    /**
     * Filter the query on the anonymous column
     *
     * Example usage:
     * <code>
     * $query->filterByAnonymous(true); // WHERE anonymous = true
     * $query->filterByAnonymous('yes'); // WHERE anonymous = true
     * </code>
     *
     * @param     boolean|string $anonymous The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildContributionQuery The current query, for fluid interface
     */
    public function filterByAnonymous($anonymous = null, $comparison = null)
    {
        if (is_string($anonymous)) {
            $anonymous = in_array(strtolower($anonymous), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(ContributionTableMap::COL_ANONYMOUS, $anonymous, $comparison);
    }

    /**
     * Filter the query on the doubt_id column
     *
     * Example usage:
     * <code>
     * $query->filterByDoubtId(1234); // WHERE doubt_id = 1234
     * $query->filterByDoubtId(array(12, 34)); // WHERE doubt_id IN (12, 34)
     * $query->filterByDoubtId(array('min' => 12)); // WHERE doubt_id > 12
     * </code>
     *
     * @see       filterByDoubt()
     *
     * @param     mixed $doubtId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildContributionQuery The current query, for fluid interface
     */
    public function filterByDoubtId($doubtId = null, $comparison = null)
    {
        if (is_array($doubtId)) {
            $useMinMax = false;
            if (isset($doubtId['min'])) {
                $this->addUsingAlias(ContributionTableMap::COL_DOUBT_ID, $doubtId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($doubtId['max'])) {
                $this->addUsingAlias(ContributionTableMap::COL_DOUBT_ID, $doubtId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ContributionTableMap::COL_DOUBT_ID, $doubtId, $comparison);
    }

    /**
     * Filter the query on the person_id column
     *
     * Example usage:
     * <code>
     * $query->filterByPersonId(1234); // WHERE person_id = 1234
     * $query->filterByPersonId(array(12, 34)); // WHERE person_id IN (12, 34)
     * $query->filterByPersonId(array('min' => 12)); // WHERE person_id > 12
     * </code>
     *
     * @see       filterByPerson()
     *
     * @param     mixed $personId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildContributionQuery The current query, for fluid interface
     */
    public function filterByPersonId($personId = null, $comparison = null)
    {
        if (is_array($personId)) {
            $useMinMax = false;
            if (isset($personId['min'])) {
                $this->addUsingAlias(ContributionTableMap::COL_PERSON_ID, $personId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($personId['max'])) {
                $this->addUsingAlias(ContributionTableMap::COL_PERSON_ID, $personId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ContributionTableMap::COL_PERSON_ID, $personId, $comparison);
    }

    /**
     * Filter the query by a related \BossEdu\Model\Doubt object
     *
     * @param \BossEdu\Model\Doubt|ObjectCollection $doubt The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildContributionQuery The current query, for fluid interface
     */
    public function filterByDoubt($doubt, $comparison = null)
    {
        if ($doubt instanceof \BossEdu\Model\Doubt) {
            return $this
                ->addUsingAlias(ContributionTableMap::COL_DOUBT_ID, $doubt->getId(), $comparison);
        } elseif ($doubt instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(ContributionTableMap::COL_DOUBT_ID, $doubt->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByDoubt() only accepts arguments of type \BossEdu\Model\Doubt or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Doubt relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildContributionQuery The current query, for fluid interface
     */
    public function joinDoubt($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Doubt');

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
            $this->addJoinObject($join, 'Doubt');
        }

        return $this;
    }

    /**
     * Use the Doubt relation Doubt object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \BossEdu\Model\DoubtQuery A secondary query class using the current class as primary query
     */
    public function useDoubtQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinDoubt($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Doubt', '\BossEdu\Model\DoubtQuery');
    }

    /**
     * Filter the query by a related \BossEdu\Model\Person object
     *
     * @param \BossEdu\Model\Person|ObjectCollection $person The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildContributionQuery The current query, for fluid interface
     */
    public function filterByPerson($person, $comparison = null)
    {
        if ($person instanceof \BossEdu\Model\Person) {
            return $this
                ->addUsingAlias(ContributionTableMap::COL_PERSON_ID, $person->getId(), $comparison);
        } elseif ($person instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(ContributionTableMap::COL_PERSON_ID, $person->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByPerson() only accepts arguments of type \BossEdu\Model\Person or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Person relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildContributionQuery The current query, for fluid interface
     */
    public function joinPerson($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Person');

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
            $this->addJoinObject($join, 'Person');
        }

        return $this;
    }

    /**
     * Use the Person relation Person object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \BossEdu\Model\PersonQuery A secondary query class using the current class as primary query
     */
    public function usePersonQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinPerson($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Person', '\BossEdu\Model\PersonQuery');
    }

    /**
     * Filter the query by a related \BossEdu\Model\McMaterial object
     *
     * @param \BossEdu\Model\McMaterial|ObjectCollection $mcMaterial the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildContributionQuery The current query, for fluid interface
     */
    public function filterByMcMaterial($mcMaterial, $comparison = null)
    {
        if ($mcMaterial instanceof \BossEdu\Model\McMaterial) {
            return $this
                ->addUsingAlias(ContributionTableMap::COL_ID, $mcMaterial->getContributionId(), $comparison);
        } elseif ($mcMaterial instanceof ObjectCollection) {
            return $this
                ->useMcMaterialQuery()
                ->filterByPrimaryKeys($mcMaterial->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByMcMaterial() only accepts arguments of type \BossEdu\Model\McMaterial or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the McMaterial relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildContributionQuery The current query, for fluid interface
     */
    public function joinMcMaterial($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('McMaterial');

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
            $this->addJoinObject($join, 'McMaterial');
        }

        return $this;
    }

    /**
     * Use the McMaterial relation McMaterial object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \BossEdu\Model\McMaterialQuery A secondary query class using the current class as primary query
     */
    public function useMcMaterialQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinMcMaterial($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'McMaterial', '\BossEdu\Model\McMaterialQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildContribution $contribution Object to remove from the list of results
     *
     * @return $this|ChildContributionQuery The current query, for fluid interface
     */
    public function prune($contribution = null)
    {
        if ($contribution) {
            $this->addUsingAlias(ContributionTableMap::COL_ID, $contribution->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the contribution table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(ContributionTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            ContributionTableMap::clearInstancePool();
            ContributionTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(ContributionTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(ContributionTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            
            ContributionTableMap::removeInstanceFromPool($criteria);
        
            $affectedRows += ModelCriteria::delete($con);
            ContributionTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // ContributionQuery
