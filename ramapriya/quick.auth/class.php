<?php

use Bitrix\Main\Engine\Contract\Controllerable;
use Bitrix\Main\Engine\ActionFilter;
use Bitrix\Main\Context;
use Bitrix\Main\Loader;
use Bitrix\Main\Localization\Loc;
use Bitrix\Main\SystemException;

Loc::loadMessages(__FILE__);

class QuickAuthComponent extends CBitrixComponent implements Controllerable {

    public function configureActions() {

    }

    public function executeComponent() {

        $this->arResult['extensions'] = $this->getExtensions();
        $this->arResult['select_user_component_params'] = $this->getSelectUserComponentParams('select_user');
        $this->IncludeComponentTemplate();

    }

    private function authorize($userId) {

        $USER = new CUser;

        if($USER->Authorize($userId)) {
            return true;
        } else {
            throw new SystemException('Ошибка авторизации');
        }

    }

    public function sendUserIdAction() {

        $request = Context::getCurrent()->getRequest();

        if(!$request['user']) {

            $result = [
                'result' => 'error',
                'error_description' => Loc::getMessage('QA_AJAX_RESPONSE_ERROR_DESCRIPTION')
            ];

        }

        $userId = (int) $request['user'];

        try {
            if($this->authorize($userId)) {
                $result = [
                    'result' => 'success'
                ];
            }
        } catch(SystemException $e) {
            $result = [
                'result' => 'error',
                'error_description' => $e->getMessage()
            ];
        }

        return $result;

    }

    public function getExtensions() {
        return [
            'ui.buttons',
            'ui.forms',
            'ui.alerts'
        ];
    }

    public function getSelectUserComponentParams($id) {
        return [
            'ID' => $id,
            'API_VERSION' => 3,
            'INPUT_NAME' => $id,
            'SELECTOR_OPTIONS' => [
                'departmentSelectDisable' => 'Y',
                'context' => strtoupper($id),
                'contextCode' => 'U',
                'enableAll' => 'N',
                'userSearchArea' => 'I',
                'allowUserSearch' => 'Y'
            ]            
        ];
    }

}