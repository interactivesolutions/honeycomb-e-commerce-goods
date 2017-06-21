<?php namespace interactivesolutions\honeycombecommercegoods\app\http\controllers\ecommerce;

use Illuminate\Database\Eloquent\Builder;
use interactivesolutions\honeycombcore\http\controllers\HCBaseController;
use interactivesolutions\honeycombecommercegoods\app\models\ecommerce\HCECDeposits;
use interactivesolutions\honeycombecommercegoods\app\models\ecommerce\HCECDepositsTranslations;
use interactivesolutions\honeycombecommercegoods\app\validators\ecommerce\HCECDepositsTranslationsValidator;
use interactivesolutions\honeycombecommercegoods\app\validators\ecommerce\HCECDepositsValidator;

class HCECDepositsController extends HCBaseController
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
            'title'       => trans ('HCECommerceGoods::e_commerce_deposits.page_title'),
            'listURL'     => route ('admin.api.e.commerce.deposits'),
            'newFormUrl'  => route ('admin.api.form-manager', ['e-commerce-deposits-new']),
            'editFormUrl' => route ('admin.api.form-manager', ['e-commerce-deposits-edit']),
            'imagesUrl'   => route ('resource.get', ['/']),
            'headers'     => $this->getAdminListHeader (),
        ];

        if (auth ()->user ()->can ('interactivesolutions_honeycomb_e_commerce_goods_e_commerce_deposits_create'))
            $config['actions'][] = 'new';

        if (auth ()->user ()->can ('interactivesolutions_honeycomb_e_commerce_goods_e_commerce_deposits_update')) {
            $config['actions'][] = 'update';
            $config['actions'][] = 'restore';
        }

        if (auth ()->user ()->can ('interactivesolutions_honeycomb_e_commerce_goods_e_commerce_deposits_delete'))
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
                "label" => trans ('HCECommerceGoods::e_commerce_deposits.value'),
            ],
            'country_id'                      => [
                "type"  => "text",
                "label" => trans ('HCECommerceGoods::e_commerce_deposits.country_id'),
            ],
            'translations.{lang}.description' => [
                "type"  => "text",
                "label" => trans ('HCECommerceGoods::e_commerce_deposits.description'),
            ],
            'translations.{lang}.label'       => [
                "type"  => "text",
                "label" => trans ('HCECommerceGoods::e_commerce_deposits.label'),
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

        $record = HCECDeposits::create (array_get ($data, 'record'));
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
        (new HCECDepositsValidator())->validateForm ();
        (new HCECDepositsTranslationsValidator())->validateForm ();

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

        $select = HCECDeposits::getFillableFields (true);

        $record = HCECDeposits::with ($with)
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
        $record = HCECDeposits::findOrFail ($id);

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
        HCECDeposits::where ('id', $id)->update (request ()->all ());

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
        HCECDeposits::destroy ($list);
    }

    /**
     * Delete records table
     *
     * @param $list
     * @return mixed|void
     */
    protected function __apiForceDelete (array $list)
    {
        HCECDeposits::onlyTrashed ()->whereIn ('id', $list)->forceDelete ();
    }

    /**
     * Restore multiple records
     *
     * @param $list
     * @return mixed|void
     */
    protected function __apiRestore (array $list)
    {
        HCECDeposits::whereIn ('id', $list)->restore ();
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
            $select = HCECDeposits::getFillableFields ();

        $list = HCECDeposits::with ($with)
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
        $r = HCECDeposits::getTableName ();
        $t = HCECDepositsTranslations::getTableName ();

        $query->where (function (Builder $query) use ($phrase) {
            $query->where ('value', 'LIKE', '%' . $phrase . '%')
                  ->orWhere ('country_id', 'LIKE', '%' . $phrase . '%');
        });

        return $query->join ($t, "$r.id", "=", "$t.record_id")
                     ->where ('description', 'LIKE', '%' . $phrase . '%')
                     ->orWhere ('label', 'LIKE', '%' . $phrase . '%');
    }
}
