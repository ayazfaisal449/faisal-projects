<?php

namespace Cranium\VideoGallery\Models;

use Cranium\VideoGallery\Models\Video;
use Illuminate\Support\Facades\Validator;

class VideoProvider
{

    /**
     * Gets a video by id.
     *
     * @param id
     * @return Video
     * @author Chris @ Cranium Creations
     */
    public function getById($id)
    {
        return $this->createModel()->newQuery()
            ->find($id);
    }

    /**
     * Gets all videos.
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
     * Gets all videos by category id
     *
     * @param Int
     * @return Collection
     * @author Chris @ Cranium Creations
     */
    public function getByCategoryId($id)
    {
        return $this->createModel()->newQuery()
            ->where('category_id', '=', $id)
            ->get();
    }

    /**
     * Gets all videos by type id
     *
     * @param Int
     * @return Collection
     * @author Chris @ Cranium Creations
     */
    public function getByTypeId($id)
    {
        return $this->createModel()->newQuery()
            ->where('type_id', '=', $id)
            ->get();
    }

    /**
     * Validates data from ardent
     *
     * @param array()
     * @return Collection of errors
     * @author Kevin @ Cranium Creations
     */
    public function validate($data)
    {
        $rules = array(
            'title' => 'required',
            'code' => 'required',
            'type_id' => 'required',
        );
        $video = $this->createModel()->fill($data);
        $validator = Validator::make($video->toArray(), $rules);

        if ($validator->fails()) {
            return [
                'status' => true,
                'messageBag' => $validator->errors()
            ];
        }

        return ['status' => false];
    }

    /**
     * Creates a new video instance for querying.
     *
     * @return video
     * @author Chris @ Cranium Creations
     */
    private function createModel()
    {
        return new Video();
    }
}
