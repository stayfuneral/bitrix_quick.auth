<?php

defined('B_PROLOG_INCLUDED') || die();

use Bitrix\Main\Localization\Loc;
use Bitrix\Main\UI\Extension;

Loc::loadMessages(__FILE__);

$APPLICATION->SetTitle(Loc::getMessage('QA_COMPONENT_NAME'));

foreach($arResult['extensions'] as $ext) {
    Extension::load($ext);
}

?>
<p><?=Loc::getMessage('QA_SELECT_USER_TEXT')?></p>
<div class="ui-ctl ui-ctl-w25 form-data">
<?php
        $APPLICATION->IncludeComponent('bitrix:main.user.selector', '', $arResult['select_user_component_params']);
?>    
</div>
<div class="ui-ctl ui-ctl-w25 form-data">
        <button id="authorize" class="ui-btn ui-btn-primary"><?=Loc::getMessage('QA_BUTTON_TEXT')?></button>    
</div>




