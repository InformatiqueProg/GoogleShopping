<?php

namespace GoogleShopping\Loop;

use GoogleShopping\Model\GoogleshoppingTaxonomy;
use GoogleShopping\Model\GoogleshoppingTaxonomyQuery;
use Thelia\Core\Template\Element\BaseLoop;
use Thelia\Core\Template\Element\LoopResult;
use Thelia\Core\Template\Element\LoopResultRow;
use Thelia\Core\Template\Element\PropelSearchLoopInterface;
use Thelia\Core\Template\Loop\Argument\Argument;
use Thelia\Core\Template\Loop\Argument\ArgumentCollection;
use Thelia\Model\CategoryQuery;
use Thelia\Model\LangQuery;

class AssociatedCategory extends BaseLoop implements PropelSearchLoopInterface
{
    public function getArgDefinitions()
    {
        return new ArgumentCollection(
            Argument::createIntTypeArgument('category_id'),
            Argument::createAnyTypeArgument('lang_id', 'en_US')
        );
    }

    public function buildModelCriteria()
    {
        $query = GoogleshoppingTaxonomyQuery::create();

        if ($this->getCategoryId()) {
            $query->filterByTheliaCategoryId($this->getCategoryId());
        }

        $query->filterByLangId($this->getLangId());

        return $query;
    }

    public function parseResults(LoopResult $loopResult)
    {
        $lang = LangQuery::create()
            ->findOneById($this->getLangId());
        /** @var GoogleshoppingTaxonomy $data */
        foreach ($loopResult->getResultDataCollection() as $data) {
            $loopResultRow = new LoopResultRow();
            $theliaCategory = CategoryQuery::create()
                ->findOneById($data->getTheliaCategoryId());
            $theliaCategory->setLocale($lang->getLocale());
            $loopResultRow->set("THELIA_CATEGORY_ID", $data->getTheliaCategoryId());
            $loopResultRow->set("THELIA_CATEGORY_TITLE", $theliaCategory->getTitle());
            $loopResultRow->set("GOOGLE_CATEGORY", $data->getGoogleCategory());

            $loopResult->addRow($loopResultRow);
        }

        return $loopResult;
    }
}
