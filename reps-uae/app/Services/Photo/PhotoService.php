<?php

namespace Cranium\PhotoGallery\Services;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\File;

use Cranium\PhotoGallery\Models\PhotoProvider;
use Cranium\PhotoGallery\Models\PhotoCategoryProvider;

class PhotoService
{

    public function __construct(
        PhotoProvider $photoProvider,
        PhotoCategoryProvider $photoCategoryProvider
    ) {
        $this->photoProvider = $photoProvider;
        $this->photoCategoryProvider = $photoCategoryProvider;
    }

    /**
     * Gets the photo provider for simple lookups.
     *
     * @return PhotoProvider
     * @author Chris @ Cranium Creations
     */
    public function getPhotoProvider()
    {
        return $this->photoProvider;
    }

    /**
     * Gets the photo category provider for simple lookups.
     *
     * @return PhotoCategoryProvider
     * @author Chris @ Cranium Creations
     */
    public function getPhotoCategoryProvider()
    {
        return $this->photoCategoryProvider;
    }
    /**************************************************************************
     *
     * Photo Category
     *
     *************************************************************************/

    /**
     * Creates a photo category.
     *
     * @param String
     * @param String
     * @param Int
     * @return Boolean
     * @author Chris @ Cranium Creations
     */
    public function saveCategory(
        $name,
        $description = null,
        $id = null
    ) {
        $data = array(
            'name' => $name,
            'description' => $description
        );
        //echo $name;exit;

        //check validation 
        $errors = $this->photoCategoryProvider
            ->validate(array('name' => $name), $id);


        if ($id) {
            //check errors before update
            if ($errors['status']) {
                return array(
                    'status' => $errors['status'],
                    'messageBag' => $errors['messageBag']
                );
            } else {
                $category = $this->photoCategoryProvider->getById($id);
                $category->fill($data);
                $status = $category->updateUniques();

                return array(
                    'status' => $errors['status'],
                    'update' => $status
                );
            }
        } else {
            //check errors before create
            if ($errors['status']) {
                return array(
                    'errors' => array(
                        'status' => $errors['status'],
                        'update' => false,
                        'messageBag' => $errors['messageBag']
                    )
                );
            } else {
                return array(
                    'errors' => array(
                        'status' => $errors['status'],
                        'update' => true,
                    ),
                    'category' => $this->photoCategoryProvider->create($data)
                );
            }
        }

        return $status;
    }

    /**
     * Changes the status of a photo category.
     *
     * @param Int
     * @return Boolean
     * @author Chris @ Cranium Creations
     */
    public function changeCategoryStatus($id)
    {
        $category = $this->photoCategoryProvider->getById($id);
        $category->is_active = !$category->is_active;
        $category->updateUniques();

        return $category->is_active;
    }

    /**
     * Deletes a photo category.
     *
     * @param Int
     * @return Boolean
     * @author Chris @ Cranium Creations
     */
    public function deleteCategory($id)
    {
        $category = $this->photoCategoryProvider->getById($id);
        $path = $path = Config::get('photo.imagePath') . '/' . $id;

        FILE::deleteDirectory($path);

        return $category->delete();
    }

    /*
     * Gives All photo categories with photos
     *
     * @param 
     * @return Collection
     * Created By Kevin @ Cranium Creations
     */
    public function getAllGalleries()
{
    $galleries = $this->photoCategoryProvider->getAll();

    $data = array();

    foreach ($galleries as $gallery) {
        //get the photos 
        $photos = $this->photoProvider->getByCategoryId($gallery->id);

        $photoArr = array();
        foreach ($photos as $photo) {
            array_push($photoArr, $photo->filename);
        }

        $data[] = array(
            'id' => $gallery->id,
            'name' => $gallery->name,
            'description' => $gallery->description,
            'photo' => $photoArr,
        );
    }
        
    $resultArray = array();

    foreach ($data as $item) {
        $id = $item['id'];
        $name = $item['name'];
        $photos = $item['photo'];

        if (!isset($resultArray[$id])) {
            $resultArray[$id] = array(
                'name' => $name,
                'photo' => $photos
            );
        } else {
            $resultArray[$id]['photo'] = $photos;
        }
    }
    // echo '<pre>'; print_r($resultArray); echo '</pre>'; exit;
    return $resultArray;
}


    /**************************************************************************
     *
     * Photo Methods
     *
     *************************************************************************/

    /**
     * Creates a photo.
     *
     * @param String
     * @param String
     * @param Int
     * @param File
     * @param Int
     * @return Boolean
     * @author Chris @ Cranium Creations
     */
    public function savePhoto(
        $title,
        $description,
        $categoryId,
        $image,
        $id = null
    ) {
        $photoData = array(
            'title' => $title,
            'description' => $description,
        );

        $imagePath = Config::get('photo.imagePath') . '/' . $categoryId;

        $status = false;
        if ($id) {
            $photo = $this->photoProvider->getById($id);
            if ($image) {
                $photoData['filename'] = $image->getClientOriginalName();
                File::delete($imagePath . '/' . $photo->filename);
                $image->move($imagePath, $image->getClientOriginalName());
            }
            $photoData['category_id'] = $categoryId;
            $photo->fill($photoData);

            $status = $photo->save();
        } else {
            $photoData['filename'] = $image->getClientOriginalName();

            if (!FILE::isDirectory($imagePath)) {
                FILE::makeDirectory($imagePath, 0755, true);
            }
            $image->move($imagePath, $image->getClientOriginalName());

            $category = $this->photoCategoryProvider->getById($categoryId);
            $status = $category->addPhoto($photoData) ? true : false;
        }

        return $status;
    }

    /**
     * Changes the status of a photo.
     *
     * @param Int
     * @return Boolean
     * @author Chris @ Cranium Creations
     */
    public function changePhotoStatus($id)
    {
        $photo = $this->photoProvider->getById($id);

        return $photo->changeStatus();
    }

    /**
     * Delets a photo.
     *
     * @param Int
     * @return Boolean
     * @author Chris @ Cranium Creations
     */
    public function deletePhoto($photoGalery, $fileName, $id)
    {
        $photo = $this->photoProvider->getById($id);
        $path = Config::get('photo.imagePath') . '/' .
            $photoGalery . '/' . $fileName;

        if (File::isFile($photo)) {
            File::delete($photo);
        }

        return $photo->delete();
    }
}
