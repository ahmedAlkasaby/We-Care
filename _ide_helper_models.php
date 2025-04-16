<?php

// @formatter:off
// phpcs:ignoreFile
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int $case_id
 * @property string|null $code_name
 * @property string|null $national_number
 * @property string|null $condition
 * @property string|null $type_of_aid
 * @property int|null $number_of_peaple
 * @property string|null $government
 * @property string|null $city
 * @property string|null $area
 * @property string|null $street
 * @property string|null $district
 * @property string|null $building
 * @property string|null $floor
 * @property string|null $apartment
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property $name
 * @property $description
 * @property-read \App\Models\CharityCase $case
 * @method static \Illuminate\Database\Eloquent\Builder|CaseDetail newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CaseDetail newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CaseDetail query()
 * @method static \Illuminate\Database\Eloquent\Builder|CaseDetail whereApartment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CaseDetail whereArea($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CaseDetail whereBuilding($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CaseDetail whereCaseId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CaseDetail whereCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CaseDetail whereCodeName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CaseDetail whereCondition($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CaseDetail whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CaseDetail whereDistrict($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CaseDetail whereFloor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CaseDetail whereGovernment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CaseDetail whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CaseDetail whereNationalNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CaseDetail whereNumberOfPeaple($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CaseDetail whereStreet($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CaseDetail whereTypeOfAid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CaseDetail whereUpdatedAt($value)
 */
	class CaseDetail extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property $name
 * @property $description
 * @property int|null $parent_category
 * @property int $active
 * @property string|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Category> $children
 * @property-read int|null $children_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Item> $items
 * @property-read int|null $items_count
 * @property-read Category|null $parent
 * @method static \Database\Factories\CategoryFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Category filter($search = null)
 * @method static \Illuminate\Database\Eloquent\Builder|Category newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Category newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Category query()
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereParentCategory($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereUpdatedAt($value)
 */
	class Category extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property $name
 * @property $description
 * @property int $active
 * @property string|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\CharityCase> $cases
 * @property-read int|null $cases_count
 * @method static \Database\Factories\CategoryCaseFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|CategoryCase filter($search = null)
 * @method static \Illuminate\Database\Eloquent\Builder|CategoryCase newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CategoryCase newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CategoryCase query()
 * @method static \Illuminate\Database\Eloquent\Builder|CategoryCase whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CategoryCase whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CategoryCase whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CategoryCase whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CategoryCase whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CategoryCase whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CategoryCase whereUpdatedAt($value)
 */
	class CategoryCase extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int|null $volunteer_id
 * @property int|null $category_case_id
 * @property int $user_id
 * @property $name
 * @property $description
 * @property string $type
 * @property string $priority
 * @property string $repeating
 * @property string|null $next_donation_date
 * @property int $active
 * @property string $date_start
 * @property string|null $date_end
 * @property string $price
 * @property string $price_raised
 * @property int $archive
 * @property int $is_event
 * @property int $done
 * @property int|null $order_no
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property-read \App\Models\CategoryCase|null $category
 * @property-read \App\Models\CaseDetail|null $details
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Donation> $donations
 * @property-read int|null $donations_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Image> $images
 * @property-read int|null $images_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Item> $items
 * @property-read int|null $items_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Transfer> $transfers
 * @property-read int|null $transfers_count
 * @property-read \App\Models\User $user
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\User> $users
 * @property-read int|null $users_count
 * @property-read \App\Models\User|null $volunteer
 * @method static \Illuminate\Database\Eloquent\Builder|CharityCase apiFilter($filters)
 * @method static \Illuminate\Database\Eloquent\Builder|CharityCase filter($search = null, $volunteer_id = null, $category_case_id = null, $priority = null, $repeating = null, $next_donation_date = null, $date_end = null, $active = null, $city_id = null, $region_id = null, $price = null, $price_raised = null, $has_items = null, $price_need = null, $is_event = null, $status = null)
 * @method static \Illuminate\Database\Eloquent\Builder|CharityCase newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CharityCase newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CharityCase query()
 * @method static \Illuminate\Database\Eloquent\Builder|CharityCase whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CharityCase whereArchive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CharityCase whereCategoryCaseId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CharityCase whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CharityCase whereDateEnd($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CharityCase whereDateStart($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CharityCase whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CharityCase whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CharityCase whereDone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CharityCase whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CharityCase whereIsEvent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CharityCase whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CharityCase whereNextDonationDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CharityCase whereOrderNo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CharityCase wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CharityCase wherePriceRaised($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CharityCase wherePriority($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CharityCase whereRepeating($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CharityCase whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CharityCase whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CharityCase whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CharityCase whereVolunteerId($value)
 */
	class CharityCase extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property $name
 * @property int $active
 * @property string|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property $description
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Region> $regions
 * @property-read int|null $regions_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\User> $users
 * @property-read int|null $users_count
 * @method static \Database\Factories\CityFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|City filter($search = null)
 * @method static \Illuminate\Database\Eloquent\Builder|City newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|City newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|City query()
 * @method static \Illuminate\Database\Eloquent\Builder|City whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|City whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|City whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|City whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|City whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|City whereUpdatedAt($value)
 */
	class City extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int $user_id
 * @property string $token
 * @property string $device_type
 * @property string $imei
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|Device newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Device newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Device query()
 * @method static \Illuminate\Database\Eloquent\Builder|Device whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Device whereDeviceType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Device whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Device whereImei($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Device whereToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Device whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Device whereUserId($value)
 */
	class Device extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int $doner_id
 * @property int|null $case_id
 * @property int $payment_id
 * @property string $price
 * @property string $doner_price
 * @property string $type
 * @property int $confirm
 * @property int $archive
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property $name
 * @property $description
 * @property-read \App\Models\CharityCase|null $case
 * @property-read \App\Models\User $doner
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Image> $images
 * @property-read int|null $images_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Item> $items
 * @property-read int|null $items_count
 * @method static \Illuminate\Database\Eloquent\Builder|Donation filter($doner_id = null, $price = null, $price_doner = null, $has_items = null, $case_id = null, $this_year = null, $this_month = null)
 * @method static \Illuminate\Database\Eloquent\Builder|Donation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Donation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Donation query()
 * @method static \Illuminate\Database\Eloquent\Builder|Donation whereArchive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Donation whereCaseId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Donation whereConfirm($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Donation whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Donation whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Donation whereDonerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Donation whereDonerPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Donation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Donation wherePaymentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Donation wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Donation whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Donation whereUpdatedAt($value)
 */
	class Donation extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property $name
 * @property $description
 * @property int $active
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Database\Factories\FaqFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Faq filter($search = null, $trashed = false)
 * @method static \Illuminate\Database\Eloquent\Builder|Faq newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Faq newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Faq onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Faq query()
 * @method static \Illuminate\Database\Eloquent\Builder|Faq whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Faq whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Faq whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Faq whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Faq whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Faq whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Faq whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Faq withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Faq withoutTrashed()
 */
	class Faq extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $image
 * @property string $imageable_type
 * @property int $imageable_id
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property $name
 * @property $description
 * @property-read \Illuminate\Database\Eloquent\Model|\Eloquent $imageable
 * @method static \Illuminate\Database\Eloquent\Builder|Image newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Image newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Image onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Image query()
 * @method static \Illuminate\Database\Eloquent\Builder|Image whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Image whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Image whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Image whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Image whereImageableId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Image whereImageableType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Image whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Image withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Image withoutTrashed()
 */
	class Image extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string|null $video
 * @property int|null $case_id
 * @property $name
 * @property $description
 * @property int $active
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\CharityCase|null $case
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Image> $images
 * @property-read int|null $images_count
 * @method static \Illuminate\Database\Eloquent\Builder|Impact apiFilter($filters)
 * @method static \Illuminate\Database\Eloquent\Builder|Impact filter($search = null, $trashed = null)
 * @method static \Illuminate\Database\Eloquent\Builder|Impact newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Impact newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Impact onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Impact query()
 * @method static \Illuminate\Database\Eloquent\Builder|Impact whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Impact whereCaseId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Impact whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Impact whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Impact whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Impact whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Impact whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Impact whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Impact whereVideo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Impact withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Impact withoutTrashed()
 */
	class Impact extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property $name
 * @property $description
 * @property string $price
 * @property int $category_id
 * @property string $amount
 * @property int $active
 * @property string|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\CharityCase> $cases
 * @property-read int|null $cases_count
 * @property-read \App\Models\Category $category
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Donation> $donations
 * @property-read int|null $donations_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Purchase> $purchases
 * @property-read int|null $purchases_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Transfer> $transfers
 * @property-read int|null $transfers_count
 * @method static \Database\Factories\ItemFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Item filter($search = null, $category_id = null)
 * @method static \Illuminate\Database\Eloquent\Builder|Item newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Item newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Item query()
 * @method static \Illuminate\Database\Eloquent\Builder|Item whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Item whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Item whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Item whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Item whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Item whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Item whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Item whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Item wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Item whereUpdatedAt($value)
 */
	class Item extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $name
 * @property string|null $description
 * @property string $model_type
 * @property int $model_id
 * @property int|null $user_id
 * @property array|null $properties
 * @property string $action
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Model|\Eloquent $model
 * @property-read \App\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|Log newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Log newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Log query()
 * @method static \Illuminate\Database\Eloquent\Builder|Log whereAction($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Log whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Log whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Log whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Log whereModelId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Log whereModelType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Log whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Log whereProperties($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Log whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Log whereUserId($value)
 */
	class Log extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property $name
 * @property $description
 * @method static \Illuminate\Database\Eloquent\Builder|MainModel newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|MainModel newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|MainModel query()
 */
	class MainModel extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property $name
 * @property string|null $phone
 * @property string|null $email
 * @property string $message
 * @property int $read
 * @property string|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property $description
 * @method static \Illuminate\Database\Eloquent\Builder|Message filter($search = null)
 * @method static \Illuminate\Database\Eloquent\Builder|Message newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Message newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Message query()
 * @method static \Illuminate\Database\Eloquent\Builder|Message whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Message whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Message whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Message whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Message whereMessage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Message whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Message wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Message whereRead($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Message whereUpdatedAt($value)
 */
	class Message extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $type
 * @property string $notifiable_type
 * @property int $notifiable_id
 * @property string $data
 * @property string|null $read_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Notification newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Notification newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Notification query()
 * @method static \Illuminate\Database\Eloquent\Builder|Notification whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Notification whereData($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Notification whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Notification whereNotifiableId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Notification whereNotifiableType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Notification whereReadAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Notification whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Notification whereUpdatedAt($value)
 */
	class Notification extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property $name
 * @property $description
 * @property int $active
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Page filter($search = null, $trashed = false)
 * @method static \Illuminate\Database\Eloquent\Builder|Page newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Page newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Page onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Page query()
 * @method static \Illuminate\Database\Eloquent\Builder|Page whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Page whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Page whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Page whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Page whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Page whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Page whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Page withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Page withoutTrashed()
 */
	class Page extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property $name
 * @property int $active
 * @property string|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property $description
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Donation> $donations
 * @property-read int|null $donations_count
 * @method static \Illuminate\Database\Eloquent\Builder|Payment filter($search = null)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Payment newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Payment query()
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereUpdatedAt($value)
 */
	class Payment extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $name
 * @property string|null $display_name
 * @property string|null $description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Role> $roles
 * @property-read int|null $roles_count
 * @method static \Illuminate\Database\Eloquent\Builder|Permission newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Permission newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Permission query()
 * @method static \Illuminate\Database\Eloquent\Builder|Permission whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Permission whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Permission whereDisplayName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Permission whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Permission whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Permission whereUpdatedAt($value)
 */
	class Permission extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $total_price
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property $name
 * @property $description
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Item> $items
 * @property-read int|null $items_count
 * @method static \Illuminate\Database\Eloquent\Builder|Purchase newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Purchase newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Purchase query()
 * @method static \Illuminate\Database\Eloquent\Builder|Purchase whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Purchase whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Purchase whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Purchase whereTotalPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Purchase whereUpdatedAt($value)
 */
	class Purchase extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property $name
 * @property int $city_id
 * @property int $active
 * @property string|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property $description
 * @property-read \App\Models\City $city
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\User> $users
 * @property-read int|null $users_count
 * @method static \Database\Factories\RegionFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Region filter($search = null)
 * @method static \Illuminate\Database\Eloquent\Builder|Region newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Region newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Region query()
 * @method static \Illuminate\Database\Eloquent\Builder|Region whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Region whereCityId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Region whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Region whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Region whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Region whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Region whereUpdatedAt($value)
 */
	class Region extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $name
 * @property string|null $display_name
 * @property string|null $description
 * @property int $is_admin
 * @property int $active
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Permission> $permissions
 * @property-read int|null $permissions_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\User> $users
 * @property-read int|null $users_count
 * @method static \Illuminate\Database\Eloquent\Builder|Role newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Role newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Role query()
 * @method static \Illuminate\Database\Eloquent\Builder|Role whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Role whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Role whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Role whereDisplayName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Role whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Role whereIsAdmin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Role whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Role whereUpdatedAt($value)
 */
	class Role extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $site_title
 * @property string $site_phone
 * @property string|null $site_email
 * @property string|null $facebook
 * @property string|null $twitter
 * @property string|null $instagram
 * @property string|null $gmail
 * @property string|null $linkedin
 * @property int|null $whatsapp
 * @property string $site_language
 * @property string|null $address
 * @property int $active
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property $name
 * @property $description
 * @method static \Illuminate\Database\Eloquent\Builder|Setting newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Setting newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Setting query()
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereFacebook($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereGmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereInstagram($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereLinkedin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereSiteEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereSiteLanguage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereSitePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereSiteTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereTwitter($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereWhatsapp($value)
 */
	class Setting extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $image
 * @property int|null $case_id
 * @property $name
 * @property $description
 * @property int $active
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\CharityCase|null $case
 * @method static \Database\Factories\SliderFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Slider filter($search = null, $trashed = false)
 * @method static \Illuminate\Database\Eloquent\Builder|Slider newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Slider newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Slider onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Slider query()
 * @method static \Illuminate\Database\Eloquent\Builder|Slider whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Slider whereCaseId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Slider whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Slider whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Slider whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Slider whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Slider whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Slider whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Slider whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Slider withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Slider withoutTrashed()
 */
	class Slider extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $price
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property $name
 * @property $description
 * @method static \Illuminate\Database\Eloquent\Builder|Storage newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Storage newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Storage query()
 * @method static \Illuminate\Database\Eloquent\Builder|Storage whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Storage whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Storage wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Storage whereUpdatedAt($value)
 */
	class Storage extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int|null $donation_id
 * @property int $case_id
 * @property string $price
 * @property string $type
 * @property int $archive
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property $name
 * @property $description
 * @property-read \App\Models\CharityCase $case
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Item> $items
 * @property-read int|null $items_count
 * @method static \Illuminate\Database\Eloquent\Builder|Transfer filter($search = null)
 * @method static \Illuminate\Database\Eloquent\Builder|Transfer newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Transfer newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Transfer query()
 * @method static \Illuminate\Database\Eloquent\Builder|Transfer whereArchive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transfer whereCaseId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transfer whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transfer whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transfer whereDonationId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transfer whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transfer wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transfer whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transfer whereUpdatedAt($value)
 */
	class Transfer extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $email
 * @property string|null $phone
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property \Illuminate\Support\Carbon|null $phone_verified_at
 * @property mixed|null $password
 * @property string $lang
 * @property int $theme
 * @property string $image
 * @property int $is_admin
 * @property string $role
 * @property string|null $gender
 * @property string $amount
 * @property int $cases
 * @property int|null $city_id
 * @property int|null $region_id
 * @property string|null $address
 * @property string|null $latitude
 * @property string|null $longitude
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\CharityCase> $CharityCases
 * @property-read int|null $charity_cases_count
 * @property-read \App\Models\City|null $city
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Device> $devices
 * @property-read int|null $devices_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Donation> $donations
 * @property-read int|null $donations_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\CharityCase> $likeCases
 * @property-read int|null $like_cases_count
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Permission> $permissions
 * @property-read int|null $permissions_count
 * @property-read \App\Models\Region|null $region
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Role> $roles
 * @property-read int|null $roles_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Laravel\Sanctum\PersonalAccessToken> $tokens
 * @property-read int|null $tokens_count
 * @method static \Database\Factories\UserFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|User filter($search = null)
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User orWhereHasPermission(\BackedEnum|array|string $permission = '', ?mixed $team = null)
 * @method static \Illuminate\Database\Eloquent\Builder|User orWhereHasRole(\BackedEnum|array|string $role = '', ?mixed $team = null)
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCases($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCityId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereDoesntHavePermissions()
 * @method static \Illuminate\Database\Eloquent\Builder|User whereDoesntHaveRoles()
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereGender($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereHasPermission(\BackedEnum|array|string $permission = '', ?mixed $team = null, string $boolean = 'and')
 * @method static \Illuminate\Database\Eloquent\Builder|User whereHasRole(\BackedEnum|array|string $role = '', ?mixed $team = null, string $boolean = 'and')
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereIsAdmin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereLang($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereLatitude($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereLongitude($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePhoneVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRegionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRole($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereTheme($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 */
	class User extends \Eloquent implements \Laratrust\Contracts\LaratrustUser, \Tymon\JWTAuth\Contracts\JWTSubject {}
}

