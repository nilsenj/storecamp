<?php

namespace App\Core\Presenters;

use App\Core\Transformers\CartItemTransformer;
use RepositoryLab\Repository\Presenter\FractalPresenter;

/**
 * Class CartItemPresenter
 *
 * @package namespace App\Core\Presenters;
 */
class CartItemPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new CartItemTransformer();
    }
}
