<?php
/**
 * @package plugins.elasticSearch
 * @subpackage lib.search
 */

class kUserSearch extends kBaseSearch
{
    
    public function __construct()
    {
        parent::__construct();
    }
    
    public function doSearch(ESearchOperator $eSearchOperator, $statuses = array(), kPager $pager = null)
    {
        kUserElasticEntitlement::init();
        if (!count($statuses))
            $statuses = array(KuserStatus::ACTIVE);
        $this->initQuery($statuses);
        $result = $this->execSearch($eSearchOperator);
        return $result;
    }

    protected function initQuery(array $statuses, kPager $pager = null)
    {
        $this->query = array(
            'index' => ElasticIndexMap::ELASTIC_KUSER_INDEX,
            'type' => ElasticIndexMap::ELASTIC_KUSER_TYPE
        );

        parent::initQuery($statuses, $pager);
    }
}