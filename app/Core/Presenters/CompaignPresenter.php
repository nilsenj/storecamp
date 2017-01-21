<?php

namespace App\Core\Presenters;

use App\Transformers\CompaignTransformer;
use RepositoryLab\Repository\Presenter\FractalPresenter;

/**
 * Class CompaignPresenter
 *
 * @package namespace App\Core\Presenters;
 */
class CompaignPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new CompaignTransformer();
    }
}
