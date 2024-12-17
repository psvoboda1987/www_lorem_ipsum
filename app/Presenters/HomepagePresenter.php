<?php

declare(strict_types=1);

namespace App\Presenters;

use App\Components\LoremForm;
use App\Components\TransformForm;
use Nette\Application\UI\Form;

final class HomepagePresenter extends BasePresenter
{
    public function __construct(
        private readonly LoremForm $loremForm,
        private readonly TransformForm $transformForm
    )
    {
    }

    public function createComponentGenerateForm(): Form
    {
        return $this->loremForm->create();
    }


    public function createComponentTransformForm(): Form
    {
        return $this->transformForm->create();
    }
}
