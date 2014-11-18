<?php
namespace Craft;

class SitemapModel extends BaseModel
{
    protected function defineAttributes()
    {
        return array(
            'id'    => AttributeType::Number,
            'sectionId' => array(AttributeType::Number, 'required' => true),
            'included'  => AttributeType::Bool,
            'frequency' => array(AttributeType::Enum, 'values' => 'day,week,month'),
            'priority'  => AttributeType::Number
        );
    }
}