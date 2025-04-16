<?php namespace Cranium\VideoGallery\Services;

use Cranium\VideoGallery\Models\VideoProvider;
use Cranium\VideoGallery\Models\VideoTypeProvider;
use Cranium\VideoGallery\Models\VideoCategoryProvider;

class VideoService {
    
    protected $videoProvider;
    protected $videoTypeProvider;
    protected $videoCategoryProvider;

    public function __construct(VideoProvider $videoProvider,
        VideoTypeProvider $videoTypeProvider,
        VideoCategoryProvider $videoCategoryProvider)
    {
        $this->videoProvider = $videoProvider;
        $this->videoTypeProvider = $videoTypeProvider;
        $this->videoCategoryProvider = $videoCategoryProvider;
    }

    /**
     * Gets the video provider for simple lookups.
     *
     * @return VideoProvider
     * @author Chris @ Cranium Creations
     */
    public function getVideoProvider()
    {
        return $this->videoProvider; 
    }

    /**
     * Gets the video type provider for simple lookups.
     *
     * @return VideoTypeProvider
     * @author Chris @ Cranium Creations
     */
    public function getVideoTypeProvider()
    {
        return $this->videoTypeProvider; 
    }

    /**
     * Gets the video category provider for simple lookups.
     *
     * @return VideoCategoryProvider
     * @author Chris @ Cranium Creations
     */
    public function getVideoCategoryProvider()
    {
        return $this->videoCategoryProvider; 
    }

    /**************************************************************************
     *
     * Video Category
     *
     *************************************************************************/

    /**
     * Creates a video category.
     *
     * @param String
     * @param String
     * @param Int
     * @return Boolean
     * @author Chris @ Cranium Creations
     */
    public function saveCategory($name, $description = null,
        $id = null)
    {
        $data = array(
            'name' => $name,
            'description' => $description,
        );

        $status = false;
        if ($id)
        {
            $category = $this->videoCategoryProvider->getById($id);
            $category->fill($data);
            $status = $category->save();
        }
        else
        {
            $status = $this->videoCategoryProvider->create($data)
                ? true : false;
        }

        return $status;
    }

    /**
     * Changes the status of a video category.
     *
     * @param Int
     * @return Boolean
     * @author Chris @ Cranium Creations
     */
    public function changeCategoryStatus($id)
    {
        $category = $this->videoCategoryProvider->getById($id); 
        
        return $category->changeStatus();
    }

    /**
     * Deletes a video category.
     *
     * @param Int
     * @return Boolean
     * @author Chris @ Cranium Creations
     */
    public function deleteCategory($id)
    {
        $category = $this->videoCategoryProvider->getById($id);

        return $category->delete(); 
    }

    /**************************************************************************
     *
     * Video Methods
     *
     *************************************************************************/

    /**
     * Creates a video.
     *
     * @param String
     * @param String
     * @param Int
     * @param Int
     * @param String
     * @param Int
     * @return Boolean
     * @author Chris @ Cranium Creations
     */
    public function saveVideo($title, $description, $categoryId, $typeId,
        $code, $id = null)
    {
        $videoData = array(
            'title' => $title,
            'description' => $description,
            'type_id' => $typeId,
            'code' => $code,
        );

        $status = false;
        if ($id)
        {
            $errors = $this->videoProvider->validate($videoData);
            
            if(!$errors['status'])
            {
                $video = $this->videoProvider->getById($id);
                $videoData['category_id'] = $categoryId;
                $video->fill($videoData);
                
                return array(
                        'status'=>$errors['status'],
                        'update'=>$video->save()
                        );
            }
            else 
            {
                 return array(
                            'status'=>$errors['status'],
                            'messageBag'=>$errors['messageBag']
                        );
            }
        }
        else
        {
            $errors = $this->videoProvider->validate($videoData);
             
            if(!$errors['status'])
            {
                $category = $this->videoCategoryProvider->getById($categoryId);
                $status = $category->addVideo($videoData) ? true : false;
               
                 return array(
                        'status'=>$errors['status'],
                        'add'=>$status
                        );
            }
            else 
            {
                 return array(
                            'status'=>$errors['status'],
                            'messageBag'=>$errors['messageBag']
                        );
            }
            
        }

    }

    /**
     * Changes the status of a video.
     *
     * @param Int
     * @return Boolean
     * @author Chris @ Cranium Creations
     */
    public function changeVideoStatus($id)
    {
        $video = $this->videoProvider->getById($id); 
        
        return $video->changeStatus();
    }

    /**
     * Deletes a video.
     *
     * @param Int
     * @return Boolean
     * @author Chris @ Cranium Creations
     */
    public function deleteVideo($id)
    {
        $video = $this->videoProvider->getById($id);

        return $video->delete(); 
    }
}
