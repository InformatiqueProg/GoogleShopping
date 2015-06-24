<?php

namespace GoogleShopping\Model\Base;

use \Exception;
use \PDO;
use GoogleShopping\Model\GoogleshoppingTaxonomy as ChildGoogleshoppingTaxonomy;
use GoogleShopping\Model\GoogleshoppingTaxonomyQuery as ChildGoogleshoppingTaxonomyQuery;
use GoogleShopping\Model\Map\GoogleshoppingTaxonomyTableMap;
use GoogleShopping\Model\Thelia\Model\Category;
use GoogleShopping\Model\Thelia\Model\Lang;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'googleshopping_taxonomy' table.
 *
 *
 *
 * @method     ChildGoogleshoppingTaxonomyQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildGoogleshoppingTaxonomyQuery orderByTheliaCategoryId($order = Criteria::ASC) Order by the thelia_category_id column
 * @method     ChildGoogleshoppingTaxonomyQuery orderByGoogleCategory($order = Criteria::ASC) Order by the google_category column
 * @method     ChildGoogleshoppingTaxonomyQuery orderByLangId($order = Criteria::ASC) Order by the lang_id column
 *
 * @method     ChildGoogleshoppingTaxonomyQuery groupById() Group by the id column
 * @method     ChildGoogleshoppingTaxonomyQuery groupByTheliaCategoryId() Group by the thelia_category_id column
 * @method     ChildGoogleshoppingTaxonomyQuery groupByGoogleCategory() Group by the google_category column
 * @method     ChildGoogleshoppingTaxonomyQuery groupByLangId() Group by the lang_id column
 *
 * @method     ChildGoogleshoppingTaxonomyQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildGoogleshoppingTaxonomyQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildGoogleshoppingTaxonomyQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildGoogleshoppingTaxonomyQuery leftJoinCategory($relationAlias = null) Adds a LEFT JOIN clause to the query using the Category relation
 * @method     ChildGoogleshoppingTaxonomyQuery rightJoinCategory($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Category relation
 * @method     ChildGoogleshoppingTaxonomyQuery innerJoinCategory($relationAlias = null) Adds a INNER JOIN clause to the query using the Category relation
 *
 * @method     ChildGoogleshoppingTaxonomyQuery leftJoinLang($relationAlias = null) Adds a LEFT JOIN clause to the query using the Lang relation
 * @method     ChildGoogleshoppingTaxonomyQuery rightJoinLang($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Lang relation
 * @method     ChildGoogleshoppingTaxonomyQuery innerJoinLang($relationAlias = null) Adds a INNER JOIN clause to the query using the Lang relation
 *
 * @method     ChildGoogleshoppingTaxonomy findOne(ConnectionInterface $con = null) Return the first ChildGoogleshoppingTaxonomy matching the query
 * @method     ChildGoogleshoppingTaxonomy findOneOrCreate(ConnectionInterface $con = null) Return the first ChildGoogleshoppingTaxonomy matching the query, or a new ChildGoogleshoppingTaxonomy object populated from the query conditions when no match is found
 *
 * @method     ChildGoogleshoppingTaxonomy findOneById(int $id) Return the first ChildGoogleshoppingTaxonomy filtered by the id column
 * @method     ChildGoogleshoppingTaxonomy findOneByTheliaCategoryId(int $thelia_category_id) Return the first ChildGoogleshoppingTaxonomy filtered by the thelia_category_id column
 * @method     ChildGoogleshoppingTaxonomy findOneByGoogleCategory(string $google_category) Return the first ChildGoogleshoppingTaxonomy filtered by the google_category column
 * @method     ChildGoogleshoppingTaxonomy findOneByLangId(int $lang_id) Return the first ChildGoogleshoppingTaxonomy filtered by the lang_id column
 *
 * @method     array findById(int $id) Return ChildGoogleshoppingTaxonomy objects filtered by the id column
 * @method     array findByTheliaCategoryId(int $thelia_category_id) Return ChildGoogleshoppingTaxonomy objects filtered by the thelia_category_id column
 * @method     array findByGoogleCategory(string $google_category) Return ChildGoogleshoppingTaxonomy objects filtered by the google_category column
 * @method     array findByLangId(int $lang_id) Return ChildGoogleshoppingTaxonomy objects filtered by the lang_id column
 *
 */
abstract class GoogleshoppingTaxonomyQuery extends ModelCriteria
{

    /**
     * Initializes internal state of \GoogleShopping\Model\Base\GoogleshoppingTaxonomyQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'thelia', $modelName = '\\GoogleShopping\\Model\\GoogleshoppingTaxonomy', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildGoogleshoppingTaxonomyQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildGoogleshoppingTaxonomyQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof \GoogleShopping\Model\GoogleshoppingTaxonomyQuery) {
            return $criteria;
        }
        $query = new \GoogleShopping\Model\GoogleshoppingTaxonomyQuery();
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
     * @return ChildGoogleshoppingTaxonomy|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = GoogleshoppingTaxonomyTableMap::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(GoogleshoppingTaxonomyTableMap::DATABASE_NAME);
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
     * @return   ChildGoogleshoppingTaxonomy A model object, or null if the key is not found
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT ID, THELIA_CATEGORY_ID, GOOGLE_CATEGORY, LANG_ID FROM googleshopping_taxonomy WHERE ID = :p0';
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
            $obj = new ChildGoogleshoppingTaxonomy();
            $obj->hydrate($row);
            GoogleshoppingTaxonomyTableMap::addInstanceToPool($obj, (string) $key);
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
     * @return ChildGoogleshoppingTaxonomy|array|mixed the result, formatted by the current formatter
     */
    protected function findPkComplex($key, $con)
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
    public function findPks($keys, $con = null)
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
     * @return ChildGoogleshoppingTaxonomyQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(GoogleshoppingTaxonomyTableMap::ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return ChildGoogleshoppingTaxonomyQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(GoogleshoppingTaxonomyTableMap::ID, $keys, Criteria::IN);
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
     * @return ChildGoogleshoppingTaxonomyQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(GoogleshoppingTaxonomyTableMap::ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(GoogleshoppingTaxonomyTableMap::ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(GoogleshoppingTaxonomyTableMap::ID, $id, $comparison);
    }

    /**
     * Filter the query on the thelia_category_id column
     *
     * Example usage:
     * <code>
     * $query->filterByTheliaCategoryId(1234); // WHERE thelia_category_id = 1234
     * $query->filterByTheliaCategoryId(array(12, 34)); // WHERE thelia_category_id IN (12, 34)
     * $query->filterByTheliaCategoryId(array('min' => 12)); // WHERE thelia_category_id > 12
     * </code>
     *
     * @see       filterByCategory()
     *
     * @param     mixed $theliaCategoryId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildGoogleshoppingTaxonomyQuery The current query, for fluid interface
     */
    public function filterByTheliaCategoryId($theliaCategoryId = null, $comparison = null)
    {
        if (is_array($theliaCategoryId)) {
            $useMinMax = false;
            if (isset($theliaCategoryId['min'])) {
                $this->addUsingAlias(GoogleshoppingTaxonomyTableMap::THELIA_CATEGORY_ID, $theliaCategoryId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($theliaCategoryId['max'])) {
                $this->addUsingAlias(GoogleshoppingTaxonomyTableMap::THELIA_CATEGORY_ID, $theliaCategoryId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(GoogleshoppingTaxonomyTableMap::THELIA_CATEGORY_ID, $theliaCategoryId, $comparison);
    }

    /**
     * Filter the query on the google_category column
     *
     * Example usage:
     * <code>
     * $query->filterByGoogleCategory('fooValue');   // WHERE google_category = 'fooValue'
     * $query->filterByGoogleCategory('%fooValue%'); // WHERE google_category LIKE '%fooValue%'
     * </code>
     *
     * @param     string $googleCategory The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildGoogleshoppingTaxonomyQuery The current query, for fluid interface
     */
    public function filterByGoogleCategory($googleCategory = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($googleCategory)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $googleCategory)) {
                $googleCategory = str_replace('*', '%', $googleCategory);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(GoogleshoppingTaxonomyTableMap::GOOGLE_CATEGORY, $googleCategory, $comparison);
    }

    /**
     * Filter the query on the lang_id column
     *
     * Example usage:
     * <code>
     * $query->filterByLangId(1234); // WHERE lang_id = 1234
     * $query->filterByLangId(array(12, 34)); // WHERE lang_id IN (12, 34)
     * $query->filterByLangId(array('min' => 12)); // WHERE lang_id > 12
     * </code>
     *
     * @see       filterByLang()
     *
     * @param     mixed $langId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildGoogleshoppingTaxonomyQuery The current query, for fluid interface
     */
    public function filterByLangId($langId = null, $comparison = null)
    {
        if (is_array($langId)) {
            $useMinMax = false;
            if (isset($langId['min'])) {
                $this->addUsingAlias(GoogleshoppingTaxonomyTableMap::LANG_ID, $langId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($langId['max'])) {
                $this->addUsingAlias(GoogleshoppingTaxonomyTableMap::LANG_ID, $langId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(GoogleshoppingTaxonomyTableMap::LANG_ID, $langId, $comparison);
    }

    /**
     * Filter the query by a related \GoogleShopping\Model\Thelia\Model\Category object
     *
     * @param \GoogleShopping\Model\Thelia\Model\Category|ObjectCollection $category The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildGoogleshoppingTaxonomyQuery The current query, for fluid interface
     */
    public function filterByCategory($category, $comparison = null)
    {
        if ($category instanceof \GoogleShopping\Model\Thelia\Model\Category) {
            return $this
                ->addUsingAlias(GoogleshoppingTaxonomyTableMap::THELIA_CATEGORY_ID, $category->getId(), $comparison);
        } elseif ($category instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(GoogleshoppingTaxonomyTableMap::THELIA_CATEGORY_ID, $category->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByCategory() only accepts arguments of type \GoogleShopping\Model\Thelia\Model\Category or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Category relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return ChildGoogleshoppingTaxonomyQuery The current query, for fluid interface
     */
    public function joinCategory($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Category');

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
            $this->addJoinObject($join, 'Category');
        }

        return $this;
    }

    /**
     * Use the Category relation Category object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \GoogleShopping\Model\Thelia\Model\CategoryQuery A secondary query class using the current class as primary query
     */
    public function useCategoryQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinCategory($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Category', '\GoogleShopping\Model\Thelia\Model\CategoryQuery');
    }

    /**
     * Filter the query by a related \GoogleShopping\Model\Thelia\Model\Lang object
     *
     * @param \GoogleShopping\Model\Thelia\Model\Lang|ObjectCollection $lang The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildGoogleshoppingTaxonomyQuery The current query, for fluid interface
     */
    public function filterByLang($lang, $comparison = null)
    {
        if ($lang instanceof \GoogleShopping\Model\Thelia\Model\Lang) {
            return $this
                ->addUsingAlias(GoogleshoppingTaxonomyTableMap::LANG_ID, $lang->getId(), $comparison);
        } elseif ($lang instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(GoogleshoppingTaxonomyTableMap::LANG_ID, $lang->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByLang() only accepts arguments of type \GoogleShopping\Model\Thelia\Model\Lang or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Lang relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return ChildGoogleshoppingTaxonomyQuery The current query, for fluid interface
     */
    public function joinLang($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Lang');

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
            $this->addJoinObject($join, 'Lang');
        }

        return $this;
    }

    /**
     * Use the Lang relation Lang object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \GoogleShopping\Model\Thelia\Model\LangQuery A secondary query class using the current class as primary query
     */
    public function useLangQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinLang($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Lang', '\GoogleShopping\Model\Thelia\Model\LangQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildGoogleshoppingTaxonomy $googleshoppingTaxonomy Object to remove from the list of results
     *
     * @return ChildGoogleshoppingTaxonomyQuery The current query, for fluid interface
     */
    public function prune($googleshoppingTaxonomy = null)
    {
        if ($googleshoppingTaxonomy) {
            $this->addUsingAlias(GoogleshoppingTaxonomyTableMap::ID, $googleshoppingTaxonomy->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the googleshopping_taxonomy table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(GoogleshoppingTaxonomyTableMap::DATABASE_NAME);
        }
        $affectedRows = 0; // initialize var to track total num of affected rows
        try {
            // use transaction because $criteria could contain info
            // for more than one table or we could emulating ON DELETE CASCADE, etc.
            $con->beginTransaction();
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            GoogleshoppingTaxonomyTableMap::clearInstancePool();
            GoogleshoppingTaxonomyTableMap::clearRelatedInstancePool();

            $con->commit();
        } catch (PropelException $e) {
            $con->rollBack();
            throw $e;
        }

        return $affectedRows;
    }

    /**
     * Performs a DELETE on the database, given a ChildGoogleshoppingTaxonomy or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or ChildGoogleshoppingTaxonomy object or primary key or array of primary keys
     *              which is used to create the DELETE statement
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *                if supported by native driver or if emulated using Propel.
     * @throws PropelException Any exceptions caught during processing will be
     *         rethrown wrapped into a PropelException.
     */
     public function delete(ConnectionInterface $con = null)
     {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(GoogleshoppingTaxonomyTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(GoogleshoppingTaxonomyTableMap::DATABASE_NAME);

        $affectedRows = 0; // initialize var to track total num of affected rows

        try {
            // use transaction because $criteria could contain info
            // for more than one table or we could emulating ON DELETE CASCADE, etc.
            $con->beginTransaction();


        GoogleshoppingTaxonomyTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            GoogleshoppingTaxonomyTableMap::clearRelatedInstancePool();
            $con->commit();

            return $affectedRows;
        } catch (PropelException $e) {
            $con->rollBack();
            throw $e;
        }
    }

} // GoogleshoppingTaxonomyQuery
