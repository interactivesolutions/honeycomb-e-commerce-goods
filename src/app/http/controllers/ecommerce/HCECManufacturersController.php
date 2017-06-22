<?php namespace interactivesolutions\honeycombecommercegoods\app\http\controllers\ecommerce;

use Illuminate\Database\Eloquent\Builder;
use interactivesolutions\honeycombcore\http\controllers\HCBaseController;
use interactivesolutions\honeycombecommercegoods\app\models\ecommerce\HCECManufacturers;
use interactivesolutions\honeycombecommercegoods\app\models\ecommerce\HCECManufacturersTranslations;
use interactivesolutions\honeycombecommercegoods\app\validators\ecommerce\HCECManufacturersTranslationsValidator;
use interactivesolutions\honeycombecommercegoods\app\validators\ecommerce\HCECManufacturersValidator;

class HCECManufacturersController extends HCBaseController
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
            'title'       => trans ('HCECommerceGoods::e_commerce_manufacturers.page_title'),
            'listURL'     => route ('admin.api.e.commerce.manufacturers'),
            'newFormUrl'  => route ('admin.api.form-manager', ['e-commerce-manufacturers-new']),
            'editFormUrl' => route ('admin.api.form-manager', ['e-commerce-manufacturers-edit']),
            'imagesUrl'   => route ('resource.get', ['/']),
            'headers'     => $this->getAdminListHeader (),
        ];

        if (auth ()->user ()->can ('interactivesolutions_honeycomb_e_commerce_goods_e_commerce_manufacturers_create'))
            $config['actions'][] = 'new';

        if (auth ()->user ()->can ('interactivesolutions_honeycomb_e_commerce_goods_e_commerce_manufacturers_update')) {
            $config['actions'][] = 'update';
            $config['actions'][] = 'restore';
        }

        if (auth ()->user ()->can ('interactivesolutions_honeycomb_e_commerce_goods_e_commerce_manufacturers_delete'))
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
            'logo_id' => [
                "type"  => "image",
                "label" => trans ('HCECommerceGoods::e_commerce_manufacturers.logo_id'),
            ],
            'name'    => [
                "type"  => "text",
                "label" => trans ('HCECommerceGoods::e_commerce_manufacturers.name'),
            ],
            'slug'    => [
                "type"  => "text",
                "label" => trans ('HCECommerceGoods::e_commerce_manufacturers.slug'),
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

        $record = HCECManufacturers::create (array_get ($data, 'record'));
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
        (new HCECManufacturersValidator())->validateForm ();
        (new HCECManufacturersTranslationsValidator())->validateForm ();

        $_data = request ()->all ();

        if (array_has ($_data, 'id'))
            array_set ($data, 'record.id', array_get ($_data, 'id'));

        array_set ($data, 'record.logo_id', array_get ($_data, 'logo_id'));
        array_set ($data, 'record.name', array_get ($_data, 'name'));
        array_set ($data, 'record.slug', generateHCSlug ('manufacturers', array_get ($_data, 'name')));

        $translations = array_get ($_data, 'translations', []);

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

        $select = HCECManufacturers::getFillableFields (true);

        $record = HCECManufacturers::with ($with)
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
        $record = HCECManufacturers::findOrFail ($id);

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
        HCECManufacturers::where ('id', $id)->update (request ()->all ());

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
        HCECManufacturersTranslations::destroy (HCECManufacturersTranslations::whereIn ('record_id', $list)->pluck ('id')->toArray ());
        HCECManufacturers::destroy ($list);
    }

    /**
     * Delete records table
     *
     * @param $list
     * @return mixed|void
     */
    protected function __apiForceDelete (array $list)
    {
        HCECManufacturersTranslations::onlyTrashed ()->whereIn ('record_id', $list)->forceDelete ();
        HCECManufacturers::onlyTrashed ()->whereIn ('id', $list)->forceDelete ();
    }

    /**
     * Restore multiple records
     *
     * @param $list
     * @return mixed|void
     */
    protected function __apiRestore (array $list)
    {
        HCECManufacturersTranslations::onlyTrashed ()->whereIn ('record_id', $list)->restore ();
        HCECManufacturers::whereIn ('id', $list)->restore ();
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
            $select = HCECManufacturers::getFillableFields ();

        $list = HCECManufacturers::with ($with)
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
        $r = HCECManufacturers::getTableName ();
        $t = HCECManufacturersTranslations::getTableName ();

        $query->where (function (Builder $query) use ($phrase) {
            $query->where ('logo_id', 'LIKE', '%' . $phrase . '%')
                  ->orWhere ('name', 'LIKE', '%' . $phrase . '%')
                  ->orWhere ('slug', 'LIKE', '%' . $phrase . '%');
        });

        return $query->join ($t, "$r.id", "=", "$t.record_id")
                     ->where ('description', 'LIKE', '%' . $phrase . '%')
                     ->orWhere ('seo_title', 'LIKE', '%' . $phrase . '%')
                     ->orWhere ('seo_description', 'LIKE', '%' . $phrase . '%')
                     ->orWhere ('seo_keywords', 'LIKE', '%' . $phrase . '%');
    }
}
