<?php namespace interactivesolutions\honeycombecommercegoods\app\http\controllers\ecommerce;

use Illuminate\Database\Eloquent\Builder;
use interactivesolutions\honeycombcore\http\controllers\HCBaseController;
use interactivesolutions\honeycombecommercegoods\app\models\ecommerce\HCECTaxes;
use interactivesolutions\honeycombecommercegoods\app\models\ecommerce\HCECTaxesTranslations;
use interactivesolutions\honeycombecommercegoods\app\validators\ecommerce\HCECTaxesTranslationsValidator;
use interactivesolutions\honeycombecommercegoods\app\validators\ecommerce\HCECTaxesValidator;

class HCECTaxesController extends HCBaseController
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
            'title'       => trans ('HCECommerceGoods::e_commerce_taxes.page_title'),
            'listURL'     => route ('admin.api.e.commerce.taxes'),
            'newFormUrl'  => route ('admin.api.form-manager', ['e-commerce-taxes-new']),
            'editFormUrl' => route ('admin.api.form-manager', ['e-commerce-taxes-edit']),
            'imagesUrl'   => route ('resource.get', ['/']),
            'headers'     => $this->getAdminListHeader (),
        ];

        if (auth ()->user ()->can ('interactivesolutions_honeycomb_e_commerce_goods_e_commerce_taxes_create'))
            $config['actions'][] = 'new';

        if (auth ()->user ()->can ('interactivesolutions_honeycomb_e_commerce_goods_e_commerce_taxes_update')) {
            $config['actions'][] = 'update';
            $config['actions'][] = 'restore';
        }

        if (auth ()->user ()->can ('interactivesolutions_honeycomb_e_commerce_goods_e_commerce_taxes_delete'))
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
            'value'                           => [
                "type"  => "text",
                "label" => trans ('HCECommerceGoods::e_commerce_taxes.value'),
            ],
            'country_id'               => [
                "type"  => "text",
                "label" => trans ('HCECommerceGoods::e_commerce_taxes.country_id'),
            ],
            'translations.{lang}.label'       => [
                "type"  => "text",
                "label" => trans ('HCECommerceGoods::e_commerce_taxes.label'),
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

        $record = HCECTaxes::create (array_get ($data, 'record'));
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
        (new HCECTaxesValidator())->validateForm ();
        (new HCECTaxesTranslationsValidator())->validateForm ();

        $_data = request ()->all ();

        if (array_has ($_data, 'id'))
            array_set ($data, 'record.id', array_get ($_data, 'id'));

        array_set ($data, 'record.value', array_get ($_data, 'value'));
        array_set ($data, 'record.country_id', array_get ($_data, 'country_id'));

        $translations = array_get ($_data, 'translations');

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

        $select = HCECTaxes::getFillableFields (true);

        $record = HCECTaxes::with ($with)
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
        $record = HCECTaxes::findOrFail ($id);

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
        HCECTaxes::where ('id', $id)->update (request ()->all ());

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
        HCECTaxesTranslations::destroy (HCECTaxesTranslations::whereIn ('record_id', $list)->pluck ('id')->toArray ());
        HCECTaxes::destroy ($list);
    }

    /**
     * Delete records table
     *
     * @param $list
     * @return mixed|void
     */
    protected function __apiForceDelete (array $list)
    {
        HCECTaxesTranslations::onlyTrashed ()->whereIn ('record_id', $list)->forceDelete ();
        HCECTaxes::onlyTrashed ()->whereIn ('id', $list)->forceDelete ();
    }

    /**
     * Restore multiple records
     *
     * @param $list
     * @return mixed|void
     */
    protected function __apiRestore (array $list)
    {
        HCECTaxesTranslations::onlyTrashed ()->whereIn ('record_id', $list)->restore ();
        HCECTaxes::whereIn ('id', $list)->restore ();
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
            $select = HCECTaxes::getFillableFields ();

        $list = HCECTaxes::with ($with)
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
        $r = HCECTaxes::getTableName ();
        $t = HCECTaxesTranslations::getTableName ();

        $query->where (function (Builder $query) use ($phrase) {
            $query->where ('value', 'LIKE', '%' . $phrase . '%')
                  ->orWhere ('country_id', 'LIKE', '%' . $phrase . '%');
        });

        return $query->join ($t, "$r.id", "=", "$t.record_id")
                     ->where ('description', 'LIKE', '%' . $phrase . '%')
                     ->orWhere ('label', 'LIKE', '%' . $phrase . '%');
    }
}
