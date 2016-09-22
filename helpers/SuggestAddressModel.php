<?php
/**
 * @author Semenov Alexander <semenov@skeeks.com>
 * @link http://skeeks.com/
 * @copyright 2010 SkeekS (�����)
 * @date 22.09.2016
 */
namespace skeeks\yii2\dadataSuggestApi\helpers;

use yii\base\Model;
use yii\helpers\ArrayHelper;

/**
 * @see https://dadata.ru/api/suggest/#response-address;
 *
 * {
    "suggestions": [
        {
            "value": "� ������, �� �����������",
            "unrestricted_value": "� ������, �� �����������",
            "data": {
                "postal_code": null,
                "country": "������",
                "region_fias_id": "0c5b2444-70a0-4932-980c-b4dc0d3f02b5",
                "region_kladr_id": "7700000000000",
                "region_with_type": "� ������",
                "region_type": "�",
                "region_type_full": "�����",
                "region": "������",
                "area_fias_id": null,
                "area_kladr_id": null,
                "area_with_type": null,
                "area_type": null,
                "area_type_full": null,
                "area": null,
                "city_fias_id": "0c5b2444-70a0-4932-980c-b4dc0d3f02b5",
                "city_kladr_id": "7700000000000",
                "city_with_type": "� ������",
                "city_type": "�",
                "city_type_full": "�����",
                "city": "������",
                "city_area": null,
                "city_district": null,
                "settlement_fias_id": null,
                "settlement_kladr_id": null,
                "settlement_with_type": null,
                "settlement_type": null,
                "settlement_type_full": null,
                "settlement": null,
                "street_fias_id": "32fcb102-2a50-44c9-a00e-806420f448ea",
                "street_kladr_id": "77000000000713400",
                "street_with_type": "�� �����������",
                "street_type": "��",
                "street_type_full": "�����",
                "street": "�����������",
                "house_fias_id": null,
                "house_kladr_id": null,
                "house_type": null,
                "house_type_full": null,
                "house": null,
                "block_type": null,
                "block_type_full": null,
                "block": null,
                "flat_type": null,
                "flat_type_full": null,
                "flat": null,
                "flat_area": null,
                "square_meter_price": null,
                "flat_price": null,
                "postal_box": null,
                "fias_id": "32fcb102-2a50-44c9-a00e-806420f448ea",
                "fias_level": "7",
                "kladr_id": "77000000000713400",
                "capital_marker": "0",
                "okato": "45263564000",
                "oktmo": "45305000",
                "tax_office": "7718",
                "tax_office_legal": "7718",
                "timezone": null,
                "geo_lat": null,
                "geo_lon": null,
                "beltway_hit": null,
                "beltway_distance": null,
                "qc_geo": null,
                "qc_complete": null,
                "qc_house": null,
                "unparsed_parts": null,
                "qc": null
            }
        },
        ...
    ]
}
 *
 * @property string $unrestrictedValue
 *
 * Class SuggestAddressModel
 * @package skeeks\yii2\dadataSuggestApi\helpers
 */
class SuggestAddressModel extends Model
{
    /**
     * @var string ����� ����� ������� (��� ������������ � ������ ���������)
     */
    public $value;

    /**
     * @var string ����� ����� ������� (������, �� �������)
     */
    public $unrestricted_value;

    /**
     * @var
     */
    public $data;

    /**
     * @return string ����� ����� ������� (������, �� �������)
     */
    public function getUnrestrictedValue()
    {
        if ($this->unrestricted_value)
        {
            return $this->unrestricted_value;
        }

        //��� ����� ���� �� ��������� ���� ���������� �� ip
        $result = [];

        $result[] = ArrayHelper::getValue($this->data, 'region_with_type');
        $result[] = ArrayHelper::getValue($this->data, 'area_with_type');
        $result[] = ArrayHelper::getValue($this->data, 'city_with_type');
        $result[] = ArrayHelper::getValue($this->data, 'settlement_with_type');
        $result[] = ArrayHelper::getValue($this->data, 'street_with_type');

        $result = array_unique($result);

        foreach ($result as $key => $value)
        {
            if (!$value)
            {
                unset($result[$key]);
            }
        }

        return implode(", ", $result);
    }
}