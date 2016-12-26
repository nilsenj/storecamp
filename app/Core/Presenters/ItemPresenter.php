<?php

namespace App\Core\Presenters;

use App\Core\Transformers\ItemTransformer;
use RepositoryLab\Repository\Presenter\FractalPresenter;

/**
 * Class ItemPresenter
 *
 * @package namespace FBA\Presenters;
 */
class ItemPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new ItemTransformer();
    }
}
