<?php namespace Cranium\VideoGallery\Models;

use Cranium\VideoGallery\Models\VideoCategory;

class VideoCategoryProvider {

    /**
     * Creates a new video category.
     *
     * @param array
     * @return VideoCategory
     * @author Chris @ Cranium Creations
     */
    public function create($data)
    {
        $category = $this->createModel();

        return $category->create($data);
    }

    /**
     * Gets a video category by id.
     *
     * @param Int
     * @return VideoCategory
     * @author Chris @ Cranium Creations
     */
    public function getById($id)
    {
        return $this->createModel()->newQuery()
            ->find($id);
    }

    /**
     * Gets all video categories.
     *
     * @return Collection
     * @author Chris @ Cranium Creations
     */
    public function getAll()
    {
        return $this->createModel()->newQuery()
            ->get();
    }

    /**
     * Gets all video categories sorted by name.
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
     * Creates a model for querying.
     *
     * @return VideoCategory
     * @author Chris @ Cranium Creations
     */
    private function createModel()
    {
        return new VideoCategory();	
    }
}