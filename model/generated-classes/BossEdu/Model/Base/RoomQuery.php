<?php

namespace BossEdu\Model\Base;

use \Exception;
use \PDO;
use BossEdu\Model\Room as ChildRoom;
use BossEdu\Model\RoomQuery as ChildRoomQuery;
use BossEdu\Model\Map\RoomTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'room' table.
 *
 * 
 *
 * @method     ChildRoomQuery orderByBuildingCode($order = Criteria::ASC) Order by the building_code column
 * @method     ChildRoomQuery orderByNumber($order = Criteria::ASC) Order by the number column
 * @method     ChildRoomQuery orderByType($order = Criteria::ASC) Order by the type column
 * @method     ChildRoomQuery orderByCapacity($order = Criteria::ASC) Order by the capacity column
 *
 * @method     ChildRoomQuery groupByBuildingCode() Group by the building_code column
 * @method     ChildRoomQuery groupByNumber() Group by the number column
 * @method     ChildRoomQuery groupByType() Group by the type column
 * @method     ChildRoomQuery groupByCapacity() Group by the capacity column
 *
 * @method     ChildRoomQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildRoomQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildRoomQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildRoomQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildRoomQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildRoomQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildRoomQuery leftJoinBuilding($relationAlias = null) Adds a LEFT JOIN clause to the query using the Building relation
 * @method     ChildRoomQuery rightJoinBuilding($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Building relation
 * @method     ChildRoomQuery innerJoinBuilding($relationAlias = null) Adds a INNER JOIN clause to the query using the Building relation
 *
 * @method     ChildRoomQuery joinWithBuilding($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Building relation
 *
 * @method     ChildRoomQuery leftJoinWithBuilding() Adds a LEFT JOIN clause and with to the query using the Building relation
 * @method     ChildRoomQuery rightJoinWithBuilding() Adds a RIGHT JOIN clause and with to the query using the Building relation
 * @method     ChildRoomQuery innerJoinWithBuilding() Adds a INNER JOIN clause and with to the query using the Building relation
 *
 * @method     ChildRoomQuery leftJoinRsAvailable($relationAlias = null) Adds a LEFT JOIN clause to the query using the RsAvailable relation
 * @method     ChildRoomQuery rightJoinRsAvailable($relationAlias = null) Adds a RIGHT JOIN clause to the query using the RsAvailable relation
 * @method     ChildRoomQuery innerJoinRsAvailable($relationAlias = null) Adds a INNER JOIN clause to the query using the RsAvailable relation
 *
 * @method     ChildRoomQuery joinWithRsAvailable($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the RsAvailable relation
 *
 * @method     ChildRoomQuery leftJoinWithRsAvailable() Adds a LEFT JOIN clause and with to the query using the RsAvailable relation
 * @method     ChildRoomQuery rightJoinWithRsAvailable() Adds a RIGHT JOIN clause and with to the query using the RsAvailable relation
 * @method     ChildRoomQuery innerJoinWithRsAvailable() Adds a INNER JOIN clause and with to the query using the RsAvailable relation
 *
 * @method     \BossEdu\Model\BuildingQuery|\BossEdu\Model\RsAvailableQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildRoom findOne(ConnectionInterface $con = null) Return the first ChildRoom matching the query
 * @method     ChildRoom findOneOrCreate(ConnectionInterface $con = null) Return the first ChildRoom matching the query, or a new ChildRoom object populated from the query conditions when no match is found
 *
 * @method     ChildRoom findOneByBuildingCode(string $building_code) Return the first ChildRoom filtered by the building_code column
 * @method     ChildRoom findOneByNumber(int $number) Return the first ChildRoom filtered by the number column
 * @method     ChildRoom findOneByType(string $type) Return the first ChildRoom filtered by the type column
 * @method     ChildRoom findOneByCapacity(int $capacity) Return the first ChildRoom filtered by the capacity column *

 * @method     ChildRoom requirePk($key, ConnectionInterface $con = null) Return the ChildRoom by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildRoom requireOne(ConnectionInterface $con = null) Return the first ChildRoom matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildRoom requireOneByBuildingCode(string $building_code) Return the first ChildRoom filtered by the building_code column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildRoom requireOneByNumber(int $number) Return the first ChildRoom filtered by the number column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildRoom requireOneByType(string $type) Return the first ChildRoom filtered by the type column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildRoom requireOneByCapacity(int $capacity) Return the first ChildRoom filtered by the capacity column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildRoom[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildRoom objects based on current ModelCriteria
 * @method     ChildRoom[]|ObjectCollection findByBuildingCode(string $building_code) Return ChildRoom objects filtered by the building_code column
 * @method     ChildRoom[]|ObjectCollection findByNumber(int $number) Return ChildRoom objects filtered by the number column
 * @method     ChildRoom[]|ObjectCollection findByType(string $type) Return ChildRoom objects filtered by the type column
 * @method     ChildRoom[]|ObjectCollection findByCapacity(int $capacity) Return ChildRoom objects filtered by the capacity column
 * @method     ChildRoom[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class RoomQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \BossEdu\Model\Base\RoomQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\BossEdu\\Model\\Room', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildRoomQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildRoomQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildRoomQuery) {
            return $criteria;
        }
        $query = new ChildRoomQuery();
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
     * $obj = $c->findPk(array(12, 34), $con);
     * </code>
     *
     * @param array[$building_code, $number] $key Primary key to use for the query
     * @param ConnectionInterface $con an optional connection object
     *
     * @return ChildRoom|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = RoomTableMap::getInstanceFromPool(serialize([(null === $key[0] || is_scalar($key[0]) || is_callable([$key[0], '__toString']) ? (string) $key[0] : $key[0]), (null === $key[1] || is_scalar($key[1]) || is_callable([$key[1], '__toString']) ? (string) $key[1] : $key[1])])))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(RoomTableMap::DATABASE_NAME);
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
     * @return ChildRoom A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT building_code, number, type, capacity FROM room WHERE building_code = :p0 AND number = :p1';
        try {
            $stmt = $con->prepare($sql);            
            $stmt->bindValue(':p0', $key[0], PDO::PARAM_STR);            
            $stmt->bindValue(':p1', $key[1], PDO::PARAM_INT);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), 0, $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(\PDO::FETCH_NUM)) {
            /** @var ChildRoom $obj */
            $obj = new ChildRoom();
            $obj->hydrate($row);
            RoomTableMap::addInstanceToPool($obj, serialize([(null === $key[0] || is_scalar($key[0]) || is_callable([$key[0], '__toString']) ? (string) $key[0] : $key[0]), (null === $key[1] || is_scalar($key[1]) || is_callable([$key[1], '__toString']) ? (string) $key[1] : $key[1])]));
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
     * @return ChildRoom|array|mixed the result, formatted by the current formatter
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
     * $objs = $c->findPks(array(array(12, 56), array(832, 123), array(123, 456)), $con);
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
     * @return $this|ChildRoomQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {
        $this->addUsingAlias(RoomTableMap::COL_BUILDING_CODE, $key[0], Criteria::EQUAL);
        $this->addUsingAlias(RoomTableMap::COL_NUMBER, $key[1], Criteria::EQUAL);

        return $this;
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildRoomQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {
        if (empty($keys)) {
            return $this->add(null, '1<>1', Criteria::CUSTOM);
        }
        foreach ($keys as $key) {
            $cton0 = $this->getNewCriterion(RoomTableMap::COL_BUILDING_CODE, $key[0], Criteria::EQUAL);
            $cton1 = $this->getNewCriterion(RoomTableMap::COL_NUMBER, $key[1], Criteria::EQUAL);
            $cton0->addAnd($cton1);
            $this->addOr($cton0);
        }

        return $this;
    }

    /**
     * Filter the query on the building_code column
     *
     * Example usage:
     * <code>
     * $query->filterByBuildingCode('fooValue');   // WHERE building_code = 'fooValue'
     * $query->filterByBuildingCode('%fooValue%'); // WHERE building_code LIKE '%fooValue%'
     * </code>
     *
     * @param     string $buildingCode The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildRoomQuery The current query, for fluid interface
     */
    public function filterByBuildingCode($buildingCode = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($buildingCode)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $buildingCode)) {
                $buildingCode = str_replace('*', '%', $buildingCode);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(RoomTableMap::COL_BUILDING_CODE, $buildingCode, $comparison);
    }

    /**
     * Filter the query on the number column
     *
     * Example usage:
     * <code>
     * $query->filterByNumber(1234); // WHERE number = 1234
     * $query->filterByNumber(array(12, 34)); // WHERE number IN (12, 34)
     * $query->filterByNumber(array('min' => 12)); // WHERE number > 12
     * </code>
     *
     * @param     mixed $number The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildRoomQuery The current query, for fluid interface
     */
    public function filterByNumber($number = null, $comparison = null)
    {
        if (is_array($number)) {
            $useMinMax = false;
            if (isset($number['min'])) {
                $this->addUsingAlias(RoomTableMap::COL_NUMBER, $number['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($number['max'])) {
                $this->addUsingAlias(RoomTableMap::COL_NUMBER, $number['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(RoomTableMap::COL_NUMBER, $number, $comparison);
    }

    /**
     * Filter the query on the type column
     *
     * Example usage:
     * <code>
     * $query->filterByType('fooValue');   // WHERE type = 'fooValue'
     * $query->filterByType('%fooValue%'); // WHERE type LIKE '%fooValue%'
     * </code>
     *
     * @param     string $type The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildRoomQuery The current query, for fluid interface
     */
    public function filterByType($type = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($type)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $type)) {
                $type = str_replace('*', '%', $type);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(RoomTableMap::COL_TYPE, $type, $comparison);
    }

    /**
     * Filter the query on the capacity column
     *
     * Example usage:
     * <code>
     * $query->filterByCapacity(1234); // WHERE capacity = 1234
     * $query->filterByCapacity(array(12, 34)); // WHERE capacity IN (12, 34)
     * $query->filterByCapacity(array('min' => 12)); // WHERE capacity > 12
     * </code>
     *
     * @param     mixed $capacity The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildRoomQuery The current query, for fluid interface
     */
    public function filterByCapacity($capacity = null, $comparison = null)
    {
        if (is_array($capacity)) {
            $useMinMax = false;
            if (isset($capacity['min'])) {
                $this->addUsingAlias(RoomTableMap::COL_CAPACITY, $capacity['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($capacity['max'])) {
                $this->addUsingAlias(RoomTableMap::COL_CAPACITY, $capacity['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(RoomTableMap::COL_CAPACITY, $capacity, $comparison);
    }

    /**
     * Filter the query by a related \BossEdu\Model\Building object
     *
     * @param \BossEdu\Model\Building|ObjectCollection $building The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildRoomQuery The current query, for fluid interface
     */
    public function filterByBuilding($building, $comparison = null)
    {
        if ($building instanceof \BossEdu\Model\Building) {
            return $this
                ->addUsingAlias(RoomTableMap::COL_BUILDING_CODE, $building->getCode(), $comparison);
        } elseif ($building instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(RoomTableMap::COL_BUILDING_CODE, $building->toKeyValue('PrimaryKey', 'Code'), $comparison);
        } else {
            throw new PropelException('filterByBuilding() only accepts arguments of type \BossEdu\Model\Building or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Building relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildRoomQuery The current query, for fluid interface
     */
    public function joinBuilding($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Building');

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
            $this->addJoinObject($join, 'Building');
        }

        return $this;
    }

    /**
     * Use the Building relation Building object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \BossEdu\Model\BuildingQuery A secondary query class using the current class as primary query
     */
    public function useBuildingQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinBuilding($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Building', '\BossEdu\Model\BuildingQuery');
    }

    /**
     * Filter the query by a related \BossEdu\Model\RsAvailable object
     *
     * @param \BossEdu\Model\RsAvailable|ObjectCollection $rsAvailable the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildRoomQuery The current query, for fluid interface
     */
    public function filterByRsAvailable($rsAvailable, $comparison = null)
    {
        if ($rsAvailable instanceof \BossEdu\Model\RsAvailable) {
            return $this
                ->addUsingAlias(RoomTableMap::COL_BUILDING_CODE, $rsAvailable->getBuildingCode(), $comparison)
                ->addUsingAlias(RoomTableMap::COL_NUMBER, $rsAvailable->getRoomNumber(), $comparison);
        } else {
            throw new PropelException('filterByRsAvailable() only accepts arguments of type \BossEdu\Model\RsAvailable');
        }
    }

    /**
     * Adds a JOIN clause to the query using the RsAvailable relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildRoomQuery The current query, for fluid interface
     */
    public function joinRsAvailable($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('RsAvailable');

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
            $this->addJoinObject($join, 'RsAvailable');
        }

        return $this;
    }

    /**
     * Use the RsAvailable relation RsAvailable object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \BossEdu\Model\RsAvailableQuery A secondary query class using the current class as primary query
     */
    public function useRsAvailableQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinRsAvailable($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'RsAvailable', '\BossEdu\Model\RsAvailableQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildRoom $room Object to remove from the list of results
     *
     * @return $this|ChildRoomQuery The current query, for fluid interface
     */
    public function prune($room = null)
    {
        if ($room) {
            $this->addCond('pruneCond0', $this->getAliasedColName(RoomTableMap::COL_BUILDING_CODE), $room->getBuildingCode(), Criteria::NOT_EQUAL);
            $this->addCond('pruneCond1', $this->getAliasedColName(RoomTableMap::COL_NUMBER), $room->getNumber(), Criteria::NOT_EQUAL);
            $this->combine(array('pruneCond0', 'pruneCond1'), Criteria::LOGICAL_OR);
        }

        return $this;
    }

    /**
     * Deletes all rows from the room table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(RoomTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            RoomTableMap::clearInstancePool();
            RoomTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(RoomTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(RoomTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            
            RoomTableMap::removeInstanceFromPool($criteria);
        
            $affectedRows += ModelCriteria::delete($con);
            RoomTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // RoomQuery
