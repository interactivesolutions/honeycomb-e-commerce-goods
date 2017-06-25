<?php namespace interactivesolutions\honeycombecommercegoods\app\http\controllers\ecommerce\goods;

use Illuminate\Database\Eloquent\Builder;
use interactivesolutions\honeycombcore\http\controllers\HCBaseController;
use interactivesolutions\honeycombecommercegoods\app\models\ecommerce\goods\HCECTypes;
use interactivesolutions\honeycombecommercegoods\app\models\ecommerce\goods\HCECTypesTranslations;
use interactivesolutions\honeycombecommercegoods\app\validators\ecommerce\goods\HCECTypesTranslationsValidator;
use interactivesolutions\honeycombecommercegoods\app\validators\ecommerce\goods\HCECTypesValidator;

class HCECTypesController extends HCBaseController
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
            'title'       => trans ('HCECommerceGoods::e_commerce_goods_types.page_title'),
            'listURL'     => route ('admin.api.e.commerce.goods.types'),
            'newFormUrl'  => route ('admin.api.form-manager', ['e-commerce-goods-types-new']),
            'editFormUrl' => route ('admin.api.form-manager', ['e-commerce-goods-types-edit']),
            'imagesUrl'   => route ('resource.get', ['/']),
            'headers'     => $this->getAdminListHeader (),
        ];

        if (auth ()->user ()->can ('interactivesolutions_honeycomb_e_commerce_goods_e_commerce_goods_types_create'))
            $config['actions'][] = 'new';

        if (auth ()->user ()->can ('interactivesolutions_honeycomb_e_commerce_goods_e_commerce_goods_types_update')) {
            $config['actions'][] = 'update';
            $config['actions'][] = 'restore';
        }

        if (auth ()->user ()->can ('interactivesolutions_honeycomb_e_commerce_goods_e_commerce_goods_types_delete'))
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
            'translations.{lang}.description'     => [
                "type"  => "text",
                "label" => trans ('HCECommerceGoods::e_commerce_goods_types.description'),
            ],
            'translations.{lang}.slug'            => [
                "type"  => "text",
                "label" => trans ('HCECommerceGoods::e_commerce_goods_types.slug'),
            ],
            'translations.{lang}.label'           => [
                "type"  => "text",
                "label" => trans ('HCECommerceGoods::e_commerce_goods_types.label'),
            ],
            'translations.{lang}.seo_title'       => [
                "type"  => "text",
                "label" => trans ('HCECommerceGoods::e_commerce_goods_types.seo_title'),
            ],
            'translations.{lang}.seo_description' => [
                "type"  => "text",
                "label" => trans ('HCECommerceGoods::e_commerce_goods_types.seo_description'),
            ],
            'translations.{lang}.seo_keywords'    => [
                "type"  => "text",
                "label" => trans ('HCECommerceGoods::e_commerce_goods_types.seo_keywords'),
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

        $record = HCECTypes::create (array_get ($data, 'record', []));
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
        (new HCECTypesValidator())->validateForm ();
        (new HCECTypesTranslationsValidator())->validateForm ();

        $_data = request ()->all ();

        if (array_has ($_data, 'id'))
            array_set ($data, 'record.id', array_get ($_data, 'id'));

        $translations = array_get ($_data, 'translations');

        foreach ($translations as &$value) {
            if (!isset($value['slug']) || $value['slug'] == "")
                $value['slug'] = generateHCSlug ('e-commerce-types', $value['label']);
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

        $select = HCECTypes::getFillableFields (true);

        $record = HCECTypes::with ($with)
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
        $record = HCECTypes::findOrFail ($id);

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
        HCECTypes::where ('id', $id)->update (request ()->all ());

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
        HCECTypesTranslations::destroy (HCECTypesTranslations::whereIn ('record_id', $list)->pluck ('id')->toArray ());
        HCECTypes::destroy ($list);

        return hcSuccess();
    }

    /**
     * Delete records table
     *
     * @param $list
     * @return mixed
     */
    protected function __apiForceDelete (array $list)
    {
        HCECTypesTranslations::onlyTrashed ()->whereIn ('record_id', $list)->forceDelete ();
        HCECTypes::onlyTrashed ()->whereIn ('id', $list)->forceDelete ();

        return hcSuccess();
    }

    /**
     * Restore multiple records
     *
     * @param $list
     * @return mixed
     */
    protected function __apiRestore (array $list)
    {
        HCECTypesTranslations::onlyTrashed ()->whereIn ('record_id', $list)->restore ();
        HCECTypes::whereIn ('id', $list)->restore ();

        return hcSuccess();
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
            $select = HCECTypes::getFillableFields ();

        $list = HCECTypes::with ($with)->select ($select)
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
        $r = HCECTypes::getTableName ();
        $t = HCECTypesTranslations::getTableName ();

        $query->where (function (Builder $query) use ($phrase) {
            $query;
        });

        return $query->join ($t, "$r.id", "=", "$t.record_id")
                     ->where ('description', 'LIKE', '%' . $phrase . '%')
                     ->orWhere ('slug', 'LIKE', '%' . $phrase . '%')
                     ->orWhere ('label', 'LIKE', '%' . $phrase . '%')
                     ->orWhere ('seo_title', 'LIKE', '%' . $phrase . '%')
                     ->orWhere ('seo_description', 'LIKE', '%' . $phrase . '%')
                     ->orWhere ('seo_keywords', 'LIKE', '%' . $phrase . '%');
    }
}
