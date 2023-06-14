<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'exception' => [
        'message' => 'Kontrollige üle sisestatud andmed!'
    ],

    'accepted'             => ':attribute on vaja nõustuda.',
    'active_url'           => 'Parameeter :attribute ei ole korrektne URL.',
    'after'                => 'Parameeter :attribute peab olema kuupäev pärast :date.',
    'after_or_equal'       => 'Parameeter :attribute peab olema kuupäev pärast või võrdne :date.',
    'alpha'                => 'Parameeter :attribute võib sisaldada ainult tähti.',
    'alpha_dash'           => 'Parameeter :attribute võib sisaldada ainult tähte, numbreid ja kriipsu.',
    'alpha_num'            => 'Parameeter :attribute võib sisaldada ainult tähti ja numbreid.',
    'array'                => 'Parameeter :attribute peab olema masiiv.',
    'before'               => 'Parameeter :attribute peab olema kuupäev enne :date.',
    'before_or_equal'      => 'Parameeter :attribute peab olema kuupäev enne või võrdne :date.',
    'between'              => [
        'numeric' => 'Parameeter :attribute peab olema vahemikus :min ja :max.',
        'file'    => 'Parameeter :attribute peab olema vahemikus :min ja :max kilobaite.',
        'string'  => 'Parameeter :attribute peab olema vahemikus :min ja :max tähemärki.',
        'array'   => 'Masiiv :attribute elementide arv peab olema vahemikus :min ja :max.',
    ],
    'boolean'              => ':attribute väli peab olema tõene või vale.',
    'confirmed'            => 'Parameetri :attribute kinnitus ei klapi.',
    'date'                 => 'Paremeeter :attribute ei ole kehtiv kuupäev.',
    'date_format'          => 'Parameeter :attribute ei vasta vormingule :format.',
    'different'            => 'The :attribute and :other must be different.',
    'digits'               => 'Parameeter :attribute peab olema :digits numbrikohta.',
    'digits_between'       => 'Parameeter :attribute peab olema vahemikus :min ja :max numbrikohta.',
    'dimensions'           => 'The :attribute has invalid image dimensions.',
    'distinct'             => 'The :attribute field has a duplicate value.',
    'email'                => 'Parameeter :attribute peab olema kehtiv e-posti aadress.',
    'exists'               => ':attribute on kehtetu.',
    'file'                 => 'Parameeter :attribute peab olema fail.',
    'filled'               => ':attribute väli on vajalik.',
    'image'                => 'Parameeter :attribute peab olema pilt.',
    'in'                   => 'Valitud parameeter :attribute on kehtetu.',
    'in_array'             => ':attribute väli ei sisalda :other.',
    'integer'              => ':attribute peab olema täisarv.',
    'ip'                   => 'Parameeter :attribute peab olema kehtiv IP-aadress.',
    'json'                 => 'Parameeter :attribute peab olema kehtiv JSON sõne.',
    'max'                  => [
        'numeric' => 'Parameeter :attribute ei tohi olla suurem kui :max.',
        'file'    => 'Parameeter :attribute ei tohi olla suurem kui :max kilobaite.',
        'string'  => 'Parameeter :attribute ei tohi olla suurem kui :max tähemärki.',
        'array'   => 'Masiiv :attribute ei tohi sisaldada rohkem elemente kui :max.',
    ],
    'mimes'                => 'Parameeter :attribute peab olema :values tüübi fail.',
    'mimetypes'            => 'Parameeter :attribute peab olema :values tüübi fail.',
    'min'                  => [
        'numeric' => ':attribute peab olema vähemalt :min.',
        'file'    => ':attribute peab sisaldama vähemalt :min kilobaite.',
        'string'  => ':attribute peab sisaldama vähemalt :min tähemärki.',
        'array'   => ':attribute peab sisaldama vähemalt :min elementi.',
    ],
    'not_in'               => 'The selected :attribute is invalid.',
    'numeric'              => 'Parameeter :attribute peab olema number.',
    'present'              => 'Parameeter :attribute peab eksisteerima.',
    'regex'                => 'Parameetri :attribute formaat on vale.',
    'required'             => ':attribute väli on vajalik.',
    'required_if'          => 'Parameetri :attribute väli on vajalik kui :other on :value.',
    'required_unless'      => 'The :attribute field is required unless :other is in :values.',
    'required_with'        => 'The :attribute field is required when :values is present.',
    'required_with_all'    => 'The :attribute field is required when :values is present.',
    'required_without'     => 'The :attribute field is required when :values is not present.',
    'required_without_all' => 'The :attribute field is required when none of :values are present.',
    'same'                 => 'The :attribute and :other must match.',
    'size'                 => [
        'numeric' => 'The :attribute must be :size.',
        'file'    => 'The :attribute must be :size kilobytes.',
        'string'  => 'The :attribute must be :size characters.',
        'array'   => 'The :attribute must contain :size items.',
    ],
    'string'               => 'Parameeter :attribute peab olema sõne.',
    'timezone'             => 'Parameeter :attribute peab olema kehtiv ajavöönd.',
    'unique'               => 'Parameeter :attribute on juba kasutusel.',
    'uploaded'             => 'Parameeter :attribute ei õnnestunud üleslaadida.',
    'url'                  => 'Parameeter :attribute formaat on vale.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap attribute place-holders
    | with something more reader friendly such as E-Mail Address instead
    | of "email". This simply helps us make messages a little cleaner.
    |
    */

    'attributes' => [
        'project_id'       => 'Objekti',
        'name'       => 'Nime',
        'display_name'       => 'Kuvatava nime',
        'description'       => 'Kirjelduse',
        'permissions'       => 'Õiguste',
        'location'       => 'Asukoha',
        'position_id'       => 'Positsiooni',
        'position_id'       => 'Positsiooni',
        'work_description'  => 'Töö kirjelduse',
        'weather_time'  => 'Ilmastiku kellaaja',
        'weather_temperature'  => 'Ilmastiku temperatuuri',
        'workers'  => 'Töötajate',
    ],

];
