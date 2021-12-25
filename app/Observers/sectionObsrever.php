<?php

namespace App\Observers;

use App\Models\Product;
use App\Models\Section;

class sectionObsrever
{
    /**
     * Handle the Section "created" event.
     *
     * @param  \App\Models\Section  $section
     * @return void
     */
    public function created(Section $section)
    {
        //
    }

    /**
     * Handle the Section "updated" event.
     *
     * @param  \App\Models\Section  $section
     * @return void
     */
    public function updated(Section $section)
    {
        foreach($section -> products as $product){
            $prod = Product::with('brand')->findOrFail($product -> id);  //get product's brand information
            if ($prod ->brand -> status != 0) {
                $product ->update([
                    'status' => $section -> status ,
                ]);
            }
        }
    }

    /**
     * Handle the Section "deleted" event.
     *
     * @param  \App\Models\Section  $section
     * @return void
     */
    public function deleting(Section $section)
    {
        $product_count =count($section -> products);  // Count Product in this section
        if($product_count > 0){  // Check if thier are products in this section
            for ($i=0; $i< $product_count;$i++) {
                $photos_count = count($section -> products[$i] -> photos); // Count photos in this product
                if($photos_count > 0){  // Check if thier are products in this section
                    for ($x=0; $x< $photos_count;$x++){
                        removeImage($section -> products[$i] -> photos[$x] , 'images/Product/'); // Delete photo
                    }
                }
            }
        }
        $section -> products() -> forceDelete();
    }

    /**
     * Handle the Section "restored" event.
     *
     * @param  \App\Models\Section  $section
     * @return void
     */
    public function restored(Section $section)
    {
        //
    }

    /**
     * Handle the Section "force deleted" event.
     *
     * @param  \App\Models\Section  $section
     * @return void
     */
    public function forceDeleted(Section $section)
    {
        //
    }
}
