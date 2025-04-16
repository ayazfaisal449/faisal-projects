<?php namespace Cranium\PhotoGallery\Models;

use Cranium\PhotoGallery\Models\Photo;

class PhotoProvider {

    /**
     * Gets a photo by id.
     *
     * @param id
     * @return Photo
     * @author Chris @ Cranium Creations
     */
    public function getById($id)
    {
        return $this->createModel()->newQuery()
            ->find($id);	
    }

    /**
     * Gets all photos.
     *
     * @param status
     * @author Chris @ Cranium Creations
     */
    public function getAll()
    {
        return $this->createModel()->newQuery()
            ->get();
    }

    /**
     * Gets all photos by category id
     *
     * @param Int
     * @return Collection
     * @author Chris @ Cranium Creations
     */
    public function getByCategoryId($id)
    {
        // return $this->createModel()->newQuery()
        //     ->where('category_id','=',$id)
        //     ->get();

                    // new query
        return $this->createModel()->newQuery()
        ->where('category_id', '=', $id)
        ->orderBy('id', 'desc') // Order by ID in descending order
        ->get();
    // new query
    }

    /**
     * Creates a new photo instance for querying.
     *
     * @return Photo
     * @author Chris @ Cranium Creations
     */
    private function createModel()
    {
        return new Photo();		
    }
}