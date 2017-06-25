<?php namespace interactivesolutions\honeycombecommercegoods\app\http\controllers\ecommerce;

use Illuminate\Database\Eloquent\Builder;
use interactivesolutions\honeycombcore\http\controllers\HCBaseController;
use interactivesolutions\honeycombecommercegoods\app\models\ecommerce\HCECGoods;
use interactivesolutions\honeycombecommercegoods\app\models\ecommerce\HCECGoodsTranslations;
use interactivesolutions\honeycombecommercegoods\app\validators\ecommerce\HCECGoodsTranslationsValidator;
use interactivesolutions\honeycombecommercegoods\app\validators\ecommerce\HCECGoodsValidator;

class HCECGoodsController extends HCBaseController
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
            'title'       => trans ('HCECommerceGoods::e_commerce_goods.page_title'),
            'listURL'     => route ('admin.api.routes.e.commerce.goods'),
            'newFormUrl'  => route ('admin.api.form-manager', ['e-commerce-goods-new']),
            'editFormUrl' => route ('admin.api.form-manager', ['e-commerce-goods-edit']),
            'imagesUrl'   => route ('resource.get', ['/']),
            'headers'     => $this->getAdminListHeader (),
        ];

        if (auth ()->user ()->can ('interactivesolutions_honeycomb_e_commerce_goods_routes_e_commerce_goods_create'))
            $config['actions'][] = 'new';

        if (auth ()->user ()->can ('interactivesolutions_honeycomb_e_commerce_goods_routes_e_commerce_goods_update')) {
            $config['actions'][] = 'update';
            $config['actions'][] = 'restore';
        }

        if (auth ()->user ()->can ('interactivesolutions_honeycomb_e_commerce_goods_routes_e_commerce_goods_delete'))
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
            'type_id'                               => [
                "type"  => "text",
                "label" => trans ('HCECommerceGoods::e_commerce_goods.type_id'),
            ],
            'virtual'                               => [
                "type"  => "text",
                "label" => trans ('HCECommerceGoods::e_commerce_goods.virtual'),
            ],
            'reference'                             => [
                "type"  => "text",
                "label" => trans ('HCECommerceGoods::e_commerce_goods.reference'),
            ],
            'ean_13'                                => [
                "type"  => "text",
                "label" => trans ('HCECommerceGoods::e_commerce_goods.ean_13'),
            ],
            'price'                                 => [
                "type"  => "text",
                "label" => trans ('HCECommerceGoods::e_commerce_goods.price'),
            ],
            'tax_id'                                => [
                "type"  => "text",
                "label" => trans ('HCECommerceGoods::e_commerce_goods.tax_id'),
            ],
            'price_before_tax'                      => [
                "type"  => "text",
                "label" => trans ('HCECommerceGoods::e_commerce_goods.price_before_tax'),
            ],
            'deposit_id'                            => [
                "type"  => "text",
                "label" => trans ('HCECommerceGoods::e_commerce_goods.deposit_id'),
            ],
            'country_id'                            => [
                "type"  => "text",
                "label" => trans ('HCECommerceGoods::e_commerce_goods.country_id'),
            ],
            'gallery_id'                            => [
                "type"  => "text",
                "label" => trans ('HCECommerceGoods::e_commerce_goods.gallery_id'),
            ],
            'manufacturer_id'                       => [
                "type"  => "text",
                "label" => trans ('HCECommerceGoods::e_commerce_goods.manufacturer_id'),
            ],
            'translations.{lang}.short_description' => [
                "type"  => "text",
                "label" => trans ('HCECommerceGoods::e_commerce_goods.short_description'),
            ],
            'translations.{lang}.long_description'  => [
                "type"  => "text",
                "label" => trans ('HCECommerceGoods::e_commerce_goods.long_description'),
            ],
            'translations.{lang}.label'             => [
                "type"  => "text",
                "label" => trans ('HCECommerceGoods::e_commerce_goods.label'),
            ],
            'translations.{lang}.slug'              => [
                "type"  => "text",
                "label" => trans ('HCECommerceGoods::e_commerce_goods.slug'),
            ],
            'translations.{lang}.seo_title'         => [
                "type"  => "text",
                "label" => trans ('HCECommerceGoods::e_commerce_goods.seo_title'),
            ],
            'translations.{lang}.seo_description'   => [
                "type"  => "text",
                "label" => trans ('HCECommerceGoods::e_commerce_goods.seo_description'),
            ],
            'translations.{lang}.seo_keywords'      => [
                "type"  => "text",
                "label" => trans ('HCECommerceGoods::e_commerce_goods.seo_keywords'),
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

        $record = HCECGoods::create (array_get ($data, 'record', []));
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
        (new HCECGoodsValidator())->validateForm ();
        (new HCECGoodsTranslationsValidator())->validateForm ();

        $_data = request ()->all ();

        if (array_has ($_data, 'id'))
            array_set ($data, 'record.id', array_get ($_data, 'id'));

        array_set ($data, 'record.type_id', array_get ($_data, 'type_id'));
        array_set ($data, 'record.virtual', array_get ($_data, 'virtual'));
        array_set ($data, 'record.reference', array_get ($_data, 'reference'));
        array_set ($data, 'record.ean_13', array_get ($_data, 'ean_13'));
        array_set ($data, 'record.price', array_get ($_data, 'price'));
        array_set ($data, 'record.tax_id', array_get ($_data, 'tax_id'));
        array_set ($data, 'record.price_before_tax', array_get ($_data, 'price_before_tax'));
        array_set ($data, 'record.deposit_id', array_get ($_data, 'deposit_id'));
        array_set ($data, 'record.country_id', array_get ($_data, 'country_id'));
        array_set ($data, 'record.gallery_id', array_get ($_data, 'gallery_id'));
        array_set ($data, 'record.manufacturer_id', array_get ($_data, 'manufacturer_id'));

        $translations = array_get ($_data, 'translations');

        foreach ($translations as &$value)
            if (!isset($value['slug']) || $value['slug'] == "")
                $value['slug'] = generateHCSlug ("e-commerce/goods", $value['label']);

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

        $select = HCECGoods::getFillableFields (true);

        $record = HCECGoods::with ($with)
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
        $record = HCECGoods::findOrFail ($id);

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
        HCECGoods::where ('id', $id)->update (request ()->all ());

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
        HCECGoodsTranslations::destroy (HCECGoodsTranslations::whereIn ('record_id', $list)->pluck ('id')->toArray ());
        HCECGoods::destroy ($list);

        return hcSuccess ();
    }

    /**
     * Delete records table
     *
     * @param $list
     * @return mixed
     */
    protected function __apiForceDelete (array $list)
    {
        HCECGoodsTranslations::onlyTrashed ()->whereIn ('record_id', $list)->forceDelete ();
        HCECGoods::onlyTrashed ()->whereIn ('id', $list)->forceDelete ();

        return hcSuccess ();
    }

    /**
     * Restore multiple records
     *
     * @param $list
     * @return mixed
     */
    protected function __apiRestore (array $list)
    {
        HCECGoodsTranslations::onlyTrashed ()->whereIn ('record_id', $list)->restore ();
        HCECGoods::whereIn ('id', $list)->restore ();

        return hcSuccess ();
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
            $select = HCECGoods::getFillableFields ();

        $list = HCECGoods::with ($with)
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
        $r = HCECGoods::getTableName ();
        $t = HCECGoodsTranslations::getTableName ();

        $query->where (function (Builder $query) use ($phrase) {
            $query->where ('type_id', 'LIKE', '%' . $phrase . '%')
                  ->orWhere ('virtual', 'LIKE', '%' . $phrase . '%')
                  ->orWhere ('reference', 'LIKE', '%' . $phrase . '%')
                  ->orWhere ('ean_13', 'LIKE', '%' . $phrase . '%')
                  ->orWhere ('price', 'LIKE', '%' . $phrase . '%')
                  ->orWhere ('tax_id', 'LIKE', '%' . $phrase . '%')
                  ->orWhere ('price_before_tax', 'LIKE', '%' . $phrase . '%')
                  ->orWhere ('deposit_id', 'LIKE', '%' . $phrase . '%')
                  ->orWhere ('country_id', 'LIKE', '%' . $phrase . '%')
                  ->orWhere ('gallery_id', 'LIKE', '%' . $phrase . '%')
                  ->orWhere ('manufacturer_id', 'LIKE', '%' . $phrase . '%');
        });

        return $query->join ($t, "$r.id", "=", "$t.record_id")
                     ->where ('short_description', 'LIKE', '%' . $phrase . '%')
                     ->orWhere ('long_description', 'LIKE', '%' . $phrase . '%')
                     ->orWhere ('label', 'LIKE', '%' . $phrase . '%')
                     ->orWhere ('slug', 'LIKE', '%' . $phrase . '%')
                     ->orWhere ('seo_title', 'LIKE', '%' . $phrase . '%')
                     ->orWhere ('seo_description', 'LIKE', '%' . $phrase . '%')
                     ->orWhere ('seo_keywords', 'LIKE', '%' . $phrase . '%');
    }
}
