<?php namespace interactivesolutions\honeycombecommercegoods\app\http\controllers\ecommerce\goods\types;

use Illuminate\Database\Eloquent\Builder;
use interactivesolutions\honeycombcore\http\controllers\HCBaseController;
use interactivesolutions\honeycombecommercegoods\app\models\ecommerce\goods\types\HCECAttributes;
use interactivesolutions\honeycombecommercegoods\app\models\ecommerce\goods\types\HCECAttributesTranslations;
use interactivesolutions\honeycombecommercegoods\app\validators\ecommerce\goods\types\HCECAttributesTranslationsValidator;
use interactivesolutions\honeycombecommercegoods\app\validators\ecommerce\goods\types\HCECAttributesValidator;

class HCECAttributesController extends HCBaseController
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
            'title'       => trans ('HCECommerceGoods::e_commerce_goods_types_attributes.page_title'),
            'listURL'     => route ('admin.api.06_routes.e.commerce.goods.types.attributes'),
            'newFormUrl'  => route ('admin.api.form-manager', ['e-commerce-goods-types-attributes-new']),
            'editFormUrl' => route ('admin.api.form-manager', ['e-commerce-goods-types-attributes-edit']),
            'imagesUrl'   => route ('resource.get', ['/']),
            'headers'     => $this->getAdminListHeader (),
        ];

        if (auth ()->user ()->can ('interactivesolutions_honeycomb_e_commerce_goods_06_routes_e_commerce_goods_types_attributes_create'))
            $config['actions'][] = 'new';

        if (auth ()->user ()->can ('interactivesolutions_honeycomb_e_commerce_goods_06_routes_e_commerce_goods_types_attributes_update')) {
            $config['actions'][] = 'update';
            $config['actions'][] = 'restore';
        }

        if (auth ()->user ()->can ('interactivesolutions_honeycomb_e_commerce_goods_06_routes_e_commerce_goods_types_attributes_delete'))
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
            'dynamic'                             => [
                "type"  => "text",
                "label" => trans ('HCECommerceGoods::e_commerce_goods_types_attributes.dynamic'),
            ],
            'min_select'                          => [
                "type"  => "text",
                "label" => trans ('HCECommerceGoods::e_commerce_goods_types_attributes.min_select'),
            ],
            'max_select'                          => [
                "type"  => "text",
                "label" => trans ('HCECommerceGoods::e_commerce_goods_types_attributes.max_select'),
            ],
            'multilanguage'                       => [
                "type"  => "text",
                "label" => trans ('HCECommerceGoods::e_commerce_goods_types_attributes.multilanguage'),
            ],
            'type_id'                             => [
                "type"  => "text",
                "label" => trans ('HCECommerceGoods::e_commerce_goods_types_attributes.type_id'),
            ],
            'translations.{lang}.description'     => [
                "type"  => "text",
                "label" => trans ('HCECommerceGoods::e_commerce_goods_types_attributes.description'),
            ],
            'translations.{lang}.label'           => [
                "type"  => "text",
                "label" => trans ('HCECommerceGoods::e_commerce_goods_types_attributes.label'),
            ],
            'translations.{lang}.slug'            => [
                "type"  => "text",
                "label" => trans ('HCECommerceGoods::e_commerce_goods_types_attributes.slug'),
            ],
            'translations.{lang}.seo_title'       => [
                "type"  => "text",
                "label" => trans ('HCECommerceGoods::e_commerce_goods_types_attributes.seo_title'),
            ],
            'translations.{lang}.seo_description' => [
                "type"  => "text",
                "label" => trans ('HCECommerceGoods::e_commerce_goods_types_attributes.seo_description'),
            ],
            'translations.{lang}.seo_keywords'    => [
                "type"  => "text",
                "label" => trans ('HCECommerceGoods::e_commerce_goods_types_attributes.seo_keywords'),
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

        $record = HCECAttributes::create (array_get ($data, 'record', []));
        $record->updateTranslations (array_get ($data, 'translations', []));

        return $this->apiShow ($record->id);
    }

    /**
     * Getting user data on POST call
     *
     * @return mixed
     */
    protected function getInputData ()
    {
        (new HCECAttributesValidator())->validateForm ();
        (new HCECAttributesTranslationsValidator())->validateForm ();

        $_data = request ()->all ();

        if (array_has ($_data, 'id'))
            array_set ($data, 'record.id', array_get ($_data, 'id'));

        array_set ($data, 'record.dynamic', array_get ($_data, 'dynamic'));
        array_set ($data, 'record.min_select', array_get ($_data, 'min_select'));
        array_set ($data, 'record.max_select', array_get ($_data, 'max_select'));
        array_set ($data, 'record.multilanguage', array_get ($_data, 'multilanguage'));
        array_set ($data, 'record.type_id', array_get ($_data, 'type_id'));

        $translations = array_get ($_data, 'translations');

        foreach ($translations as &$value)
            if (!isset($value['slug']) || $value['slug'] == "")
                $value['slug'] = generateHCSlug ("e-commerce/goods/types/attributes", $value['label']);

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

        $select = HCECAttributes::getFillableFields (true);

        $record = HCECAttributes::with ($with)
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
        $record = HCECAttributes::findOrFail ($id);

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
        HCECAttributes::where ('id', $id)->update (request ()->all ());

        return $this->apiShow ($id);
    }

    /**
     * Delete records table
     *
     * @param $list
     * @return mixed|void
     */
    protected function __apiDestroy (array $list)
    {
        HCECAttributesTranslations::destroy (HCECAttributesTranslations::whereIn ('record_id', $list)->pluck ('id')->toArray ());
        HCECAttributes::destroy ($list);
    }

    /**
     * Delete records table
     *
     * @param $list
     * @return mixed|void
     */
    protected function __apiForceDelete (array $list)
    {
        HCECAttributesTranslations::onlyTrashed ()->whereIn ('record_id', $list)->forceDelete ();
        HCECAttributes::onlyTrashed ()->whereIn ('id', $list)->forceDelete ();
    }

    /**
     * Restore multiple records
     *
     * @param $list
     * @return mixed|void
     */
    protected function __apiRestore (array $list)
    {
        HCECAttributesTranslations::onlyTrashed ()->whereIn ('record_id', $list)->restore ();
        HCECAttributes::whereIn ('id', $list)->restore ();
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
            $select = HCECAttributes::getFillableFields ();

        $list = HCECAttributes::with ($with)
                              ->select ($select)
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
        $r = HCECAttributes::getTableName ();
        $t = HCECAttributesTranslations::getTableName ();

        $query->where (function (Builder $query) use ($phrase) {
            $query->where ('dynamic', 'LIKE', '%' . $phrase . '%')
                  ->orWhere ('min_select', 'LIKE', '%' . $phrase . '%')
                  ->orWhere ('max_select', 'LIKE', '%' . $phrase . '%')
                  ->orWhere ('multilanguage', 'LIKE', '%' . $phrase . '%')
                  ->orWhere ('type_id', 'LIKE', '%' . $phrase . '%');
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
