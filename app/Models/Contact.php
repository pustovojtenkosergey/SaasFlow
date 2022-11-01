<?php

namespace App\Models;

use App\Infrastructure\Repo\CountryRepository;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property string|null $name
 * @property string|null $company_name
 * @property string|null $address_line_1
 * @property string|null $address_line_2
 * @property string|null $address_line_3
 * @property string|null $city
 * @property string|null $state
 * @property string|null $zip
 * @property string|null $country
 * @property string|null $phone
 * @property string|null $email
 * @method static self  where($field, $value)
 * @method self|null  first()
 */
class Contact extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function packages()
    {
        return $this->hasMany(Package::class);
    }

    /**
     * @deprecated
     */
    public function getFullCountry(): string
    {
        return app(CountryRepository::class)->getNameByAlpha2($this->country) ?? '';
    }
}
