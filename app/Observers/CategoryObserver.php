<?php

namespace App\Observers;

use App\Models\Category;

class CategoryObserver
{
    /**
     * Handle the category "created" event.
     *
     * @param Category $category
     * @return void
     */
    public function created(Category $category)
    {
        //
    }

    /**
     * Handle the category "updated" event.
     *
     * @param Category $category
     * @return void
     */
    public function updated(Category $category)
    {
        //
    }

    /**
     * Handle the category "deleted" event.
     *
     * @param Category $category
     * @return void
     */
    public function deleted(Category $category)
    {
        $category->products()->delete();
    }

    /**
     * Handle the category "restored" event.
     *
     * @param Category $category
     * @return void
     */
    public function restored(Category $category)
    {
        //
    }

    /**
     * Handle the category "force deleted" event.
     *
     * @param Category $category
     * @return void
     */
    public function forceDeleted(Category $category)
    {
        //
    }
}
