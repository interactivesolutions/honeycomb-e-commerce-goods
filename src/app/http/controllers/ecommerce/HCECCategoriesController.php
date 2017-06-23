<?php namespace interactivesolutions\honeycombecommercegoods\app\http\controllers\ecommerce;

use Illuminate\Database\Eloquent\Builder;
use interactivesolutions\honeycombcore\errors\facades\HCLog;
use interactivesolutions\honeycombcore\http\controllers\HCBaseController;
use interactivesolutions\honeycombecommercegoods\app\models\ecommerce\HCECCategories;
use interactivesolutions\honeycombecommercegoods\app\models\ecommerce\HCECCategoriesTranslations;
use interactivesolutions\honeycombecommercegoods\app\validators\ecommerce\HCECCategoriesTranslationsValidator;
use interactivesolutions\honeycombecommercegoods\app\validators\ecommerce\HCECCategoriesValidator;

class HCECCategoriesController extends HCBaseController
{

    //TODO recordsPerPage setting

    /**
     * Returning configured admin view
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function adminIndex ()
    {
        $config = [
            'title'       => trans ('HCECommerceGoods::e_commerce_categories.page_title'),
            'listURL'     => route ('admin.api.e.commerce.categories'),
            'newFormUrl'  => route ('admin.api.form-manager', ['e-commerce-categories-new']),
            'editFormUrl' => route ('admin.api.form-manager', ['e-commerce-categories-edit']),
            'imagesUrl'   => route ('resource.get', ['/']),
            'headers'     => $this->getAdminListHeader (),
        ];

        if (auth ()->user ()->can ('interactivesolutions_honeycomb_e_commerce_goods_e_commerce_categories_create'))
            $config['actions'][] = 'new';

        if (auth ()->user ()->can ('interactivesolutions_honeycomb_e_commerce_goods_e_commerce_categories_update')) {
            $config['actions'][] = 'update';
            $config['actions'][] = 'restore';
        }

        if (auth ()->user ()->can ('interactivesolutions_honeycomb_e_commerce_goods_e_commerce_categories_delete'))
            $config['actions'][] = 'delete';

        $config['actions'][] = 'search';
        $config['filters']   = $this->getFilters ();

        return hcview ('HCCoreUI::admin.content.list', ['config' => $config]);
    }

    /**
     * Creating Admin List Header based on Main Table
     *
     * @return array
     */
    private function getAdminListHeader ()
    {
        return [
            'resource_id'                         => [
                "type"  => "text",
                "label" => trans ('HCECommerceGoods::e_commerce_categories.resource_id'),
            ],
            'parent_id'                           => [
                "type"  => "text",
                "label" => trans ('HCECommerceGoods::e_commerce_categories.parent_id'),
            ],
            'translations.{lang}.description'     => [
                "type"  => "text",
                "label" => trans ('HCECommerceGoods::e_commerce_categories.description'),
            ],
            'translations.{lang}.label'           => [
                "type"  => "text",
                "label" => trans ('HCECommerceGoods::e_commerce_categories.label'),
            ],
            'translations.{lang}.slug'            => [
                "type"  => "text",
                "label" => trans ('HCECommerceGoods::e_commerce_categories.slug'),
            ],
            'translations.{lang}.seo_title'       => [
                "type"  => "text",
                "label" => trans ('HCECommerceGoods::e_commerce_categories.seo_title'),
            ],
            'translations.{lang}.seo_description' => [
                "type"  => "text",
                "label" => trans ('HCECommerceGoods::e_commerce_categories.seo_description'),
            ],
            'translations.{lang}.seo_keywords'    => [
                "type"  => "text",
                "label" => trans ('HCECommerceGoods::e_commerce_categories.seo_keywords'),
            ],

        ];
    }

    /**
     * Generating filters required for admin view
     *
     * @return array
     */
    public function getFilters ()
    {
        $filters = [];

        return $filters;
    }

    /**
     * Create item
     *
     * @return mixed
     */
    protected function __apiStore ()
    {
        $data = $this->getInputData ();

        $record = HCECCategories::create (array_get ($data, 'record'));
        $record->updateTranslations (array_get ($data, 'translations'));

        return $this->apiShow ($record->id);
    }

