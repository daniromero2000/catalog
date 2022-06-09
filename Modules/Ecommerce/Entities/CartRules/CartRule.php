<?php

namespace Modules\Ecommerce\Entities\CartRules;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Customers\Entities\CustomerGroups\CustomerGroup;
use Modules\Ecommerce\Entities\CartRuleCoupons\CartRuleCoupon;

class CartRule extends Model
{
    use SoftDeletes;
    protected $table = 'cart_rules';

    protected $fillable = [
        'name',
        'description',
        'starts_from',
        'ends_till',
        'status',
        'coupon_type',
        'use_auto_generation',
        'usage_per_customer',
        'uses_per_coupon',
        'times_used',
        'condition_type',
        'conditions',
        'actions',
        'end_other_rules',
        'uses_attribute_conditions',
        'action_type',
        'discount_amount',
        'discount_quantity',
        'discount_step',
        'apply_to_shipping',
        'free_shipping',
        'sort_order'
    ];


    protected $hidden = [
        'deleted_at',
        'updated_at',
        'id'
    ];

    protected $guarded = ['id', 'created_at', 'updated_at', 'deleted_at'];

    protected $dates  = ['created_at', 'updated_at', 'deleted_at'];

    /**
     * Get the customer groups that owns the cart rule.
     */
    public function customer_groups(): BelongsToMany
    {
        return $this->belongsToMany(CustomerGroup::class(), 'cart_rule_customer_groups');
    }

    /**
     * Get the coupons that owns the cart rule.
     */
    public function coupons(): HasOne
    {
        return $this->hasOne(CartRuleCoupon::class());
    }

    /**
     * Get primary coupon code for cart rule.
     */
    public function coupon_code()
    {
        return $this->coupons()->where('is_primary', 1);
    }

    /**
     * Get primary coupon code for cart rule.
     */
    public function getCouponCodeAttribute()
    {
        $coupon = $this->coupon_code()->first();

        if (!$coupon) {
            return;
        }

        return $coupon->code;
    }
}
