<?php

namespace PalPalani\BayLinks\Resources;

use PalPalani\BayLinks\Objects\CategoryNaturalArea;
use PalPalani\BayLinks\Objects\Listed;
use PalPalani\BayLinks\Objects\NaturalArea;
use PalPalani\BayLinks\Requests\CategoryNaturalArea\GetAllCategoryNaturalAreaRequest;
use PalPalani\BayLinks\Requests\CategoryNaturalArea\GetCategoryNaturalAreaAllNaturalAreaRequest;
use PalPalani\BayLinks\Requests\CategoryNaturalArea\GetCategoryNaturalAreaRequest;

final class CategoryNaturalAreaResource extends Resource
{
    /**
     * @return mixed|Listed<CategoryNaturalArea>
     */
    public function all(): mixed
    {
        return $this->connector->send(new GetAllCategoryNaturalAreaRequest())->dto();
    }

    /**
     * @return mixed|CategoryNaturalArea
     */
    public function get(int $categoryNaturalAreaId): mixed
    {
        return $this->connector->send(new GetCategoryNaturalAreaRequest($categoryNaturalAreaId))->dto();
    }

    /**
     * @return mixed|Listed<NaturalArea>
     */
    public function naturalAreas(int $categoryNaturalAreaId): mixed
    {
        return $this->connector->send(new GetCategoryNaturalAreaAllNaturalAreaRequest($categoryNaturalAreaId))->dto();
    }
}
