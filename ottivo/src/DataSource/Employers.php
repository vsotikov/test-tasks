<?php
declare(strict_types = 1);

require_once 'Entity/Employer.php';

/**
 * Employers datasource
 */
class Employers extends ArrayObject
{
    private const EMPLOYERS = [
        [
            'name' => 'Hans Mueller',
            'birth_date' => '1950-12-30',
            'contract_start_date' => '2001-01-01',
            'contract_special_vacation_days' => null,
        ],
        [
            'name' => 'Angelika Fringe',
            'birth_date' => '1966-06-09',
            'contract_start_date' => '2001-01-15',
            'contract_special_vacation_days' => null,
        ],
        [
            'name' => 'Peter Klever',
            'birth_date' => '1991-07-12',
            'contract_start_date' => '2016-05-15',
            'contract_special_vacation_days' => 27,
        ],
        [
            'name' => 'Marina Helter',
            'birth_date' => '1970-01-26',
            'contract_start_date' => '2018-01-15',
            'contract_special_vacation_days' => null,
        ],
        [
            'name' => 'Sepp Meier',
            'birth_date' => '1980-05-23',
            'contract_start_date' => '2017-12-01',
            'contract_special_vacation_days' => null,
        ],
    ];

    public function load()
    {
        $this->exchangeArray(array_map(
            static function (array $employerData) {
                return (new Employer())->setFromArray($employerData);
            },
            self::EMPLOYERS
        ));
    }


}