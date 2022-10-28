<?php

// @formatter:off
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * Class Customer
 *
 * @package App\Models
 * @version October 15, 2022, 2:44 am UTC
 * @property integer $user_id
 * @property string $name
 * @property string $phone
 * @property string $email
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Database\Factories\CustomerFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Customer newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Customer query()
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereUserId($value)
 */
	class Customer extends \Eloquent {}
}

namespace App\Models{
/**
 * Class Income
 *
 * @package App\Models
 * @version October 15, 2022, 2:45 am UTC
 * @property integer $recipe_id
 * @property integer $customer_id
 * @property number $qty
 * @property number $price
 * @property number $cost
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Database\Factories\IncomeFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Income newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Income newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Income query()
 * @method static \Illuminate\Database\Eloquent\Builder|Income whereCost($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Income whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Income whereCustomerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Income whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Income wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Income whereQty($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Income whereRecipeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Income whereUpdatedAt($value)
 */
	class Income extends \Eloquent {}
}

namespace App\Models{
/**
 * Class Ingredient
 *
 * @package App\Models
 * @version October 15, 2022, 2:42 am UTC
 * @property integer $user_id
 * @property string $description
 * @property number $qty
 * @property integer $measurement_unit_id
 * @property number $price
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\MeasurementUnit $measurementUnit
 * @method static \Database\Factories\IngredientFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Ingredient newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Ingredient newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Ingredient query()
 * @method static \Illuminate\Database\Eloquent\Builder|Ingredient whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ingredient whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ingredient whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ingredient whereMeasurementUnitId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ingredient wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ingredient whereQty($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ingredient whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ingredient whereUserId($value)
 */
	class Ingredient extends \Eloquent {}
}

namespace App\Models{
/**
 * Class Loss
 *
 * @package App\Models
 * @version October 15, 2022, 2:45 am UTC
 * @property integer $recipe_id
 * @property number $qty
 * @property number $cost
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Database\Factories\LossFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Loss newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Loss newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Loss query()
 * @method static \Illuminate\Database\Eloquent\Builder|Loss whereCost($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Loss whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Loss whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Loss whereQty($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Loss whereRecipeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Loss whereUpdatedAt($value)
 */
	class Loss extends \Eloquent {}
}

namespace App\Models{
/**
 * Class MeasurementUnit
 *
 * @package App\Models
 * @version October 15, 2022, 2:38 am UTC
 * @property string $abbreviation
 * @property string $description
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Database\Factories\MeasurementUnitFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|MeasurementUnit newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|MeasurementUnit newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|MeasurementUnit query()
 * @method static \Illuminate\Database\Eloquent\Builder|MeasurementUnit whereAbbreviation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MeasurementUnit whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MeasurementUnit whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MeasurementUnit whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MeasurementUnit whereUpdatedAt($value)
 */
	class MeasurementUnit extends \Eloquent {}
}

namespace App\Models{
/**
 * Class Production
 *
 * @package App\Models
 * @version October 15, 2022, 2:46 am UTC
 * @property integer $recipe_id
 * @property number $qty
 * @property number $cost
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Recipe $recipe
 * @method static \Database\Factories\ProductionFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Production newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Production newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Production query()
 * @method static \Illuminate\Database\Eloquent\Builder|Production whereCost($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Production whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Production whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Production whereQty($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Production whereRecipeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Production whereUpdatedAt($value)
 */
	class Production extends \Eloquent {}
}

namespace App\Models{
/**
 * Class Recipe
 *
 * @package App\Models
 * @version October 15, 2022, 2:44 am UTC
 * @property integer $user_id
 * @property string $description
 * @property number $price
 * @property integer $stock_qty
 * @property number $cost
 * @property number $avg_cost
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Ingredient[] $ingredients
 * @property-read int|null $ingredients_count
 * @method static \Database\Factories\RecipeFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Recipe newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Recipe newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Recipe query()
 * @method static \Illuminate\Database\Eloquent\Builder|Recipe whereAvgCost($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Recipe whereCost($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Recipe whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Recipe whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Recipe whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Recipe wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Recipe whereStockQty($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Recipe whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Recipe whereUserId($value)
 */
	class Recipe extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\User
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Sanctum\PersonalAccessToken[] $tokens
 * @property-read int|null $tokens_count
 * @method static \Database\Factories\UserFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 */
	class User extends \Eloquent implements \Tymon\JWTAuth\Contracts\JWTSubject {}
}

