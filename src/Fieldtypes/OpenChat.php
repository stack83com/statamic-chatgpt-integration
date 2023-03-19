<?php

namespace Stack83\StatamicChatGPT\Fieldtypes;

use Statamic\Fields\Fieldtype;

class OpenChat extends Fieldtype
{
    /**
     * @return string
     */
    public static function title()
    {
        return 'OpenAI';
    }
}
