<?php

namespace App\Core\Presenters;

use App\Transformers\AttributeGroupTransformer;
use RepositoryLab\Repository\Presenter\FractalPresenter;

/**
 * Class AttributeGroupPresenter
 *
 * @package namespace App\Core\Presenters;
 */
class AttributeGroupPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new AttributeGroupTransformer();
    }
}
