<?php

namespace Webneex\XSDSAT;

use DOMDocument;

class SchemaHelpers {

    public static function validateDom($dom, $schema) {

        if (substr($schema, 0, 2) == './') $schema = __DIR__ . '/../files/' . substr($schema, 2);

        $prev = libxml_use_internal_errors(true);
        libxml_clear_errors();
        if (!@$dom->schemaValidate($schema)) {
            $errors = libxml_get_errors();
            libxml_clear_errors();
            libxml_use_internal_errors($prev);
            return $errors;
        }
        libxml_use_internal_errors($prev);
        return [];
    }

    public static function validateString($string, $schema) {
        $dom = new DOMDocument;
        $dom->loadXML($string);
        return static::validateDom($dom, $schema);
    }
}