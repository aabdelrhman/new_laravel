<?php

namespace App\Observers;

use App\Models\Brand;
use App\Models\Product;

class brandObserver
{
    /**
     * Handle the Brand "created" event.
     *
     * @param  \App\Models\Brand  $brand
     * @return void
     */
    public function created(Brand $brand)
    {
        //
    }

    /**
     * Handle the Brand "updated" event.
     *
     * @param  \App\Models\Brand  $brand
     * @return void
     */
    public function updated(Brand $brand)
    {
        foreach($brand -> products as $product){
            $prod = Product::with('section')->findOrFail($product -> id);
            if ($prod ->section -> status != 0) {
                $product ->update([
                    'status' => $brand -> status ,
                ]);
            }
        }
    }

    /**
     * Handle the Brand "deleted" event.
     *
     * @param  \App\Models\Brand  $brand
     * @return void
     */
    public function deleting(Brand $brand)
    {
        $product_count =count($brand -> products);  // Count Product in this brand
        if($product_count > 0){  // Check if thier are products in this brand
            for ($i=0; $i< $product_count;$i++) {
                $photos_count = count($brand -> products[$i] -> photos); // Count photos in this product
                if($photos_count > 0){  // Check if thier are products in this brand
                    for ($x=0; $x< $photos_count;$x++){
                        removeImage($brand -> products[$i] -> photos[$x] , 'images/Product/'); // Delete photo
                    }
                }
            }
        }
        $brand -> products() -> forceDelete();
    }

    /**
     * Handle the Brand "restored" event.
     *
     * @param  \App\Models\Brand  $brand
     * @return void
     */
    public function restored(Brand $brand)
    {
        //
    }

    /**
     * Handle the Brand "force deleted" event.
     *
     * @param  \App\Models\Brand  $brand
     * @return void
     */
    public function forceDeleted(Brand $brand)
    {
        //
    }
}
