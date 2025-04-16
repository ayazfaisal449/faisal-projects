<?php

namespace Cranium\PhotoGallery\Models;

use Cranium\PhotoGallery\Models\PhotoCategory;
use Illuminate\Support\Facades\Validator;
class PhotoCategoryProvider
{

    /**
     * Creates a new photo category.
     *
     * @param array
     * @return PhotoCategory
     * @author Chris @ Cranium Creations
     */
    public function create($data)
    {
        $category = $this->createModel();

        return $category->create($data);
    }

    /**
     * Gets a photo category by id.
     *
     * @param Int
     * @return PhotoCategory
     * @author Chris @ Cranium Creations
     */
    public function getById($id)
    {
        return $this->createModel()->newQuery()
            ->find($id);
    }

    /**
     * Gets all photo categories.
     *
     * @return Collection
     * @author Chris @ Cranium Creations
     */
    public function getAll()
    {
        // return $this->createModel()->newQuery()
        //     ->get();

        // new query
        return $this->createModel()->newQuery()
            ->orderBy('id', 'desc') // Order by ID in descending order
            ->get();
        // new query
    }

    /**
     * Creates a model for querying.
     *
     * @return PhotoCategory
     * @author Chris @ Cranium Creations
     */
    private function createModel()
    {
        return new PhotoCategory();
    }

    

    public function validate($data, $id = null)
    {
        // Define validation rules
        $rules = array (
            'name' => 'required|unique:photo_category',
        );

        // Create Validator instance
        $validator = Validator::make($data, $rules);

        // Check if validation fails
        if ($validator->fails()) {
            return [
                'status' => true,
                'messageBag' => $validator->errors()
            ];
        }

        // If validation passes, fill and return status
        if ($id) {
            $photoCategory = $this->getById($id);
        } else {
            $photoCategory = $this->createModel();
        }

        $photoCategory->fill($data);

        return ['status' => false]; // Validation passed, no errors
    }
}
