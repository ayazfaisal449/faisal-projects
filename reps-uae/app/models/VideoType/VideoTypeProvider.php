<?php namespace Cranium\VideoGallery\Models;

use Cranium\VideoGallery\Models\VideoType;

class VideoTypeProvider {

    /**
     * Gets a video type by id.
     *
     * @param id
     * @return VideoType
     * @author Chris @ Cranium Creations
     */
    public function getById($id)
    {
        return $this->createModel()->newQuery()
            ->find($id);
    }

    /**
     * Gets all video types.
     *
     * @author Chris @ Cranium Creations
     */
    public function getAll()
    {
        return $this->createModel()->newQuery()
            ->get();
    }

    /**
     * Gets all video types in alphabetical order.
     *
     * @return Collection
     * @author Chris @ Cranium Creations
     */
    public function getAllSortedByName()
    {
        return $this->createModel()->newQuery()
            ->orderBy('name','ASC')
            ->get();
    }

    /**
     * Creates a new video type instance for querying.
     *
     * @return VideoType
     * @author Chris @ Cranium Creations
     */
    private function createModel()
    {
        return new VideoType();		
    }
}