    /**
     * Getting user data on POST call
     *
     * @return mixed
     */
    protected function getInputData ()
    {
        (new HCECCategoriesValidator())->validateForm ();
        (new HCECCategoriesTranslationsValidator())->validateForm ();

        $_data = request ()->all ();

        if (array_has ($_data, 'id'))
            array_set ($data, 'record.id', array_get ($_data, 'id'));

        array_set ($data, 'record.resource_id', array_get ($_data, 'resource_id'));
        array_set ($data, 'record.parent_id', array_get ($_data, 'parent_id'));

        $translations = array_get ($_data, 'translations');

        foreach ($translations as &$value)
        {
            if (!isset($value['slug']) || $value['slug'] == "")
                $value['slug'] = generateHCSlug('ec-categories', $value['label']);
        }

        array_set ($data, 'translations', $translations);

        return makeEmptyNullable ($data);
    }

    /**
     * Getting single record
     *
     * @param $id
     * @return mixed
     */
    public function apiShow (string $id)
    {
        $with = ['translations'];

        $select = HCECCategories::getFillableFields (true);

        $record = HCECCategories::with ($with)
                                ->select ($select)
                                ->where ('id', $id)
                                ->firstOrFail ();

        return $record;
    }

    /**
     * Updates existing item based on ID
     *
     * @param $id
     * @return mixed
     */
    protected function __apiUpdate (string $id)
    {
        $record = HCECCategories::findOrFail ($id);

        $data = $this->getInputData ();

        $record->update (array_get ($data, 'record', []));
        $record->updateTranslations (array_get ($data, 'translations', []));

        return $this->apiShow ($record->id);
    }

    /**
     * Updates existing specific items based on ID
     *
     * @param string $id
     * @return mixed
     */
    protected function __apiUpdateStrict (string $id)
    {
        HCECCategories::where ('id', $id)->update (request ()->all ());

        return $this->apiShow ($id);
    }

    /**
     * Delete records table
     *
     * @param $list
     * @return mixed
     */
    protected function __apiDestroy (array $list)
    {
        foreach($list as $id)
            if(HCECCategories::where ('parent_id', $id))
                return HCLog::error('EC-0001', trans('HCECommerceGoods::e_commerce_categories.has_children'));

        HCECCategoriesTranslations::destroy (HCECCategoriesTranslations::whereIn ('record_id', $list)->pluck ('id')->toArray ());
        HCECCategories::destroy ($list);
    }

    /**
     * Delete records table
     *
     * @param $list
     * @return mixed|void
     */
    protected function __apiForceDelete (array $list)
    {
        HCECCategoriesTranslations::onlyTrashed ()->whereIn ('record_id', $list)->forceDelete ();
        HCECCategories::onlyTrashed ()->whereIn ('id', $list)->forceDelete ();
    }

    /**
     * Restore multiple records
     *
     * @param $list
     * @return mixed|void
     */
    protected function __apiRestore (array $list)
    {
        HCECCategoriesTranslations::onlyTrashed ()->whereIn ('record_id', $list)->restore ();
        HCECCategories::whereIn ('id', $list)->restore ();
    }

    /**
     * Creating data query
     *
     * @param array $select
     * @return mixed
     */
    protected function createQuery (array $select = null)
    {
        $with = ['translations'];

        if ($select == null)
            $select = HCECCategories::getFillableFields ();

        $list = HCECCategories::with ($with)->select ($select)
            // add filters
                              ->where (function ($query) use ($select) {
                $query = $this->getRequestParameters ($query, $select);
            });

        // enabling check for deleted
        $list = $this->checkForDeleted ($list);

        // add search items
        $list = $this->search ($list);

        // ordering data
        $list = $this->orderData ($list, $select);

        return $list;
    }

    /**
     * List search elements
     * @param Builder $query
     * @param string $phrase
     * @return Builder
     */
    protected function searchQuery (Builder $query, string $phrase)
    {
        $r = HCECCategories::getTableName ();
        $t = HCECCategoriesTranslations::getTableName ();

        $query->where (function (Builder $query) use ($phrase) {
            $query->where ('resource_id', 'LIKE', '%' . $phrase . '%')
                  ->orWhere ('parent_id', 'LIKE', '%' . $phrase . '%');
        });

        return $query->join ($t, "$r.id", "=", "$t.record_id")
                     ->where ('description', 'LIKE', '%' . $phrase . '%')
                     ->orWhere ('label', 'LIKE', '%' . $phrase . '%')
                     ->orWhere ('slug', 'LIKE', '%' . $phrase . '%')
                     ->orWhere ('seo_title', 'LIKE', '%' . $phrase . '%')
                     ->orWhere ('seo_description', 'LIKE', '%' . $phrase . '%')
                     ->orWhere ('seo_keywords', 'LIKE', '%' . $phrase . '%');
    }
}
